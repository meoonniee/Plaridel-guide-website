<?php

namespace App\Services;

use Illuminate\Support\Str;
use RuntimeException;

class BookingJsonService
{
    private string $bookingsPath;
    private string $schedulesPath;

    public function __construct()
    {
        $privateDir = storage_path('app/private');
        if (!is_dir($privateDir)) {
            mkdir($privateDir, 0775, true);
        }

        $this->bookingsPath = $privateDir . DIRECTORY_SEPARATOR . 'bookings.json';
        $this->schedulesPath = $privateDir . DIRECTORY_SEPARATOR . 'schedules.json';

        $this->ensureSeededFiles();
    }

    private function ensureSeededFiles(): void
    {
        if (!file_exists($this->schedulesPath)) {
            $defaultSchedules = [
                'slots' => [
                    '08:00 AM - Heritage Walk',
                    '10:00 AM - River & Nature Tour',
                    '01:30 PM - Cultural & Culinary Stop',
                    '03:30 PM - Sunset Heritage Visit',
                ],
                'closed_dates' => [],
                'max_per_slot' => 15,
            ];
            $this->writeJsonLocked($this->schedulesPath, $defaultSchedules);
        }

        if (!file_exists($this->bookingsPath)) {
            $defaultBookings = [
                [
                    'reference_code' => 'PLR-2026-1001',
                    'visitor_name' => 'Maria Santos',
                    'email' => 'maria.santos@example.com',
                    'phone' => '09171234567',
                    'attraction' => 'Plaridel Church & Heritage Plaza',
                    'visit_date' => now()->addDays(2)->toDateString(),
                    'time_slot' => '08:00 AM - Heritage Walk',
                    'guests' => 2,
                    'status' => 'Confirmed',
                    'notes' => 'Interested in historical architecture and bell tower stories.',
                    'created_at' => now()->toDateTimeString(),
                ],
                [
                    'reference_code' => 'PLR-2026-1002',
                    'visitor_name' => 'Jose Reyes',
                    'email' => 'jose.reyes@example.com',
                    'phone' => '09187654321',
                    'attraction' => 'Angat River & Nature Trail',
                    'visit_date' => now()->addDays(4)->toDateString(),
                    'time_slot' => '10:00 AM - River & Nature Tour',
                    'guests' => 3,
                    'status' => 'Pending',
                    'notes' => 'Morning birdwatching and riverside walk.',
                    'created_at' => now()->toDateTimeString(),
                ],
            ];
            $this->writeJsonLocked($this->bookingsPath, $defaultBookings);
        }
    }

    public function getSchedules(): array
    {
        $data = $this->readJsonLocked($this->schedulesPath);
        return [
            'slots' => $data['slots'] ?? [],
            'closed_dates' => $data['closed_dates'] ?? [],
            'max_per_slot' => (int) ($data['max_per_slot'] ?? 15),
        ];
    }

    public function updateSchedules(array $slots, array $closedDates, int $maxPerSlot): array
    {
        $cleanSlots = array_values(array_filter(array_map('trim', $slots), fn($v) => $v !== ''));
        $cleanDates = array_values(array_unique(array_filter(array_map('trim', $closedDates), fn($v) => $v !== '')));

        $payload = [
            'slots' => $cleanSlots,
            'closed_dates' => $cleanDates,
            'max_per_slot' => max(1, $maxPerSlot),
        ];

        $this->writeJsonLocked($this->schedulesPath, $payload);
        return $payload;
    }

    public function getAllBookings(): array
    {
        $rows = $this->readJsonLocked($this->bookingsPath);
        return is_array($rows) ? array_values($rows) : [];
    }

    public function findByReference(string $refCode): ?array
    {
        $needle = strtoupper(trim($refCode));
        foreach ($this->getAllBookings() as $booking) {
            if (strtoupper((string) ($booking['reference_code'] ?? '')) === $needle) {
                return $booking;
            }
        }
        return null;
    }

