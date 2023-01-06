<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Sesi Penilaian</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Sesi Penilaian</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}}



    {{-- ========== CONTAINER START ========== --}}
    <div class="container-fluid" style="min-height: 30.333rem">

        {{-- ========== CURRENT ACTIVE SESSION START ========== --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title pb-3 border-bottom text-success">Currently Active Session</h4>
                    <div id="education_fields" class=" m-t-20"></div>
                    <form class="row align-items-end">
                        <div class="col-sm-3 col-md-4">
                            <label for="">Tipe</label>
                            <div class="form-group">
                                <input type="text" class="form-control text-success" disabled readonly wire:model="activeType">
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-3">
                            <label for="">Tanggal Mulai</label>
                            <div class="form-group">
                                <input type="date" class="form-control text-success" disabled readonly wire:model="activeStartDate">
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-3">
                            <label for="">Tanggal Berakhir</label>
                            <div class="form-group">
                                <input type="date" class="form-control text-success" disabled readonly wire:model="activeEndDate">
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <button class="btn btn-danger btn-block" type="button" wire:click="DisableActiveSession" @if(!$activeType) @disabled(true) @endif>
                                    Nonaktifkan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ========== CURRENT ACTIVE SESSION END ========== --}}



        {{-- ========== CONFIGURE DATE START ========== --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-info border-bottom pb-3">Configure Session</h4>
                    <div id="education_fields" class=" m-t-20"></div>
                    <form class="row align-items-end" wire:submit.prevent="SetActiveSession">
                        <div class="col-sm-3 col-md-4">
                            <div class="form-group">
                                <label for="">Tipe</label>
                                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" wire:model.lazy="type">
                                    <option value="HW1">TUGAS 1</option>
                                    <option value="EX1">UJIAN 1</option>
                                    <option value="MID">UJIAN TENGAH SEMESTER</option>
                                    <option value="HW2">TUGAS 2</option>
                                    <option value="EX2">UJIAN 2</option>
                                    <option value="FIN">UJIAN AKHIR SEMESTER</option>
                                </select>
                                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-3">
                            <div class="form-group">
                                <label for="">Tanggal Mulai</label>
                                <input type="date" class="form-control @error('startDate') is-invalid @enderror" id="start-date" name="start-date" placeholder="Tanggal Mulai" wire:model.lazy="startDate">
                                @error('startDate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-3">
                            <div class="form-group">
                                <label for="">Tanggal Berakhir</label>
                                <input type="date" class="form-control @error('endDate') is-invalid @enderror" id="end-date" name="end-date" placeholder="Tanggal Berakhir" wire:model.lazy="endDate">
                                @error('endDate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <button class="btn btn-outline-info btn-block" type="submit">
                                    <i class="fa fa-check-circle"></i>
                                    Set As Active
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ========== CONFIGURE DATE END ========== --}}



        {{-- ========== PAST SESSION START ========== --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-danger border-bottom pb-3">Session History</h4>
                    <div id="education_fields" class="m-t-20"></div>
                    <div class="table-responsive" style="overflow: hidden">
                        <table class="table" >
                            <thead class="bg-inverse text-white">
                                <tr>
                                    <th>No.</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th>Tipe</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Berakhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border border-dark">
                                @foreach(\App\Models\ScoringSession::query()->orderBy('created_at', 'DESC')->paginate(6) as $data)
                                <tr>
                                    <td>{{ $loop->iteration + 5 * ($page - 1) }}</td>
                                    <td>{{ $data->schoolyear->year }}</td>
                                    <td>{{ $data->schoolyear->semester }}</td>
                                    <td>{{ $data->type }}</td>
                                    <td>{{ $data->start_date }}</td>
                                    <td>{{ $data->end_date }}</td>
                                    <td>
                                        <button class="btn btn-block btn-outline-danger" data-toggle="modal" data-target="#studentInfoModal" wire:click="DeleteScoringSession('{{ $data->id }}')">
                                            <i class="ti-trash"></i>
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                        {{-- ========== PAGINATION START ========== --}}
                        <div class="row justify-content-center align-items-center my-3">
                            {{ \App\Models\ScoringSession::query()->orderBy('created_at', 'DESC')->paginate(6)->links() }}
                        </div>
                        {{-- ========== PAGINATION END ========== --}}

                    </div>
                </div>
            </div>
        </div>
        {{-- ========== PAST SESSION END ========== --}}

    </div>
    {{-- ========== CONTAINER END ========== --}}



    {{-- ========== FOOTER START ========== --}}
    <footer class="footer text-center">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}}

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
    {{-- TOAST FOR CONFIGURED SESSION --}}
    <script>
        $(function ()
        {
            window.addEventListener('success-configure-session', e =>
            {
                toastr.success("Sesi disetel untuk penilaian " + e.detail.data + "!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>

    {{-- TOAST FOR DISABLED SESSION --}}
    <script>
        $(function ()
        {
            window.addEventListener('scoring-session-disabled', e =>
            {
                toastr.error("Sesi untuk penilaian " + e.detail.data + " dinonaktifkan!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>

    {{-- TOAST FOR DELETED SESSION --}}
    <script>
        $(function ()
        {
            window.addEventListener('scoring-session-deleted', e =>
            {
                toastr.success("Sesi penilaian dihapus!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>

    {{-- TOAST FOR ALREADY FILLED SESSION --}}
    <script>
        $(function ()
        {
            window.addEventListener('data-already-filled', e =>
            {
                toastr.warning("Data tidak bisa dihapus karena nilai sudah diinput!", 'Warning!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>
@endpush
