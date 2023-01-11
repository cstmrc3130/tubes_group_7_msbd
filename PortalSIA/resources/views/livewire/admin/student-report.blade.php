<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Rapor Siswa</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Rapor Siswa</li>
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
                    <h4 class="card-title text-info border-bottom pb-3">Konfigurasi Kelas Dan Nama</h4>
                    <div id="education_fields" class="m-t-20"></div>
                    <form class="row align-items-end" wire:submit.prevent="UpdateOrCreateRecords">
                        <div class="col-sm-3 col-md-6">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select name="class-name" class="form-control form-select" wire:model="selectedClass">
                                    <option value=""></option>
                                    @foreach(\App\Models\Classroom\Classroom::query()->whereHas('homeroomclass', fn($q) => $q->where('school_year_id', session('currentSchoolYear')))->get() as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="col-sm-3 col-md-6">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <select name="student-name" class="form-control form-select @error('NISN') is-invalid @enderror" wire:model="NISN">
                                    <option value=""></option>
                                    @foreach(\App\Models\Student\HomeroomClass::query()->where('school_year_id', session('currentSchoolYear'))->where('homeroom_class_id', $selectedClass)->join('students', 'student_homeroom_classes.NISN', '=', 'students.NISN')->orderBy('students.name', 'ASC')->get() as $student)
                                    <option value="{{ $student->NISN }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                                @error('NISN')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="col-md-12">
            <div class="card">
                <div class="card-body" wire:loading.remove>
                    <div class="d-flex align-items-center justify-content-start mb-2" >
                        <h4 class="col-sm-6 col-md-6 card-title text-info border-bottom pb-3 px-0">
                            Tabulasi Nilai {{ $NISN ? $NISN : "Siswa" }}
                        </h4>

                        {{-- ========== EXPORT BUTTONS START ========== --}}
                        <div class="col-sm-6 col-md-6 text-right align-self-start px-0">
                            <a href="{{ session('currentSemester') == "Genap" ? route('student-report-even', $NISN) : route('student-report-odd', $NISN) }}" class="btn btn-success">
                                <i class="ti ti-printer"></i>
                                Print Report
                            </a>
                        </div>
                        {{-- ========== EXPORT BUTTONS END ========== --}}

                    </div>

                    {{-- ========== ROW TITLE START ========== --}}
                    <div class="row align-items-end">
                        <div class="col-sm-3 col-md-4">
                            <div class="text-left">
                                <label for="">Mata Pelajaran</label>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="text-center">
                                <label for="">HW1</label>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="text-center">
                                <label for="">EX1</label>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="text-center">
                                <label for="">MID</label>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="text-center">
                                <label for="">HW2</label>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="text-center">
                                <label for="">EX2</label>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="text-center">
                                <label for="">FIN</label>
                            </div>
                        </div>
                    </div>
                    {{-- ========== ROW TITLE END ========== --}}

                    @if($NISN)
                        @foreach(\App\Models\Subject\Subject::query()->where('school_year_id', session('currentSchoolYear'))->whereNot('name', "KIMIA")->groupBy('name')->get() as $subject)
                            @livewire('admin.student-score-inline', ['NISN' => $NISN, 'subject' => $subject], key($subject->id))
                        @endforeach
                    @endif

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
    {{-- TOAST FOR FAILED EXPORT --}}
    <script>
        $(function ()
        {
            @if(Session::has('report-not-found'))
                toastr.error("{{ session('report-not-found') }}", 'Failure!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            @endif
        })
    </script>

    {{-- TOAST FOR SUCCESS SCORE INSERTION --}}
    <script>
        $(function ()
        {
            window.addEventListener('score-inserted-successfully', e =>
            {
                toastr.success('Nilai ' + e.detail.name + ' berhasil diinput!', 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>

    {{-- TOAST FOR FAILED SCORE INSERTION --}}
    <script>
        $(function ()
        {
            window.addEventListener('score-insertion-failure', e =>
            {
                toastr.error('Nilai ' + e.detail.name + ' gagal diinput!' + '<br>' + 'Pastikan tidak ada field yang kosong!', 'Failure!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>
@endpush