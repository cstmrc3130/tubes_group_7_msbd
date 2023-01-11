<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}} 
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Informasi Kelas</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Informasi Kelas</li>
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
                    <h4 class="card-title text-info border-bottom pb-3">Detail Informasi Kelas</h4>
                    <div id="education_fields" class="m-t-20"></div>
                    <form class="row align-items-start justify-content-between">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="" class="mb-0">Pilih Tahun Ajaran</label>
                                <select class="form-control form-select" wire:model="selectedSchoolYear">
                                    <option value=""></option>
                                    @foreach(\App\Models\SchoolYear::query()->where('id', \App\Models\Student\HomeroomClass::query()->where('NISN', Auth::user()->NISN)->value('school_year_id'))->get() as $schoolYear)
                                    <option value="{{ $schoolYear->id }}">{{ $schoolYear->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="white-box text-right"> 
                                <img src="{{ asset('assets/images/classroom.svg') }}" class="img-responsive" style="height: 4.777rem"> 
                            </div>
                        </div>
                    </form>



                    <div class="row align-items-center mb-2" >

                        {{-- ========== CLASS NAME START ========== --}}
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group mb-0">
                                <label for="" class="text-success font-bold mb-0">Kelas : {{ \App\Models\Student\HomeroomClass::query()->where('NISN', Auth::user()->NISN)->where('school_year_id', $selectedSchoolYear)->join("classes", "student_homeroom_classes.homeroom_class_id", '=', 'classes.id')->value('name') }}</label>
                            </div>
                            <div class="form-group mb-0">
                                <label for="" class="text-success font-bold mb-0">Wali Kelas : {{ $homeroomTeacherName }}</label>
                            </div>
                        </div>
                        {{-- ========== CLASS NAME END ========== --}}

                    </div>



                    <h4 class="text-center mt-5 font-bold text-secondary">TEMAN SATU KELAS ANDA</h4>
                    <div class="table-responsive" style="overflow: hidden">
                        <table class="table" >
                            <thead class="bg-inverse text-white">
                                <tr>
                                    <th>No.</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                </tr>
                            </thead>
                            <tbody class="border border-dark">
                                @foreach(\App\Models\Student\HomeroomClass::query()->where('school_year_id', $selectedSchoolYear)->where('homeroom_class_id', \App\Models\Student\HomeroomClass::query()->where('NISN', Auth::user()->NISN)->where('school_year_id', $selectedSchoolYear)->value('homeroom_class_id'))->join('students', 'student_homeroom_classes.NISN', '=', 'students.NISN')->orderBy('students.name', 'ASC')->paginate(5) as $data)
                                <tr>
                                    <td>{{ $loop->iteration + 5 * ($page - 1) }}</td>
                                    <td>{{ $data->NISN }}</td>
                                    <td>{{ \App\Models\Student\Student::query()->where('NISN', $data->NISN)->value('name') }}</td>
                                    <td>{{ \Carbon\Carbon::parse(\App\Models\Student\Student::query()->where('NISN', $data->NISN)->value('date_of_birth'))->format("d F Y") }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                        {{-- ========== PAGINATION START ========== --}}
                        <div class="row justify-content-center align-items-center my-3">
                            {{ \App\Models\Student\HomeroomClass::query()->where('school_year_id', $selectedSchoolYear)->where('homeroom_class_id', \App\Models\Student\HomeroomClass::query()->where('NISN', Auth::user()->NISN)->where('school_year_id', $selectedSchoolYear)->value('homeroom_class_id'))->join('students', 'student_homeroom_classes.NISN', '=', 'students.NISN')->orderBy('students.name', 'ASC')->paginate(5)->links() }}
                        </div>
                        {{-- ========== PAGINATION END ========== --}}

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
