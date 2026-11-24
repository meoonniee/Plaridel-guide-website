<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plaridel, Bulacan — Heritage & Nature Travel Guide</title>
    <style>
        :root {
            --bg: #f6f4ef;
            --surface: #ffffff;
            --surface-alt: #eef2ec;
            --ink: #1b2420;
            --muted: #55625b;
            --primary: #1f5c47;
            --primary-dark: #154232;
            --accent: #b87a28;
            --accent-soft: #fdf4e4;
            --border: #dce2da;
            --success-bg: #e7f6ed;
            --success-ink: #166534;
            --danger-bg: #fdecec;
            --danger-ink: #991b1b;
            --radius: 14px;
            --shadow: 0 8px 24px rgba(27, 36, 32, 0.06);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            background: var(--bg);
            color: var(--ink);
            line-height: 1.55;
        }

        .container {
            width: 100%;
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 1.15rem;
        }

        /* Sticky Navbar */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            min-height: 64px;
        }

        .brand {
            font-weight: 800;
            font-size: 1.02rem;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 0.35rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--ink);
            font-size: 0.88rem;
            font-weight: 600;
            padding: 0.42rem 0.7rem;
            border-radius: 8px;
        }

        .nav-links a:hover {
            background: var(--surface-alt);
            color: var(--primary);
        }

        .nav-cta {
            background: var(--primary) !important;
            color: #fff !important;
        }

        /* Hero */
        .hero {
            padding: 2.5rem 0 2rem;
            background: linear-gradient(135deg, #163f30 0%, #245d48 60%, #7d5622 100%);
            color: #fff;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 0.3rem 0.75rem;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 600;
            margin-bottom: 0.85rem;
        }

        .hero h1 {
            margin: 0 0 0.7rem;
            font-size: clamp(1.85rem, 4vw, 2.75rem);
            line-height: 1.18;
            max-width: 22ch;
        }

        .hero p {
            margin: 0 0 1.35rem;
            max-width: 62ch;
            color: rgba(255, 255, 255, 0.92);
            font-size: 1rem;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.68rem 1.05rem;
            border-radius: 10px;
            border: 1px solid transparent;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
            transition: 0.15s ease;
        }

        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); }

        .btn-accent { background: var(--accent); color: #fff; }
        .btn-accent:hover { filter: brightness(0.94); }

        .btn-light { background: #fff; color: var(--primary-dark); }
        .btn-light:hover { background: #f2f5f2; }

        .btn-outline {
            background: transparent;
            color: var(--ink);
            border-color: var(--border);
        }
        .btn-outline:hover { background: var(--surface-alt); }

        .btn-danger {
            background: var(--danger-bg);
            color: var(--danger-ink);
            border-color: #f4c7c7;
        }

        .btn-sm { padding: 0.42rem 0.72rem; font-size: 0.82rem; }

        /* Sections */
        section.guide-section {
            padding: 2.35rem 0;
            border-bottom: 1px solid var(--border);
        }

        .section-head {
            margin-bottom: 1.25rem;
        }

        .section-head h2 {
            margin: 0 0 0.3rem;
            font-size: 1.5rem;
        }

        .section-head p {
            margin: 0;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1rem;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.2rem;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.2rem;
            box-shadow: var(--shadow);
        }

        /* Filter pills */
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 0.45rem;
            margin-bottom: 1.15rem;
        }

        .filter-btn {
            padding: 0.45rem 0.85rem;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--ink);
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
        }

        .filter-btn.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .tag {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.22rem 0.6rem;
            border-radius: 999px;
            background: var(--surface-alt);
            color: var(--primary);
            margin-bottom: 0.55rem;
        }

        .card h3 {
            margin: 0 0 0.4rem;
            font-size: 1.08rem;
        }

        .card p.desc {
            margin: 0 0 0.8rem;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .meta-line {
            font-size: 0.82rem;
            color: var(--muted);
            margin-bottom: 0.85rem;
        }

        /* Itinerary Tabs */
        .tab-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .tab-btn {
            padding: 0.52rem 0.9rem;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--surface);
            font-weight: 600;
            font-size: 0.88rem;
            cursor: pointer;
        }

        .tab-btn.active {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .stop-item {
            display: grid;
            grid-template-columns: 95px 1fr;
            gap: 0.8rem;
            padding: 0.75rem 0;
            border-bottom: 1px dashed var(--border);
        }

        .stop-item:last-child { border-bottom: none; }

        .stop-time {
            font-weight: 700;
            color: var(--primary);
            font-size: 0.86rem;
        }

        /* Alerts */
        .alert {
            padding: 0.8rem 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        .alert-success {
            background: var(--success-bg);
            color: var(--success-ink);
            border: 1px solid #b7e4c7;
        }
        .alert-error {
            background: var(--danger-bg);
            color: var(--danger-ink);
            border: 1px solid #f5c2c2;
        }

        /* Forms */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 0.85rem;
        }

        .field {
            margin-bottom: 0.85rem;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-size: 0.84rem;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        input, select, textarea {
            width: 100%;
            padding: 0.62rem 0.75rem;
            border: 1px solid #c9d1cb;
            border-radius: 9px;
            font-size: 0.92rem;
            font-family: inherit;
            background: #fff;
        }

        input:focus, select:focus, textarea:focus {
            outline: 2px solid rgba(31, 92, 71, 0.22);
            border-color: var(--primary);
        }

        .lookup-row {
            display: flex;
            gap: 0.55rem;
        }

        .lookup-row input { flex: 1; }

        .result-box {
            margin-top: 1rem;
            padding: 0.95rem;
            border-radius: 10px;
            background: var(--accent-soft);
            border: 1px solid #ecd3a6;
            font-size: 0.9rem;
        }

        /* Stats & Table */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 0.75rem;
            margin-bottom: 1.1rem;
        }

        .stat-box {
            background: var(--surface-alt);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.75rem;
            text-align: center;
        }

        .stat-num {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--primary);
        }

        .stat-lbl {
            font-size: 0.78rem;
            color: var(--muted);
        }

        .table-wrap {
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        th, td {
            padding: 0.65rem 0.75rem;
            border-bottom: 1px solid var(--border);
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: var(--surface-alt);
            font-weight: 700;
            white-space: nowrap;
        }

        .status-pill {
            display: inline-block;
            padding: 0.2rem 0.55rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            background: var(--surface-alt);
        }

        /* Modal */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 19, 0.55);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            z-index: 100;
        }

        .modal-backdrop.open { display: flex; }

        .modal-card {
            background: #fff;
            border-radius: 16px;
            max-width: 540px;
            width: 100%;
            padding: 1.4rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        .modal-head {
            display: flex;
            justify-content: space-between;
            align-items: start;
            gap: 1rem;
            margin-bottom: 0.75rem;
        }

        .modal-close {
            background: var(--surface-alt);
            border: none;
            border-radius: 8px;
            width: 34px;
            height: 34px;
            font-size: 1.1rem;
            cursor: pointer;
        }

        footer {
            padding: 1.6rem 0;
            text-align: center;
            color: var(--muted);
            font-size: 0.86rem;
        }

        @media (max-width: 640px) {
            .nav-links a { font-size: 0.8rem; padding: 0.35rem 0.5rem; }
            .stop-item { grid-template-columns: 1fr; gap: 0.2rem; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container nav-inner">
            <a href="#top" class="brand">Plaridel, Bulacan Guide</a>
            <div class="nav-links">
                <a href="#overview">Overview</a>
                <a href="#attractions">Attractions</a>
                <a href="#itineraries">Itineraries</a>
                <a href="#tips">Tips &amp; Map</a>
                <a href="#appointment" class="nav-cta">Book Tour</a>
                @if ($isAdmin)
                    <a href="#admin-panel">Admin</a>
                @else
                    <a href="{{ route('admin.login.form') }}">Admin Login</a>
                @endif
            </div>
        </div>
    </nav>

    <header id="top" class="hero">
        <div class="container">
            <span class="hero-badge">Bulacan Heritage &amp; Nature Travel Guide</span>
            <h1>Explore Plaridel’s History, Riverside Breeze &amp; Local Flavors</h1>
            <p>Plan a relaxed day trip or half-day walk through Plaridel, Bulacan—from historic landmarks and cultural stops to riverside scenery and local merienda, complete with guided tour slot booking.</p>
            <div class="hero-actions">
                <a href="#appointment" class="btn btn-light">Book a Guided Tour Slot</a>
                <a href="#attractions" class="btn btn-accent">Browse Attractions</a>
            </div>
        </div>
    </header>

    <main>
        <!-- Overview -->
        <section id="overview" class="guide-section">
            <div class="container">
                <div class="section-head">
                    <h2>Why Visit Plaridel, Bulacan</h2>
                    <p>A welcoming municipality along Bulacan’s heritage and travel corridor where civic history meets everyday provincial warmth.</p>
                </div>
                <div class="grid-3">
                    <div class="card">
                        <span class="tag">Heritage</span>
                        <h3>Living Historical Roots</h3>
                        <p class="desc">Named after reformist writer Marcelo H. del Pilar, Plaridel connects town-center landmarks with Bulacan’s rich historical narrative.</p>
                    </div>
                    <div class="card">
                        <span class="tag">Nature</span>
                        <h3>Rivers &amp; Open Countryside</h3>
                        <p class="desc">Enjoy breezy river stretches, lush green corridors, and early-morning rural views that offer a calm change of pace.</p>
                    </div>
                    <div class="card">
                        <span class="tag">Culture &amp; Food</span>
                        <h3>Unrushed Local Hospitality</h3>
                        <p class="desc">Pair morning sightseeing with Bulacan kakanin, afternoon merienda stops, and easy neighborhood exploration.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Attractions -->
        <section id="attractions" class="guide-section">
            <div class="container">
                <div class="section-head">
                    <h2>Featured Attractions &amp; Stops</h2>
                    <p>Filter by interest or click any stop to view suggested visit times, duration, and highlights.</p>
                </div>

                <div class="filter-bar" role="tablist" aria-label="Filter attractions">
                    @foreach (['All', 'Heritage', 'Nature', 'Culinary', 'Culture'] as $cat)
                        <button
                            type="button"
                            class="filter-btn {{ $loop->first ? 'active' : '' }}"
                            data-filter="{{ $cat }}"
                            onclick="filterAttractions('{{ $cat }}', this)"
                        >{{ $cat }}</button>
                    @endforeach
                </div>

                <div class="grid-3" id="attractionsGrid">
                    @foreach ($attractions as $item)
                        <article class="card attraction-card" data-category="{{ $item['category'] }}">
                            <span class="tag">{{ $item['category'] }} &bull; {{ $item['barangay'] }}</span>
                            <h3>{{ $item['name'] }}</h3>
                            <p class="desc">{{ $item['summary'] }}</p>
                            <div class="meta-line">
                                <strong>Best Time:</strong> {{ $item['best_time'] }}<br>
                                <strong>Suggested Stay:</strong> {{ $item['duration'] }}
                            </div>
                            <button
                                type="button"
                                class="btn btn-outline btn-sm"
                                onclick='openAttractionModal(@json($item))'
                            >View Details &amp; Book</button>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Itineraries -->
        <section id="itineraries" class="guide-section">
            <div class="container">
                <div class="section-head">
                    <h2>Sample Itineraries</h2>
                    <p>Switch between suggested pacing options depending on how much time you have in Plaridel.</p>
                </div>

                <div class="tab-bar">
                    @foreach ($itineraries as $key => $itin)
                        <button
                            type="button"
                            class="tab-btn {{ $loop->first ? 'active' : '' }}"
                            onclick="switchItinerary('{{ $key }}', this)"
                        >{{ $itin['title'] }}</button>
                    @endforeach
                </div>

                @foreach ($itineraries as $key => $itin)
                    <div
                        class="card itinerary-panel"
                        id="itin-{{ $key }}"
                        style="{{ $loop->first ? '' : 'display: none;' }}"
                    >
                        <h3>{{ $itin['title'] }}</h3>
                        <p class="desc">{{ $itin['subtitle'] }}</p>
                        @foreach ($itin['stops'] as $stop)
                            <div class="stop-item">
                                <div class="stop-time">{{ $stop['time'] }}</div>
                                <div>
                                    <strong>{{ $stop['place'] }}</strong>
                                    <div style="color: var(--muted); font-size: 0.88rem;">{{ $stop['note'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Travel Tips & Map -->
        <section id="tips" class="guide-section">
            <div class="container">
                <div class="section-head">
                    <h2>Practical Travel Tips &amp; Location</h2>
                    <p>Helpful reminders for a smooth, comfortable visit around Plaridel, Bulacan.</p>
                </div>

                <div class="grid-2">
                    <div class="card">
                        <h3>Visitor Tips</h3>
                        <ul style="margin: 0.4rem 0 0; padding-left: 1.15rem; color: var(--muted);">
                            <li><strong>Start early:</strong> Morning hours (6:30 AM – 9:30 AM) offer cooler temperatures and quieter streets.</li>
                            <li><strong>Dress comfortably:</strong> Wear breathable clothing, walking shoes, and sun protection (cap, umbrella, water bottle).</li>
                            <li><strong>Respect heritage &amp; local spaces:</strong> Keep voices low near churches and ask permission before photographing residents or private property.</li>
                            <li><strong>Carry small cash:</strong> Useful for merienda stalls, local snacks, and minor transit expenses.</li>
                        </ul>
                    </div>

                    <div class="card">
                        <h3>Plaridel Location Reference</h3>
                        <p class="desc">Central Plaridel sits along key Bulacan roads with easy access to town-center landmarks and riverside routes.</p>
                        <iframe
                            title="Map of Plaridel, Bulacan"
                            src="https://www.openstreetmap.org/export/embed.html?bbox=120.8350%2C14.8680%2C120.8820%2C14.9050&amp;layer=mapnik&amp;marker=14.8856%2C120.8583"
                            style="width: 100%; height: 240px; border: 1px solid var(--border); border-radius: 10px;"
                            loading="lazy"
                        ></iframe>
                        <div style="margin-top: 0.65rem; font-size: 0.84rem; color: var(--muted);">
                            <a href="https://www.openstreetmap.org/?mlat=14.8856&amp;mlon=120.8583#map=15/14.8856/120.8583" target="_blank" rel="noopener">Open larger map in OpenStreetMap &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Appointment Booking & Reference Lookup -->
        <section id="appointment" class="guide-section">
            <div class="container">
                <div class="section-head">
                    <h2>Guided Tour Appointment &amp; Reference Lookup</h2>
                    <p>Reserve a tour slot (max {{ $schedules['max_per_slot'] }} guests per slot) or check an existing booking using your reference code.</p>
                </div>

                @if (session('booking_success'))
                    <div class="alert alert-success">{{ session('booking_success') }}</div>
                @endif

                @if (session('booking_error'))
                    <div class="alert alert-error">{{ session('booking_error') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        <strong>Please check your input:</strong>
                        <ul style="margin: 0.35rem 0 0; padding-left: 1.2rem;">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid-2">
                    <!-- Booking Form -->
                    <div class="card">
                        <h3>Book an Appointment</h3>
                        <form method="POST" action="{{ route('appointments.store') }}">
                            @csrf
                            <div class="form-grid">
                                <div class="field">
                                    <label for="visitor_name">Full Name *</label>
                                    <input id="visitor_name" type="text" name="visitor_name" value="{{ old('visitor_name') }}" required>
                                </div>

                                <div class="field">
                                    <label for="email">Email Address *</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                                </div>

                                <div class="field">
                                    <label for="phone">Mobile Number *</label>
                                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}" placeholder="09XX XXX XXXX" required>
                                </div>

                                <div class="field">
                                    <label for="guests">Number of Guests (1–{{ $schedules['max_per_slot'] }}) *</label>
                                    <input id="guests" type="number" name="guests" min="1" max="{{ $schedules['max_per_slot'] }}" value="{{ old('guests', 2) }}" required>
                                </div>

                                <div class="field full">
                                    <label for="attraction">Preferred Focus / Stop *</label>
                                    <select id="attraction" name="attraction" required>
                                        @foreach ($attractions as $item)
                                            <option value="{{ $item['name'] }}" {{ old('attraction') === $item['name'] ? 'selected' : '' }}>
                                                {{ $item['name'] }} ({{ $item['category'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="field">
                                    <label for="visit_date">Visit Date *</label>
                                    <input id="visit_date" type="date" name="visit_date" min="{{ now()->toDateString() }}" value="{{ old('visit_date', now()->addDay()->toDateString()) }}" required>
                                </div>

                                <div class="field">
                                    <label for="time_slot">Time Slot *</label>
                                    <select id="time_slot" name="time_slot" required>
                                        @foreach ($schedules['slots'] as $slot)
                                            <option value="{{ $slot }}" {{ old('time_slot') === $slot ? 'selected' : '' }}>{{ $slot }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="field full">
                                    <label for="notes">Special Requests or Notes (Optional)</label>
                                    <textarea id="notes" name="notes" rows="2" placeholder="Senior citizen companion, pace preference, etc.">{{ old('notes') }}</textarea>
                                </div>
                            </div>

                            @if (!empty($schedules['closed_dates']))
                                <div style="font-size: 0.8rem; color: var(--danger-ink); margin-bottom: 0.75rem;">
                                    <strong>Closed Dates:</strong> {{ implode(', ', $schedules['closed_dates']) }}
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Confirm Appointment Request</button>
                        </form>
                    </div>

                    <!-- Reference Code Lookup -->
                    <div class="card">
                        <h3>Check Appointment Status</h3>
                        <p class="desc">Enter your reference code (for example: <code>PLR-2026-1001</code>) to check your booking details.</p>

                        <form method="GET" action="{{ route('appointments.lookup') }}">
                            <div class="lookup-row">
                                <input
                                    type="text"
                                    name="ref"
                                    value="{{ $lookupRef }}"
                                    placeholder="e.g. PLR-2026-1001"
                                    required
                                >
                                <button type="submit" class="btn btn-accent">Lookup</button>
                            </div>
                        </form>

                        @if ($lookupSearched)
                            @if ($lookupResult)
                                <div class="result-box">
                                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;">
                                        <strong>Ref: {{ $lookupResult['reference_code'] }}</strong>
                                        <span class="status-pill">{{ $lookupResult['status'] }}</span>
                                    </div>
                                    <div style="margin-top: 0.5rem; font-size: 0.88rem;">
                                        <strong>Visitor:</strong> {{ $lookupResult['visitor_name'] }}<br>
                                        <strong>Stop/Focus:</strong> {{ $lookupResult['attraction'] }}<br>
                                        <strong>Schedule:</strong> {{ $lookupResult['visit_date'] }} &bull; {{ $lookupResult['time_slot'] }}<br>
                                        <strong>Guests:</strong> {{ $lookupResult['guests'] }}
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-error" style="margin-top: 1rem;">
                                    No appointment found matching reference code <strong>{{ $lookupRef }}</strong>.
                                </div>
                            @endif
                        @endif

                        <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border);">
                            <h4 style="margin: 0 0 0.35rem; font-size: 0.98rem;">Coordinator Access</h4>
                            <p class="desc" style="margin-bottom: 0.65rem;">
                                @if ($isAdmin)
                                    You are signed in as <strong>{{ session('plaridel_admin_email') }}</strong>.
                                @else
                                    Tour coordinators can sign in to update statuses, remove records, and manage tour slots.
                                @endif
                            </p>
                            @if ($isAdmin)
                                <a href="#admin-panel" class="btn btn-primary btn-sm">Jump to Admin Panel</a>
                            @else
                                <a href="{{ route('admin.login.form') }}" class="btn btn-outline btn-sm">Admin Sign In</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Protected Admin Management Section -->
        @if ($isAdmin)
            <section id="admin-panel" class="guide-section">
                <div class="container">
                    <div class="section-head" style="display: flex; justify-content: space-between; align-items: end; flex-wrap: wrap; gap: 0.75rem;">
                        <div>
                            <h2>Tour Coordinator Admin Panel</h2>
                            <p>Manage visitor appointments and update tour schedule slots (persisted in <code>storage/app/private/</code>).</p>
                        </div>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline btn-sm">Sign Out</button>
                        </form>
                    </div>

                    @if (session('admin_success'))
                        <div class="alert alert-success">{{ session('admin_success') }}</div>
                    @endif
                    @if (session('admin_error'))
                        <div class="alert alert-error">{{ session('admin_error') }}</div>
                    @endif

                    <div class="stats-row">
                        <div class="stat-box"><div class="stat-num">{{ $stats['total'] }}</div><div class="stat-lbl">Total Bookings</div></div>
                        <div class="stat-box"><div class="stat-num">{{ $stats['pending'] }}</div><div class="stat-lbl">Pending</div></div>
                        <div class="stat-box"><div class="stat-num">{{ $stats['confirmed'] }}</div><div class="stat-lbl">Confirmed</div></div>
                        <div class="stat-box"><div class="stat-num">{{ $stats['completed'] }}</div><div class="stat-lbl">Completed</div></div>
                        <div class="stat-box"><div class="stat-num">{{ $stats['cancelled'] }}</div><div class="stat-lbl">Cancelled</div></div>
                    </div>

                    <!-- Bookings Table -->
                    <div class="card" style="margin-bottom: 1.25rem;">
                        <h3>Appointments ({{ count($bookings) }})</h3>
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Ref Code</th>
                                        <th>Visitor</th>
                                        <th>Date &amp; Slot</th>
                                        <th>Guests</th>
                                        <th>Focus</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $b)
                                        <tr>
                                            <td><strong>{{ $b['reference_code'] }}</strong></td>
                                            <td>
                                                {{ $b['visitor_name'] }}<br>
                                                <span style="color: var(--muted); font-size: 0.78rem;">{{ $b['phone'] }}</span>
                                            </td>
                                            <td>
                                                {{ $b['visit_date'] }}<br>
                                                <span style="color: var(--muted); font-size: 0.78rem;">{{ $b['time_slot'] }}</span>
                                            </td>
                                            <td>{{ $b['guests'] }}</td>
                                            <td>{{ $b['attraction'] }}</td>
                                            <td><span class="status-pill">{{ $b['status'] }}</span></td>
                                            <td>
                                                <div style="display: flex; gap: 0.35rem; align-items: center; flex-wrap: wrap;">
                                                    <form method="POST" action="{{ route('admin.appointments.status', $b['reference_code']) }}" style="display: flex; gap: 0.3rem;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <select name="status" style="width: auto; padding: 0.3rem 0.45rem; font-size: 0.8rem;">
                                                            @foreach (['Pending', 'Confirmed', 'Completed', 'Cancelled'] as $st)
                                                                <option value="{{ $st }}" {{ ($b['status'] ?? '') === $st ? 'selected' : '' }}>{{ $st }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                    </form>

                                                    <form method="POST" action="{{ route('admin.appointments.delete', $b['reference_code']) }}" onsubmit="return confirm('Delete booking {{ $b['reference_code'] }}?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" style="text-align: center; color: var(--muted);">No appointments recorded yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Schedule Configuration -->
                    <div class="card">
                        <h3>Tour Schedule &amp; Capacity Settings</h3>
                        <form method="POST" action="{{ route('admin.schedules.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-grid">
                                <div class="field">
                                    <label for="slots_text">Available Time Slots (one per line)</label>
                                    <textarea id="slots_text" name="slots_text" rows="4" required>{{ implode("\n", $schedules['slots']) }}</textarea>
                                </div>

                                <div class="field">
                                    <label for="closed_dates_text">Closed Dates (YYYY-MM-DD, comma or line separated)</label>
                                    <textarea id="closed_dates_text" name="closed_dates_text" rows="4" placeholder="2026-12-25, 2027-01-01">{{ implode("\n", $schedules['closed_dates']) }}</textarea>
                                </div>

                                <div class="field">
                                    <label for="max_per_slot">Max Guests per Slot</label>
                                    <input id="max_per_slot" type="number" name="max_per_slot" min="1" max="200" value="{{ $schedules['max_per_slot'] }}" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-accent">Save Schedule Settings</button>
                        </form>
                    </div>
                </div>
            </section>
        @endif
    </main>

    <!-- Attraction Detail Modal -->
    <div id="attractionModal" class="modal-backdrop" onclick="if (event.target === this) closeAttractionModal()">
        <div class="modal-card">
            <div class="modal-head">
                <div>
                    <span class="tag" id="modalCategory"></span>
                    <h3 id="modalTitle" style="margin: 0;"></h3>
                </div>
                <button type="button" class="modal-close" onclick="closeAttractionModal()" aria-label="Close">&times;</button>
            </div>
            <p id="modalSummary" class="desc"></p>
            <div id="modalMeta" class="meta-line"></div>
            <ul id="modalHighlights" style="margin: 0 0 1rem; padding-left: 1.15rem; font-size: 0.9rem;"></ul>
            <div style="display: flex; gap: 0.6rem; justify-content: flex-end;">
                <button type="button" class="btn btn-outline btn-sm" onclick="closeAttractionModal()">Close</button>
                <a href="#appointment" id="modalBookBtn" class="btn btn-primary btn-sm" onclick="selectAttractionAndBook()">Book This Focus</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            Plaridel, Bulacan Heritage &amp; Nature Guide &bull; Built with Laravel &amp; JSON File Storage
        </div>
    </footer>

    <script>
        let currentModalAttractionName = '';

        function filterAttractions(category, btn) {
            document.querySelectorAll('.filter-btn').forEach(el => el.classList.remove('active'));
            if (btn) btn.classList.add('active');

            document.querySelectorAll('.attraction-card').forEach(card => {
                const match = category === 'All' || card.dataset.category === category;
                card.style.display = match ? '' : 'none';
            });
        }

        function switchItinerary(key, btn) {
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            if (btn) btn.classList.add('active');

            document.querySelectorAll('.itinerary-panel').forEach(panel => {
                panel.style.display = panel.id === 'itin-' + key ? '' : 'none';
            });
        }

        function openAttractionModal(item) {
            currentModalAttractionName = item.name || '';
            document.getElementById('modalCategory').textContent = (item.category || '') + ' • ' + (item.barangay || '');
            document.getElementById('modalTitle').textContent = item.name || '';
            document.getElementById('modalSummary').textContent = item.summary || '';
            document.getElementById('modalMeta').innerHTML =
                '<strong>Best Time:</strong> ' + (item.best_time || '') + '<br>' +
                '<strong>Duration:</strong> ' + (item.duration || '') + '<br>' +
                '<strong>Admission / Notes:</strong> ' + (item.fee || '') + '<br>' +
                '<strong>Coordinates:</strong> ' + (item.coordinates || '');

            const list = document.getElementById('modalHighlights');
            list.innerHTML = '';
            (item.highlights || []).forEach(h => {
                const li = document.createElement('li');
                li.textContent = h;
                list.appendChild(li);
            });

            document.getElementById('attractionModal').classList.add('open');
        }

        function closeAttractionModal() {
            document.getElementById('attractionModal').classList.remove('open');
        }

        function selectAttractionAndBook() {
            const select = document.getElementById('attraction');
            if (select && currentModalAttractionName) {
                for (const option of select.options) {
                    if (option.value === currentModalAttractionName) {
                        select.value = currentModalAttractionName;
                        break;
                    }
                }
            }
            closeAttractionModal();
        }
    </script>
</body>
</html>
