
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
        <a href="{{url('/')}}" class="navbar-brand ml-lg-3">
            <img src={{asset("img/logo-no-background.png")}} alt="">
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="{{url('/')}}" class="nav-item nav-link">Home</a>
                <a href="{{url('/subject')}}" class="nav-item nav-link">Subjects</a>
                <a href="{{url('/tutor')}}" class="nav-item nav-link">Tutors</a>
                <!-- <a href="{{url('/about')}}" class="nav-item nav-link">About</a> -->
            </div>
            @guest
            <div class="btn-group">
                <button type="button" class="btn btn-primary py-2 px-4 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Register | Login
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{url('/register-student')}}">Register as a Student</a>
                    <a class="dropdown-item" href="{{url('/register-tutor')}}">Register as a Tutor</a>
                    <a class="dropdown-item" href="{{url('/login')}}">Login</a>
                </div>
            </div>
            @else
            <div class="navbar-nav">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary py-2 px-4 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> Profile
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                        @if (Auth::user()->role == 'Student')
                        <a class="dropdown-item" href="{{ url('/edit-details') }}">Edit Profile</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i> <span class="badge badge-danger">{{ Auth::user()->unreadNotificationsCount() }}</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @forelse(Auth::user()->userNotifications()->where('is_read', false)->get() as $notification)
                        <a class="dropdown-item" href="{{ route('notifications.index') }}">{{ $notification->message }}</a>
                        @empty
                        <a class="dropdown-item" href="{{ route('notifications.index') }}">No notifications</a>
                        @endforelse
                    </div>
                </div>
            </div>
            @endguest
        </div>
    </nav>
</div>
