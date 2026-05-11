<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Aditto Portfolio' }}</title>
    <style>
        :root {
            --bg: #f6f8f9;
            --surface: #ffffff;
            --ink: #152029;
            --muted: #4f6575;
            --accent: #0c7c59;
            --accent-2: #f4a259;
            --line: #d9e2e9;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Georgia, Cambria, 'Times New Roman', serif;
            color: var(--ink);
            background: radial-gradient(circle at top right, #e8f4ef, transparent 45%), var(--bg);
        }
        a { color: inherit; }
        .container {
            width: min(1100px, 92vw);
            margin: 0 auto;
        }
        .nav {
            position: sticky;
            top: 0;
            background: rgba(246, 248, 249, 0.92);
            backdrop-filter: blur(6px);
            border-bottom: 1px solid var(--line);
            z-index: 50;
        }
        .nav-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }
        .brand {
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--accent);
            text-decoration: none;
        }
        .menu {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .menu a {
            text-decoration: none;
            font-size: 0.96rem;
            color: var(--muted);
            padding: 0.35rem 0.6rem;
            border-radius: 8px;
        }
        .menu form { margin: 0; }
        .menu button {
            border: 1px solid #d4dde4;
            background: #fff;
            color: var(--muted);
            border-radius: 8px;
            font: inherit;
            font-size: 0.96rem;
            padding: 0.35rem 0.6rem;
            cursor: pointer;
        }
        .menu a:hover { background: #e7efec; color: var(--ink); }
        main { padding: 2rem 0 4rem; }
        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 1.1rem;
        }
        .grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        }
        h1, h2, h3 { margin-top: 0; }
        .muted { color: var(--muted); }
        .badge {
            display: inline-block;
            padding: 0.2rem 0.5rem;
            background: #e8f4ef;
            border: 1px solid #cbe3da;
            border-radius: 999px;
            margin-right: 0.35rem;
            margin-bottom: 0.35rem;
            font-size: 0.8rem;
        }
        .btn {
            border: 1px solid var(--accent);
            background: var(--accent);
            color: white;
            border-radius: 10px;
            padding: 0.6rem 0.95rem;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
        .btn-alt {
            background: transparent;
            color: var(--accent);
        }
        input, textarea, select {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 0.65rem;
            margin-top: 0.35rem;
            margin-bottom: 0.85rem;
            font: inherit;
        }
        .alert {
            background: #e9f7ef;
            border: 1px solid #b8e1c8;
            padding: 0.7rem;
            border-radius: 10px;
            margin-bottom: 1rem;
        }
        footer {
            border-top: 1px solid var(--line);
            padding: 1.5rem 0;
            color: var(--muted);
            font-size: 0.9rem;
        }
        @media (max-width: 720px) {
            .nav-inner { align-items: flex-start; gap: 0.8rem; flex-direction: column; }
        }
    </style>
</head>
<body class="{{ !empty($isHomeHero) ? 'home-hero-mode' : '' }}">
    @if (! empty($isHomeHero))
        @yield('content')
    @else
        <nav class="nav">
        @if (request()->is('admin*') && !request()->routeIs('admin.login'))
            <div class="container nav-inner">
                <a class="brand" href="{{ route('home') }}">Aditto Saha</a>
                <div class="menu">
                    <a href="{{ route('home') }}">View Site</a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        @else
            <div class="container nav-inner">
                <a class="brand" href="{{ route('home') }}">Aditto Saha</a>
                <div class="menu">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('projects.index') }}">Projects</a>
                    <a href="{{ route('about') }}">About</a>
                    <a href="{{ route('contact.index') }}">Contact</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('admin.login') }}">Admin Login</a>
                    @endauth
                </div>
            </div>
        @endif
        </nav>

        <main style="{{ (request()->is('admin*') && !request()->routeIs('admin.login')) ? 'padding: 0;' : '' }}">
            <div class="container" style="{{ (request()->is('admin*') && !request()->routeIs('admin.login')) ? 'display: flex; gap: 2rem; max-width: 1400px; width: 95vw; margin: 2rem auto;' : '' }}">
                @if (request()->is('admin*') && !request()->routeIs('admin.login'))
                    <aside style="width: 250px; flex-shrink: 0;">
                        <nav style="display: flex; flex-direction: column; gap: 0.5rem; background: var(--surface); padding: 1.5rem; border-radius: 16px; border: 1px solid var(--line);">
                            <div style="font-weight: bold; margin-bottom: 0.5rem; color: var(--muted); text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em;">Admin Menu</div>
                            <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; padding: 0.5rem 0.8rem; border-radius: 8px; color: {{ request()->routeIs('admin.dashboard') ? 'var(--accent)' : 'var(--ink)' }}; background: {{ request()->routeIs('admin.dashboard') ? '#e8f4ef' : 'transparent' }};">Dashboard</a>
                            <a href="{{ route('admin.settings.index') }}" style="text-decoration: none; padding: 0.5rem 0.8rem; border-radius: 8px; color: {{ request()->routeIs('admin.settings.*') ? 'var(--accent)' : 'var(--ink)' }}; background: {{ request()->routeIs('admin.settings.*') ? '#e8f4ef' : 'transparent' }};">Settings</a>
                            <a href="{{ route('admin.projects.index') }}" style="text-decoration: none; padding: 0.5rem 0.8rem; border-radius: 8px; color: {{ request()->routeIs('admin.projects.*') ? 'var(--accent)' : 'var(--ink)' }}; background: {{ request()->routeIs('admin.projects.*') ? '#e8f4ef' : 'transparent' }};">Projects</a>
                            <a href="{{ route('admin.skills.index') }}" style="text-decoration: none; padding: 0.5rem 0.8rem; border-radius: 8px; color: {{ request()->routeIs('admin.skills.*') ? 'var(--accent)' : 'var(--ink)' }}; background: {{ request()->routeIs('admin.skills.*') ? '#e8f4ef' : 'transparent' }};">Skills</a>
                            <a href="{{ route('admin.achievements.index') }}" style="text-decoration: none; padding: 0.5rem 0.8rem; border-radius: 8px; color: {{ request()->routeIs('admin.achievements.*') ? 'var(--accent)' : 'var(--ink)' }}; background: {{ request()->routeIs('admin.achievements.*') ? '#e8f4ef' : 'transparent' }};">Achievements</a>
                            <a href="{{ route('admin.messages.index') }}" style="text-decoration: none; padding: 0.5rem 0.8rem; border-radius: 8px; color: {{ request()->routeIs('admin.messages.*') ? 'var(--accent)' : 'var(--ink)' }}; background: {{ request()->routeIs('admin.messages.*') ? '#e8f4ef' : 'transparent' }};">Messages</a>
                        </nav>
                    </aside>
                    <div style="flex-grow: 1; min-width: 0;">
                @endif

                @if (session('success'))
                    <div class="alert">{{ session('success') }}</div>
                @endif

                @yield('content')

                @if (request()->is('admin*') && !request()->routeIs('admin.login'))
                    </div>
                @endif
            </div>
        </main>

        <footer>
            <div class="container">
                Built with Laravel by Aditto Saha.
            </div>
        </footer>
    @endif
</body>
</html>
