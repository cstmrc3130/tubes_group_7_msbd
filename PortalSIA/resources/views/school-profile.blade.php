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

       {{-- ========== PROFIL SCHOOL ========= --}}
       <div class="main-wrapper">
        <div class="container" style="margin-left: 15%; margin-top:5%">
        <div style= "text-align:justify; color:black;">
            <h2> Profil Sekolah </h2>
            <img src="{{ asset("assets/images/front-gate1.jpg")}}" style="width: 40%; text-align:center" class="m-b-30">
        <dl class="row" style="text-align:justify">
            <dt class="col-sm-3">Nama Sekolah  </dt>
            <dd class="col-sm-9">: MTsn 1 Labuhanbatu</dd>
            <dt class="col-sm-3">Status </dt>
            <dd class="col-sm-9">: Negeri </dd>
            <dt class="col-sm-3">Nomor Stastistik  </dt>
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
            <dd class="col-sm-9">: 1. Menyelenggarakan Pendidikan Agama dan Umum secara efektif,<br> sehingga siswa berkembang secara maksimal.<br>
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


{{-- ========== PROFIL SCHOOL END ========= --}}



        {{-- ========== FOOTER START ========== --}}
        <x-school-events.footer/>
        {{-- ========== FOOTER END ========== --}}

    </div>



    {{-- ========== JAVASCRIPTS ========== --}}
    <x-landing-page.javascript />

</body>



</html>