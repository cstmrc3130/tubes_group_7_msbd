<div class="container">
    
    {{-- ========== HEADER START ========== --}}
    <header class="topbar">
        <div class="container">
            <div class="header p-t-20">

                {{-- ========== NAVBAR START ========== --}}
                <nav class="navbar navbar-expand-md navbar-light rounded border-bottom">

                    {{-- ========== APPS NAME AND ICON START ========== --}}
                    <a class="navbar-brand d-flex align-items-center" href="/">
                        <img src="{{ asset("assets/images/landing-icon.png") }}" alt="logo" class="img-fluid w-2" width="60" length="60">
                        <span class="font-weight-bold ml-3">SIA - MTsN 1 Labuhanbatu</span>
                    </a>
                    {{-- ========== APPS NAME AND ICON END ========== --}}



                    {{-- ========== TOGGLER BUTTON FOR SMALL DEVICE START ========== --}}
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    {{-- ========== TOGGLER BUTTON FOR SMALL DEVICE END ========== --}}

                    @auth()

                    {{-- ========== AUTHED USER BUTTONS START ========== --}}
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">

                            {{-- ========== DIREKTORI START ========== --}}
                            <div class="dropleft show">
                                <a class="nav-link btn dropdown-toggle m-r-15" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Direktori
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('directory.teacher') }}">Guru</a>
                                    <a class="dropdown-item" href="{{ route('directory.student') }}">Siswa</a>
                                </div>
                            </div>
                            {{-- ========== DIREKTORI END ========== --}}


                            {{-- ========== DASHBOARD AND LOGOUT BUTTON START ========== --}}
                            <li class="nav-item">
                                <div class="btn-group">
                                    <button class="btn btn-danger dropdown-toggle text-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if (Auth::user()->role == 0)
                                        Admin
                                        @elseif (Auth::user()->role == 1)
                                            @for($i = 0; $i < 2; $i++)
                                                {!! print_r(explode(" ", auth()->user()->teacher->name)[$i], true); !!}
                                            @endfor
                                        @else 
                                            @for($i = 0; $i < 2; $i++)
                                                {!! print_r(explode(" ", auth()->user()->student->name)[$i], true); !!}
                                            @endfor
                                        @endif
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route("student.dashboard") }}">Dashboard</a>
                                        <form wire:submit.prevent="Logout">
                                            @csrf
                                            <button type="button" wire:click="Logout" class="btn dropdown-item">Logout</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            {{-- ========== DASHBOARD AND LOGOUT BUTTON END ========== --}}

                        </ul>
                    </div>
                    {{-- ========== AUTHED USER BUTTONS END ========== --}}

                    @else

                    {{-- ========== GUEST BUTTONS START ========== --}}
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">

                            {{-- ========== DIREKTORI START ========== --}}
                            <div class="dropleft show">
                                <a class="nav-link btn dropdown-toggle m-r-15" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Direktori
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('directory.teacher') }}">Guru</a>
                                    <a class="dropdown-item" href="{{ route('directory.student') }}">Siswa</a>
                                </div>
                            </div>
                            {{-- ========== DIREKTORI END ========== --}}


                            {{-- ========== LOGIN BUTTON START ========== --}}
                            <li class="nav-item">
                                <a class="nav-link btn btn-info text-light" href="{{ url('login') }}">Log in</a>
                            </li>
                            {{-- ========== LOGIN BUTTON END ========== --}}
                        </ul>
                    </div>
                    {{-- ========== GUEST BUTTONS END ========== --}}

                    @endauth

                </nav>
                {{-- ========== NAVBAR END ========== --}}

            </div>
        </div>
    </header>
    {{-- ========== HEADER END ========== --}}



    <div class="row header-banner align-items-center pt-3 pb-0">
        
        {{-- ========== SEARCH BUTTON START ========== --}}
        <div class="col-sm-12 col-md-6 col-lg-4">
            <form wire:submit.prevent="Search">
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('keyword') is-invalid @enderror" placeholder="Masukkan NIP atau Nama" aria-label="" aria-describedby="basic-addon1" wire:model.defer="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" wire:click="Search">Cari!</button>
                    </div>
                    @error('keyword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </form>
        </div>
        {{-- ========== SEARCH BUTTON END ========== --}}


        @if(session()->has('paginatedTeacher'))
        
        {{-- ========== SEARCH RESULT ALERT START ========== --}}
        <div class="col-lg-8 col-md-6 col-sm-12">
            <div class="alert {{ $totalUserFound != 0 ? 'alert-success' : 'alert-danger' }} " >
                {!! $totalUserFound != 0 ? '<i class="fa fa-check-circle"></i>' : '<i class="fa fa-exclamation-triangle"></i>' !!}
                <span>
                    {{ "Found " . $totalUserFound . ($totalUserFound <= 1 ? ' teacher' : ' teachers') . " with keyword " . "'" . $keyword . "'" }}
                </span> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                    <span aria-hidden="true">×</span> 
                </button>
            </div>
        </div>
        {{-- ========== SEARCH RESULT ALERT END ========== --}}

        @endif

    </div>



    {{-- ========== SEARCH RESULT START ========== --}}
    <div class="row header-banner align-items-center pt-3">

        @if(session()->has('paginatedTeacher'))
        
        @forelse ($paginatedTeacher as $teacher)

        {{-- ========== ALL USERS FOUND START ========== --}}
        <div class="{{ $totalUserFound == 1 ? 'col-md-12' : 'col-md-4' }} py-2 col-xxl-3">
            <div class="card border-dark">
                <div class="card-body">

                    {{-- ========== USER CARD START ========== --}}
                    <div class="text-center">
                        <img src="{{ $teacher->user->profile_picture != "DEFAULT" ? asset('users-profile-pictures/' . $teacher->user->profile_picture) : asset('users-profile-pictures/' . 'default-user.svg') }}" class="img-fluid w-2" alt="friend" width="84" length="84">
                        <h5 class="mt-3">{{ $teacher->name }}<i class="mdi mdi-checkbox-marked-circle-outline text-success ml-1"></i></h5>
                        <p class="mb-0 text-muted"><i class="mdi mdi-email-outline me-1"></i>{{ $teacher->user->email }}</p>
                        <hr class="bg-dark-light my-3">
                        <h5 class="mt-3 fw-semibold text-muted">
                            Teacher
                        </h5>
                        <div class="row mt-3 justify-content-center">
                            <div class="col-12">
                                <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn w-100 btn-outline-dark" wire:click="ShowDetails({{ $teacher->NIP }})">
                                    <i class="dripicons-user-id me-1"></i>
                                    View details
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- ========== USER CARD END ========== --}}

                </div>
            </div>
        </div> 
        {{-- ========== ALL USERS FOUND END ========== --}}

        @empty

        @endforelse

        @endif

    </div>
    {{-- ========== SEARCH RESULT END ========== --}}

    @if(session()->has('paginatedTeacher'))

    {{-- ========== PAGINATION START ========== --}}
    <div class="d-flex justify-content-center align-items-center my-3">
        {{ $paginatedTeacher->links() }}
    </div>
    {{-- ========== PAGINATION END ========== --}}

    @endif

    {{-- ========== DETAILS MODAL START ========== --}}
    <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4 align-self-center text-center ">
                            <div class="h-100 border-right border-dark">
                                <img src="{{ $profilePicture != "DEFAULT" ? asset('users-profile-pictures/' . $profilePicture) : asset('users-profile-pictures/' . 'default-user.svg') }}" class="img-fluid w-50" alt="friend" width="84" length="84">
                            </div>
                        </div>
                        <div class="col-8">
                            
                            <div class="form-group row">
                                {{ Form::label('name', 'Nama Lengkap', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                <div class="col-md-8">
                                    {{ Form::text('name', $name, ['class' => 'form-control form-control-line bg-transparent', 'disabled', 'readonly']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('NIP', 'NIP', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                <div class="col-md-8">
                                    {{ Form::text('NIP', $NIP, ['class' => 'form-control form-control-line bg-transparent', 'disabled', 'readonly']) }}
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                {{ Form::label('KARPEG', 'KARPEG', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                <div class="col-md-8">
                                    {{ Form::text('KARPEG', $KARPEG, ['class' => 'form-control form-control-line bg-transparent', 'disabled', 'readonly']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('email', 'Email', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                <div class="col-md-8">
                                    {{ Form::text('email', $email, ['class' => 'form-control form-control-line bg-transparent', 'disabled', 'readonly']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('class', 'Kelas', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                <div class="col-md-8">
                                    {{ Form::text('class', $class, ['class' => 'form-control form-control-line bg-transparent', 'disabled', 'readonly']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('subject', 'Mata Pelajaran', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                <div class="col-md-8">
                                    {{ Form::text('subject', $subject, ['class' => 'form-control form-control-line bg-transparent', 'disabled', 'readonly']) }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== DETAILS MODAL END ========== --}}

</div>
