<div class="livewire-component">

    {{-- ========== BREADCRUMB START ========== --}} 
    <div class="page-breadcrumb mb-3">
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

            {{-- ========== PROFILE START ========== --}} 
            <div class="col-sm-12 col-md-6">
                <div class="card card-hover bg-success btn btn-block waves-effect rounded" wire:click="Profile">
                    <div class="card-body text-white">
                        <div class="d-flex flex-row">
                            <div class="align-self-center display-6"><i class="mdi mdi-account-card-details"></i></div>
                            <div class="p-10 align-self-center">
                                <h4 class="m-b-0">Informasi Profil</h4>
                            </div>
                            <div class="ml-auto align-self-center">
                                <h2 class="font-medium m-b-0">&#x203A;</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ========== PROFILE END ========== --}} 



            {{-- ========== HOMEROOM CLASS START ========== --}} 
            <div class="col-sm-12 col-md-6"> 
                <div class="card card-hover bg-info btn btn-block waves-effect rounded" wire:click="Class( '{{ Auth::id() }}' )">
                    <div class="card-body text-white">
                        <div class="d-flex flex-row">
                            <div class="align-self-center display-6"><i class="mdi mdi-chair-school"></i></div>
                            <div class="p-10 align-self-center">
                                <h4 class="m-b-0">Informasi Kelas</h4>
                            </div>
                            <div class="ml-auto align-self-center">
                                <h2 class="font-medium m-b-0">&#x203A;</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ========== HOMEROOM CLASS END ========== --}} 



            {{-- ========== SUBJECT START ========== --}} 
            <div class="col-sm-12 col-md-6">
                <div class="card card-hover bg-warning btn btn-block waves-effect rounded">
                    <div class="card-body text-white">
                        <div class="d-flex flex-row">
                            <div class="align-self-center display-6"><i class="mdi mdi-book-open"></i></div>
                            <div class="p-10 align-self-center">
                                <h4 class="m-b-0">Informasi Mata Pelajaran</h4>
                            </div>
                            <div class="ml-auto align-self-center">
                                <h2 class="font-medium m-b-0">&#x203A;</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ========== SUBJECT END ========== --}} 



            {{-- ========== EXTRACURRICULAR START ========== --}} 
            <div class="col-sm-12 col-md-6">
                <div class="card card-hover bg-cyan btn btn-block waves-effect rounded">
                    <div class="card-body text-white">
                        <div class="d-flex flex-row">
                            <div class="align-self-center display-6"><i class="mdi mdi-football"></i></div>
                            <div class="p-10 align-self-center">
                                <h4 class="m-b-0">Informasi Ekstrakurikuler</h4>
                            </div>
                            <div class="ml-auto align-self-center">
                                <h2 class="font-medium m-b-0">&#x203A;</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ========== EXTRACURRICULAR END ========== --}} 



            {{-- ========== QUOTE START ========== --}} 
            <div class="container pt-5 h-100">
                <div class="row d-flex align-items-center h-100">
                    <div class="col col-lg-12 mb-4 mb-lg-0">
                        <figure class="bg-white p-3 rounded border-left border-danger border-2" >
                            <blockquote class="blockquote pb-2">
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
    <footer class="footer text-center">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}} 

</div>



