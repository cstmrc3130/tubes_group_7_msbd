<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    
    {{-- ========== ASSETS AND META COMPONENT ========== --}}
    <x-dashboard.assets-and-meta :title="$title"/>

    @livewireStyles
</head>

<body>
    
    {{-- ========== PRELOADER START ========== --}}
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    {{-- ========== PRELOADER END ========== --}}



    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
    
    
    
                    {{-- ========== LOGO AND TOGGLE BUTTON START ========== --}}
                    <div class="navbar-brand">
                        <a href="{{ route("teacher.dashboard") }}" class="logo">
                            <span class="logo-text">
                                <img src="{{ asset("/assets/images/landing-icon.png") }}" alt="homepage" width="40px" height="40px"/>
                            </span>
                            <span class="font-semibold m-b-0 mx-2 text-light">Dashboard Guru</span>
                        </a>
                        <a class="sidebartoggler d-none d-md-block" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                            <i class="mdi mdi-toggle-switch mdi-toggle-switch-off font-20"></i>
                        </a>
                    </div>
                    {{-- ========== LOGO AND TOGGLE BUTTON END ========== --}}
    
    
    
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>
    
    
    
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav float-left mr-0" style="padding-left: 20px">
                        <div class="row alert alert-cyan mb-0 nowrap py-2">
                            <li class="col-2 align-self-center">
                                <i class="mdi mdi-access-point mdi-24px"></i>
                            </li>
                            <div class="col-10 flex-column">
                                <li> 
                                    Tahun Ajaran Aktif :
                                    <span class="font-bold">
                                        {{ \App\Models\SchoolYear::query()->find(session('currentSchoolYear'))->year }}
                                    </span>
                                </li>
                                <li> 
                                    Semester Aktif :
                                    <span class="font-bold">
                                        {{ session('currentSemester') }}
                                    </span>
                                </li>
                            </div>
                        </div>
                    </ul>

                    
                    <ul class="navbar-nav float-right ml-auto">
    
                        {{-- ========== USER INFO START ========== --}}
                        <li class="nav-item dropdown">
    
                            {{-- ========== NAME AND PROFILE PICTURE START ========== --}}
                            <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ Auth::user()->profile_picture != 'DEFAULT' ? asset('users-profile-pictures/'.Auth::user()->profile_picture) : asset('users-profile-pictures/'.'default-user.svg')  }}" alt="profile-picture" class="rounded-circle" width="40">
                                <span class="m-l-5 font-medium d-none d-sm-inline-block">
                                    {{ auth()->user()->teacher->name }}
                                <i class="mdi mdi-chevron-down"></i></span>
                            </a>
                            {{-- ========== NAME AND PROFILE PICTURE END ========== --}}
    
    
    
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
    
                                {{-- ========== DROPDOWN ARROW START ========== --}}
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>
                                {{-- ========== DROPDOWN ARROW END ========== --}}
    
    
    
                                {{-- ========== NAME AND EMAIL START ========== --}}
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class="">
                                        <img src="{{ Auth::user()->profile_picture != 'DEFAULT' ? asset('users-profile-pictures/'.Auth::user()->profile_picture) : asset('users-profile-pictures/'.'default-user.svg')  }}" alt="profile_picture" class="rounded-circle" width="60">
                                    </div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0">
                                        {{ auth()->user()->teacher->name }}
                                        </h4>
                                        <p class=" m-b-0">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                {{-- ========== NAME AND EMAIL END ========== --}}
    
    
    
                                {{-- ========== PROFILE SECTION START ========== --}}
                                <div class="profile-dis scrollable">
    
                                    {{-- ========== PROFILE BUTTON START ========== --}}
                                    <button type="button" class="btn dropdown-item" onclick="return window.location.href = '{{ route('teacher.profile') }}'">
                                        <i class="ti-user m-r-5 m-l-5"></i> 
                                        Profil
                                    </button>
                                    {{-- ========== PROFILE BUTTON END ========== --}}
    
    
    
                                    <div class="dropdown-divider"></div>
    
    
    
                                    {{-- ========== LOGOUT BUTTON START ========== --}}
                                    <form method="POST" action="{{ url('logout') }}" wire:submit.prevent="Logout">
                                        @csrf
                                        <button type="submit" class="btn dropdown-item">
                                            <i class="fa fa-power-off m-r-5 m-l-5"></i> 
                                            Logout
                                        </button>
                                    </form>
                                    {{-- ========== LOGOUT BUTTON END ========== --}}
    
                                </div>
                                {{-- ========== PROFIL SECTION END ========== --}}
    
                            </div>
                        </li>
                        {{-- ========== USER INFO END ========== --}}
    
                    </ul>
                </div>
            </nav>
        </header>



        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
    
                        @if(Auth::user()->teacher->homeroom_class_id != NULL)
                        {{-- ========== TITLE START ========== --}} 
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Informasi Kelas</span>
                        </li>
                        {{-- ========== TITLE END ========== --}} 
    
    
    
                        {{-- ========== CLASS START ========== --}} 
                        <li class="sidebar-item">
                            <a href="{{ route('teacher.homeroom-class') }}" class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                <i class="ti-agenda"></i>
                                <span class="hide-menu">Wali Kelas</span>
                            </a>
                        </li>
                        {{-- ========== CLASS END ========== --}} 
                        @endif


                        {{-- ========== TITLE START ========== --}} 
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Manajemen Nilai</span>
                        </li>
                        {{-- ========== TITLE END ========== --}} 
    
    
    
                        {{-- ========== E-RAPOR START ========== --}} 
                        <li class="sidebar-item">
                            <a href="{{ route('teacher.subject-score') }}" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu">Nilai Mata Pelajaran</span>
                            </a>
                        </li>



                        @if(\App\Models\Teacher\TeachingExtracurricular::query()->where('NIP', Auth::user()->NIP)->first())
                        <li class="sidebar-item">
                            <a href="{{ route('teacher.extracurricular-score') }}" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu">Nilai Ekstrakurikuler</span>
                            </a>
                        </li>
                        @endif

                        {{-- ========== E-RAPOR END ========== --}} 
    
                    </ul>
                </nav>
            </div>
        </aside>



        {{ $slot }}
    </div>



    {{-- ========== JAVASCRIPTS ========== --}}
    <x-dashboard.javascript />

    @livewireScripts
</body>

</html>