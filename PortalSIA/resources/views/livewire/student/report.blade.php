<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Rapor Semester</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Rapor Semester</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}}



    {{-- ========== CLASS DETAILS START ========== --}}
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-info border-bottom pb-3">Cetak Rapor Semester</h4>
                    <div id="education_fields" class="m-t-20"></div>
                    <form class="row align-items-center">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="" class="mb-0">Pilih Tahun Ajaran</label>
                                <select class="form-control form-select" wire:model="selectedSchoolYear">
                                    <option value=""></option>
                                    @foreach(\App\Models\Student\HomeroomClass::query()->where("NISN", Auth::user()->NISN)->get() as $schoolYear)
                                    <option value={{ $schoolYear->schoolyear->year }}>{{ $schoolYear->schoolyear->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="" class="mb-0">Pilih Semester</label>
                                <select class="form-control form-select" wire:model="selectedSemester">
                                    <option value=""></option>
                                    @if($selectedSchoolYear)
                                    @foreach(\App\Models\SchoolYear::query()->where('year', 'LIKE', '%' . $selectedSchoolYear . '%')->orderBy('semester', 'ASC')->get() as $semester)
                                    <option value="{{ $semester->id }}">{{ $semester->semester }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </form>



                    <div class="row justify-content-start align-items-center mt-4" >

                        {{-- ========== PRINT BUTTONS START ========== --}}
                        <div class="col-sm-6 col-md-6">
                            <a href="{{ session('selectedSemester') == "Ganjil" ? route('student.print-report-odd') : route('student.print-report-even') }}" class="btn btn-outline-success">
                                <span class="fa fa-print"></span>
                                Print
                            </a>
                        </div>
                        {{-- ========== PRINT BUTTONS END ========== --}}

                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== CLASS DETAILS END ========== --}}



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

@endpush