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

                    {{-- ========== AUTHED USER BUTTONS START ========== --}}
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <div class="dropleft show">
                                <a class="nav-link btn dropdown-toggle m-r-15" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">E-Rapor</a>
                                    <a class="dropdown-item" href="#">Direktori</a>
                                </div>
                            </div>
                            <li class="nav-item">
                                <form action="{{ url('logout') }}" wire:submit.prevent="Logout">
                                    @csrf
                                    <div class="btn-group">
                                        <button class="btn btn-danger dropdown-toggle text-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0)">Dashboard</a>
                                            <button type="submit" class="btn dropdown-item">Logout</button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                    {{-- ========== AUTHED USER BUTTONS END ========== --}}

                    @else

                    {{-- ========== GUEST BUTTONS START ========== --}}
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <div class="dropleft show">
                                <a class="nav-link btn dropdown-toggle m-r-15" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">E-Rapor</a>
                                    <a class="dropdown-item" href="#">Direktori</a>
                                </div>
                            </div>
                            <li class="nav-item">
                                <a class="nav-link btn btn-info text-light" href="{{ url('login') }}">Log in</a>
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
                            <ul>
                                <li>
                                    Terwujudnya Madrasah Unggul dalam Prestasi, Terampil, Beriman, Bertaqwa, Berakhlakul Karimah dan Berwawasan Lingkungan.
                                </li>
                                <li>
                                    Menciptakan peserta didik menjadi hafidz dan hafidzah.
                                </li>
                                <li>
                                    Melaksanakan pembelajaran kontekstual yang islami.
                                </li>
                                <li>
                                    Menyelenggarakan kegiatan pengembangan diri terhadap minat dan bakat siswa.
                                </li>
                            </ul>
                        </p>
                        <a href="{{url("full-profile")}}" class="btn btn-custom-md btn-outline-info m-t-10">Lihat Profil</a>
                    </div>
                    {{-- ========== HERO TEXT END ========== --}}



                    {{-- ========== HERO IMAGE START ========== --}}
                    <div id="hero-image" class="col-lg-6 offset-lg-1 text-right carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="img-shadow img-fluid" src="{{ asset("assets/images/front-gate1.jpg") }}" alt="Sekolah MTsN 1 Labuhanbatu">
                            </div>
                            <div class="carousel-item">
                                <img class="img-shadow img-fluid" src="{{ asset("assets/images/front1.jpg") }}" alt="Sekolah MTsN 1 Labuhanbatu">
                            </div>
                            <div class="carousel-item">
                                <img class="img-shadow img-fluid" src="{{ asset("assets/images/hero1.jpg") }}" alt="Sekolah MTsN 1 Labuhanbatu">
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
        <section id="events" class="demos spacer">
            <div class="container">
                <div class="row justify-content-center ">
                    <div class="col-md-12 text-center">
                        <h1>News</h1>
                        <a href="{{ url("news") }}" class="m-t-20 text-danger border-bottom border-danger">Semua berita</a>
                    </div>
                    <div class="col-lg-4 col-md-6 m-t-20">
                        <div class="card live-box">
                            <img class="card-img-top img-responsive" src="{{ asset("assets/images/trophies2.jpg") }}" alt="Sesuaikan dengan database">
                            <div class="overlay">
                                <a class="btn btn-cyan live-btn" href="..">Baca selengkapnya</a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Event Title</h4>
                                <h6 class="card-subtitle mb-2 text-muted">Author Name</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
    </div>
    {{-- ========== NEWS END ========== --}}



    {{-- ========== FOOTER START ========== --}}
    <x-footer/>
    {{-- ========== FOOTER END ========== --}}

</div>
