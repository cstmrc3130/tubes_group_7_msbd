<!DOCTYPE html>
<html lang="en">

<head>

    {{-- ========== ASSETS AND META COMPONENT ========== --}}
    <x-school-events.assets-and-meta />
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
                            <span class="font-weight-bold ml-3">SIA - MTsN 1 Labuhanbatu </span>
                        </a>
                        {{-- ========== APPS NAME AND ICON END ========== --}}



                        {{-- ========== TOGGLER BUTTON FOR SMALL DEVICE START ========== --}}
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        {{-- ========== TOGGLER BUTTON FOR SMALL DEVICE END ========== --}}



                        {{-- ========== LOGIN BUTTON AND DROPDOWN START ========== --}}
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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


        {{-- ========== EVENTS START ========== --}}
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-10 align-self-start m-t-20 m-b-20">
                        <h3><span class="font-bold">School Events</span></h3>
                    </div>
                <div class="container row justify-content-evenly">
                    <div class="col-4">
                        <div class="card m-b-30">
                            <img class="card-img-top img-responsive" src="{{ asset("assets/images/trophies2.jpg")}}" alt="Card image cap">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center m-b-15">
                                    <span><i class="ti-calendar"></i> 20 May 2018</span>
                                </div>
                                <h3 class="font-normal">Recindy Natalia Memenangkan Lomba Makan Kerupuk</h3>
                                <p class="m-b-0 m-t-10">Affa iyah</p>
                                <a class="btn btn-success btn-rounded waves-effect waves-light m-t-20" href="{{ url("full-events") }}">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card m-b-30">
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

                    <div class="col-4">
                        <div class="card m-b-30">
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


                    <div class="col-4">
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


                    <div class="col-4">
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

                    <div class="col-4">
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
                </div>
                </div>
            </div>
        </div>
        {{-- ========== EVENTS END ========== --}}



        {{-- ========== FOOTER START ========== --}}
        <x-school-events.footer/>
        {{-- ========== FOOTER END ========== --}}

    </div>



    {{-- ========== JAVASCRIPTS ========== --}}
    <x-landing-page.javascript />

</body>



</html>