<?php

namespace App\Http\Controllers;

use App\Services\BookingJsonService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Throwable;

class PlaridelGuideController extends Controller
{
    private const ADMIN_EMAIL = 'admin@plaridel.local';
    // Password hash for: admin123
    private const ADMIN_PASSWORD_HASH = '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

    public function __construct(private readonly BookingJsonService $bookingService)
    {
    }

    public function index(Request $request): View
    {
        $attractions = [
            [
                'slug' => 'plaridel-church',
                'name' => 'St. James the Apostle Parish Church (Plaridel Church)',
                'category' => 'Heritage',
                'barangay' => 'Poblacion',
                'best_time' => 'Morning (6:30 AM - 9:30 AM)',
                'duration' => '1 - 1.5 hours',
                'fee' => 'Free admission (donations welcome)',
                'summary' => 'Historic colonial-era church and town square anchor reflecting Plaridel\'s civic and religious heritage in Bulacan.',
                'highlights' => [
                    'Classic brick and stone facade details',
                    'Quiet morning plaza atmosphere near municipal landmarks',
                    'Easy starting point for a walking heritage route',
                ],
                'coordinates' => '14.8856° N, 120.8583° E',
            ],
            [
                'slug' => 'angat-river-trail',
                'name' => 'Angat River & Riverside Nature Stretch',
                'category' => 'Nature',
                'barangay' => 'Riverside Barangays',
                'best_time' => 'Early Morning or Late Afternoon',
                'duration' => '1.5 - 2 hours',
                'fee' => 'Free / guide fee varies by local activity',
                'summary' => 'Breezy riverbanks, lush foliage, and open sky views offering a calm nature break from highway travel.',
                'highlights' => [
                    'Fresh riverside breeze and bird sightings',
                    'Scenic sunset and golden-hour photo spots',
                    'Pairs well with a slow afternoon nature walk',
                ],
                'coordinates' => '14.8920° N, 120.8675° E',
            ],
            [
                'slug' => 'marcelo-del-pilar-shrine',
                'name' => 'Marcelo H. del Pilar Heritage Tribute',
                'category' => 'Heritage',
                'barangay' => 'Poblacion / Bulacan Heritage Route',
                'best_time' => 'Morning (8:00 AM - 11:00 AM)',
                'duration' => '1 hour',
                'fee' => 'Free admission',
                'summary' => 'Honors Plaridel\'s namesake hero and Propaganda Movement legacy—connecting local history with Bulacan\'s broader story.',
                'highlights' => [
                    'Historical context on Plaridel\'s namesake and reformist heritage',
                    'Great stop for students, culture enthusiasts, and families',
                    'Short transfer from central Plaridel stops',
                ],
                'coordinates' => '14.8842° N, 120.8551° E',
            ],
            [
                'slug' => 'bulacan-agri-eco-fields',
                'name' => 'Plaridel Farmlands & Rural Eco-Corridor',
                'category' => 'Nature',
                'barangay' => 'Outer Barangays',
                'best_time' => '6:00 AM - 8:30 AM',
                'duration' => '1 - 2 hours',
                'fee' => 'Free / coordinate ahead for farm visits',
                'summary' => 'Wide paddy views, coconut and fruit trees, and traditional rural rhythm showcasing Bulacan\'s agricultural side.',
                'highlights' => [
                    'Unobstructed sunrise horizons and cool morning air',
                    'Authentic glimpse of provincial farming life',
                    'Ideal for photography and slow-travel itineraries',
                ],
                'coordinates' => '14.8765° N, 120.8490° E',
            ],
            [
                'slug' => 'bulacan-kakanin-eateries',
                'name' => 'Local Kakanin, Coffee & Heritage Merienda Stops',
                'category' => 'Culinary',
                'barangay' => 'Town Center',
                'best_time' => 'Mid-Morning or 3:00 PM Merienda',
                'duration' => '45 mins - 1 hour',
                'fee' => '₱80 - ₱250 per person',
                'summary' => 'Sample classic Bulacan sweets, rice delicacies, and comforting merienda plates between heritage and nature stops.',
                'highlights' => [
                    'Traditional Filipino snacks and afternoon refreshments',
                    'Convenient rest stop to recharge between walks',
                    'Easy takeaway options for pasalubong',
                ],
                'coordinates' => '14.8861° N, 120.8594° E',
            ],
            [
                'slug' => 'plaza-craft-market',
                'name' => 'Town Plaza & Local Craft / Pasalubong Corner',
                'category' => 'Culture',
                'barangay' => 'Poblacion',
                'best_time' => 'Late Afternoon (3:30 PM - 6:00 PM)',
                'duration' => '1 hour',
                'fee' => 'Free browsing',
                'summary' => 'Community gathering spaces, everyday local commerce, and small specialty finds celebrating Plaridel hospitality.',
                'highlights' => [
                    'Lively local atmosphere as heat eases in the late afternoon',
                    'Walkable access to snacks, transit, and civic landmarks',
                    'Great wrap-up stop before heading home',
                ],
                'coordinates' => '14.8859° N, 120.8588° E',
            ],
        ];

        $itineraries = [
            'half-day' => [
                'title' => 'Half-Day Heritage & Breeze (4 Hours)',
                'subtitle' => 'Ideal for a relaxed morning or afternoon loop around central Plaridel.',
                'stops' => [
                    ['time' => '08:00 AM', 'place' => 'St. James the Apostle Parish Church', 'note' => 'Start in cooler morning light and explore the historic town center.'],
                    ['time' => '09:15 AM', 'place' => 'Marcelo H. del Pilar Heritage Tribute', 'note' => 'Dive into local history and the story behind Plaridel\'s name.'],
                    ['time' => '10:15 AM', 'place' => 'Local Kakanin & Merienda Stop', 'note' => 'Take a break with Bulacan snacks and cold drinks.'],
                    ['time' => '11:00 AM', 'place' => 'Angat River & Riverside Nature Stretch', 'note' => 'Wrap up with open river views before midday heat peaks.'],
                ],
            ],
            'full-day' => [
                'title' => 'Full-Day Heritage, River & Countryside Loop',
                'subtitle' => 'Balanced full-day pace mixing landmarks, nature scenery, and local food.',
                'stops' => [
                    ['time' => '07:00 AM', 'place' => 'Plaridel Farmlands & Rural Eco-Corridor', 'note' => 'Catch cool morning air and open rural landscapes early.'],
                    ['time' => '08:45 AM', 'place' => 'St. James the Apostle Parish Church', 'note' => 'Visit the heritage church and surrounding plaza.'],
                    ['time' => '10:30 AM', 'place' => 'Marcelo H. del Pilar Heritage Tribute', 'note' => 'Connect historical context to the municipality\'s roots.'],
                    ['time' => '12:00 PM', 'place' => 'Lunch & Rest Break', 'note' => 'Refuel indoors and rest during peak afternoon warmth.'],
                    ['time' => '02:30 PM', 'place' => 'Angat River & Riverside Nature Stretch', 'note' => 'Enjoy riverside breezes and scenic views as afternoon light softens.'],
                    ['time' => '04:15 PM', 'place' => 'Town Plaza & Local Craft / Pasalubong Corner', 'note' => 'Pick up snacks or small keepsakes before departure.'],
                ],
            ],
            'nature-food' => [
                'title' => 'Nature & Culinary Slow Trail',
                'subtitle' => 'Designed for laid-back travelers focused on fresh air, scenery, and merienda.',
                'stops' => [
                    ['time' => '07:30 AM', 'place' => 'Plaridel Farmlands & Rural Eco-Corridor', 'note' => 'Morning walk along quiet green stretches.'],
                    ['time' => '09:30 AM', 'place' => 'Angat River & Riverside Nature Stretch', 'note' => 'Relax by the water and take unhurried photos.'],
                    ['time' => '11:00 AM', 'place' => 'Local Kakanin & Merienda Stop', 'note' => 'Taste sweet and savory local specialties.'],
                    ['time' => '03:30 PM', 'place' => 'Town Plaza & Local Craft / Pasalubong Corner', 'note' => 'Afternoon merienda and easy pasalubong wrap-up.'],
                ],
            ],
        ];

        $schedules = $this->bookingService->getSchedules();
        $allBookings = $this->bookingService->getAllBookings();
        $isAdmin = (bool) $request->session()->get('plaridel_admin_authenticated', false);

        $lookupRef = strtoupper(trim((string) $request->query('ref', '')));
        $lookupResult = null;
        $lookupSearched = false;

        if ($lookupRef !== '') {
            $lookupSearched = true;
            $lookupResult = $this->bookingService->findByReference($lookupRef);
        }

        $stats = [
            'total' => count($allBookings),
            'pending' => count(array_filter($allBookings, fn($b) => ($b['status'] ?? '') === 'Pending')),
            'confirmed' => count(array_filter($allBookings, fn($b) => ($b['status'] ?? '') === 'Confirmed')),
            'completed' => count(array_filter($allBookings, fn($b) => ($b['status'] ?? '') === 'Completed')),
            'cancelled' => count(array_filter($allBookings, fn($b) => ($b['status'] ?? '') === 'Cancelled')),
        ];

        return view('plaridel', [
            'attractions' => $attractions,
            'itineraries' => $itineraries,
            'schedules' => $schedules,
            'bookings' => $isAdmin ? array_reverse($allBookings) : [],
            'isAdmin' => $isAdmin,
            'adminEmail' => self::ADMIN_EMAIL,
            'lookupRef' => $lookupRef,
            'lookupResult' => $lookupResult,
            'lookupSearched' => $lookupSearched,
            'stats' => $stats,
        ]);
    }

