<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}} 
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <span>
                    Selamat Datang, <h4 class="page-title"> {{ Auth::user()->student->name }}</h4>
                </span> 
                
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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

            {{-- ========== CLASS START ========== --}} 
            <div class="col-sm-12 col-md-6">
                <div class="card card-hover bg-info btn btn-block waves-effect rounded" onclick="return window.location.href = '{{ route('student.homeroom-class') }}'">
                    <div class="card-body text-white p-0">
                        <div class="d-flex flex-row">
                            <div class="align-self-center display-6"><i class="mdi mdi-chair-school"></i></div>
                            <div class="p-2 align-self-center">
                                <h4 class="m-b-0">Informasi Kelas</h4>
                            </div>
                            <div class="ml-auto align-self-center">
                                <h2 class="font-medium m-b-0">&#x203A;</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ========== CLASS END ========== --}} 



            {{-- ========== ABSENT RECAPITULATION START ========== --}} 
            <div class="col-sm-12 col-md-6"> 
                <div class="card card-hover bg-warning btn btn-block waves-effect rounded" onclick="return window.location.href = '{{ route('student.absent-recapitulation') }}'">
                    <div class="card-body text-white p-0">
                        <div class="d-flex flex-row">
                            <div class="align-self-center display-6"><i class="mdi mdi-playlist-check"></i></div>
                            <div class="p-2 align-self-center">
                                <h4 class="m-b-0">Rekapitulasi Absensi</h4>
                            </div>
                            <div class="ml-auto align-self-center">
                                <h2 class="font-medium m-b-0">&#x203A;</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ========== ABSENT RECAPITULATION END ========== --}} 



            {{-- ========== MONTHLY REPORT START ========== --}} 
            <div class="col-sm-12 col-md-6">
                <div class="card card-hover bg-cyan btn btn-block waves-effect rounded" onclick="return window.location.href = '{{ route('student.monthly-report') }}'">
                    <div class="card-body text-white p-0">
                        <div class="d-flex flex-row">
                            <div class="align-self-center display-6"><i class="ti-agenda"></i></div>
                            <div class="p-2 align-self-center">
                                <h4 class="m-b-0">Rapor Bulanan</h4>
                            </div>
                            <div class="ml-auto align-self-center">
                                <h2 class="font-medium m-b-0">&#x203A;</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ========== MONTHLY REPORT END ========== --}} 



            {{-- ========== SEMESTER REPORT START ========== --}} 
            <div class="col-sm-12 col-md-6">
                <div class="card card-hover bg-success btn btn-block waves-effect rounded" onclick="return window.location.href = '{{ route('student.semester-report') }}'">
                    <div class="card-body text-white p-0">
                        <div class="d-flex flex-row">
                            <div class="align-self-center display-6"><i class="ti-bookmark-alt"></i></div>
                            <div class="p-2 align-self-center">
                                <h4 class="m-b-0">Rapor Semester</h4>
                            </div>
                            <div class="ml-auto align-self-center">
                                <h2 class="font-medium m-b-0">&#x203A;</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ========== SEMESTER REPORT END ========== --}} 



            {{-- ========== QUOTE START ========== --}} 
            <div class="container pt-5 h-100 mb-5">
                <div class="row d-flex align-items-center h-100">
                    <div class="col col-lg-12 mb-4 mb-lg-0">
                        <figure class="bg-white p-3 rounded border-left border-danger border-2" >
                            <blockquote class="blockquote mb-0">
                                <p>
                                    {!! \Illuminate\Foundation\Inspiring::quote() !!}
                                </p>
                            </blockquote>
                        </figure>
                    </div>
                </div>
            </div>
            {{-- ========== QUOTE END ========== --}} 

        </div>
    </div>
    {{-- ========== CONTENT START ========== --}} 



    {{-- ========== FOOTER START ========== --}} 
    <footer class="footer text-center mt-5">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}} 

</div>



