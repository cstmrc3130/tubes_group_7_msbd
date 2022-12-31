<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Ekstrakurikuler Siswa</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Ekstrakurikuler Siswa</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}}



    {{-- ========== CONFIGURE SUBJECT START ========== --}}
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-info border-bottom pb-3">Tambah Ekstrakurikuler Siswa</h4>
                    <div id="education_fields" class="m-t-20"></div>
                    <form class="row align-items-end" wire:submit.prevent="UpdateOrCreateRecords">
                        <div class="col-sm-3 col-md-5">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select class="form-control form-select" wire:model="selectedClass">
                                    <option value=""></option>
                                    @foreach(\App\Models\Classroom\Classroom::all() as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="col-sm-3 col-md-5">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <select class="form-control form-select @error('NISN') is-invalid @enderror" wire:model="NISN">
                                    <option value=""></option>
                                    @foreach(\App\Models\Student\HomeroomClass::query()->where('school_year_id', session('currentSchoolYear'))->where('homeroom_class_id', $selectedClass)->join('students', 'student_homeroom_classes.NISN', '=', 'students.NISN')->orderBy('students.name', 'ASC')->get() as $student)
                                    <option value="{{ $student->NISN }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                                @error('NISN')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>



                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="">Ekstrakurikuler</label>
                                <select class="form-control form-select @error('extracurricular') is-invalid @enderror" wire:model="extracurricular">
                                    <option value=""></option>
                                    @foreach(\App\Models\Extracurricular\Extracurricular::all() as $extracurricular)
                                    <option value="{{ $extracurricular->id }}">{{ $extracurricular->name }}</option>
                                    @endforeach
                                </select>
                                @error('extracurricular')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2 col-md-2">
                            <div class="form-group mb-0">
                                <button class="btn btn-info" type="submit">
                                    <i class="fa fa-check-circle"></i>
                                    Submit
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
                    <h4 class="card-title text-info border-bottom pb-3">Tabulasi Ekstrakurikuler Siswa</h4>
                    <div id="education_fields" class="m-t-20"></div>

                    {{-- <button class="btn btn-outline-orange" style="margin-bottom: 1rem" id="export">
                        <i class="ti ti-export"></i>
                        Export as PDF
                    </button> --}}

                    <div class="table-responsive" id="teaching-extracurricular-tabulation">
                        <table class="table" >
                            <thead class="bg-inverse text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Ekstrakurikuler</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border border-dark">
                                @foreach(\App\Models\Student\TakingExtracurricular::query()->where('NISN', $NISN)->get() as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \App\Models\Extracurricular\Extracurricular::find($data->extracurricular_id)->name }}</td>
                                    <td>{{ \App\Models\SchoolYear::find(session('currentSchoolYear'))->year }}</td>
                                    <td>
                                        <button class="btn btn-block btn-outline-danger" wire:click="DeleteRecord('{{ $data->id }}')">
                                            <i class="mdi mdi-delete-circle"></i>
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== CONFIGURE SUBJECT END ========== --}}



    {{-- ========== FOOTER START ========== --}}
    <footer class="footer text-center">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}}

</div>

@push('additional-style')
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