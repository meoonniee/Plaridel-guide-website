<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In — Plaridel, Bulacan Guide</title>
    <style>
        :root {
            --bg: #f6f4ef;
            --surface: #ffffff;
            --ink: #1b2420;
            --muted: #55625b;
            --primary: #1f5c47;
            --primary-dark: #154232;
            --accent: #b87a28;
            --border: #dfe4de;
            --danger-bg: #fdecec;
            --danger-ink: #991b1b;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            background: var(--bg);
            color: var(--ink);
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 1.25rem;
        }
        .card {
            width: 100%;
            max-width: 420px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.75rem;
            box-shadow: 0 12px 30px rgba(27, 36, 32, 0.08);
        }
        .badge {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--primary);
            background: #e7f1ec;
            padding: 0.3rem 0.65rem;
            border-radius: 999px;
            margin-bottom: 0.65rem;
        }
        h1 {
            margin: 0 0 0.4rem;
            font-size: 1.45rem;
        }
        p.sub {
            margin: 0 0 1.25rem;
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.45;
        }
        .alert {
            padding: 0.75rem 0.9rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            font-size: 0.88rem;
            background: var(--danger-bg);
            color: var(--danger-ink);
            border: 1px solid #f5c2c2;
        }
        .field {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            font-size: 0.86rem;
            font-weight: 600;
            margin-bottom: 0.35rem;
        }
        input {
            width: 100%;
            padding: 0.7rem 0.8rem;
            border: 1px solid #c9d1cb;
            border-radius: 10px;
            font-size: 0.95rem;
        }
        input:focus {
            outline: 2px solid rgba(31, 92, 71, 0.25);
            border-color: var(--primary);
        }
        .btn {
            width: 100%;
            padding: 0.78rem 1rem;
            border: none;
            border-radius: 10px;
            background: var(--primary);
            color: #fff;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
        }
        .btn:hover {
            background: var(--primary-dark);
        }
        .hint {
            margin-top: 1rem;
            padding-top: 0.9rem;
            border-top: 1px dashed var(--border);
            font-size: 0.82rem;
            color: var(--muted);
        }
        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: var(--primary);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="card">
        <span class="badge">Plaridel Guide Admin</span>
        <h1>Tour Coordinator Sign In</h1>
        <p class="sub">Sign in with your administrator account to manage appointment statuses, bookings, and tour slots.</p>

        @if (session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="field">
                <label for="email">Admin Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email', $defaultEmail) }}"
                    required
                    autofocus
                >
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                >
            </div>

            <button type="submit" class="btn">Sign In to Admin Panel</button>
        </form>

        <div class="hint">
            Demo Credentials: <strong>{{ $defaultEmail }}</strong> / <strong>admin123</strong>
        </div>

        <a href="{{ route('home') }}" class="back-link">&larr; Back to Plaridel Travel Guide</a>
    </div>
</body>
</html>
