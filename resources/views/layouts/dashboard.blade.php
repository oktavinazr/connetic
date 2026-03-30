<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Connetic E-Modul')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --pink-50: #fdf2f8;
            --pink-100: #fce7f3;
            --pink-200: #fbcfe8;
            --pink-300: #f9a8d4;
            --pink-400: #f472b6;
            --pink-500: #ec4899;
            --pink-600: #db2777;
            --pink-700: #be185d;
            --bg: #fafbfe;
            --bg-card: #ffffff;
            --border: #eef0f6;
            --text: #111827;
            --text-muted: #6b7280;
            --shadow: 0 1px 4px rgba(0,0,0,0.03), 0 4px 20px rgba(0,0,0,0.04);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            position: sticky; top: 0; z-index: 50;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 40px;
            height: 64px;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }
        .navbar-left { display: flex; align-items: center; gap: 32px; }
        .navbar-logo {
            font-size: 18px; font-weight: 800;
            color: var(--pink-500);
            text-decoration: none;
        }
        .navbar-menu { display: flex; align-items: center; gap: 4px; }
        .nav-link {
            padding: 8px 14px;
            font-size: 13px; font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .nav-link:hover { color: var(--pink-600); background: var(--pink-50); }
        .nav-link.active { color: var(--pink-600); background: var(--pink-50); font-weight: 600; }

        /* Profile dropdown */
        .navbar-right { display: flex; align-items: center; gap: 12px; }
        .profile-trigger {
            display: flex; align-items: center; gap: 10px;
            padding: 4px 8px 4px 4px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.2s;
            position: relative;
            border: none; background: none;
            font-family: 'Inter', sans-serif;
        }
        .profile-trigger:hover { background: var(--pink-50); }

        .nav-avatar {
            width: 34px; height: 34px;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--pink-400), var(--pink-600));
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 13px;
            overflow: hidden; flex-shrink: 0;
        }
        .nav-avatar img { width: 100%; height: 100%; object-fit: cover; }

        .profile-name { font-size: 13px; font-weight: 600; color: var(--text); }
        .profile-chevron { font-size: 10px; color: var(--text-muted); transition: transform 0.2s; }

        /* Dropdown */
        .dropdown {
            position: absolute; top: calc(100% + 8px); right: 0;
            width: 200px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            padding: 6px;
            display: none;
            z-index: 100;
        }
        .dropdown.open { display: block; }
        .dropdown-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px;
            font-size: 13px; font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.15s;
            border: none; background: none; width: 100%;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }
        .dropdown-item:hover { background: var(--pink-50); color: var(--pink-600); }
        .dropdown-item.danger:hover { background: #fef2f2; color: #ef4444; }
        .dropdown-divider { height: 1px; background: var(--border); margin: 4px 0; }

        /* Container */
        .container { max-width: 960px; margin: 0 auto; padding: 32px 24px; }
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow);
        }
        .page-title { font-size: 22px; font-weight: 700; margin-bottom: 4px; }
        .page-sub { font-size: 14px; color: var(--text-muted); margin-bottom: 28px; }

        /* Toast */
        .toast {
            position: fixed; top: 80px; right: 24px;
            background: #059669; color: #fff;
            padding: 12px 20px; border-radius: 10px;
            font-size: 13px; font-weight: 500;
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
            z-index: 200;
            animation: slideIn 0.3s ease, fadeOut 0.3s ease 2.5s forwards;
        }
        @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes fadeOut { to { opacity: 0; transform: translateX(20px); } }

        @media (max-width: 640px) {
            .navbar { padding: 0 16px; }
            .navbar-left { gap: 16px; }
            .profile-name { display: none; }
            .container { padding: 24px 16px; }
        }
    </style>
    @yield('styles')
</head>
<body>
    @if(session('success'))
        <div class="toast">{{ session('success') }}</div>
    @endif

    <nav class="navbar">
        <div class="navbar-left">
            <a href="/" class="navbar-logo">✦ Connetic</a>
            <div class="navbar-menu">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('pembelajaran') }}" class="nav-link {{ request()->routeIs('pembelajaran') ? 'active' : '' }}">Pembelajaran</a>
            </div>
        </div>

        <div class="navbar-right">
            <button class="profile-trigger" onclick="document.getElementById('profileDropdown').classList.toggle('open')">
                <div class="nav-avatar">
                    @if(Auth::user()->getAvatarUrl())
                        <img src="{{ Auth::user()->getAvatarUrl() }}" alt="">
                    @else
                        {{ Auth::user()->getInitial() }}
                    @endif
                </div>
                <span class="profile-name">{{ Auth::user()->profile?->full_name ?? 'User' }}</span>
                <span class="profile-chevron">▼</span>

                <div class="dropdown" id="profileDropdown">
                    <a href="{{ route('profile') }}" class="dropdown-item">
                        <span>👤</span> Profil Saya
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item danger">
                            <span>🚪</span> Keluar
                        </button>
                    </form>
                </div>
            </button>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script>
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const trigger = document.querySelector('.profile-trigger');
            const dropdown = document.getElementById('profileDropdown');
            if (!trigger.contains(e.target)) {
                dropdown.classList.remove('open');
            }
        });
    </script>
</body>
</html>