    public function createBooking(array $input): array
    {
        $handle = fopen($this->bookingsPath, 'c+');
        if ($handle === false) {
            throw new RuntimeException('Unable to open bookings storage file.');
        }

        try {
            if (!flock($handle, LOCK_EX)) {
                throw new RuntimeException('Unable to acquire exclusive file lock on bookings storage.');
            }

            rewind($handle);
            $raw = stream_get_contents($handle);
            $bookings = json_decode($raw ?: '[]', true);
            if (!is_array($bookings)) {
                $bookings = [];
            }

            $schedules = $this->getSchedules();
            if (in_array($input['visit_date'], $schedules['closed_dates'], true)) {
                throw new RuntimeException('Selected visit date is currently closed for tours.');
            }

            $bookedGuests = 0;
            foreach ($bookings as $row) {
                if (($row['status'] ?? '') === 'Cancelled') {
                    continue;
                }
                if (
                    ($row['visit_date'] ?? '') === $input['visit_date'] &&
                    ($row['time_slot'] ?? '') === $input['time_slot']
                ) {
                    $bookedGuests += (int) ($row['guests'] ?? 0);
                }
            }

            $requestedGuests = (int) $input['guests'];
            if (($bookedGuests + $requestedGuests) > $schedules['max_per_slot']) {
                throw new RuntimeException('Selected time slot does not have enough remaining guest capacity.');
            }

            $refCode = $this->generateUniqueReferenceCode($bookings);

            $record = [
                'reference_code' => $refCode,
                'visitor_name' => trim($input['visitor_name']),
                'email' => trim($input['email']),
                'phone' => trim($input['phone']),
                'attraction' => trim($input['attraction']),
                'visit_date' => trim($input['visit_date']),
                'time_slot' => trim($input['time_slot']),
                'guests' => $requestedGuests,
                'status' => 'Pending',
                'notes' => trim((string) ($input['notes'] ?? '')),
                'created_at' => now()->toDateTimeString(),
            ];

            $bookings[] = $record;

            ftruncate($handle, 0);
            rewind($handle);
            fwrite($handle, json_encode($bookings, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            fflush($handle);

            return $record;
        } finally {
            flock($handle, LOCK_UN);
            fclose($handle);
        }
    }

    public function updateStatus(string $refCode, string $newStatus): bool
    {
        $allowed = ['Pending', 'Confirmed', 'Completed', 'Cancelled'];
        if (!in_array($newStatus, $allowed, true)) {
            return false;
        }

        $handle = fopen($this->bookingsPath, 'c+');
        if ($handle === false) {
            throw new RuntimeException('Unable to open bookings storage file.');
        }

        try {
            if (!flock($handle, LOCK_EX)) {
                throw new RuntimeException('Unable to acquire lock for status update.');
            }

            rewind($handle);
            $raw = stream_get_contents($handle);
            $bookings = json_decode($raw ?: '[]', true);
            if (!is_array($bookings)) {
                return false;
            }

            $updated = false;
            foreach ($bookings as &$row) {
                if (strtoupper((string) ($row['reference_code'] ?? '')) === strtoupper(trim($refCode))) {
                    $row['status'] = $newStatus;
                    $updated = true;
                    break;
                }
            }
            unset($row);

            if ($updated) {
                ftruncate($handle, 0);
                rewind($handle);
                fwrite($handle, json_encode(array_values($bookings), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
                fflush($handle);
            }

            return $updated;
        } finally {
            flock($handle, LOCK_UN);
            fclose($handle);
        }
    }

    public function deleteBooking(string $refCode): bool
    {
        $handle = fopen($this->bookingsPath, 'c+');
        if ($handle === false) {
            throw new RuntimeException('Unable to open bookings storage file.');
        }

        try {
            if (!flock($handle, LOCK_EX)) {
                throw new RuntimeException('Unable to acquire lock for booking deletion.');
            }

            rewind($handle);
            $raw = stream_get_contents($handle);
            $bookings = json_decode($raw ?: '[]', true);
            if (!is_array($bookings)) {
                return false;
            }

            $target = strtoupper(trim($refCode));
            $filtered = [];
            $deleted = false;

            foreach ($bookings as $row) {
                if (strtoupper((string) ($row['reference_code'] ?? '')) === $target) {
                    $deleted = true;
                    continue;
                }
                $filtered[] = $row;
            }

            if ($deleted) {
                ftruncate($handle, 0);
                rewind($handle);
                fwrite($handle, json_encode(array_values($filtered), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
                fflush($handle);
            }

            return $deleted;
        } finally {
            flock($handle, LOCK_UN);
            fclose($handle);
        }
    }

    private function generateUniqueReferenceCode(array $existingBookings): string
    {
        $existingCodes = array_map(
            fn($b) => strtoupper((string) ($b['reference_code'] ?? '')),
            $existingBookings
        );

        do {
            $code = 'PLR-' . now()->year . '-' . random_int(1000, 9999);
        } while (in_array(strtoupper($code), $existingCodes, true));

        return $code;
    }

    private function readJsonLocked(string $path): array
    {
        if (!file_exists($path)) {
            return [];
        }

        $handle = fopen($path, 'r');
        if ($handle === false) {
            throw new RuntimeException("Unable to open JSON file: {$path}");
        }

        try {
            if (!flock($handle, LOCK_SH)) {
                throw new RuntimeException("Unable to acquire shared lock on JSON file: {$path}");
            }

            $contents = stream_get_contents($handle);
            $decoded = json_decode($contents ?: '[]', true);
            return is_array($decoded) ? $decoded : [];
        } finally {
            flock($handle, LOCK_UN);
            fclose($handle);
        }
    }

    private function writeJsonLocked(string $path, array $data): void
    {
        $handle = fopen($path, 'c+');
        if ($handle === false) {
            throw new RuntimeException("Unable to open JSON file for writing: {$path}");
        }

        try {
            if (!flock($handle, LOCK_EX)) {
                throw new RuntimeException("Unable to acquire exclusive lock on JSON file: {$path}");
            }

            ftruncate($handle, 0);
            rewind($handle);
            fwrite($handle, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            fflush($handle);
        } finally {
            flock($handle, LOCK_UN);
            fclose($handle);
        }
    }
}