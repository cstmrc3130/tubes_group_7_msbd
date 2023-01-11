<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Nilai Ekstrakurikuler</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Nilai Ekstrakurikuler</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}}



    {{-- ========== CONTAINER START ========== --}}
    <div class="container-fluid">

        {{-- ========== EXTRACURRICULAR SCORE START ========== --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex align-items-center justify-content-start mb-2" >
                        <h4 class="col-sm-6 col-md-6 card-title text-info border-bottom pb-3 px-0">
                            Nilai Ekstrakurikuler {{ \App\Models\Teacher\TeachingExtracurricular::query()->where('NIP', Auth::user()->NIP)->where('school_year_id', session('currentSchoolYear'))->first()->extracurricular->name }}
                        </h4>

                        {{-- ========== EXPORT BUTTONS START ========== --}}
                        <div class="col-sm-6 col-md-6 text-right align-self-start px-0">
                            <a href="{{ route('teacher.export-extracurricular-score') }}" class="btn btn-success">Export as Excel</a>
                        </div>
                        {{-- ========== EXPORT BUTTONS END ========== --}}

                    </div>

                    {{-- ========== ROW TITLE START ========== --}}
                    <div class="row align-items-end">
                        <div class="col-sm-3 col-md-5">
                            <div class="text-left">
                                <label for="">Nama</label>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-5">
                            <div class="text-left">
                                <label for="">Nilai</label>
                            </div>
                        </div>

                    </div>
                    {{-- ========== ROW TITLE END ========== --}}

                    @foreach(\App\Models\Student\TakingExtracurricular::query()->where('school_year_id', session('currentSchoolYear'))->join("students", 'taking_extracurriculars.NISN', '=', 'students.NISN')->groupBy('name')->paginate(5) as $student)
                        @livewire('teacher.extracurricular-score-inline', ['eachStudent' => $student, 'extracurricular' => \App\Models\Teacher\TeachingExtracurricular::query()->where('NIP', Auth::user()->NIP)->where('school_year_id', session('currentSchoolYear'))->first()->extracurricular_id], key($student->NISN))
                    @endforeach

                    {{-- ========== PAGINATION START ========== --}}
                    <div class="row justify-content-center align-items-center mt-3 mb-0">
                        {{ \App\Models\Student\TakingExtracurricular::query()->where('school_year_id', session('currentSchoolYear'))->join("students", 'taking_extracurriculars.NISN', '=', 'students.NISN')->groupBy('name')->paginate(5)->links() }}
                    </div>
                    {{-- ========== PAGINATION END ========== --}}

                </div>
            </div>
        </div>
        {{-- ========== EXTRACURRICULAR SCORE START ========== --}}

    </div>
    {{-- ========== CONTAINER END ========== --}}



    {{-- ========== FOOTER START ========== --}} 
    <footer class="footer text-center mt-5">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}} 

</div>

@push('additional-script')
    {{-- TOAST FOR SUCCESSFUL SCORE INSERTION --}}
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
                toastr.error('Nilai ' + e.detail.name + ' gagal diinput!', 'Failure!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>
@endpush