<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Mata Pelajaran</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Mata Pelajaran</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}}



    {{-- ========== POWERGRID TABLE START ========== --}}
    <div class="container-fluid">
        <div class="col-4 col-sm-2 d-flex justify-content-start">
            <button class="btn btn-block btn-info" data-toggle='modal' data-target="#exampleModal">
                <i class="mdi mdi-plus-outline"></i>
                Tambah Data
            </button>
        </div>

        @livewire('subject-builder')
    </div>
    {{-- ========== POWERGRID TABLE END ========== --}}



    {{-- ========== ADD DATA MODAL START ========== --}}
    <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Tambah Data Siswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="CreateNewSubjectData" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                
                                <div class="form-group row">
                                    {{ Form::label('name', 'Nama', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('name', $name, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('name') ? ' is-invalid' : ''), 'wire:model.lazy' => 'name']) }}
                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    {{ Form::label('school-year', 'Tahun Ajaran', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('school-year', '', ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('schoolYear') ? ' is-invalid' : ''), 'wire:model' => 'schoolYear', 'disabled', 'readonly']) }}
                                        @error('schoolYear')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    {{ Form::label('completeness', 'KKM', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::number('completeness', $completeness, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('completeness') ? ' is-invalid' : ''), 'wire:model.lazy' => 'completeness', 'min' => '0', 'max' => '100']) }}
                                        @error('completeness')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer pb-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" @if ($errors->has('name') ||$errors->has('schoolYear') || $errors->has('completeness')) @disabled(true) @endif>Submit</button>
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
                toastr.success("Mata pelajaran " + event.detail.data + " berhasil dihapus!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>

    {{-- SWEET ALERT FOR DELETE SUBJECT --}}
    <script>
        $(function ()
        {
            window.addEventListener('confirm-to-delete-subject', e =>
            {
                swal({   
                title: "Delete Data",   
                text: "Hapus mata pelajaran " + e.detail.name + "?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Hapus",   
                cancelButtonText: "Batalkan",   
                }).then((isConfirm) => 
                    {   
                        if (isConfirm && isConfirm.dismiss != 'cancel') {     
                            Livewire.emit('DeleteSubject', e.detail.id);
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
                $(':input').val('');
                
                toastr.success("Mata pelajaran successfully created!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
                
                $("[data-dismiss=modal]").trigger({ type: "click" })
            })   
        })
    </script>
@endpush
