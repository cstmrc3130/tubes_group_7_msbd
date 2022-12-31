<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Tahun Ajaran</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tahun Ajaran</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}}



    {{-- ========== POWERGRID TABLE START ========== --}}
    <div class="container-fluid">
        <div class="col-4 col-sm-2 d-flex justify-content-start mb-3">
            <button class="btn btn-block btn-info" data-toggle='modal' data-target="#exampleModal">
                <i class="mdi mdi-plus-outline"></i>
                Tambah Data
            </button>
        </div>

        @livewire('school-year-builder')
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
                    <form wire:submit.prevent="CreateSchoolYearData()" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                
                                <div class="form-group row">
                                    {{ Form::label('year', 'Tahun Ajaran', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-8">
                                        {{ Form::text('year', $year, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('year') ? ' is-invalid' : ''), 'wire:model.lazy' => 'year']) }}
                                        @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="form-group row justify-content-center">
                                    {{ Form::label('semester', 'Semester', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-4 col-form-label align-self-center">
                                        {{ Form::radio('semester', "Ganjil", false, ['class' => ($errors->has('semester') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'odd', 'wire:model.lazy' => 'semester']) }}
                                        <label for="Ganjil">Ganjil</label>
                                    </div>
                                    
                                    <div class="col-md-4 col-form-label align-self-center">
                                        {{ Form::radio('semester', "Genap", false, ['class' => ($errors->has('semester') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'even', 'wire:model.lazy' => 'semester']) }}
                                        <label for="Genap">Genap</label>
                                    </div>
                                    @error('semester')<div class="text-danger mr-4 pr-2">{{ $message }}</div>@enderror
                                </div>
    
                            </div>
                        </div>

                        <div class="modal-footer pb-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" @if ($errors->has('year') || $errors->has('semester')) @disabled(true) @endif >Submit</button>
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
    {{-- SHOW SUCCESS TOAST --}}
    <script>
        window.addEventListener('set-school-year', e =>
        {
            toastr.success("Tahun ajaran saat ini berhasil di-update menjadi " + e.detail.year + "!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
        })
    </script>

    {{-- TOAST FOR CREATE SCHOOL YEAR --}}
    <script>
        window.addEventListener('success-create-school-year', e =>
        {
            toastr.success("Data tahun ajaran berhasil dibuat!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            
            $(':input').not(':button, :submit, :reset, :hidden').removeAttr('checked').removeAttr('selected').not(':checkbox, :radio, select').val('');
            
            $("[data-dismiss=modal]").trigger({ type: "click" }) 
        })
    </script>

    {{-- TOAST FOR DELETE DATA --}}
    <script>
        $(function (){
            window.addEventListener('success-delete', event =>
            {
                toastr.success("Tahun ajaran " + event.detail.data + " berhasil dihapus!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>

    {{-- SWEET ALERT FOR DELETE SCHOOL YEAR --}}
    <script>
        $(function ()
        {
            window.addEventListener('confirm-to-delete-school-year', e =>
            {
                swal({   
                title: "Delete Data",   
                text: "Hapus tahun ajaran " + e.detail.year + " semester " + e.detail.semester + "?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Hapus",   
                cancelButtonText: "Batalkan",   
                }).then((isConfirm) => 
                    {   
                        if (isConfirm && isConfirm.dismiss != 'cancel') {     
                            Livewire.emit('DeleteSchoolYear', e.detail.year, e.detail.semester);
                        } else {     
                            swal("Batal", "Data batal dihapus!", "error");   
                        } 
                    });
                    
            })
        })
    </script>
@endpush
