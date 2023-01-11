<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Rekapitulasi Absensi</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Rekapitulasi Absensi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB END ========== --}}



    {{-- ========== NEWS CARD START ========== --}}
    <div class="container-fluid">
        <div class="row align-items-end">
            <div class="col-sm-2 col-md-12">
                <div class="alert alert-warning alert-rounded" id="test"> 
                    <i class="ti ti-alert"></i> 
                    Kehadiran kamu harus lebih dari 80% agar bisa naik kelas!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                        <span aria-hidden="true">×</span> 
                    </button>
                </div>
            </div>
        </div>



        <div class="row justify-content-center">
            
            {{-- ========== WITH PERMISSION START ========== --}}
            <div class="col-lg-4">
                <div class="card rounded border border-warning shadow flex-col justify-content-between h-100">
                    <div class="card-body d-flex flex-column justify-content-between">

                        <div class="d-flex no-block align-items-center m-b-15">
                            <span><i class="ti-calendar"></i></span>
                            <div class="ml-auto">
                                <a href="javascript:void(0)" class="link"><i class="ti-pencil"></i> IZIN</a>
                            </div>
                        </div>

                        <h3 class="font-normal text-center">
                            <i class="ti ti-envelope" style="font-size: 3rem"></i>
                        </h3>

                        <h4 class="text-center font-bold">
                            {{ \App\Models\AbsentRecapitulation::query()->where('NISN', Auth::user()->NISN)->where('school_year_id', session('tempSchoolYear'))->where('type', 'I')->count() }} hari
                        </h4>

                        <div class="row justify-content-center">
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-warning btn-block waves-effect waves-light m-t-20" data-target="#absentInfoModal" data-toggle="modal" wire:click="SetType('I')">Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ========== WITHOUT PERMISSION END ========== --}}



            {{-- ========== SICK START ========== --}}
            <div class="col-lg-4">
                <div class="card rounded border border-orange shadow flex-col justify-content-between h-100">
                    <div class="card-body d-flex flex-column justify-content-between">

                        <div class="d-flex no-block align-items-center m-b-15">
                            <span><i class="ti-calendar"></i></span>
                            <div class="ml-auto">
                                <a href="javascript:void(0)" class="link"><i class="ti-pencil"></i> SAKIT</a>
                            </div>
                        </div>

                        <h3 class="font-normal text-center">
                            <i class="mdi mdi-thermometer" style="font-size: 3rem"></i>
                        </h3>

                        <h4 class="text-center font-bold">
                            {{ \App\Models\AbsentRecapitulation::query()->where('NISN', Auth::user()->NISN)->where('school_year_id', session('tempSchoolYear'))->where('type', 'S')->count() }} hari
                        </h4>

                        <div class="row justify-content-center">
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-orange btn-block waves-effect waves-light m-t-20" data-target="#absentInfoModal" data-toggle="modal" wire:click="SetType('S')">Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ========== SICK END ========== --}}



            {{-- ========== ALPHA START ========== --}}
            <div class="col-lg-4">
                <div class="card rounded border border-danger shadow flex-col justify-content-between h-100">
                    <div class="card-body d-flex flex-column justify-content-between">

                        <div class="d-flex no-block align-items-center m-b-15">
                            <span><i class="ti-calendar"></i></span>
                            <div class="ml-auto">
                                <a href="javascript:void(0)" class="link"><i class="ti-pencil"></i> ALPHA</a>
                            </div>
                        </div>

                        <h3 class="font-normal text-center">
                            <i class="fa fa-comment-slash" style="font-size: 3rem"></i>
                        </h3>

                        <h4 class="text-center font-bold">
                            {{ \App\Models\AbsentRecapitulation::query()->where('NISN', Auth::user()->NISN)->where('school_year_id', session('tempSchoolYear'))->where('type', 'A')->count() }} hari
                        </h4>

                        <div class="row justify-content-center">
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-danger btn-block waves-effect waves-light m-t-20" data-target="#absentInfoModal" data-toggle="modal" wire:click="SetType('A')">Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ========== ALPHA END ========== --}}

        </div>



        <div class="row justify-content-end text-center mt-4">
            <div class="col-lg-12 justify-content-end align-self-end align-items-end">
                <h4 class="font-bold">Total Ketidakhadiran : {{ \App\Models\AbsentRecapitulation::query()->where('NISN', Auth::user()->NISN)->where('school_year_id', session('tempSchoolYear'))->count() }} hari</h4>
            </div>
        </div>
    </div>
    {{-- ========== NEWS CARD END ========== --}}



    {{-- ========== ABSENT MODAL START ========== --}}
    <div class="modal fade show" id="absentInfoModal" tabindex="-1" role="dialog" aria-labelledby="absentInfoModalLabel1" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="loginInfoModalLabel1">Your Absent Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form id="student-absent">
                        <div class="row">
                            <div class="col-12">

                                {{-- ========== ABSENT HISTORY START ========== --}}
                                <div class="table-responsive" style="overflow: hidden">
                                    <table class="table" >
                                        <thead class="bg-inverse text-white">
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border border-dark">
                                            @foreach(\App\Models\AbsentRecapitulation::query()->where('NISN', Auth::user()->NISN)->where('school_year_id', session('tempSchoolYear'))->where('type', $type)->paginate(5, ['*'], 'absentpage') as $data)
                                            <tr>
                                                <td>{{ $loop->iteration + 5 * ($page - 1) }}</td>
                                                <td>{{ $data->date }}</td>
                                                <td>
                                                    {{ $data->type == "I" ? "Izin" : "" }}
                                                    {{ $data->type == "S" ? "Sakit" : "" }}
                                                    {{ $data->type == "A" ? "Alpha" : "" }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-outline-danger" wire:click.prevent="ConfirmToReportError('{{ $data->id }}')"
                                                        @foreach(Auth::user()->query()->where('role', '0')->first()->notifications->where('type', 'App\Notifications\StudentAbsent') as $notification)
                                                            @if($notification->data['absent_id'] == $data->id) 
                                                                @disabled(true)
                                                            @endif 
                                                        @endforeach>
                                                        <i class="fa fa-trash-alt"></i>
                                                        Laporkan Kesalahan
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>



                                    {{-- ========== PAGINATION START ========== --}}
                                    <div class="row justify-content-center align-items-center my-3">
                                        {{ \App\Models\AbsentRecapitulation::query()->where('NISN', Auth::user()->NISN)->where('school_year_id', session('tempSchoolYear'))->paginate(5, ['*'], 'absentpage')->links() }}
                                    </div>
                                    {{-- ========== PAGINATION END ========== --}}
            
                                </div>
                                {{-- ========== ABSENT HISTORY END ========== --}}

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== ABSENT MODAL END ========== --}}



    {{-- ========== FOOTER START ========== --}}
    <footer class="footer text-center font-light" style="margin-top: .78rem">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER END ========== --}}