    public function storeBooking(Request $request): RedirectResponse
    {
        $schedules = $this->bookingService->getSchedules();
        $maxGuests = max(1, (int) ($schedules['max_per_slot'] ?? 15));

        $validated = $request->validate([
            'visitor_name' => ['required', 'string', 'min:2', 'max:120'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'min:7', 'max:30'],
            'attraction' => ['required', 'string', 'max:150'],
            'visit_date' => ['required', 'date', 'after_or_equal:today'],
            'time_slot' => ['required', 'string', 'max:120'],
            'guests' => ['required', 'integer', 'min:1', "max:{$maxGuests}"],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        try {
            $created = $this->bookingService->createBooking($validated);

            return redirect()
                ->to(route('home', ['ref' => $created['reference_code']]) . '#appointment')
                ->with('booking_success', 'Appointment booked! Save your Reference Code: ' . $created['reference_code']);
        } catch (Throwable $e) {
            return redirect()
                ->to(route('home') . '#appointment')
                ->withInput()
                ->with('booking_error', $e->getMessage());
        }
    }

    public function lookupBooking(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'reference_code' => ['required', 'string', 'max:40'],
        ]);

        $code = strtoupper(trim($validated['reference_code']));

        return redirect()->to(route('home', ['ref' => $code]) . '#appointment');
    }

