<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin DK Academy')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="admin-page">
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <a href="{{ route('admin.dashboard') }}" class="admin-brand">
                <img src="{{ asset('images/dkacademy logo.png') }}" alt="DK Academy">
                <span>Admin Panel</span>
            </a>

            <nav class="admin-nav" aria-label="Admin navigation">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2"></i>Dashboard</a>
                <a href="{{ route('admin.registrations.index') }}" class="{{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}"><i class="bi bi-people"></i>Pendaftar</a>
                <a href="{{ route('admin.programs.index') }}" class="{{ request()->routeIs('admin.programs.*') ? 'active' : '' }}"><i class="bi bi-journal-bookmark"></i>Program</a>
                <a href="{{ route('admin.mentors.index') }}" class="{{ request()->routeIs('admin.mentors.*') ? 'active' : '' }}"><i class="bi bi-person-workspace"></i>Mentor</a>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="{{ route('home') }}"><i class="bi bi-box-arrow-up-right"></i>Lihat Website</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><i class="bi bi-box-arrow-right"></i>Keluar</button>
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <header class="admin-header">
                <div>
                    <p class="admin-kicker">DK Academy Makassar</p>
                    <h1>@yield('heading', 'Admin Panel')</h1>
                </div>
                <div class="admin-user"><i class="bi bi-person-circle"></i>{{ auth()->user()->name }}</div>
            </header>

            @yield('content')
        </main>
    </div>
</body>
</html>
