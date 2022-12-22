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



    {{-- ========== CONFIGURE DATE START ========== --}}
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title pb-3 border-bottom text-success">Ongoing Session</h4>
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
                                <button class="btn btn-success" type="button" disabled>
                                    <i class="fa fa-check-circle"></i>
                                    Currently Active
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


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
                                <button class="btn btn-outline-info" type="submit">
                                    <i class="fa fa-check-circle"></i>
                                    Set As Active
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== CONFIGURE DATE END ========== --}}



    {{-- ========== FOOTER START ========== --}}
    <footer class="footer text-center">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}}

</div>

@push('additional-script')
    <script>
        $(function ()
        {
            window.addEventListener('success-configure-session', e =>
            {
                toastr.success("Sesi disetel untuk penilaian " + e.detail.data + "!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>
@endpush
