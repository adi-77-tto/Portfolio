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
            background: #ffffff;
        }
        a { color: #60a5fa; }
        body.home-hero-mode a { color: inherit; }
        .container {
            width: min(1100px, 92vw);
            margin: 0 auto;
            padding: 0 1rem;
        }
        .nav {
            position: sticky;
            top: 0;
            background: rgba(12, 14, 18, 0.95);
            backdrop-filter: blur(6px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 50;
        }
        
        .nav.minimal {
            background: rgba(12, 14, 18, 0.95);
        }
        
        .nav.minimal .nav-inner {
            justify-content: flex-start;
            padding: 1rem 0 1rem 1rem;
        }
        
        .nav.minimal .brand {
            display: none;
        }
        
        .nav.minimal .menu {
            gap: 0;
        }
        
        .nav.minimal .menu a {
            color: #9ca3af;
            padding: 0.5rem;
        }
        
        .nav.minimal .menu a:hover {
            color: #60a5fa;
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
            color: #60a5fa;
            text-decoration: none;
        }
        
        body.home-hero-mode .brand {
            color: var(--accent);
        }
        .menu {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .menu a {
            text-decoration: none;
            font-size: 0.96rem;
            color: #9ca3af;
            padding: 0.35rem 0.6rem;
            border-radius: 8px;
        }
        .menu form { margin: 0; }
        .menu button {
            border: 1px solid rgba(148, 163, 184, 0.2);
            background: rgba(30, 41, 59, 0.5);
            color: #9ca3af;
            border-radius: 8px;
            font: inherit;
            font-size: 0.96rem;
            padding: 0.35rem 0.6rem;
            cursor: pointer;
        }
        .menu a:hover { 
            color: #60a5fa;
        }
        
        body.home-hero-mode .menu a {
            color: var(--muted);
        }
        
        body.home-hero-mode .menu button {
            border: 1px solid #d4dde4;
            background: #fff;
            color: var(--muted);
        }
        
        body.home-hero-mode .menu a:hover { 
            background: #e7efec; 
            color: var(--ink); 
        }
        main { padding: 2rem 0 4rem; }
        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 1.1rem;
            color: var(--ink);
        }
        
        body.home-hero-mode .card {
            background: var(--surface);
            border: 1px solid var(--line);
            color: var(--ink);
        }
        .grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        }
        .grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        }
        
        h1, h2, h3 { 
            margin-top: 0;
            color: var(--ink);
        }
        
        body.home-hero-mode h1,
        body.home-hero-mode h2,
        body.home-hero-mode h3 {
            color: var(--ink);
        }
        .muted { 
            color: #9ca3af;
        }
        
        body.home-hero-mode .muted {
            color: var(--muted);
        }
        .badge {
            display: inline-block;
            padding: 0.2rem 0.5rem;
            background: rgba(37, 99, 235, 0.2);
            border: 1px solid rgba(37, 99, 235, 0.4);
            border-radius: 999px;
            margin-right: 0.35rem;
            margin-bottom: 0.35rem;
            font-size: 0.8rem;
            color: #60a5fa;
        }
        
        body.home-hero-mode .badge {
            background: #e8f4ef;
            border: 1px solid #cbe3da;
            color: var(--ink);
        }
        .btn {
            border: 1px solid #2563eb;
            background: #2563eb;
            color: white;
            border-radius: 10px;
            padding: 0.6rem 0.95rem;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
        
        .btn:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
        }
        
        .btn-alt {
            background: transparent;
            color: #60a5fa;
            border-color: #60a5fa;
        }
        
        .btn-alt:hover {
            background: rgba(96, 165, 250, 0.1);
        }
        
        body.home-hero-mode .btn {
            border: 1px solid var(--accent);
            background: var(--accent);
            color: white;
        }
        
        body.home-hero-mode .btn-alt {
            background: transparent;
            color: var(--accent);
            border-color: var(--accent);
        }
        input, textarea, select {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 0.65rem;
            margin-top: 0.35rem;
            margin-bottom: 0.85rem;
            font: inherit;
            background: var(--surface);
            color: var(--ink);
        }
        
        input::placeholder, textarea::placeholder {
            color: var(--muted);
        }
        
        body.home-hero-mode input,
        body.home-hero-mode textarea,
        body.home-hero-mode select {
            border: 1px solid var(--line);
            background: var(--surface);
            color: var(--ink);
        }
        
        body.home-hero-mode input::placeholder,
        body.home-hero-mode textarea::placeholder {
            color: var(--muted);
        }
        .alert {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            padding: 0.7rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            color: #86efac;
        }
        
        body.home-hero-mode .alert {
            background: #e9f7ef;
            border: 1px solid #b8e1c8;
            color: var(--ink);
        }
        
        footer {
            border-top: 1px solid rgba(148, 163, 184, 0.2);
            padding: 1.5rem 0;
            color: #9ca3af;
            font-size: 0.9rem;
        }
        
        body.home-hero-mode footer {
            border-top: 1px solid var(--line);
            color: var(--muted);
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
        @if (request()->is('admin*') && !request()->routeIs('admin.login'))
            <nav class="nav">
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
            </nav>
        @else
            <nav class="nav minimal">
                <div class="container nav-inner">
                    <a class="brand" href="{{ route('home') }}">Aditto Saha</a>
                    <div class="menu">
                        <a href="{{ route('home') }}" title="Home">
                            <svg style="width: 24px; height: 24px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </a>
                    </div>
                </div>
            </nav>
        @endif

        <main style="{{ (request()->is('admin*') && !request()->routeIs('admin.login')) ? 'padding: 0;' : 'background: #0c0e12; color: #e5e7eb; min-height: 100vh;' }}">
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
