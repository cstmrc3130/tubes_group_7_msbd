<div class="container">

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

                            {{-- ========== DIREKTORI START ========== --}}
                            <div class="dropleft show">
                                <a class="nav-link btn dropdown-toggle m-r-15" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Direktori
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('directory.teacher') }}">Guru</a>
                                    <a class="dropdown-item" href="{{ route('directory.student') }}">Siswa</a>
                                </div>
                            </div>
                            {{-- ========== DIREKTORI END ========== --}}


                            {{-- ========== DASHBOARD AND LOGOUT BUTTON START ========== --}}
                            <li class="nav-item">
                                <div class="btn-group">
                                    <button class="btn btn-danger dropdown-toggle text-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if (Auth::user()->role == 0)
                                        Admin
                                        @elseif (Auth::user()->role == 1)
                                            @for($i = 0; $i < 2; $i++)
                                                {!! print_r(explode(" ", auth()->user()->teacher->name)[$i], true); !!}
                                            @endfor
                                        @else 
                                            @for($i = 0; $i < 2; $i++)
                                                {!! print_r(explode(" ", auth()->user()->student->name)[$i], true); !!}
                                            @endfor
                                        @endif
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route("student.dashboard") }}">Dashboard</a>
                                        <form wire:submit.prevent="Logout">
                                            @csrf
                                            <button type="button" wire:click="Logout" class="btn dropdown-item">Logout</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            {{-- ========== DASHBOARD AND LOGOUT BUTTON END ========== --}}

                        </ul>
                    </div>
                    {{-- ========== AUTHED USER BUTTONS END ========== --}}

                    @else

                    {{-- ========== GUEST BUTTONS START ========== --}}
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">

                            {{-- ========== DIREKTORI START ========== --}}
                            <div class="dropleft show">
                                <a class="nav-link btn dropdown-toggle m-r-15" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Direktori
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('directory.teacher') }}">Guru</a>
                                    <a class="dropdown-item" href="{{ route('directory.student') }}">Siswa</a>
                                </div>
                            </div>
                            {{-- ========== DIREKTORI END ========== --}}


                            {{-- ========== LOGIN BUTTON START ========== --}}
                            <li class="nav-item">
                                <a class="nav-link btn btn-info text-light" href="{{ url('login') }}">Log in</a>
                            </li>
                            {{-- ========== LOGIN BUTTON END ========== --}}
                        </ul>
                    </div>
                    {{-- ========== GUEST BUTTONS END ========== --}}

                    @endauth

                </nav>
                {{-- ========== NAVBAR END ========== --}}

            </div>
        </div>
    </header>
    {{-- ========== HEADER END ========== --}}



    {{-- ========== SCHOOL PROFILE START ========== --}}
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 align-self-start m-t-20 m-b-20">
                    <h3>
                        <span class="font-bold">Profil Sekolah</span>
                    </h3>
                </div>



                <div class="col-lg-9 align-self-start m-t-20 m-b-20">
                    <img src="{{ asset("assets/images/front-gate1.jpg")}}" class="img-fluid w-50 m-b-40">
                    <dl class="row" style="text-align:justify">
                        <dt class="col-sm-3">Nama Sekolah </dt>
                        <dd class="col-sm-9">: MTsn 1 Labuhanbatu</dd>
                        <dt class="col-sm-3">Status </dt>
                        <dd class="col-sm-9">: Negeri </dd>
                        <dt class="col-sm-3">Nomor Stastistik </dt>
                        <dd class="col-sm-9">: 121112100091</dd>
                        <dt class="col-sm-3">Kecamatan</dt>
                        <dd class="col-sm-9">: Rantau Utara</dd>
                        <dt class="col-sm-3">Desa/Kelurahan</dt>
                        <dd class="col-sm-9">: Kartini</dd>
                        <dt class="col-sm-3">Jalan</dt>
                        <dd class="col-sm-9">: Kamp. Baru Gg. Tsanawiyah No.150</dd>
                        <dt class="col-sm-3">Kode Pos</dt>
                        <dd class="col-sm-9">: 21418</dd>
                        <dt class="col-sm-3">Telepon</dt>
                        <dd class="col-sm-9">: + 06212345678</dd>
                        <dt class="col-sm-3">Daerah</dt>
                        <dd class="col-sm-9">: Perkotaan</dd>
                        <dt class="col-sm-3">Akreditasi</dt>
                        <dd class="col-sm-9">: A</dd>
                        <dt class="col-sm-3">Surat Keputusan / SK</dt>
                        <dd class="col-sm-9">: -</dd>
                        <dt class="col-sm-3">Tahun Berdiri</dt>
                        <dd class="col-sm-9">: 1991</dd>
                        <dt class="col-sm-3">Organisasi Penyelenggara</dt>
                        <dd class="col-sm-9">: Pemerintah</dd>
                        <dt class="col-sm-3">NPSN</dt>
                        <dd class="col-sm-9">: 10263986</dd>
                        <dt class="col-sm-3">VISI</dt>
                        <dd class="col-sm-9">: Terwujudnya Madrasah Unggul dalam Prestasi, Terampil, Beriman, Bertaqwa,<br>Berakhlakul Karimah dan Berwawasan Lingkungan.</dd>
                        <dt class="col-sm-3">MISI</dt>
                        
                        <dd class="col-sm-9">: 
                            1. Menyelenggarakan Pendidikan Agama dan Umum secara efektif,<br> sehingga siswa berkembang secara maksimal.<br>
                            2. Melaksanakan pembelajaran kontekstual yang islami.<br>
                            3. Menyelenggarakan kegiatan pengembangan diri terhadap minat dan bakat siswa.<br>
                            4. Melaksanakan pembinaan dan diklat pendidik serta tenaga kependidikan.<br>
                            5. Membudayakan perilaku terpuji dan kepekaan sosial dalam kehidupan sehari-hari.<br>
                            6. Menciptakan peserta didik menjadi hafidz dan hafidzah.<br>
                            7. Menumbuhkembangkan budaya dan tanggung jawab terhadap lingkungan yang<br> terintegrasi dalam proses pembelajaran.
                        </dd>
                    </dl>
                    </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== SCHOOL PROFILE START ========== --}}

</div>

@push('additional-script')

@endpush


