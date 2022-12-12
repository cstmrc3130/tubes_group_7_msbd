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
                            <div class="col-7">
                                <i class="mdi mdi-emoticon font-20 text-info"></i>
                                <p class="font-16 m-b-5">Siswa</p>
                            </div>
                            <div class="col-5">
                                <h1 class="font-light text-right mb-0">{{ $studentCount }}</h1>
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
                                <i class="mdi mdi-image font-20 text-success"></i>
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
                                <i class="mdi mdi-currency-eur font-20 text-purple"></i>
                                <p class="font-16 m-b-5">Mata Pelajaran</p>
                            </div>
                            <div class="col-5">
                                <h1 class="font-light text-right mb-0">157</h1>
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
                                <i class="mdi mdi-poll font-20 text-danger"></i>
                                <p class="font-16 m-b-5">Kelas</p>
                            </div>
                            <div class="col-5">
                                <h1 class="font-light text-right mb-0">236</h1>
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
        <livewire:online-users-collection />
    </div>
    {{-- ========== DATA TABLE FOR ACTIVE USERS START ========== --}}



    {{-- ========== FOOTER START ========== --}}
    <footer class="footer text-center">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}}



    {{-- ========== PROFILE MODAL START ========== --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Profile Info</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    <form>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="fname" placeholder="First Name Here">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="lname" placeholder="Last Name Here">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email1" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email1" placeholder="Email Here">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Contact No</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="cono1" placeholder="Contact No Here">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- ========== PROFILE MODAL END ========== --}}

</div>

@push('additional-style')
    <style>
        .vertical-align-middle{
            vertical-align: middle !important
        }
    </style>
@endpush

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