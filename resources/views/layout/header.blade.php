<div class="header">
    <div class="header-logo-contain">
        <div class="logo-area">
            <div class="header-logo"><a href="{{route('dashboard')}}"></a></div>
            <div class="header-brand">Super Resolution</div>
        </div>
        <div class="header-signIn">

            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register-user') }}">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('signout') }}">Logout</a>
            </li> --}}
        </div>
    </div>

        @if (Auth::user())
            <input id="user_id_login" value="{{Auth::user()->id}}" type="hidden">
            <div class="dropdown">

                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                {{Auth::user()->name}}
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item" href="{{route('profile')}}">Profile</a></li>
                    @if (Auth::user()->is_admin == 1)
                        <li><a class="dropdown-item" href="{{route('scaled')}}">Upscaled Images</a></li>
                        <li><a class="dropdown-item" href="{{route('admin')}}">Admin</a></li>
                        <li><a class="dropdown-item" href="{{route('viewChangePassword')}}">Change Password</a></li>
                        <li><a class="dropdown-item" href="{{route('signout')}}">Logout</a></li>
                    @else
                        <li><a class="dropdown-item" href="{{route('scaled')}}">Upscaled Images</a></li>
                        <li><a class="dropdown-item" href="{{route('viewChangePassword')}}">Change Password</a></li>
                        <li><a class="dropdown-item" href="{{route('signout')}}">Logout</a></li>
                    @endif
                </ul>
            </div>
        @else
            <li><a class="nav-item" href="{{route('login')}}">Login</a></li>
            <li style="padding-left:20px"><a id="registerUser" class="nav-item" href="{{route('register-user')}}">Register</a></li>
        @endif
</div>

