<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}} 
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Profile</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}} 



    {{-- ========== CONTENT START ========== --}} 
    <div class="container-fluid">
        <div class="row">

            {{-- ========== PROFILE LEFT SECTION START ========== --}}
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="m-t-30 text-center"> 
                            <img src="{{ Auth::user()->profile_picture != 'DEFAULT' ? asset('users-profile-pictures/'.Auth::user()->profile_picture) : asset('users-profile-pictures/'.'default-user.svg')  }}" class="rounded-circle" width="150" alt="profile-picture"/>
                            <h4 class="card-title m-t-10">Foto Profil</h4>

                            {{-- ========== UPDATE PROFILE PICTURE BUTTON START ========== --}}
                            <div class="row text-center justify-content-md-center">
                                <input type="file" name="select_image" id="select_image" class="d-none">
                                <button type="button" class="btn btn-outline-cyan mb-2 waves-effect " id="button_select_image" >
                                    <i class="mdi mdi-account-box-outline me-1"></i>
                                    Update Foto Profil
                                </button>  
                            </div>
                            {{-- ========== UPDATE PROFILE PICTURE BUTTON START ========== --}}

                        </div>
                    </div>
                    <div>
                        <hr> </div>
                    <div class="card-body"> 
                        <small class="text-muted">Lulus Dari</small>
                        <h6>{{ Auth::user()->teacher->graduated_from }}</h6> 
                        <small class="text-muted p-t-30 db">Tahun Lulus</small>
                        <h6>{{ Auth::user()->teacher->graduated_at }}</h6> 
                        <small class="text-muted p-t-30 db">Tahun Mulai Bekerja</small>
                        <h6>{{ Auth::user()->teacher->started_working_at }}</h6>
                    </div>
                </div>
            </div>
            {{-- ========== PROFILE LEFT SECTION END ========== --}}



            {{-- ========== PROFILE RIGHT SECTION START ========== --}}
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#teacher-profile-info">Teacher Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#teacher-login-info">Login Info</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">

                            {{-- ========== TEACHER PROFILE INFO START ========== --}}
                            <div class="tab-pane fade show active" id="teacher-profile-info" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                <div class="card-body">
                                    {!! Form::model($profile, ["method" => "PUT", "class" => "form-horizontal", "autocomplete" => "off", "id" => 'teacher-profile-form']) !!}

                                        {{-- ========== NIP START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('NIP', 'NIP', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-9">
                                                {{ Form::text('NIP', null, ['class' => 'form-control form-control-line'.($errors->has('NIP') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'NIP', 'readonly', 'disabled', 'wire:model' => 'NIP']) }}
                                            </div>
                                        </div>
                                        {{-- ========== NIP START ========== --}}



                                        {{-- ========== KARPEG START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('KARPEG', 'KARPEG', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-9">
                                                {{ Form::text('KARPEG', null, ['class' => 'form-control form-control-line'.($errors->has('KARPEG') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'KARPEG', 'readonly', 'disabled', 'wire:model' => 'KARPEG']) }}
                                                @error('KARPEG')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        {{-- ========== KARPEG END ========== --}}



                                        {{-- ========== NAME START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('name', 'Nama Lengkap', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-9">
                                                {{ Form::text('name', null, ['class' => 'form-control form-control-line'.($errors->has('name') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'name', 'wire:model' => 'name']) }}
                                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        {{-- ========== NAME START ========== --}}



                                        {{-- ========== POSITION START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('position', 'Jabatan', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-9">
                                                {{ Form::text('position', null, ['class' => 'form-control form-control-line'.($errors->has('position') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'position', 'readonly', 'disabled', 'wire:model' => 'position']) }}
                                                @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        {{-- ========== POSITION END ========== --}}



                                        {{-- ========== PLACE OF BIRTH START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('place_of_birth', 'Tempat Lahir', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-9">
                                                {{ Form::text('place_of_birth', null, ['class' => 'form-control form-control-line'.($errors->has('placeOfBirth') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'place_of_birth', 'wire:model' => 'placeOfBirth']) }}
                                                @error('placeOfBirth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        {{-- ========== PLACE OF BIRTH START ========== --}}



                                        {{-- ========== DATE OF BIRTH START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('date_of_birth', 'Tanggal Lahir', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-9">
                                                {{ Form::date('date_of_birth', null, ['class' => 'form-control form-control-line'.($errors->has('dateOfBirth') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'date_of_birth', 'wire:model' => 'dateOfBirth']) }}
                                                @error('dateOfBirth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        {{-- ========== DATE OF BIRTH START ========== --}}



                                        {{-- ========== GENDER START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('Gender', 'Jenis Kelamin', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-3 col-form-label">
                                                {{ Form::radio('gender', 'M', false, ['class' => ($errors->has('gender') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'male', 'disabled', 'wire:model' => 'gender']) }}
                                                <label for="male">Laki-laki</label>
                                            </div>
                                            
                                            <div class="col-md-3 col-form-label">
                                                {{ Form::radio('gender', 'F', false, ['class' => ($errors->has('gender') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'female', 'disabled', 'wire:model' => 'gender']) }}
                                                <label for="female">Perempuan</label>
                                                @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                        </div>
                                        {{-- ========== GENDER END ========== --}}



                                        {{-- ========== ADDRESS START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('address', 'Alamat', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-9">
                                                {{ Form::textarea('address', 'address', ['class' => 'form-control form-control-line'.($errors->has('address') ? ' is-invalid' : ''), 'style' => 'max-height: 12ch; min-height: 5ch', 'autocomplete' => 'off', 'id' => 'address', 'rows' => '3', 'wire:model' => 'address']) }}
                                                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        {{-- ========== ADDRESS END ========== --}}



                                        {{-- ========== PHONE NUMBER START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('phone_numbers', 'Nomor Handphone', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="input-group col-md-9">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend">+62</span>
                                                </div>
                                                {{ Form::tel('phone_numbers', null, ['class' => 'form-control form-control-line'.($errors->has('phoneNumber') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'phone_numbers', 'wire:model' => 'phoneNumber']) }}
                                                @error('phoneNumber')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        {{-- ========== PHONE NUMBER END ========== --}}



                                        {{-- ========== TERMS AND SUBMIT BUTTON START ========== --}}
                                        <div class="form-group row mt-5">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-success" id="update-student-info-button"                                                
                                                @if ($errors->has('NISN') ||
                                                    $errors->has('name') ||  
                                                    $errors->has('placeOfBirth') ||
                                                    $errors->has('dateOfBirth') ||
                                                    $errors->has('KARPEG') ||
                                                    $errors->has('position') ||
                                                    $errors->has('gender') ||
                                                    $errors->has('address') ||
                                                    $errors->has('phoneNumber'))
                                                    @disabled(true) 
                                                    @endif 
                                                    >
                                                    <i class="ti-save mr-2"></i>
                                                    Update Teacher Info
                                                </button>
                                            </div>
                                        </div>
                                        {{-- ========== TERMS AND SUBMIT BUTTON END ========== --}}

                                    {!! Form::close() !!}
                                </div>
                            </div>
                            {{-- ========== TEACHER PROFILE INFO END ========== --}}



                            {{-- ========== TEACHER LOGIN INFO START ========== --}}
                            <div class="tab-pane fade" id="teacher-login-info" role="tabpanel" aria-labelledby="pills-setting-tab">
                                <div class="card-body">
                                    {!! Form::model($user, ["method" => "PUT", "class" => "form-horizontal", "autocomplete" => "off", "id" => 'teacher-login-form', 'wire:submit.prevent' => "UpdateLoginInfo()"]) !!}

                                        {{-- ========== EMAIL START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('email', 'Email', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-9">
                                                {{ Form::email('email', null, ['class' => 'form-control form-control-line'.($errors->has('email') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'email', 'wire:model.defer' => 'email', 'required']) }}
                                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        {{-- ========== EMAIL START ========== --}}



                                        {{-- ========== OLD PASSWORD START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('old_password', 'Kata Sandi Lama', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-9">
                                                {{ Form::password('old_password', ['class' => 'form-control form-control-line'.($errors->has('oldPassword') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'old_password', 'wire:model.defer' => 'oldPassword', 'required']) }}
                                                @error('oldPassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        {{-- ========== OLD PASSWORD START ========== --}}



                                        {{-- ========== NEW PASSWORD START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('new_password', 'Kata Sandi Baru', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-9">
                                                {{ Form::password('new_password', ['class' => 'form-control form-control-line'.($errors->has('newPassword') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'new_password', 'wire:model.defer' => 'newPassword', 'required']) }}
                                                @error('newPassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        {{-- ========== NEW PASSWORD START ========== --}}



                                        {{-- ========== SUBMIT BUTTON START ========== --}}
                                        <div class="form-group row mt-5">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-success" id="update-login-info-button">
                                                    <i class="ti-save mr-2"></i>
                                                    Update Login Info
                                                </button>
                                            </div>
                                        </div>
                                        {{-- ========== SUBMIT BUTTON END ========== --}}

                                    {!! Form::close() !!}
                                </div>
                            </div>
                            {{-- ========== TEACHER LOGIN INFO END ========== --}}

                        </div>
                    </div>
                </div>
            </div>
            {{-- ========== PROFILE RIGHT SECTION END ========== --}}


        </div>
    </div>
    {{-- ========== CONTENT START ========== --}} 



    {{-- ========== FOOTER START ========== --}} 
    <footer class="footer text-center">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}} 
</div>

@push('additional-script')
    {{-- REMOVE 08 OR 62 IN PHONE NUMBER --}}
    <script>
        $(function ()
        {
            let phoneNumber = $('#phone_numbers').val();

            if (phoneNumber.length == 13)
            {
                if (phoneNumber.substring(0, 2) == '62' )
                {
                    $('#phone_numbers').val(phoneNumber.substring(2, phoneNumber.length))
                }
                else if(phoneNumber.substring(0, 2) == '08')
                {
                    $('#phone_numbers').val(phoneNumber.substring(1, phoneNumber.length))
                }
            }
            else if(phoneNumber.length == 12)
            {
                phoneNumber.substring(0, 2) == '08' ? $('#phone_numbers').val(phoneNumber.substring(1, phoneNumber.length)) : ''
            }

            $('#phone_numbers').bind('keyup', function (event)
            {
                phoneNumber = event.target.value;

                phoneNumber.substring(0, 2) == '62' ? $('#phone_numbers').val(phoneNumber.substring(2, phoneNumber.length)) : ''
                phoneNumber.substring(0, 2) == '08' ? $('#phone_numbers').val(phoneNumber.substring(1, phoneNumber.length)) : ''
            })
        })
    </script>

    {{-- PROFILE INFO SUBMIT BUTTON --}}
    <script>
        $(function ()
        {
            const previousState = $('#teacher-profile-form').serialize();

            $('#teacher-profile-form').on('input', function()
            {
                $(this).find('input:submit, button:submit').prop('disabled', previousState == $(this).serialize());
            }).find('input:submit, button:submit').prop('disabled', true);

            window.addEventListener('toggle-submit-button', event =>
            {
                $('#teacher-profile-form').find('input:submit, button:submit').prop('disabled', previousState == $('#teacher-profile-form').serialize());

                $('#teacher-profile-form').submit(function (event) {
                    if (previousState == $(this).serialize())
                    {
                        event.preventDefault();
                    }
                });
            })
        })
    </script>

    {{-- LOGIN INFO UPDATE TOAST --}}
    <script>
        $(function()
        {
            window.addEventListener('login-info-update-result', event =>
            {
                if (event.detail.response == 'success')
                {
                    toastr.success('Informasi login berhasil di-update!', 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
                }
                else
                {
                    toastr.error('Harap tunggu 5 menit sebelum melakukan update!', 'Failure!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
                }

                $('#teacher-login-form').find("input[type='password']").val('');
            })
        })
    </script>

    {{-- PERSIST BOOTSTRAP TAB UPON RELOAD --}}
    <script>
        $(function()
        {
            window.addEventListener('persisting-last-tab', event => {
                $('#pills-timeline-tab').toggleClass('active');
                $('#pills-setting-tab').toggleClass('active show');

                $('#teacher-profile-info').toggleClass('show active');
                $('#'+event.detail['tab-ID']).toggleClass('show active');
                $('#'+event.detail['tab-ID']).tab('show');
            })
            
            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
                localStorage.setItem('tab-used', $(this).attr('href'));
            });

            var lastTab = localStorage.getItem('tab-used');
            
            if (lastTab) {
                $('[href="' + lastTab + '"]').tab('show');
            }
        })
    </script>

    {{-- IJABOCROPTOOL --}}
    <script src="{{ asset('assets/js/ijaboCropTool.min.js') }}"></script>
    <script>
        $(document).on("click", "#button_select_image", () =>
        {
            $("#select_image").click();
        })

        $("#select_image").ijaboCropTool(
        {
            preview : '.rounded-circle',
            setRatio:1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText:['CROP','BATAL'],
            buttonsColor:['#30bf7d','#ee5155', -15],
            processUrl:'{{ route("teacher.update-profile-picture") }}',
            withCSRF:['_token','{{ csrf_token() }}'],
            onSuccess:function(message){
                toastr.success('Foto profil berhasil di-update!', 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            },
            onError:function(message, element, status){
                toastr.error('Foto profil gagal di-update!', 'Failure!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            }
        }); 
    </script>

    {{-- SWEETALERT UPDATE PROFILE --}}
    <script>
        $('#teacher-profile-form').submit(function(event){
            event.preventDefault();
            swal({   
                title: "Update Profile",   
                text: "Kamu harus menunggu 5 menit sebelum melakukan update berikutnya!",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Lanjutkan",   
                cancelButtonText: "Batalkan",   
            }).then((isConfirm) => 
                {   
                    if (isConfirm && isConfirm.dismiss != 'cancel') {     
                        Livewire.emit('TeacherIntendedToUpdate');
                    } else {     
                        swal("Gagal", "Perbaruan profil dibatalkan!", "error");   
                    } 
                });
        });

        // CONVERT STRING INTO TITLE CASE
        function ToTitleCase(str) {
            return str.replace(
                /\w\S*/g,
                function(txt) {
                    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                }
            );
        }

        window.addEventListener('teacher-profile-updated', event => {
            toastr.success('Profilmu berhasil di-update!', "" + ToTitleCase(event.detail.response) + "", {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
        })
    </script>
@endpush
