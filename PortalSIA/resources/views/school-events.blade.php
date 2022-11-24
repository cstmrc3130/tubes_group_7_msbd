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
                        <a class="navbar-brand d-flex align-items-center" href="#">
                            <img src="{{ asset("assets/images/landing-icon.png") }}" alt="logo" class="img-fluid w-2" width="60" length="60">
                            <span class="font-weight-bold ml-3">SIA - MTsN 1 Labuhanbatu</span>
                        </a>
                        {{-- ========== APPS NAME AND ICON END ========== --}}



                        {{-- ========== TOGGLER BUTTON FOR SMALL DEVICE START ========== --}}
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        {{-- ========== TOGGLER BUTTON FOR SMALL DEVICE END ========== --}}



                        {{-- ========== LOGIN BUTTON AND DROPDOWN START ========== --}}
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <div class="dropleft show">
                                    <a class="nav-link btn dropdown-toggle m-r-15" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Opsi
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">E-Rapor</a>
                                        <a class="dropdown-item" href="#">Direktori</a>
                                    </div>
                                </div>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-info text-light" href="{{ url("login") }}">Login</a>
                                </li>
                            </ul>
                        </div>
                        {{-- ========== LOGIN BUTTON AND DROPDOWN END ========== --}}

                    </nav>
                    {{-- ========== NAVBAR END ========== --}}
                </div>
            </div>
        </header>
        {{-- ========== HEADER END ========== --}}


        {{-- ========== NEWS START ========== --}}
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Sekilas Konten Berita  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Row -->
                <div class="row justify-content-center">
                    <div class="col-lg-10 align-self-start m-t-20 m-b-20">
                        <h3><span class="font-bold">School Events</span></h3>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-3">
                        <div class="card">
                            <img class="card-img-top img-responsive" src="{{ asset("assets/images/trophies2.jpg")}}" alt="Card image cap">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center m-b-15">
                                    <span><i class="ti-calendar"></i> 20 May 2018</span>
                                </div>
                                <h3 class="font-normal">Recindy Natalia Memenangkan Lomba Makan Kerupuk</h3>
                                <p class="m-b-0 m-t-10">Affa iyah</p>
                                <button class="btn btn-success btn-rounded waves-effect waves-light m-t-20">Baca Selengkapnya</button>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3">
                        <div class="card">
                            <img class="card-img-top img-responsive" src="{{ asset("assets/images/trophies2.jpg")}}" alt="Card image cap">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center m-b-15">
                                    <span><i class="ti-calendar"></i> 20 May 2018</span>
                                </div>
                                <h3 class="font-normal">Recindy Natalia Memenangkan Lomba Makan Kerupuk</h3>
                                <p class="m-b-0 m-t-10">Affa iyah</p>
                                <button class="btn btn-success btn-rounded waves-effect waves-light m-t-20">Baca Selengkapnya</button>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3">
                        <div class="card">
                            <img class="card-img-top img-responsive" src="{{ asset("assets/images/trophies2.jpg")}}" alt="Card image cap">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center m-b-15">
                                    <span><i class="ti-calendar"></i> 20 May 2018</span>
                                </div>
                                <h3 class="font-normal">Recindy Natalia Memenangkan Lomba Makan Kerupuk</h3>
                                <p class="m-b-0 m-t-10">Affa iyah</p>
                                <button class="btn btn-success btn-rounded waves-effect waves-light m-t-20">Baca Selengkapnya</button>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Sekilas Konten Berita  -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Nice admin. Designed and Developed by
                <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
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