<div class="livewire-component">

    {{-- ========== BREADCRUMB START ========== --}} 
    <div class="page-breadcrumb mb-3">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Informasi Kelas</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Informasi Kelas</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}} 



    {{-- ========== CONTENT START ========== --}} 
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Kelas {{ $homeroomClassName }}</h3>
                        <h6 class="card-subtitle">Semester {{ $homeroomClassSemester }}</h6>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="white-box text-center"> <img src="{{ asset('assets/images/classroom.svg') }}" class="img-responsive"> </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-6">
                                <h4 class="box-title m-t-40">Deskripsi Kelas</h4>
                                <p>Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. but the majority have suffered alteration in some form, by injected humour</p>
                                <h2 class="m-t-40">
                                    Wali Kelas 
                                    <small class="text-success">
                                        (Nama Guru)
                                    </small>
                                </h2>
                                <h3 class="box-title m-t-40">Detail Kelas</h3>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-check text-success"></i> Jumlah Siswa {{ $homeroomClassStudent }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    {{-- ========== CONTENT START ========== --}} 



    {{-- ========== FOOTER START ========== --}} 
    <footer class="footer text-center">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}} 

</div>
