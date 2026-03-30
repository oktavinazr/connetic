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
            --bg-dark: #0a0a0f;
            --bg-card: rgba(255, 255, 255, 0.04);
            --border: rgba(244, 114, 182, 0.15);
            --text: #f1f1f4;
            --text-muted: #9ca3af;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Animated BG */
        .bg-glow {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background:
                radial-gradient(ellipse 600px 400px at 20% 20%, rgba(236,72,153,0.08), transparent),
                radial-gradient(ellipse 500px 500px at 80% 80%, rgba(219,39,119,0.06), transparent),
                radial-gradient(ellipse 300px 300px at 50% 50%, rgba(244,114,182,0.04), transparent);
        }

        .glass {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            backdrop-filter: blur(20px);
        }

        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 12px 28px;
            background: linear-gradient(135deg, var(--pink-500), var(--pink-700));
            color: #fff; font-weight: 600; font-size: 14px;
            border: none; border-radius: 10px; cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(236,72,153,0.3); }

        .btn-outline {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 12px 28px;
            background: transparent;
            color: var(--pink-400); font-weight: 600; font-size: 14px;
            border: 1px solid var(--pink-400); border-radius: 10px; cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .btn-outline:hover { background: rgba(244,114,182,0.1); }

        .btn-google {
            display: inline-flex; align-items: center; justify-content: center; gap: 10px;
            padding: 12px 28px; width: 100%;
            background: rgba(255,255,255,0.06);
            color: var(--text); font-weight: 500; font-size: 14px;
            border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .btn-google:hover { background: rgba(255,255,255,0.1); }

        .input-field {
            width: 100%; padding: 12px 16px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px; color: var(--text);
            font-size: 14px; font-family: 'Inter', sans-serif;
            transition: border-color 0.3s;
            outline: none;
        }
        .input-field:focus { border-color: var(--pink-500); }
        .input-field::placeholder { color: var(--text-muted); }

        .label { display: block; font-size: 13px; font-weight: 500; color: var(--text-muted); margin-bottom: 6px; }

        .divider {
            display: flex; align-items: center; gap: 12px;
            color: var(--text-muted); font-size: 13px; margin: 20px 0;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px;
            background: rgba(255,255,255,0.08);
        }

        .error-text { color: #f87171; font-size: 13px; margin-top: 4px; }

        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 50;
            padding: 16px 32px;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(10,10,15,0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
        }
        .nav-logo { font-size: 18px; font-weight: 700; color: var(--pink-400); text-decoration: none; }
        .nav-links { display: flex; gap: 24px; align-items: center; }
        .nav-links a { color: var(--text-muted); text-decoration: none; font-size: 14px; font-weight: 500; transition: color 0.3s; }
        .nav-links a:hover { color: var(--pink-400); }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-in { animation: fadeUp 0.6s ease forwards; }
        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.2s; opacity: 0; }
        .delay-3 { animation-delay: 0.3s; opacity: 0; }
    </style>
    @yield('styles')
</head>
<body>
    <div class="bg-glow"></div>
    @yield('content')
</body>
</html>