<div>
    @include('pages.header')

    <!-- About-area start -->
    <section class="title-banner-5">
        <div class="txt">
            <h2 class="white text-center">Contacto</h2>
            <div class="txt-block text-center white">
                <a href="index.html">Home</a>
                <i class="fa-solid fa-greater-than"></i>
                <a href="about.html">Contacto</a>
            </div>
        </div>
    </section>
    <!-- About-area start  end -->

    <!--title start  -->
    <section class="files my-80">
        <div class="container-fluid">
            <div class="row  row-gap-4 align-items-end">
                <div class="col-lg-6  col-md-6 col-sm-6   my-40">
                    <form>
                        <div class="topic">
                            <h6 class="mb-12">Seleciona o Assunto</h6>
                            <div class="d-flex  gap-24 align-items-center flex-wrap">
                                <div class="flex-shrink-0">
                                    <input type="radio" id="Signing" name="topic" class="d-none" checked>
                                    <label for="Signing"> Entrando</label>
                                </div>
                                <div class="flex-shrink-0">
                                    <input type="radio" id="booking" name="topic" class="d-none">
                                    <label for="booking"> Problema com a reserva</label>
                                </div>
                                <div class="flex-shrink-0">
                                    <input type="radio" id="report" name="topic" class="d-none">
                                    <label for="report"> Relatar uma correção</label>
                                </div>
                                <div class="flex-shrink-0">
                                    <input type="radio" id="work" name="topic" class="d-none">
                                    <label for="work"> Trabalhe conosco</label>
                                </div>
                                <div class="flex-shrink-0">
                                    <input type="radio" id="us" name="topic" class="d-none">
                                    <label for="us">Precisa de algo mais</label>
                                </div>
                                {{-- <div class="flex-shrink-0">
                                    <input type="radio" id="in" name="topic" class="d-none">
                                    <label for="in"> Signing in</label>
                                </div>
                                <div class="flex-shrink-0">
                                    <input type="radio" id="Works" name="topic" class="d-none">
                                    <label for="Works">Work with us</label>
                                </div>
                                <div class="flex-shrink-0">
                                    <input type="radio" id="something" name="topic" class="d-none">
                                    <label for="something"> Need something else</label>
                                </div> --}}
                            </div>
                            <h6 class="mt-24 mb-24">Fale conosco</h6>
                            <input class="mb-4" type="text" placeholder="Your Name ">
                            <input class="mb-4" type="email" placeholder="Email *">
                            <input class="mb-4" type="text" placeholder="contacto *">
                            <a href="contact.html" class="cus-btn mt-24">
                                <span class="btn-text">
                                    Envia
                                </span>
                                <span>
                                    Enviar
                                </span>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <img src="assets/media/blogs/pngwing-19.png" alt="car">
                </div>
            </div>
        </div>
    </section>
    <!-- title end -->

    <!-- vichles-section -->
    <section class="cards py-80">
        <div class="container-fluid">
            <div class="row row-gap-4">
                <div class="col-xl-3 col-lg-6  col-md-6 col-sm-6">
                    <div class="banner">
                        <i class="fa-solid fa-phone-volume mb-24"></i>
                        <h5 class="mb-16">Contactos</h5>
                        <P>923482877 / 946320021</P>
                    </div>
                </div>
                <div class="col-xl-3  col-lg-6 col-md-6 col-sm-6">
                    <div class="banner">
                        <i class="fa-thin fa-envelope mb-24"></i>
                        <h5 class="mb-16">Email</h5>
                        <P>rent@orgchana.com</P>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="banner">
                        <i class="fa-light fa-location-dot mb-24"></i>
                        <h5 class="mb-16">Location</h5>
                        <P>Estrada principal do Lar do Patriota - Luanda</P>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="banner">
                        <i class="fa-regular fa-clock mb-24"></i>
                        <h5 class="mb-16">Horário de funcionamento</h5>
                        <p>Mon-Sat (08H:30 - 16H:30)<p>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- vicheles-end -->
</div>
