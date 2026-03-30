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
            height: 60px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }
        .navbar-left { display: flex; align-items: center; gap: 32px; }
        .navbar-logo {
            font-size: 17px; font-weight: 800;
            color: var(--pink-500);
            text-decoration: none;
        }
        .navbar-menu { display: flex; align-items: center; gap: 2px; }
        .nav-link {
            padding: 7px 14px;
            font-size: 13px; font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .nav-link:hover { color: var(--pink-600); background: var(--pink-50); }
        .nav-link.active { color: var(--pink-600); background: var(--pink-50); font-weight: 600; }

        /* Profile trigger */
        .profile-wrap { position: relative; }
        .profile-trigger {
            display: flex; align-items: center; gap: 10px;
            padding: 5px 10px 5px 5px;
            border-radius: 10px;
            cursor: pointer;
            border: 1px solid transparent;
            background: none;
            font-family: 'Inter', sans-serif;
            transition: all 0.15s;
        }
        .profile-trigger:hover { background: #f3f4f6; }
        .profile-trigger.open { background: #f3f4f6; border-color: var(--border); }

        .nav-avatar {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: #e5e7eb;
            display: flex; align-items: center; justify-content: center;
            color: #6b7280; font-weight: 700; font-size: 13px;
            overflow: hidden; flex-shrink: 0;
        }
        .nav-avatar img { width: 100%; height: 100%; object-fit: cover; }

        .profile-text {
            display: flex; flex-direction: column; align-items: flex-start;
            line-height: 1;
        }
        .profile-name { font-size: 13px; font-weight: 600; color: var(--text); }
        .profile-role { font-size: 11px; color: var(--text-muted); margin-top: 2px; }

        .profile-chevron {
            font-size: 10px; color: var(--text-muted);
            transition: transform 0.2s;
            margin-left: 2px;
        }
        .profile-trigger.open .profile-chevron { transform: rotate(180deg); }

        /* Dropdown */
        .dropdown {
            position: absolute; top: calc(100% + 6px); right: 0;
            width: 180px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            padding: 4px;
            display: none;
            z-index: 100;
        }
        .dropdown.open { display: block; }

        .dropdown-item {
            display: flex; align-items: center; gap: 8px;
            padding: 9px 12px;
            font-size: 13px; font-weight: 500;
            color: var(--text);
            text-decoration: none;
            border-radius: 7px;
            transition: all 0.12s;
            border: none; background: none; width: 100%;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }
        .dropdown-item:hover { background: #f3f4f6; }
        .dropdown-item.danger { color: var(--text-muted); }
        .dropdown-item.danger:hover { background: #fef2f2; color: #dc2626; }

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
            position: fixed; top: 76px; right: 24px;
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
            .profile-text { display: none; }
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

        <div class="profile-wrap">
            <button class="profile-trigger" id="profileTrigger">
                <div class="nav-avatar">
                    @if(Auth::user()->getAvatarUrl())
                        <img src="{{ Auth::user()->getAvatarUrl() }}" alt="">
                    @else
                        {{ Auth::user()->getInitial() }}
                    @endif
                </div>
                <div class="profile-text">
                    <span class="profile-name">{{ Auth::user()->profile?->full_name ?? 'User' }}</span>
                    <span class="profile-role">{{ Auth::user()->role === 'admin' ? 'Admin' : 'Siswa' }}</span>
                </div>
                <span class="profile-chevron">▼</span>
            </button>

            <div class="dropdown" id="profileDropdown">
                <a href="{{ route('profile') }}" class="dropdown-item">
                    👤 Profil Saya
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item danger">
                        🚪 Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script>
        const trigger = document.getElementById('profileTrigger');
        const dropdown = document.getElementById('profileDropdown');

        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = dropdown.classList.toggle('open');
            trigger.classList.toggle('open', isOpen);
        });

        document.addEventListener('click', function(e) {
            if (!trigger.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.remove('open');
                trigger.classList.remove('open');
            }
        });
    </script>
</body>
</html>