 <!-- PRELOADER START -->
    <div id="preloader">
        <div class="spinner"></div>

        <div id="content"></div>
    </div>

    <!-- PRELOADER END -->

    <!-- Main Wrapper Start -->

    <!-- HEADER MENU START -->
    <header class="header">
        <div class="container-fluid">
            <nav class="navigation d-flex align-items-center justify-content-between">
                <a href="{{route('front.index')}}" class="d-flex align-items-center">
                    <img src="{{asset('assets/media/brands/chanalogo.png')}}" alt="/logo" class="header-logo" style="width: auto; height: 40px;">
                </a>
                <div class="menu-button-right">
                    <div class="main-menu__nav">
                        <ul class="main-menu__list">
                            <li>
                                <a href="{{route('front.index')}}">Home</a>
                            </li>
                            <li>
                                <a href="{{route('front.about')}}">Sobre</a>
                            </li>
                            <li class="dropdown">
                                <a href="{{route('front.cars')}}">Carros</a>
                            </li>
                            <!-- <li class="dropdown">
                                <a href="javascript:void(0);">Rental</a>
                                <ul>
                                    <li><a href="rental.html">Rental</a></li>
                                    <li><a href="rental-sidebar.html">Rental sidebar</a></li>
                                    <li><a href="vehicle-details.html">Vehicle details</a></li>
                                </ul>
                            </li> -->
                            <!-- <li class="dropdown">
                                <a href="javascript:void(0);">Booking</a>
                                <ul>
                                    <li><a href="booking.html">Booking</a></li>
                                    <li><a href="book-now.html">Book-now</a></li>
                                </ul>
                            </li> -->
                            <!-- <li class="dropdown">
                                <a href="javascript:void(0);">Blogs</a>
                                <ul>
                                    <li><a href="blogs.html">Blogs</a></li>
                                    <li><a href="blogs-details.html">Blogs details</a></li>
                                </ul>
                            </li> -->
                            <li>
                                <a href="{{route('front.contact')}}">Contacto</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main-menu__right">
                    <div class="search-heart-icon d-md-flex d-none align-items-center gap-24">
                       @auth
    <div class="hidden sm:flex sm:items-center sm:ms-6">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                         x-text="name"
                         x-on:profile-updated.window="name = $event.detail.name">
                    </div>
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Botão de Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
@else
    <a href="{{ route('login') }}">Log in</a>
    @if (Route::has('register'))
        <a href="{{ route('register') }}">Register</a>
    @endif
@endauth
                    </div>
                        <a href="#" class="d-xl-none d-flex main-menu__toggler mobile-nav__toggler">
                            <i class="fa-light fa-bars"></i>
                        </a>
                </div>
            </nav>
        </div>
    </header>
    <!-- HEADER MENU END -->
