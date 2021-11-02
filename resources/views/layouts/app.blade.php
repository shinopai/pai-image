<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/sidebar.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="flex items-center justify-between flex-wrap bg-gray-800 p-6">
        <div class="text-white mr-6">
            <a href="{{ url('/') }}"
                class="font-semibold text-xl tracking-tight">{{ config('app.name', 'Laravel') }}</a>
        </div>
        <div class="block md:hidden sidebar-open">
            <i class="fas fa-bars text-white cursor-pointer" style="font-size: 25px;"></i>
        </div>

        <!-- sidebar content-->
        <div class="sidebar">
            <div class="sidebar-inner">
                <h2 class="sidebar-ttl">Menu</h2>
                <div class="sidebar-close">
                    <i class="fas fa-times-circle cursor-pointer"></i>
                </div>
            </div>
            @guest
                <p class="sidebar-txt">
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                </p>
                <p class="sidebar-txt">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                </p>
            @else
                <p class="sidebar-txt">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                </p>
                <p class="sidebar-txt">
                    <a class="cursor-pointer"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </p>
            @endguest
        </div>
        <div class="sidebar-bg"></div>
        <!-- /sidembar content -->

        <div class="w-full hidden flex-grow md:flex md:items-center md:w-auto" id="navbar">
            <div class="text-sm text-white md:flex-grow  text-center md:text-right">
                @guest
                    <a class="nav-link mr-3 bg-gray-400 p-2 rounded" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="nav-link bg-blue-400 p-2 rounded"
                            href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <span class="mr-2"><i class="fas fa-user"></i> {{ Auth::user()->name }}</span>
                    <button class="modal-open text-white font-bold py-2 px-4 mr-2"><i class="fas fa-upload"></i> Post
                        image</button>

                    <!--Modal-->
                    <div class="modal hidden fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
                        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                        <div
                            class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                            <!-- Add margin if you want to see some of the overlay behind the modal-->
                            <div class="modal-content py-4 text-left px-6">
                                <!--Title-->
                                <div class="flex justify-between items-center pb-3">
                                    <p class="text-black text-2xl font-bold">Post image!</p>
                                    <div class="modal-close cursor-pointer z-50">
                                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                            height="18" viewBox="0 0 18 18">
                                            <path
                                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>

                                <!--Body-->
                                <div class="mb-2">
                                    @error('imagename')
                                        <span class="invalid-feedback text-red-400" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <form action="{{ route('image.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div
                                            class="relative h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
                                            <div class="absolute">
                                                <div class="flex flex-col items-center "> <i
                                                        class="fa fa-cloud-upload fa-3x text-gray-200"></i> <span
                                                        class="block text-gray-400 font-normal">Attach you images
                                                        here</span>
                                                    <span class="block text-gray-400 font-normal">or</span> <span
                                                        class="block text-blue-400 font-normal">Browse images</span>
                                                </div>
                                            </div> <input type="file" class="my-image h-full w-full opacity-0"
                                                name="imagename">
                                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                        </div>
                                </div>
                                <div class="mt-3 text-center pb-3">
                                    <img class="preview">
                                </div>
                            </div>
                            <!--Footer-->
                            <div class="flex justify-end pt-2">
                                <button type="submit"
                                    class="px-4 p-3 rounded-lg text-white bg-yellow-500 m-2 cursor-pointer">Post</button>
                                <button type="button"
                                    class="modal-close px-4 bg-gray-400 p-3 rounded-lg text-white m-2 cursor-pointer">Close</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <a class="bg-gray-400 rounded p-2" href=""
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </div>
        </div>
    </nav>

    @if (session('flash'))
        <p class="bg-blue-400 text-white text-center text-md font-bold px-4 py-3" role="alert">
            {{ session('flash') }}
        </p>
    @endif

    @yield('content')

    <!-- script -->
    <script src="{{ mix('js/sidebar.js') }}" defer></script>
    <script src="{{ mix('js/modal.js') }}" defer></script>

</html>
