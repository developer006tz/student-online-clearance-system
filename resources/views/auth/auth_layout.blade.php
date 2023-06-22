<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SCS- Login</title>

    <link rel="shortcut icon" href="{{ URL::to('assets/images/favicon/favicon-32x32.png') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/custom.css') }}">

    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
    <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
</head>
<body>

<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left">
                    <img class="img-fluid" src="{{ URL::to('assets/images/login.png') }}" alt="Logo">
                    <h2 class="auth-left-title">UNIVERSITY OF DAR ES SALAAAM</h2>
                    <div class="auth-left-contact">
                        <p class="udsm-address">
                    <span class="contact">Contact</span><br>
                    University of Dar es Salaam<br>
                    Mwalimu Julius Nyerere Mlimani Campus<br>
                    P.O. Box 35091<br>
                    Dar es Salaam, Tanzania<br>
                    <span class="telephone">+255 754 311 439</span><br>
			<span class="email">lms@udsm.ac.tz</span><br>
                </p>
                    </div>
                </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Welcome to Online SCS</h1>
                         @if(request()->routeIs('login'))
                        <p class="account-subtitle">New User? <a href="{{ route('register') }}">Register</a></p>
                        @endif
                        <h2>@yield('heading')</h2>
                        @yield('content')

                        <div class="login-or">
                            <span class="or-line"></span>
                            <span class="span-or">&nbsp;&nbsp;</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ URL::to('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::to('assets/js/feather.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ URL::to('assets/js/script.js') }}"></script>
@stack('scripts')
</body>
</html>