</div>

@push("additional-style")
    {{-- FOR ALIGNING td TO THE CENTER --}}
    <style>
        tbody td
        {
            vertical-align: middle !important;
        }
    </style>
@endpush

@push('additional-script')
    {{-- SWEET ALERT FOR DELETE SUBJECT --}}
    <script>
        $(function ()
        {
            window.addEventListener('confirm-to-report-error', e =>
            {
                swal({   
                title: "Report an Error!",   
                html: "Apakah kamu yakin ada kesalahan pada informasi absen?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Ya, Laporkan",   
                cancelButtonText: "Batalkan",   
                }).then((isConfirm) => 
                    {   
                        if (isConfirm && isConfirm.dismiss != 'cancel') {     
                            Livewire.emit('SendNotification', e.detail.id);
                        } else {     
                            swal("Batal", "Aksi dibatalkan!", "error");   
                        } 
                    });
                    
            });
        })
    </script>

    {{-- TOAST FOR SENDING NOTIFICATION --}}
    <script>
        $(function ()
        {
            window.addEventListener('send-absent-notification', event => {
                toastr.success('Data absensi akan segera diperiksa!', "Success!", {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
                
                $("#absentInfoModal").find("[data-dismiss=modal]").trigger({ type: "click" })
            })
        })
    </script>
@endpush
