<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @include('include.footercss')
    <style>
        .custom-red-header {
            width: 100%;
            background-color: rgb(255, 3, 3);
            color: white;
            text-align: center;
        }


        .mcategory-menu {
            background-color: rgb(255, 3, 3);
            /* สีพื้นหลัง */
            /* border-radius: 10px; ขอบมุม */
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            padding: 10px;
            /* ระยะห่างขอบ */
            /* position: fixed;  */
            /* ติดตั้งเมนู */
            width: 100%;
            top: 0;
            /* ยืดให้ชิดด้านซ้ายและอยู่กึ่งกลางแนวตั้ง */
            /* transform: translateY(-50%); ย้ายเมนูให้อยู่กึ่งกลางแนวตั้ง */
        }

        .mcategory-menu ul {
            list-style: none;
            /* เอา bullet point ออก */
            padding: 0;
        }

        .mcategory-menu li a {
            color: white;
            /* สีข้อความ */
            text-decoration: none;
            /* เอา underline ออก */
        }

        .mcategory-menu li {
            margin-bottom: 5px;
            /* ระยะห่างระหว่างรายการ */
        }

        .strong {
            font-weight: bold;
            font-size: 70px;
            line-height: 22px;
            border: 1px solid #000000;
        }

    
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    @stack('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    <!-- Other head content -->

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  /> --}}
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
@include('include.head')

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('storage/images/ip2M.png') }}" width="120px">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}"
                                href="{{ route('home') }}">{{ __('messages.home') }}</a>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('works.index') ? 'active' : '' }}"
                                    href="{{ route('works.index') }}">{{ __('messages.Work_information') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('appointment.index') ? 'active' : '' }}"
                                    href="{{ route('appointment.index') }}">{{ __('messages.Business_appointment_information') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('buy.index') ? 'active' : '' }}"
                                    href="{{ route('buy.index') }}">{{ __('messages.Tender_offer_information') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('seller.index') ? 'active' : '' }}"
                                    href="{{ route('seller.index') }}">{{ __('messages.Offering_information') }}</a>
                            </li>

                            {{-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('messages.Manage_data') }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('works.index') }}">
                                        {{ __('messages.Work_information') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('profiles.index') }}">
                                        {{ __('messages.Business_appointment_information') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('profiles.index') }}">
                                        {{ __('messages.Tender_offer_information') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('seller.index') }}">
                                        {{ __('messages.Offering_information') }}
                                    </a>
                                </div>
                            </li> --}}
                            <li class="nav-item dropdown">


                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->title }}{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="{{ route('profiles.index') }}">
                                        {{ __('messages.editprofile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                                        {{ __('messages.editpass') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <li class="nav-item">
                            @include('language-switch')
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        @include('include.footer')
    </div>
    @stack('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            })
        </script>
    @endif
</body>

</html>
