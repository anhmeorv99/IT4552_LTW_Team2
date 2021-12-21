<div class="header">
    <div class="header-logo-contain">
        <div class="header-logo"></div>
        <span class="header-brand">Kwarovski</span>
    </div>
    <div class="header-signIn">
        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register-user') }}">Register</a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('signout') }}">Logout</a>
        </li>
        @endguest
    </div>
</div>

