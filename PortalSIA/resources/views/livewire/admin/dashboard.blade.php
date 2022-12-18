<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Dashboard</h4>
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
    <div class="container-fluid" style="min-height: 1em">
        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <i class="mdi mdi-emoticon font-20 text-info"></i>
                                <p class="font-16 m-b-5">Siswa</p>
                            </div>
                            <div class="col-6">
                                <h1 class="font-light text-center mb-0">{{ $studentCount }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <i class="mdi mdi-account-multiple font-20 text-success"></i>
                                <p class="font-16 m-b-5">Guru</p>
                            </div>
                            <div class="col-5">
                                <h1 class="font-light text-right mb-0">{{ $teacherCount }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <i class="mdi mdi-city font-20 text-danger"></i>
                                <p class="font-16 m-b-5">Kelas</p>
                            </div>
                            <div class="col-5">
                                <h1 class="font-light text-right mb-0">{{ $classroomCount }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <i class="mdi mdi-calendar font-20 text-purple"></i>
                                <p class="font-16 m-b-5">Tahun Ajaran</p>
                            </div>
                            <div class="col-5">
                                <h1 class="font-light font-14 text-right mb-0">{{ \App\Models\SchoolYear::latest()->take(1)->value('year') }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- ========== ENTITIES AMOUNT START ========== --}}



    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Currently Active Users</h4>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}}



    {{-- ========== DATA TABLE FOR ACTIVE USERS START ========== --}}
    <div class="container-fluid" wire:poll>
        <livewire:online-user-collection />
    </div>
    {{-- ========== DATA TABLE FOR ACTIVE USERS START ========== --}}



    {{-- ========== FOOTER START ========== --}}
    <footer class="footer text-center">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}}

</div>

@push('additional-script')
    {{-- SWEET ALERT FOR ONLINE USER --}}
    <script>
        $(function ()
        {
            window.addEventListener('confirm-to-end-session', e =>
            {
                swal({   
                title: "End Session",   
                text: "Akhiri sesi untuk " + e.detail.username + "?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Akhiri",   
                cancelButtonText: "Batalkan",   
                }).then((isConfirm) => 
                    {   
                        if (isConfirm && isConfirm.dismiss != 'cancel') {     
                            Livewire.emit('EndUserSession', e.detail.id);
                        } else {     
                            swal("Batal", "Sesi tidak jadi diakhiri!", "error");   
                        } 
                    });
                    
            })
        })
    </script>
@endpush