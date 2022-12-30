<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Berita</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Berita</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB END ========== --}}



    {{-- ========== NEWS CARD START ========== --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 col-sm-2 d-flex justify-content-start m-b-20">
                <button class="btn btn-block btn-info" id="add-news" data-toggle='modal' data-target="#exampleModal">
                    <i class="mdi mdi-plus-outline"></i>
                    Tambah Data
                </button>
            </div>
        </div>

        <div class="row justify-content-center">
            @forelse($allNews as $news)
            <div class="col-lg-4">
                <div class="card rounded border shadow flex-col justify-content-between h-100">
                        @if (preg_match('%<img\s.*?src=".*?/?([^/]+?(\.gif|\.png|\.jpg))"%s', $news->content, $regs)) 
                            <img class="card-img-top" src="{{ asset('/storage/news-images/' . $regs[1]) }}" height="250px" alt="Card image cap">
                        @else 
                            <img class="card-img-top" src="{{ asset('assets/images/auth-bg2.jpg') }}" height="250px" alt="Card image cap">
                        @endif
                    <div class="card-body d-flex flex-column justify-content-between">

                        <div class="d-flex no-block align-items-center m-b-15">
                            <span><i class="ti-calendar"></i> {{ $news->created_at->diffForHumans() }}</span>
                            <div class="ml-auto">
                                <a href="javascript:void(0)" class="link"><i class="ti-pencil"></i> by Admin</a>
                            </div>
                        </div>

                        <h3 class="font-normal">{{ $news->title }}</h3>

                        <div class="m-b-0 m-t-10" style="overflow:hidden; display:-webkit-box; -webkit-box-orient:vertical; -webkit-line-clamp:1; ">
                            {{ Str::words($news->content, 10, '...') }}
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-outline-dark btn-block waves-effect waves-light m-t-20" data-toggle="modal" data-target="#exampleModal" wire:click="ConfigureNewsModal('{{ $news->id }}')">Edit</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-danger btn-block waves-effect waves-light m-t-20" wire:click="ShowDeleteAlert('{{ $news->id }}')">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 col-sm-2 text-center align-self-center h-auto">
                <span class="text-default font-20 font-bold">Belum Ada Berita</span>
            </div>
            @endforelse
        </div>
    </div>
    {{-- ========== NEWS CARD END ========== --}}



    {{-- ========== PAGINATION START ========== --}}
    <div class="row justify-content-center align-items-center my-3">
        {{ $allNews->links() }}
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
                    <form wire:submit.prevent="CreateOrUpdateNews">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                
                                <div class="form-group row">
                                    {{ Form::label('title', 'Judul', ["class" => "col-md-2 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-10">
                                        {{ Form::text('title', NULL, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('title') ? ' is-invalid' : ''), 'wire:model.lazy' => 'title']) }}
                                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
    
                                <div class="form-group row" wire:ignore>
                                    {{ Form::label('content', "Konten", ["class" => "col-md-2 col-form-label font-bold text-info"]) }}
                                    <div class="col-md-10">
                                        {{ Form::textarea('content', NULL, ['class' => 'form-control form-control-line bg-transparent' . ($errors->has('content') ? ' is-invalid' : ''), 'rows' => '3', 'cols' => '30', 'wire:model.lazy' => 'content']) }}
                                        @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer pb-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" @if ($errors->has('title') || $errors->has('content')) @disabled(true) @endif >Submit</button>
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
    {{-- TINYMCE CDN --}}
    <script src="https://cdn.tiny.cloud/1/9swjvo9zajhghcmdd6fxh7n29smh1k3h3wip3ldrgxakblbb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    
    {{-- TINYMCE SETUP --}}
    <script>
        tinymce.init(
        {
            selector: '#content',
            height: 500,
            width: '100%',
            resize: false,
            document_base_url: "{!! asset('/storage/news-images/') !!}",
            file_browser_callback_types: 'file image media',
            file_picker_types: 'file image media',
            image_title: true,
            forced_root_block : "",
            force_br_newlines : true,
            force_p_newlines : false,
            skin: "oxide-dark",
            content_css: "light",
            relative_urls: false,
            remove_script_host: false,
            plugins: 
            [
                'autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
            ],
            toolbar1:
                'undo redo | insert | styleselect table | bold italic | hr alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media ',
            toolbar2: 
                'print preview | forecolor backcolor emoticons | fontselect | fontsizeselect | codesample code fullscreen',

            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });

                // REPLACE WIRE MODEL WITH @this
                editor.on('change', function (e) {
                    @this.set('content', editor.getContent());
                });
            },

            images_upload_handler: function (blobInfo, success, failure) 
            {
                var XHTTPReq, formData, JSONResponse;
                var token = '{{ csrf_token() }}'

                XHTTPReq = new XMLHttpRequest();
                XHTTPReq.withCredentials = false;
                XHTTPReq.open('POST', '{{ route("admin.upload-image") }}');
                XHTTPReq.setRequestHeader("X-CSRF-Token", token);
                XHTTPReq.onload = function() 
                {
                    if (XHTTPReq.status != 200) 
                    {
                        failure('HTTP Error: ' + XHTTPReq.status);
                        return;
                    }

                    // STRINGIFIED JSON FROM WEB SERVER NEED TO BE PARSED BEFORE USAGE
                    // JSONResponse = JSON.parse(XHTTPReq.responseText)
                    JSONResponse = JSON.parse(XHTTPReq.response)
                    success(JSONResponse.location)

                    // IMAGE ADDRESS THAT ASBOLUTELY RETURNED CAN BE USED WITHOUT BEING PARSED 
                    // success(XHTTPReq.response);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                XHTTPReq.send(formData);
            }

        });
    </script>

    {{-- CLEAN MODAL ON FIRST MOUNT --}}
    <script>
        $(function (){
            $('#add-news').click(e =>
            {
                $('#title').val('');
                tinymce.activeEditor.setContent('');
            })
        })
    </script>

    {{-- TOAST FOR SUBMIT OR UPDATE --}}
    <script>
        $(function ()
        {
            // SHOW SUCCESS TOAST, DISMISS MODAL, AND CLEAN ALL INPUT FIELDS
            window.addEventListener('news-created-successfully', e =>
            {
                toastr.success("Berita berhasil dibuat!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });

                $('#title').val('');
                
                $("[data-dismiss=modal]").trigger({ type: "click" })
                
                tinymce.activeEditor.setContent('');
            })

            // SHOW ERROR TOAST IF TINYMCE IS EMPTY
            window.addEventListener('validation-fails', e =>
            {
                toastr.error("Content is required!", 'Failure!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>

    {{-- TOAST FOR DELETE NEWS --}}
    <script>
        $(function (){
            window.addEventListener('success-delete', event =>
            {
                tinymce.activeEditor.setContent('');

                $('#title').val('');

                toastr.success("Berita berhasil dihapus!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            })
        })
    </script>

    {{-- SWEET ALERT FOR DELETE NEWS --}}
    <script>
        $(function ()
        {
            window.addEventListener('confirm-to-delete-news', e =>
            {
                swal({   
                title: "Delete Data",   
                text: "Anda yakin ingin menghapus berita?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Hapus",   
                cancelButtonText: "Batalkan",   
                }).then((isConfirm) => 
                    {   
                        if (isConfirm && isConfirm.dismiss != 'cancel') {     
                            Livewire.emit('DeleteNews', e.detail.id);
                        } else {     
                            swal("Batal", "Berita batal dihapus!", "error");   
                        } 
                    });
            })
        })
    </script>

    {{-- CONFIGURE MODAL TO UPDATE --}}
    <script>
        $(function (){
            window.addEventListener('configure-news-modal', event =>
            {
                @this.set('title', event.detail.title)
                @this.set('newsID', event.detail.id)
                tinymce.activeEditor.setContent(event.detail.content);
            })
        })
    </script>
@endpush
