<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Info Kelas</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Info Kelas</li>
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
                    <h4 class="card-title text-info border-bottom pb-3">Detail Informasi Wali Kelas</h4>
                    <div id="education_fields" class="m-t-20"></div>
                    <form class="row align-items-center">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="" class="mb-0">Pilih Tahun Ajaran</label>
                                <select class="form-control form-select" wire:model="selectedSchoolYear">
                                    <option value=""></option>
                                    @foreach(\App\Models\Teacher\HomeroomClass::query()->where('NIP', Auth::user()->NIP)->join('school_years', 'school_years.id', '=', 'teacher_homeroom_classes.school_year_id')->orderBy('year', 'ASC')->get() as $schoolYear)
                                    <option value="{{ $schoolYear->id }}">{{ $schoolYear->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>



                    <div class="row align-items-center mb-2" >

                        {{-- ========== CLASS NAME START ========== --}}
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group mb-0">
                                <label for="" class="text-success font-bold mb-0">Kelas : {{ \App\Models\Teacher\HomeroomClass::query()->where('NIP', Auth::user()->NIP)->where('school_year_id', $selectedSchoolYear)->join("classes", "teacher_homeroom_classes.homeroom_class_id", '=', 'classes.id')->value('name') }}</label>
                            </div>
                        </div>
                        {{-- ========== CLASS NAME END ========== --}}



                        {{-- ========== EXPORT BUTTONS START ========== --}}
                        <div class="col-sm-6 col-md-6 text-right">
                            <a href="{{ url('export-class-pdf', $selectedClass) }}" class="btn btn-outline-danger">Export as PDF</a>
                            <a href="{{ url('export-class-excel', $selectedClass) }}" class="btn btn-outline-success">Export as Excel</a>
                        </div>
                        {{-- ========== EXPORT BUTTONS END ========== --}}

                    </div>



                    <div class="table-responsive" style="overflow: hidden">
                        <table class="table" >
                            <thead class="bg-inverse text-white">
                                <tr>
                                    <th>No.</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border border-dark">
                                @foreach(\App\Models\Student\HomeroomClass::query()->where('school_year_id', $selectedSchoolYear)->where('homeroom_class_id', \App\Models\Teacher\HomeroomClass::query()->where('NIP', Auth::user()->NIP)->where('school_year_id', $selectedSchoolYear)->value('homeroom_class_id'))->join('students', 'student_homeroom_classes.NISN', '=', 'students.NISN')->orderBy('students.name', 'ASC')->paginate(5) as $data)
                                <tr>
                                    <td>{{ $loop->iteration + 5 * ($page - 1) }}</td>
                                    <td>{{ $data->NISN }}</td>
                                    <td>{{ \App\Models\Student\Student::query()->where('NISN', $data->NISN)->value('name') }}</td>
                                    <td class="d-flex">

                                        <div class="btn-group @if(session('currentSemester') == "Genap") col-md-4  @else col-md-6 @endif">
                                            <button type="button" id="filter-value" class="btn btn-block btn-outline-cyan dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-format-list-bulleted"></i>
                                                Rekap Absensi
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#absentInfoModal" wire:click="ConfigureModal('{{ $data->NISN }}', '{{ session('currentSchoolYear') }}')">Ganjil</a>
                                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#absentInfoModal" wire:click="ConfigureModal('{{ $data->NISN }}', '{{ session('tempSchoolYear') }}')">Genap</a>
                                            </div>
                                        </div>

                                        <div class="btn-group @if(session('currentSemester') == "Genap") col-md-4  @else col-md-6 @endif mx-1">
                                            <button type="button" id="filter-value" class="btn btn-block btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-book-variant"></i>
                                                Lihat Rapor
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="return window.location.href = '{{ route('student-report-odd', $data->NISN) }}'">Ganjil</a>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="return window.location.href = '{{ route('student-report-even', $data->NISN) }}'">Genap</a>
                                            </div>
                                        </div>

                                        @if(session('currentSemester') == "Genap")
                                            <div class="btn-group col-md-4">
                                                <button class="btn btn-block btn-outline-success" data-toggle="modal" data-target="#promoteStudentModal" wire:click="ConfigurePromoteModal('{{ $data->NISN }}')">
                                                    <i class="mdi mdi-arrow-up-bold"></i>
                                                    Naik Kelas
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                        {{-- ========== PAGINATION START ========== --}}
                        <div class="row justify-content-center align-items-center my-3">
                            {{ \App\Models\Student\HomeroomClass::query()->where('school_year_id', $selectedSchoolYear)->where('homeroom_class_id', \App\Models\Teacher\HomeroomClass::query()->where('NIP', Auth::user()->NIP)->where('school_year_id', $selectedSchoolYear)->value('homeroom_class_id'))->join('students', 'student_homeroom_classes.NISN', '=', 'students.NISN')->orderBy('students.name', 'ASC')->paginate(5)->links() }}
                        </div>
                        {{-- ========== PAGINATION END ========== --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== CLASS DETAILS END ========== --}}



    {{-- ========== ABSENT MODAL START ========== --}}
    <div class="modal fade show" id="absentInfoModal" tabindex="-1" role="dialog" aria-labelledby="absentInfoModalLabel1" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="loginInfoModalLabel1">Student Absent Recapitulation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                </div>
                <div class="modal-body">
                    <form id="student-absent" @if(session('currentSemester') == \App\Models\SchoolYear::query()->find($absentSchoolYear)->semester) wire:submit.prevent="CreateOrUpdateAbsent()" @endif >
                        <div class="row">
                            <div class="col-12">
                                
                                {{-- ========== NAME START ========== --}}
                                <div class="form-group row">
                                    {{ Form::label('name', 'Nama', ["class" => "col-md-3 col-form-label"]) }}
                                    <div class="col-md-9">
                                        {{ Form::text('name', '', ['class' => 'form-control form-control-line'.($errors->has('name') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'name', 'required']) }}
                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                {{-- ========== NAME END ========== --}}



                                {{-- ========== DATE START ========== --}}
                                <div class="form-group row">
                                    {{ Form::label('date', 'Tanggal', ["class" => "col-md-3 col-form-label"]) }}
                                    <div class="col-md-9">
                                        {{ Form::date('date', '', ['class' => 'form-control form-control-line'.($errors->has('date') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'date', 'required', 'disabled', 'readonly', 'wire:model' => 'date']) }}
                                        @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                {{-- ========== DATE END ========== --}}



                                {{-- ========== DESCRIPTION START ========== --}}
                                <div class="form-group row">
                                    {{ Form::label('description', 'Keterangan', ["class" => "col-md-3 col-form-label"]) }}
                                    <div class="col-md-3 col-form-label align-self-center">
                                        {{ Form::radio('description', "S", false, ['class' => ($errors->has('description') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'odd', 'wire:model.lazy' => 'description']) }}
                                        <label for="Sakit">Sakit</label>
                                    </div>
                                    
                                    <div class="col-md-3 col-form-label align-self-center">
                                        {{ Form::radio('description', "I", false, ['class' => ($errors->has('description') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'even', 'wire:model.lazy' => 'description']) }}
                                        <label for="Izin">Izin</label>
                                    </div>

                                    <div class="col-md-3 col-form-label align-self-center">
                                        {{ Form::radio('description', "A", false, ['class' => ($errors->has('description') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'even', 'wire:model.lazy' => 'description']) }}
                                        <label for="Alpha">Alpha</label>
                                    </div>
                                    @error('description')<div class="text-danger mr-4 pr-2">{{ $message }}</div>@enderror
                                </div>
                                {{-- ========== DESCRIPTION END ========== --}}



                                {{-- ========== ABSENT HISTORY START ========== --}}
                                <h4 class="text-center mt-5 font-bold text-secondary">RIWAYAT KETIDAKHADIRAN</h4>

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
                                            @foreach(\App\Models\AbsentRecapitulation::query()->where('NISN', $NISN)->where('school_year_id', $absentSchoolYear)->paginate(5, ['*'], 'absentpage') as $data)
                                            <tr>
                                                <td>{{ $loop->iteration + 5 * ($absentpage - 1) }}</td>
                                                <td>{{ $data->date }}</td>
                                                <td>
                                                    {{ $data->type == "I" ? "Izin" : "" }}
                                                    {{ $data->type == "S" ? "Sakit" : "" }}
                                                    {{ $data->type == "A" ? "Alpha" : "" }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-outline-danger" wire:click.prevent="DeleteAbsentRecord('{{ $data->id }}')">
                                                        <i class="fa fa-trash-alt"></i>
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>



                                    {{-- ========== PAGINATION START ========== --}}
                                    <div class="row justify-content-center align-items-center my-3">
                                        {{ \App\Models\AbsentRecapitulation::query()->where('NISN', $NISN)->where('school_year_id', session('tempSchoolYear'))->paginate(5, ['*'], 'absentpage')->links() }}
                                    </div>
                                    {{-- ========== PAGINATION END ========== --}}
            
                                </div>
                                {{-- ========== ABSENT HISTORY END ========== --}}

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" id="submit-absent-info" class="btn btn-info" 
                                @if(\App\Models\AbsentRecapitulation::query()->where('NISN', $NISN)->where('school_year_id', session('tempSchoolYear'))->where('date', date('Y-m-d'))->first()) @disabled(true) @endif
                                @if(session('currentSemester') != \App\Models\SchoolYear::query()->find($absentSchoolYear)->semester) @disabled(true) @endif
                                >
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== ABSENT MODAL END ========== --}}



    {{-- ========== PROMOTE MODAL START ========== --}}
    <div class="modal fade show" id="promoteStudentModal" tabindex="-1" role="dialog" aria-labelledby="promoteStudentModalLabel1" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="loginInfoModalLabel1">Student New HomeroomClass</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="PromoteStudent()">
                        <div class="row">
                            <div class="col-12">
                                
                                {{-- ========== NAME START ========== --}}
                                <div class="form-group row">
                                    {{ Form::label('name', 'Nama', ["class" => "col-md-3 col-form-label"]) }}
                                    <div class="col-md-9">
                                        {{ Form::text('name', '', ['class' => 'form-control form-control-line'.($errors->has('name') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'name', 'required']) }}
                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                {{-- ========== NAME END ========== --}}



                                {{-- ========== SCHOOL YEAR START ========== --}}
                                <div class="form-group row">
                                    {{ Form::label('school-year', 'Tahun Ajaran', ["class" => "col-md-3 col-form-label"]) }}
                                    <div class="col-md-9">
                                        {{ Form::text('school-year', '', ['class' => 'form-control form-control-line ' . ($errors->has('promoteSchoolYear') ? ' is-invalid' : ''), 'wire:model' => 'promoteSchoolYear', 'disabled', 'readonly']) }}
                                        @error('promoteSchoolYear')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                {{-- ========== SCHOOL YEAR START ========== --}}



                                {{-- ========== NEW CLASS START ========== --}}
                                <div class="form-group row">
                                    {{ Form::label('homeroom-class', 'Kelas', ["class" => "col-md-3 col-form-label"]) }}
                                    <div class="col-md-9">
                                        <select id="homeroom-class" class="form-control form-select form-control-line" wire:model="newClass">
                                            <option value=""></option>
                                            @foreach(\App\Models\Classroom\Classroom::all() as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('newClass')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                {{-- ========== NEW CLASS START ========== --}}

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" id="submit-promote-info" class="btn btn-info">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== PROMOTE MODAL END ========== --}}



    {{-- ========== FOOTER START ========== --}}
    <footer class="footer text-center">All Rights Reserved by Kelompok 7 KOM C ?? 2022. </footer>
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
    {{-- TOAST FOR FAILED EXPORT --}}
    <script>
        $(function ()
        {
            @if(Session::has('export-failed'))
                toastr.error("{{ session('export-failed') }}", 'Failure!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            @endif
        })
    </script>

    {{-- CONFIGURE ABSENT MODAL --}}
    <script>
        $(function ()
        {
            window.addEventListener('configure-absent-modal', event =>
            {
                $('#absentInfoModal').find('#name').val(event.detail.name)
            })
        })
    </script>

    {{-- CONFIGURE PROMOTE MODAL --}}
    <script>
        $(function ()
        {
            window.addEventListener('configure-promote-modal', event =>
            {
                $('#promoteStudentModal').find('#name').val(event.detail.name)
            })
        })
    </script>

    {{-- TOAST SUCCESS SUBMIT --}}
    <script>
        $(function ()
        {
            window.addEventListener('success-submit-absent', e =>
            {
                toastr.success("Informasi absent berhasil disubmit", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });

                $("#absentInfoModal").find(':input').val('');

                $("#absentInfoModal").find("[data-dismiss=modal]").trigger({ type: "click" })
            })
        })
    </script>

    {{-- TOAST SUCCESS SUBMIT --}}
    <script>
        $(function ()
        {
            window.addEventListener('success-promote-student', e =>
            {
                toastr.success("Informasi absent berhasil disubmit", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });

                $("#promoteStudentModal").find(':input').val('');

                $("#promoteStudentModal").find("[data-dismiss=modal]").trigger({ type: "click" })
            })
        })
    </script>
@endpush