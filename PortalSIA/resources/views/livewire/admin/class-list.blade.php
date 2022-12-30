<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Data Kelas</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
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
                    <h4 class="card-title text-info border-bottom pb-3">Detail Informasi Tiap Kelas</h4>
                    <div id="education_fields" class="m-t-20"></div>
                    <form class="row align-items-center">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="" class="mb-0">Pilih Kelas</label>
                                <select class="form-control form-select" wire:model="selectedClass">
                                    <option value=""></option>
                                    @foreach(\App\Models\Classroom\Classroom::all() as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="" class="mb-0">Pilih Wali Kelas</label>
                                <select class="form-control form-select" wire:model="selectedHomeroomTeacher">
                                    <option value=""></option>
                                    @foreach(\App\Models\Teacher\Teacher::query()->doesntHave('homeroomclass')->orderBy('name', 'ASC')->get() as $teacher)
                                    <option value="{{ $teacher->NIP }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>



                    <div class="row align-items-center mb-2" >

                        {{-- ========== HOMEROOM TEACHER START ========== --}}
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group mb-0">
                                <label for="" class="text-success font-bold mb-0">Wali Kelas : {{ \App\Models\Teacher\Teacher::query()->where('NIP', \App\Models\Teacher\HomeroomClass::query()->where('homeroom_class_id', $selectedClass)->value('NIP'))->value('name') }}</label>
                            </div>
                        </div>
                        {{-- ========== HOMEROOM TEACHER END ========== --}}



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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border border-dark">
                                {{-- @foreach(\App\Models\Student\HomeroomClass::query()->where('homeroom_class_id', $selectedClass)->orderBy('NISN', 'DESC')->paginate(5) as $data) --}}
                                @foreach(\App\Models\Student\HomeroomClass::query()->where('homeroom_class_id', $selectedClass)->join('students', 'student_homeroom_classes.NISN', '=', 'students.NISN')->orderBy('students.name', 'ASC')->paginate(5) as $data)
                                <tr>
                                    <td>{{ $loop->iteration + 5 * ($page - 1) }}</td>
                                    <td>{{ $data->NISN }}</td>
                                    <td>{{ \App\Models\Student\Student::query()->where('NISN', $data->NISN)->value('name') }}</td>
                                    <td>
                                        <button class="btn btn-block btn-outline-orange" data-toggle="modal" data-target="#studentInfoModal" wire:click="ConfigureStudentModal({{ $data->NISN }}, '{{ $selectedClass }}')">
                                            <i class="mdi mdi-table-edit"></i>
                                            Ganti Kelas
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                        {{-- ========== PAGINATION START ========== --}}
                        <div class="row justify-content-center align-items-center my-3">
                            {{ \App\Models\Student\HomeroomClass::query()->where('homeroom_class_id', $selectedClass)->paginate(5)->links() }}
                        </div>
                        {{-- ========== PAGINATION END ========== --}}


                        <div class="row align-items-center">
                            <div class="col-sm-6 col-md-12">
                                <button class="btn btn-block btn-outline-info" @if($selectedHomeroomTeacher == null) @disabled(true) @endif wire:click="ChangeStudentHomeroomTeacher">Update</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== CLASS DETAILS END ========== --}}



    {{-- ========== STUDENT INFO MODAL START ========== --}}
    <div class="modal fade show" id="studentInfoModal" tabindex="-1" role="dialog" aria-labelledby="loginInfoModalLabel1" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="loginInfoModalLabel1">Configure Student Homeroom Class</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form id="student-homeroom-class" wire:submit.prevent="ChangeStudentHomeroomClass()">
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
                                {{-- ========== NAME START ========== --}}



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
                            <button type="submit" id="approve-update" class="btn btn-info">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== STUDENT INFO MODAL END ========== --}}


    
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
            @if(Session::has('export-failed'))

                toastr.error("{{ session('export-failed') }}", 'Failure!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            
            @endif
        })
    </script>

    {{-- TOAST FOR SUCCESS CHANGE STUDENT HOMEROOM CLASS --}}
    <script>
        $(function ()
        {
            window.addEventListener('success-change-student-homeroom-class', event =>
            {
                toastr.success("Kelas untuk " + event.detail.name + " berhasil diubah!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
                
                $("#studentInfoModal").find("[data-dismiss=modal]").trigger({ type: "click" })
            })
        })
    </script>

    {{-- TOAST FOR SUCCESS CHANGE STUDENT HOMEROOM TEACHER --}}
    <script>
        $(function ()
        {
            window.addEventListener('success-change-student-homeroom-teacher', event =>
            {
                toastr.success("Wali kelas berhasil diganti menjadi " + event.detail.name, 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>

    {{-- CONFIGURE MODAL TO CHANGE HOMEROOM CLASS --}}
    <script>
        $(function ()
        {
            window.addEventListener('configure-student-homeroom-class', event =>
            {
                name = event.detail.name
                studentNISN = event.detail['NISN']

                $('#studentInfoModal').find('#name').val(event.detail.name)
                $('#studentInfoModal').find('#homeroom-class').val(event.detail.class)
            })
        })
    </script>
@endpush
