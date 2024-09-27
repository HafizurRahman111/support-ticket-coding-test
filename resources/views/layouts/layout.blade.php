<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">

    @yield('styles')
</head>

<body>
    <!-- nav bar -->
    <nav class="navbar navbar-expand-sm navbar-dark">
        <a class="navbar-brand" href="#">Support Ticket System</a>
        <div class="ml-auto d-flex align-items-center">
            <div class="user-info text-light">
                <span class="username">{{ Auth::user()->name }}</span>
                <br />
                <span class="email">{{ Auth::user()->email }}</span>
            </div>
            <img src="{{ asset('assets/images/user.png') }}" alt="User Avatar" class="rounded-circle"
                style="width: 45px; height: 45px; margin: 10px;">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm ml-2">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="d-flex">
        <!-- sidebar -->
        <aside class="sidebar" id="sidebar">
            <button class="toggle-btn" id="sidebarToggle">
                <i class="fas fa-chevron-left"></i>
            </button>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('dashboard') }}">
                        <i class="fas fa-home icon"></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                {{-- @if (Auth::user()->role->slug == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-user-shield icon"></i>
                            <span class="text">Roles</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users icon"></i>
                            <span class="text">Users</span>
                        </a>
                    </li>
                @endif --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tickets.index') }}">
                        <i class="fas fa-ticket-alt icon"></i>
                        <span class="text">Tickets</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- main content -->
        <main class="flex-grow-1 content" id="main-content">
            @if (session('message'))
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="successToast" class="toast align-items-center text-white bg-success border-0"
                        role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ session('message') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="container-fluid">
                <header class="bg-white p-3 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h5"> @yield('title')</h1>
                        @if (isset($routeName) && Route::has($routeName) && $showCreateButton)
                            <a href="{{ route($routeName) }}" class="btn btn-primary float-end">Create New</a>
                        @endif
                    </div>
                </header>
                @yield('content')
            </div>

            {{-- <!-- footer -->
            <footer class="footer" id="footer">
                <p>© {{ date('Y') }} Hafizur Rahman</p>
            </footer> --}}
        </main>
    </div>

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#sidebarToggle").click(function() {
                $("#sidebar, #main-content, #footer").toggleClass("collapsed");
                $(this).find('i').toggleClass('fa-chevron-left fa-chevron-right');
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
