<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}} 
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <span>
                    Selamat Datang, <h4 class="page-title"> {{ Auth::user()->teacher->name }}</h4>
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



    {{-- ========== ENTITIES AMOUNT START ========== --}}
    <div class="container-fluid" style="min-height: 1px">

        {{-- ========== ALERT FOR SCORING START ========== --}} 
        @if(App\Models\ScoringSession::query()->where('start_date', "!=", "0000-00-00")->where('end_date', ">=", date("Y-m-d"))->where('school_year_id', session('tempSchoolYear'))->first())
        <div class="row align-items-end">
            <div class="col-sm-2 col-md-12">
                <div class="d-flex alert alert-warning alert-rounded"> 
                    <i class="ti ti-info col-1 align-self-center text-center"></i>
                    
                    <span class="col-10">
                        Kepada Bapak/Ibu Guru Yang Terhormat, minggu ini merupakan masa pengisian nilai 
                        {{ App\Models\ScoringSession::query()->where('start_date', "!=", "0000-00-00")->where('end_date', ">=", date("Y-m-d"))->where('school_year_id', session('tempSchoolYear'))->first()->type }}.
                        <br>
                        Silakan untuk segera menginput nilai siswa sebelum {{ \Carbon\Carbon::parse(App\Models\ScoringSession::query()->where('start_date', "!=", "0000-00-00")->where('end_date', ">=", date("Y-m-d"))->where('school_year_id', session('tempSchoolYear'))->first()->end_date)->format('d F Y') }} pukul 23:59 WIB
                    </span>  
                    
                    <button type="button" class="close col-1" data-dismiss="alert" aria-label="Close"> 
                        <span aria-hidden="true">×</span> 
                    </button>
                </div>
            </div>
        </div>
        @endif
        {{-- ========== ALERT FOR SCORING END ========== --}} 



        <div class="row">

            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <i class="mdi mdi-emoticon font-20 text-info"></i>
                                <p class="font-16 m-b-5">Kelas</p>
                            </div>
                            <div class="col-6">
                                <h1 class="font-light text-right mb-0">{{ \App\Models\Teacher\HomeroomClass::query()->where('NIP', auth()->user()->NIP)->first()->classroom->name }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <i class="mdi mdi-account-multiple font-20 text-success"></i>
                                <p class="font-16 m-b-5">Guru</p>
                            </div>
                            <div class="col-5">
                                <h1 class="font-light text-right mb-0">{{ \App\Models\Teacher\Teacher::all()->count() }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- ========== ENTITIES AMOUNT START ========== --}}



    {{-- ========== CONTAINER START ========== --}} 
    <div class="container-fluid" style="min-height: 1px">

        {{-- ========== QUOTE START ========== --}} 
        <div class="row align-items-center" style="margin-top: 4rem">
            <div class="col-lg-12 mb-4 mb-lg-0">
                <figure class="bg-white p-3 rounded border-left border-danger border-2" >
                    <blockquote class="blockquote mb-0">
                        <p>
                            {!! \Illuminate\Foundation\Inspiring::quote() !!}
                        </p>
                    </blockquote>
                </figure>
            </div>
        </div>
        {{-- ========== QUOTE END ========== --}} 

    </div>
    {{-- ========== CONTAINER END ========== --}} 



    {{-- ========== FOOTER START ========== --}} 
    <footer class="footer text-center" style="padding: .8rem">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}} 

</div>