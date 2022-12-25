<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Data Guru</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Guru</li>
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
            <button class="btn btn-block btn-info" data-toggle='modal' data-target="#exampleModal">
                <i class="mdi mdi-plus-outline"></i>
                Tambah Data
            </button>
        </div>

        @livewire('teacher-builder')
    </div>
    {{-- ========== POWERGRID TABLE END ========== --}}



    {{-- ========== ADD DATA MODAL START ========== --}}
    <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Tambah Data Guru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="CreateNewTeacherData" method="POST">
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
                                    {{ Form::label('graduated-from', 'Pendidikan Terakhir', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('graduated-from', '', ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('graduatedFrom') ? ' is-invalid' : ''), 'wire:model.lazy' => 'graduatedFrom']) }}
                                        @error('graduatedFrom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    {{ Form::label('graduated-at', 'Tahun Lulus', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('graduated-at', '', ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('graduatedAt') ? ' is-invalid' : ''), 'wire:model.lazy' => 'graduatedAt']) }}
                                        @error('graduatedAt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('started-working-at', 'Tahun Mula Bekerja', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('started-working-at', '', ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('startedWorkingAt') ? ' is-invalid' : ''), 'wire:model.lazy' => 'startedWorkingAt']) }}
                                        @error('startedWorkingAt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                            </div>



                            <div class="col-6">

                                <div class="form-group row">
                                    {{ Form::label('NIP', 'NIP', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('NIP', $NIP, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('NIP') ? ' is-invalid' : ''), 'wire:model.lazy' => 'NIP']) }}
                                        @error('NIP')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('KARPEG', 'KARPEG', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('KARPEG', $KARPEG, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('KARPEG') ? ' is-invalid' : ''), 'wire:model.lazy' => 'KARPEG']) }}
                                        @error('KARPEG')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('position', 'Posisi', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::select('position', ['Ka. MTsN' => 'Kepala Sekolah', 'Wakil Ka. MTsN' => 'Wakil Kepala Sekolah', 'Guru' => 'Guru'], null, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('position') ? ' is-invalid' : ''), 'wire:model.lazy' => 'position']) }}
                                        @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                $errors->has('graduatedAt') ||
                                $errors->has('graduatedAt') ||
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
                toastr.success("Guru dengan NIP " + event.detail.data + " berhasil dihapus!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>

    {{-- SWEET ALERT FOR DELETE STUDENT --}}
    <script>
        $(function ()
        {
            window.addEventListener('confirm-to-delete-teacher', e =>
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
                            Livewire.emit('DeleteTeacher', e.detail.NIP);
                        } else {     
                            swal("Batal", "Data batal dihapus!", "error");   
                        } 
                    });
                    
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
                
                toastr.success("Teacher data successfully created!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
                
                $("[data-dismiss=modal]").trigger({ type: "click" })
            })   
        })
    </script>
@endpush
