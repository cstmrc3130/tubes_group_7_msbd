<!DOCTYPE html>
<html lang="en">

<head>

    {{-- ========== ASSETS AND META COMPONENT ========== --}}
    <x-landing-page.assets-and-meta />

</head>

<body>

    <div id="main-wrapper">

        {{-- ========== HEADER START ========== --}}
        <header class="topbar">
            <div class="container">
                <div class="header p-t-20">

                    {{-- ========== NAVBAR START ========== --}}
                    <nav class="navbar navbar-expand-md navbar-light rounded border-bottom">

                        {{-- ========== APPS NAME AND ICON START ========== --}}
                        <a class="navbar-brand d-flex align-items-center" href="/">
                            <img src="{{ asset("assets/images/landing-icon.png") }}" alt="logo" class="img-fluid w-2" width="60" length="60">
                            <span class="font-weight-bold ml-3">SIA - MTsN 1 Labuhanbatu</span>
                        </a>
                        {{-- ========== APPS NAME AND ICON END ========== --}}



                        {{-- ========== TOGGLER BUTTON FOR SMALL DEVICE START ========== --}}
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        {{-- ========== TOGGLER BUTTON FOR SMALL DEVICE END ========== --}}

                        @auth()

                        {{-- ========== AUTHER USER BUTTONS START ========== --}}
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <div class="dropleft show">
                                    <a class="nav-link btn dropdown-toggle m-r-15" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Opsi
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">E-Rapor</a>
                                        <a class="dropdown-item" href="#">Direktori</a>
                                        <a class="dropdown-item" href="{{ url("events") }}">Events</a>
                                    </div>
                                </div>
                                <li class="nav-item">
                                    <form action="{{ url('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="nav-link btn btn-danger text-light">Log out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        {{-- ========== AUTHER USER BUTTONS END ========== --}}

                        @else

                        {{-- ========== GUEST BUTTONS START ========== --}}
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <div class="dropleft show">
                                    <a class="nav-link btn dropdown-toggle m-r-15" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Opsi
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">E-Rapor</a>
                                        <a class="dropdown-item" href="#">Direktori</a>
                                        <a class="dropdown-item" href="{{ url("events") }}">Events</a>
                                    </div>
                                </div>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-info text-light" href="{{ url("login") }}">Log in</a>
                                </li>
                            </ul>
                        </div>
                        {{-- ========== GUEST BUTTONS END ========== --}}

                        @endauth

                    </nav>
                    {{-- ========== NAVBAR END ========== --}}



                    {{-- ========== HERO START ========== --}}
                    <div class="row header-banner align-items-center">

                        {{-- ========== HERO TEXT START ========== --}}
                        <div class="col-lg-5 align-self-start">
                            <h2>Sistem Informasi Akademik<span class="font-bold"> Madrasah Tsanawiyah Negeri 1 Labuhanbatu</span></h2>
                            <p class="m-t-40">
                                <span class="font-bold text-dark">Visi & Misi</span> 
                                <br>
                                900+ Page Templates, Unlimited Color Schemes, 
                            </p>
                            <a href="#demos" class="btn btn-custom-md btn-outline-info m-t-40 m-b-40 dm-btn">Lihat Profil</a>
                        </div>
                        {{-- ========== HERO TEXT END ========== --}}



                        {{-- ========== HERO IMAGE START ========== --}}
                        <div id="hero-image" class="col-lg-6 offset-lg-1 text-right carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="img-shadow img-fluid" src="{{ asset("assets/images/hero.jpeg") }}" alt="Sekolah MTsN 1 Labuhanbatu">
                                </div>
                                <div class="carousel-item">
                                    <img class="img-shadow img-fluid" src="{{ asset("assets/images/hero.jpeg") }}" alt="Sekolah MTsN 1 Labuhanbatu">
                                </div>
                                <div class="carousel-item">
                                    <img class="img-shadow img-fluid" src="{{ asset("assets/images/hero.jpeg") }}" alt="Sekolah MTsN 1 Labuhanbatu">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#hero-image" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#hero-image" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        {{-- ========== HERO IMAGE END ========== --}}

                    </div>
                    {{-- ========== HERO END ========== --}}

                </div>
            </div>
        </header>
        {{-- ========== HEADER END ========== --}}


        {{-- ========== NEWS START ========== --}}
        <div class="page-wrapper">
            <section id="news" class="demos spacer">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-7 text-center">
                            <h1>Berita Terbaru</h1>
                            <p class="m-t-20">Apa yang perlu disini?
                            </p>
                        </div>
                        <div class="col-md-6 m-t-40">
                            <div class="live-box bg-light text-center p-t-30 p-b-0">
                                <img class="shadow img-fluid" src="{{ asset("assets/images/trophies.jpeg") }}" alt="Sesuaikan dengan database">
                                <div class="overlay">
                                    <a class="btn btn-danger live-btn" href="html/ltr/index.html">Baca selengkapnya</a>
                                </div>
                            </div>
                            <div class="m-l-30 m-t-30">
                                <span class="font-20 font-bold text-uppercase">JUDUL BERITA</span>
                                <h5>Deskripsi Singkat.....</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        {{-- ========== NEWS END ========== --}}



        {{-- ========== FOOTER START ========== --}}
        <footer class="text-center text-lg-start bg-light text-muted">

            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">

                <div class="me-5 d-none d-lg-block">
                    <span>Get connected with us on social networks:</span>
                </div>


                <div>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </section>

            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="fas fa-gem me-3"></i>Company name
                            </h6>
                            <p>
                                Here you can use rows and columns to organize your footer content. Lorem ipsum
                                dolor sit amet, consectetur adipisicing elit.
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Products
                            </h6>
                            <p>
                                <a href="#!" class="text-reset">Angular</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">React</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Vue</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Laravel</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Useful links
                            </h6>
                            <p>
                                <a href="#!" class="text-reset">Pricing</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Settings</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Orders</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Help</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                            <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                            <p>
                                <i class="fas fa-envelope me-3"></i>
                                info@example.com
                            </p>
                            <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                            <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>


            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2021 Copyright:
                <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </div>
        </footer>
        {{-- ========== FOOTER END ========== --}}

    </div>



    {{-- ========== JAVASCRIPTS ========== --}}
    <x-landing-page.javascript />

</body>



</html>