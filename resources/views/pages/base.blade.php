{{-- resources/views/pages/base.blade.php --}}
<x-app-layout>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- CSS -->
<link rel="stylesheet" href="{{asset('assets/css/vendor/font-awesome.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/vendor/slick.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/vendor/slick-theme.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/vendor/smoothScorllbar.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/vendor/classic.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/vendor/classic.date.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/app.css')}}">

    {{-- Cabeçalho opcional --}}


    {{-- Conteúdo principal --}}
    <main class="w-full min-h-screen bg-gray-50 dark:bg-gray-800 p-0 m-0 ">
        @yield('content')
    </main>

    {{-- Rodapé opcional --}}
     <!--Footer-start -->
    <footer class="pt-40">
        <div class="container">
            <div class="row mb-16 row-gap-4">
                <div class="col-lg-3">
                    <div class="txt-block">
                        <a href="index.html">
                            <img src="{{asset('assets/media/brands/chanalogo.png')}}" alt="/logo" class="header-logo" style="width: auto; height: 40px;">
                            {{-- <img src="assets/media/footer/Frame-173.png" alt="Frame"> --}}
                        </a>
                    </div>
                    <p class="mb-32">Chana Car é uma empresa especializada em aluguel de veículos, oferecendo conforto, segurança e flexibilidade para suas viagens.</p>
                    <h6 class="white mb-16">Assine nossa newsletter</h6>
                    <form action="index.html" class="newsletter-form">
                        <input type="email" name="email" id="eMail" class="form-input"
                            placeholder=" Your email address">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_383_5670)">
                                    <path
                                        d="M19.8284 0.171647C19.6626 0.00586635 19.414 -0.0451101 19.1965 0.041921L0.36834 7.57308C0.152911 7.65925 0.00865304 7.86441 0.00037181 8.09632C-0.00787036 8.32819 0.121504 8.54308 0.330254 8.64433L7.75477 12.2451L11.3556 19.6697C11.4538 19.8722 11.6589 19.9999 11.8827 19.9999C11.8896 19.9999 11.8966 19.9998 11.9036 19.9995C12.1355 19.9913 12.3407 19.847 12.4268 19.6316L19.9581 0.803599C20.0451 0.585943 19.9941 0.337389 19.8284 0.171647ZM2.0349 8.16862L16.9812 2.19016L8.07383 11.0974L2.0349 8.16862ZM11.8313 17.9651L8.90246 11.926L17.8099 3.01875L11.8313 17.9651Z"
                                        fill="#2D74BA" />
                                </g>
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="col-lg-5 col-md-8 offset-lg-1">
                    <div class="row">
                        <div class="col-6">
                            <div class="links-block">
                                <h6 class="mb-32">Quick Links</h6>
                                <ul class="unstyled">
                                    <li class="mb-12">
                                        <a href="{{asset('/')}}">Home </a>
                                    </li>
                                    <li class="mb-12">
                                        <a href="{{asset('/about')}}">Sobre</a>
                                    </li>
                                    <li class="mb-12">
                                        <a href="{{asset('/carros')}}">Carros</a>
                                    </li>
                                    <li class="mb-12">
                                        <a href="{{asset('/contacto')}}">Contactos</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="links-block">
                                <h6 class="mb-32">Acesso</h6>
                                <ul class="unstyled">
                                    <li class="mb-12">
                                        <a href="rental.html">Login</a>
                                    </li>
                                    <li class="mb-12">
                                        <a href="book-now.html">Register</a>
                                    </li>
                                    <li class="mb-12">
                                        <a href="booking.html">Termos & Políticas</a>
                                    </li>
                                    {{-- <li class="mb-12">
                                        <a href="index.html">Brands</a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="links-block">
                        <div class="mb-24">
                            <h6 class="mb-32">Informações de Contacto</h6>
                        </div>
                        <ul class="unstyled">
                            <li class="mb-16">
                                <div class="contact">
                                    <img src="{{asset('assets/media/footer/uil-outgoing-call.png')}}" alt="call-logo">
                                    <a href="tel:+244923482877">923482877 / 946320021</a>
                                </div>
                            </li>
                            <li class="mb-16">
                                <div class="contact">
                                    <img src="{{asset('assets/media/footer/uil-map-marker.png')}}" alt="logo">
                                    <p>Estrada principal do Lar do Patriota - Luanda</p>
                                </div>
                            </li>
                            <li class="mb-24">
                                <div class="contact">
                                    <img src="{{asset('assets/media/footer/uil-envelope.png')}}" alt="logo">
                                    <a href="mailto:rent@orgchana.com">rent@orgchana.com</a>
                                </div>
                            </li>
                        </ul>
                        <h5>Siga-nos!</h5>
                        <div class="social-icons mb-12">
                            <ul class="d-flex unstyled gap-12">
                                <li>
                                    <a href="">
                                        <img src="{{asset('assets/media/footer/Instagram.png')}}" alt="logo">
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="{{asset('assets/media/footer/Twitter.png')}}" alt="logo">
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="{{asset('assets/media/footer/Dribbble.png')}}" alt="logo">
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="{{asset('assets/media/footer/Linkedin.png')}}" alt="logo">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hr-line  bg-light-gray"></div>
            <p class="mt-32 pb-32 text-center">@2025 All Rights <span
                    class="fw-700 color-sec">CHANA-A-CAR.</span>
                By EGATECLOUD</p>
        </div>
    </footer>
    <!--Footer-end -->

    <!-- Back To Top Start -->
    <button class="scrollToTopBtn"><i class="fa fa-arrow-up"></i></button>

    <!-- Mobile Menu Start -->
    {{-- <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
            <div class="logo-box">
                <a href="index.html" aria-label="logo image"><img src="assets/media/user/logo.png" alt=""></a>
            </div>
            <div class="mobile-nav__container"></div>
            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:example@company.com">example@company.com</a>
                </li>
                <li>
                    <i class="fa fa-phone-alt"></i>
                    <a href="tel:+12345678">+123 (4567) -890</a>
                </li>
            </ul>
            <div class="mobile-nav__social">
                <a href=""><i class="fa-brands fa-x-twitter"></i></a>
                <a href=""><i class="fab fa-facebook"></i></a>
                <a href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div> --}}
    <!-- Mobile Menu End -->

    <!-- JS -->
<script src="{{asset('assets/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery-3.6.3.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/slick.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/smooth-scrollbar.js')}}"></script>
<script src="{{asset('assets/js/vendor/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/picker.date.js')}}"></script>
<script src="{{asset('assets/js/date.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
</x-app-layout>
