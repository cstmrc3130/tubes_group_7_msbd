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



    {{-- ========== ALL NEWS START ========== --}}
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 align-self-start m-t-20 m-b-20">
                    <h3><span class="font-bold">Sort Or Search</span></h3>
                </div>
            <div class="container row justify-content-evenly">

                @forelse($allNews as $news)
                <div class="col-4">
                    <div class="card m-b-30">
                        @if (preg_match('%<img\s.*?src=".*?/?([^/]+?(\.gif|\.png|\.jpg))"%s', $news->content, $regs)) 
                        <img class="card-img-top" src="{{ asset('/storage/news-images/' . $regs[1]) }}" height="250px" alt="Card image cap">
                        @else 
                        <img class="card-img-top" src="{{ asset('assets/images/auth-bg2.jpg') }}" height="250px" alt="Card image cap">
                        @endif
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center m-b-15">
                                <span><i class="ti-calendar"></i> {{ $news->created_at->diffForHumans() }}</span>
                            </div>
                            <h4 class="card-title">{{ $news->title }}</h4>
                            <div class="m-b-0 m-t-10" style="overflow:hidden; display:-webkit-box; -webkit-box-orient:vertical; -webkit-line-clamp:3; ">
                                {{ Str::words($news->content, 10, '...') }}
                            </div>
                            <a class="btn btn-success btn-rounded waves-effect waves-light m-t-20" href="{{ url("full-events") }}">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse

            </div>
        </div>
    </div>
    {{-- ========== ALL NEWS END ========== --}}

</div>