    public function showAdminLogin(Request $request): View|RedirectResponse
    {
        if ($request->session()->get('plaridel_admin_authenticated', false)) {
            return redirect()->to(route('home') . '#admin-panel');
        }

        return view('admin-login', [
            'defaultEmail' => self::ADMIN_EMAIL,
        ]);
    }

    public function loginAdmin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $emailMatches = strtolower(trim($credentials['email'])) === strtolower(self::ADMIN_EMAIL);
        $passwordMatches = Hash::check($credentials['password'], self::ADMIN_PASSWORD_HASH);

        if (!$emailMatches || !$passwordMatches) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Invalid admin email or password.');
        }

        $request->session()->regenerate();
        $request->session()->put('plaridel_admin_authenticated', true);
        $request->session()->put('plaridel_admin_email', self::ADMIN_EMAIL);

        return redirect()
            ->to(route('home') . '#admin-panel')
            ->with('admin_success', 'Signed in to Plaridel Guide Admin Panel.');
    }

    public function logoutAdmin(Request $request): RedirectResponse
    {
        $request->session()->forget(['plaridel_admin_authenticated', 'plaridel_admin_email']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->to(route('home') . '#appointment')
            ->with('admin_success', 'Signed out of admin session.');
    }

    public function updateBookingStatus(Request $request, string $refCode): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Pending,Confirmed,Completed,Cancelled'],
        ]);

        $updated = $this->bookingService->updateStatus($refCode, $validated['status']);

        return redirect()
            ->to(route('home') . '#admin-panel')
            ->with(
                $updated ? 'admin_success' : 'admin_error',
                $updated ? "Updated {$refCode} to {$validated['status']}." : "Booking {$refCode} was not found."
            );
    }

    public function deleteBooking(string $refCode): RedirectResponse
    {
        $deleted = $this->bookingService->deleteBooking($refCode);

        return redirect()
            ->to(route('home') . '#admin-panel')
            ->with(
                $deleted ? 'admin_success' : 'admin_error',
                $deleted ? "Deleted booking {$refCode}." : "Booking {$refCode} was not found."
            );
    }

    public function updateSchedules(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'slots_text' => ['required', 'string', 'max:2000'],
            'closed_dates_text' => ['nullable', 'string', 'max:2000'],
            'max_per_slot' => ['required', 'integer', 'min:1', 'max:200'],
        ]);

        $slots = preg_split('/\r\n|\r|\n/', $validated['slots_text']) ?: [];
        $closedDates = preg_split('/[\r\n,]+/', (string) ($validated['closed_dates_text'] ?? '')) ?: [];

        $this->bookingService->updateSchedules($slots, $closedDates, (int) $validated['max_per_slot']);

        return redirect()
            ->to(route('home') . '#admin-panel')
            ->with('admin_success', 'Tour schedule slots, capacity, and closed dates saved to schedules.json.');
    }
}