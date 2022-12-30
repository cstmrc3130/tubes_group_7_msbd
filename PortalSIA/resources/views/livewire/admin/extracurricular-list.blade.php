<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Ekstrakurikuler</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Ekstrakurikuler</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB END ========== --}}



    {{-- ========== EXTRACURRICULAR CARD START ========== --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 col-sm-2 d-flex justify-content-start m-b-20">
                <button class="btn btn-block btn-info" id="add-extracurricular" data-toggle='modal' data-target="#exampleModal">
                    <i class="mdi mdi-plus-outline"></i>
                    Tambah Data
                </button>
            </div>
        </div>

        <div class="row justify-content-center">
            @forelse($allExtracurriculars as $extracurricular)
            <div class="col-lg-4">
                <div class="card rounded border shadow flex-col justify-content-between">
                    <img class="card-img-top" src="{{ asset('/storage/' . $extracurricular->image) }}" height="250px" alt="Card image cap">
                    <div class="card-body d-flex flex-column justify-content-between ">
                        <h3 class="font-normal">{{ $extracurricular->name }}</h3>

                        <div class="m-b-0 m-t-10" style="overflow:hidden; display:-webkit-box; -webkit-box-orient:vertical; -webkit-line-clamp:1; ">
                            {{ Str::words($extracurricular->description, 10, '...') }}
                        </div>

                        <div class="row">
                            <div class="col-6 mt-auto">
                                <button class="btn btn-outline-dark btn-block waves-effect waves-light m-t-20" data-toggle="modal" data-target="#exampleModal" wire:click="ConfigureExtracurricularModal('{{ $extracurricular->id }}')">Edit</button>
                            </div>
                            <div class="col-6 mt-auto">
                                <button type="button" class="btn btn-outline-danger btn-block waves-effect waves-light m-t-20" wire:click="ShowDeleteAlert('{{ $extracurricular->id }}')">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 col-sm-2 text-center align-self-center h-auto">
                <span class="text-default font-20 font-bold">Belum Ada Ekstrakurikuler</span>
            </div>
            @endforelse
        </div>
    </div>
    {{-- ========== EXTRACURRICULAR CARD END ========== --}}



    {{-- ========== PAGINATION START ========== --}}
    <div class="row justify-content-center align-items-center my-3">
        {{ $allExtracurriculars->links() }}
    </div>
    {{-- ========== PAGINATION END ========== --}}



    {{-- ========== ADD DATA MODAL START ========== --}}
    <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Berita Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="CreateOrUpdateExtracurricular">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                
                                <div class="form-group row">
                                    {{ Form::label('name', 'Nama', ["class" => "col-md-2 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-10">
                                        {{ Form::text('name', NULL, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('name') ? ' is-invalid' : ''), 'wire:model' => 'name']) }}
                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    {{ Form::label('description', "Deskripsi", ["class" => "col-md-2 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-10">
                                        {{ Form::textarea('description', NULL, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('description') ? ' is-invalid' : ''), 'rows' => '3', 'cols' => '30', 'wire:model' => 'description']) }}
                                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('image', "Gambar", ["class" => "col-md-2 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-10">
                                        {{ Form::file('image', ['class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''), 'wire:model' => 'image']) }}
                                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer pb-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" @if ($errors->has('name') || $errors->has('description') || $errors->has('image')) @disabled(true) @endif >Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== ADD DATA MODAL END ========== --}}



    {{-- ========== FOOTER START ========== --}}
    <footer class="footer text-center font-light">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER END ========== --}}

</div>

@push('additional-script')
    {{-- CLEAN MODAL ON FIRST MOUNT --}}
    <script>
        $(function (){
            $('#add-extracurricular').click(e =>
            {
                $(':input').val('');
            })
        })
    </script>

    {{-- TOAST FOR SUBMIT OR UPDATE --}}
    <script>
        $(function ()
        {
            window.livewire.on('success-create-extracurricular', () =>
            {
                toastr.success("Ekstrakurikuler berhasil dibuat!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
                
                $(':input').val('');
                
                $("[data-dismiss=modal]").trigger({ type: "click" })
            })
        })
    </script>

    {{-- CONFIGURE MODAL TO UPDATE --}}
    <script>
        $(function (){
            window.addEventListener('configure-extracurricular-modal', event =>
            {
                @this.set('extracurricularID', event.detail.id)
                @this.set('name', event.detail.name)
                @this.set('description', event.detail.description)
            })
        })
    </script>

    {{-- TOAST FOR DELETE EXTRACURRICULAR --}}
    <script>
        $(function (){
            window.addEventListener('success-delete', event =>
            {
                $(':input').val('');

                toastr.success("Ekstrakurikuler berhasil dihapus!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>
    
    {{-- SWEET ALERT FOR DELETE EXTRACURRICULAR --}}
    <script>
        $(function ()
        {
            window.addEventListener('confirm-to-delete-extracurricular', e =>
            {
                swal({   
                title: "Delete Data",   
                text: "Anda yakin ingin menghapus ekstrakurikuler " + e.detail.name + "?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Hapus",   
                cancelButtonText: "Batalkan",   
                }).then((isConfirm) => 
                    {   
                        if (isConfirm && isConfirm.dismiss != 'cancel') {     
                            Livewire.emit('DeleteExtracurricular', e.detail.id);
                        } else {     
                            swal("Batal", "Berita batal dihapus!", "error");   
                        } 
                    });
            })
        })
    </script>
@endpush
