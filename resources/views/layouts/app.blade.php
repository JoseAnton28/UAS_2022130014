<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FGO Team Builder')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">FGO Team Builder</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('teambuilders*') ? 'active' : '' }}" href="{{ route('teambuilders.index') }}">
                            <i class="fas fa-users"></i> Team Builder
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('servants*') ? 'active' : '' }}" href="{{ route('servants.index') }}">
                            <i class="fas fa-user-shield"></i> Servants
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('craft-essences*') ? 'active' : '' }}" href="{{ route('craftessences.index') }}">
                            <i class="fas fa-scroll"></i> Craft Essences
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('materials*') ? 'active' : '' }}" href="{{ route('materials.index') }}">
                            <i class="fas fa-cubes"></i> Materials
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('character-planners*') ? 'active' : '' }}" href="{{ route('character_planner.index') }}">
                            <i class="fas fa-user"></i> Character Planner
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 container">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
