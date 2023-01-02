<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Data Siswa</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}}



    {{-- ========== POWERGRID TABLE START ========== --}}
    <div class="container-fluid" style="min-height: 74vh">
        <div class="col-4 col-sm-2 d-flex justify-content-start mb-3">
            <button class="btn btn-block btn-info" data-toggle='modal' data-target="#exampleModal" @if(session('currentSchoolYear') != \App\Models\SchoolYear::orderBy('year', 'desc')->value('id')) @disabled(true) @endif>
                <i class="mdi mdi-plus-outline"></i>
                Tambah Data
            </button>
        </div>

        @livewire('student-builder')
    </div>
    {{-- ========== POWERGRID TABLE END ========== --}}



    {{-- ========== ADD DATA MODAL START ========== --}}
    <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Tambah Data Siswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="CreateNewStudentData" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                
                                <div class="form-group row">
                                    {{ Form::label('name', 'Nama Lengkap', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('name', $name, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('name') ? ' is-invalid' : ''), 'wire:model.lazy' => 'name']) }}
                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    {{ Form::label('place-of-birth', 'Tempat Lahir', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('place-of-birth', $placeOfBirth, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('placeOfBirth') ? ' is-invalid' : ''), 'wire:model.lazy' => 'placeOfBirth']) }}
                                        @error('placeOfBirth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    {{ Form::label('date-of-birth', 'Tanggal Lahir', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::date('date-of-birth', $dateOfBirth, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('dateOfBirth') ? ' is-invalid' : ''), 'wire:model.lazy' => 'dateOfBirth']) }}
                                        @error('dateOfBirth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('address', 'Alamat', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('address', $address, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('address') ? ' is-invalid' : ''), 'wire:model.lazy' => 'address']) }}
                                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('father-name', 'Nama Ayah', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('father-name', $fatherName, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('fatherName') ? ' is-invalid' : ''), 'wire:model.lazy' => 'fatherName']) }}
                                        @error('fatherName')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    {{ Form::label('mother-name', 'Nama Ibu', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('mother-name', $motherName, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('motherName') ? ' is-invalid' : ''), 'wire:model.lazy' => 'motherName']) }}
                                        @error('motherName')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('guardian-name', 'Nama Wali', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('guardian-name', $guardianName, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('guardianName') ? ' is-invalid' : ''), 'wire:model.lazy' => 'guardianName']) }}
                                        @error('guardianName')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                            </div>



                            <div class="col-6">

                                <div class="form-group row">
                                    {{ Form::label('NISN', 'NISN', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('NISN', $NISN, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('NISN') ? ' is-invalid' : ''), 'wire:model.lazy' => 'NISN']) }}
                                        @error('NISN')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('phone-number', 'Nomor Telephone', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('phone-number', $phoneNumber, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('phoneNumber') ? ' is-invalid' : ''), 'wire:model.lazy' => 'phoneNumber']) }}
                                        @error('phoneNumber')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="form-group row justify-content-center">
                                    {{ Form::label('gender', 'Jenis Kelamin', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-4 col-form-label align-self-center">
                                        {{ Form::radio('gender', 'M', false, ['class' => '' . ($errors->has('gender') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'male', 'wire:model' => 'gender']) }}
                                        <label for="male">Laki-laki</label>
                                    </div>
                                    
                                    <div class="col-md-4 col-form-label align-self-center">
                                        {{ Form::radio('gender', 'F', false, ['class' => '' . ($errors->has('gender') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'female', 'wire:model' => 'gender']) }}
                                        <label for="female">Perempuan</label>
                                    </div>
                                    @error('gender')<div class="text-danger ml-5 pl-3">{{ $message }}</div>@enderror
                                </div>
    
                                <div class="form-group row">
                                    {{ Form::label('entry-year', 'Tahun Masuk', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::number('entry-year', $entryYear, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('entryYear') ? ' is-invalid' : ''), 'wire:model.lazy' => 'entryYear']) }}
                                        @error('entryYear')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="form-group row justify-content-center">
                                    {{ Form::label('status', 'Status', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-4 col-form-label align-self-center">
                                        {{ Form::radio('status', 'A', false, ['class' => ($errors->has('status') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'active', 'wire:model' => 'status']) }}
                                        <label for="active">Aktif</label>
                                    </div>
                                    
                                    <div class="col-md-4 col-form-label align-self-center">
                                        {{ Form::radio('status', 'I', false, ['class' => ($errors->has('status') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'inactive', 'wire:model' => 'status']) }}
                                        <label for="inactive">Inaktif</label>
                                    </div>
                                    @error('status')<div class="text-danger ml-5 pl-3">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group row justify-content-end">
                                    {{ Form::label('special-needs', 'Kebutuhan Khusus', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-4 col-form-label align-self-center">
                                        {{ Form::radio('special-needs', 'E', false, ['class' => ($errors->has('specialNeeds') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'exist', 'wire:model' => 'specialNeeds']) }}
                                        <label for="exist">Ada</label>
                                    </div>
                                    
                                    <div class="col-md-4 col-form-label align-self-center">
                                        {{ Form::radio('special-needs', 'NE', false, ['class' => ($errors->has('specialNeeds') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'not-exist', 'wire:model' => 'specialNeeds']) }}
                                        <label for="not-exist">Tidak Ada</label>
                                    </div>
                                    @error('specialNeeds')<div class="text-danger mr-4 pr-2">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('class', 'Kelas', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        <select type="text" class="form-control form-control-line bg-transparent" name="homeroom-class" id="homeroom-class" placeholder="Homeroom Class" wire:model.lazy="homeroomClass">
                                            @foreach(\App\Models\Classroom\Classroom::all() as $homeroomClass)
                                            <option value="{{ $homeroomClass->id }}">{{ $homeroomClass->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
    
                            </div>
                        </div>

                        <div class="modal-footer pb-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" 
                            @if ($errors->has('NISN') ||
                                $errors->has('name') ||  
                                $errors->has('placeOfBirth') ||
                                $errors->has('dateOfBirth') ||
                                $errors->has('motherName') ||
                                $errors->has('fatherName') ||
                                $errors->has('gender') ||
                                $errors->has('address') ||
                                $errors->has('phoneNumber'))
                                @disabled(true) 
                                @endif 
                                >Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== ADD DATA MODAL END ========== --}}



    {{-- ========== FOOTER START ========== --}}
    <footer class="footer text-center">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}}

</div>

@push('additional-script')
    {{-- TOAST FOR UPDATE DATA --}}
    <script>
        $(function (){
            window.addEventListener('success-update', event =>
            {
                toastr.success("Field " + event.detail.field + " berhasil di-update!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>

    {{-- TOAST FOR DELETE DATA --}}
    <script>
        $(function (){
            window.addEventListener('success-delete', event =>
            {
                toastr.success("Siswa dengan NISN " + event.detail.data + " berhasil dihapus!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>

    {{-- SWEET ALERT FOR DELETE STUDENT --}}
    <script>
        $(function ()
        {
            window.addEventListener('confirm-to-delete-student', e =>
            {
                swal({   
                title: "Delete Data",   
                text: "Hapus data " + e.detail.username + "?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Hapus",   
                cancelButtonText: "Batalkan",   
                }).then((isConfirm) => 
                    {   
                        if (isConfirm && isConfirm.dismiss != 'cancel') {     
                            Livewire.emit('DeleteStudent', e.detail.NISN);
                        } else {     
                            swal("Batal", "Data batal dihapus!", "error");   
                        } 
                    });
                    
            })
        })
    </script>

    {{-- REMOVE 08 OR 62 IN PHONE NUMBER --}}
    <script>
        $(function ()
        {
            $('#phone-number').bind('keyup', function (event)
            {
                phoneNumber = event.target.value;

                phoneNumber.substring(0, 2) == '62' ? $(this).val('' + phoneNumber.substring(2, phoneNumber.length)) : ''
                phoneNumber.substring(0, 2) == '08' ? $(this).val(phoneNumber.substring(1, phoneNumber.length)) : ''
            })
        })
    </script>

    {{-- TRIGGER DISMISS MODAL AND CLEAR FORM ON SUCCESSFUL SUBMIT --}}
    <script>
        $(function ()
        {
            window.addEventListener('dismiss-modal', e =>
            {
                $(':input').not(':button, :submit, :reset, :hidden').removeAttr('checked').removeAttr('selected').not(':checkbox, :radio, select').val('');
                
                toastr.success("Student data successfully created!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
                
                $("[data-dismiss=modal]").trigger({ type: "click" })
            })   
        })
    </script>
@endpush
