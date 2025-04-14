<nav>
    <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        @auth
            {{-- Links for authenticated users --}}
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('profile') }}">Profile</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @else
            {{-- Links for guests --}}
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @endauth

        {{-- Language Switcher --}}
        <li class="language-dropdown">
            <button class="language-button">🌐</button>
            <ul class="language-menu">
                <li><a href="{{ route('lang.switch', 'en') }}">English</a></li>
                <li><a href="{{ route('lang.switch', 'de') }}">Deutsch</a></li>
                <li><a href="{{ route('lang.switch', 'fr') }}">Français</a></li>
                <li><a href="{{ route('lang.switch', 'es') }}">Español</a></li>
                <li><a href="{{ route('lang.switch', 'hr') }}">Hrvatski</a></li>
            </ul>
        </li>
    </ul>
    <p>Current Locale 1: {{ Session::get('locale', '?') }}</p>
    <p>Current Locale 2: {{ App::getLocale(), '?' }}</p>
</nav>