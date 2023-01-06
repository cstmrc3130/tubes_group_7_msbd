<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Nilai Mata Pelajaran</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Nilai Mata Pelajaran</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}}



    {{-- ========== CONTAINER START ========== --}}
    <div class="container-fluid">

        {{-- ========== CONFIGURE CLASS START ========== --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-info border-bottom pb-3">Mata Pelajaran & Kelas</h4>
                    <div class="row align-items-end">
                        <div class="col-sm-3 col-md-6">
                            <div class="form-group">
                                <label for="">Mata Pelajaran</label>
                                <select class="form-control form-select" wire:model="dynamicSubject">
                                    <option value=""></option>
                                    @foreach(\App\Models\Teacher\TeachingSubject::query()->where('NIP', auth()->user()->NIP)->groupBy('subject_id')->get() as $subject)
                                        <option value="{{ $subject->subject_id }}">{{ $subject->subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-6">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select class="form-control form-select" wire:model="selectedClass">
                                    <option value=""></option>
                                    @foreach(\App\Models\Teacher\TeachingSubject::query()->where('NIP', auth()->user()->NIP)->where('subject_id', $dynamicSubject)->get() as $class)
                                        <option value="{{ $class->class_id }}">{{ $class->classroom->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ========== CONFIGURE CLASS END ========== --}}



        {{-- ========== SUBJECT SCORE START ========== --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-info border-bottom pb-3">Nilai Siswa</h4>

                    @if(\App\Models\ScoringSession::query()->first() == NULL || !$activeScoringSession)
                    <div class="row align-items-end">
                        <div class="col-sm-2 col-md-12">
                            <div class="alert alert-warning alert-rounded" id="test"> 
                                <i class="ti ti-alert"></i> 
                                Saat ini bukan merupakan masa pengisian nilai!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                    <span aria-hidden="true">×</span> 
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- ========== ROW TITLE START ========== --}}
                    <div class="row align-items-end">
                        <div class="col-sm-3 col-md-4">
                            <div class="text-left">
                                <label for="">Nama</label>
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

                    @foreach(\App\Models\Student\HomeroomClass::query()->where('school_year_id', session('currentSchoolYear'))->where('homeroom_class_id', $selectedClass)->join("students", 'student_homeroom_classes.NISN', '=', 'students.NISN')->groupBy('name')->paginate(5) as $student)
                        @livewire('teacher.subject-score-inline', ['eachStudent' => $student, 'activeScoringSession' => $activeScoringSession, 'subject' => $dynamicSubject], key($student->NISN))
                    @endforeach

                    {{-- ========== PAGINATION START ========== --}}
                    <div class="row justify-content-center align-items-center my-3">
                        {{ \App\Models\Student\HomeroomClass::query()->where('school_year_id', session('currentSchoolYear'))->where('homeroom_class_id', $selectedClass)->join("students", 'student_homeroom_classes.NISN', '=', 'students.NISN')->groupBy('name')->paginate(5)->links() }}
                    </div>
                    {{-- ========== PAGINATION END ========== --}}

                </div>
            </div>
        </div>
        {{-- ========== SUBJECT SCORE START ========== --}}

    </div>
    {{-- ========== CONTAINER END ========== --}}



    {{-- ========== FOOTER START ========== --}} 
    <footer class="footer text-center mt-5">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}} 

</div>

@push('additional-script')
    <script>
        $(function ()
        {
            window.addEventListener('score-inserted-successfully', e =>
            {
                toastr.success('Nilai ' + e.detail.name + ' berhasil diinput!', 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>
@endpush