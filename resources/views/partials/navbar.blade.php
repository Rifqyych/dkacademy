<nav class="site-navbar" data-navbar>
    <div class="site-container nav-inner">
        <a href="{{ route('home') }}" class="brand" aria-label="DK Academy Makassar">
            <img src="{{ asset('images/dkacademy logo.png') }}" alt="DK Academy" class="brand-logo">
        </a>

        <button class="nav-toggle" type="button" aria-label="Toggle navigation" aria-expanded="false" data-nav-toggle>
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="nav-menu" data-nav-menu>
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('programs.index') }}" class="{{ request()->routeIs('programs.*') ? 'active' : '' }}">Programs</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
            <a href="{{ route('mentors.index') }}" class="{{ request()->routeIs('mentors.*') ? 'active' : '' }}">Mentors</a>
            <a href="{{ route('success-stories') }}" class="{{ request()->routeIs('success-stories') ? 'active' : '' }}">Success Stories</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </div>

        <a href="{{ route('kursus.daftar') }}" class="nav-cta">Register Now</a>
    </div>
</nav>
