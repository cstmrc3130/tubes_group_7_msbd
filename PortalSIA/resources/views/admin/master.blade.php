<!DOCTYPE html>
<html dir="ltr" lang="en">

    <head>

        {{-- ========== ASSETS AND META COMPONENT ========== --}}
        <x-dashboard.assets-and-meta :title="$title"/>

        @stack('additional-style')

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
                            <a href="{{ route('admin.dashboard') }}" class="logo">
                                <span class="logo-text">
                                    <img src="{{ asset("/assets/images/landing-icon.png") }}" alt="homepage" width="40px" height="40px"/>
                                </span>
                                <span class="font-semibold m-b-0 mx-2 text-light">Dashboard Admin</span>
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
                        <ul class="navbar-nav float-right ml-auto">
        
                            {{-- ========== NOTIFICATION START ========== --}} 
                            <li class="nav-item dropdown border-right">
        
                                {{-- ========== NOTIFICATION COUNT START ========== --}} 
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-bell-outline font-22"></i>
                                    <span class="badge badge-pill badge-info noti">3</span>
                                </a>
                                {{-- ========== NOTIFICATION COUNT END ========== --}} 
        
        
                                {{-- ========== NOTIFICATION ICON START ========== --}} 
                                <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
        
                                    {{-- ========== CHEVRON UP START ========== --}}
                                    <span class="with-arrow">
                                        <span class="bg-primary"></span>
                                    </span>
                                    {{-- ========== CHEVRON UP END ========== --}}
        
        
        
                                    {{-- ========== NOTIFICATION SECTION START ========== --}}
                                    <ul class="list-style-none">
        
                                        {{-- ========== TITLE START ========== --}}
                                        <li>
                                            <div class="drop-title bg-primary text-white">
                                                <h4 class="m-b-0 m-t-5">4 New</h4>
                                                <span class="font-light">Notifications</span>
                                            </div>
                                        </li>
                                        {{-- ========== TITLE END ========== --}}
        
        
                                        {{-- ========== NOTIFICATION ITEMS START ========== --}}
                                        <li>
                                            <div class="message-center notifications">
                                                <a href="javascript:void(0)" class="message-item">
                                                    <span class="btn btn-danger btn-circle">
                                                        <i class="fa fa-link"></i>
                                                    </span>
                                                    <div class="mail-contnet">
                                                        <h5 class="message-title">Luanch Admin</h5>
                                                        <span class="mail-desc">Just see the my new admin!</span>
                                                        <span class="time">9:30 AM</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                        {{-- ========== NOTIFICATION ITEMS END ========== --}}
        
        
                                        {{-- ========== VIEW ALL START ========== --}}
                                        <li>
                                            <a class="nav-link text-center m-b-5 text-dark" href="javascript:void(0);">
                                                <strong>Check all notifications</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </li>
                                        {{-- ========== VIEW ALL START ========== --}}
        
                                    </ul>
                                    {{-- ========== NOTIFICATION SECTION END ========== --}}
        
                                </div>
                                {{-- ========== NOTIFICATION ICON END ========== --}} 
        
                            </li>
                            {{-- ========== NOTIFICATION END ========== --}} 
        
        
        
                            {{-- ========== USER INFO START ========== --}}
                            <li class="nav-item dropdown">
        
                                {{-- ========== NAME AND PROFILE PICTURE START ========== --}}
                                <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset("/assets/images/landing-icon.png") }}" alt="user" class="rounded-circle" width="40">
                                    <span class="m-l-5 font-medium d-none d-sm-inline-block">Jonathan Doe <i class="mdi mdi-chevron-down"></i></span>
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
                                            <img src="{{ asset("/assets/images/landing-icon.png") }}" alt="user" class="rounded-circle" width="60">
                                        </div>
                                        <div class="m-l-10">
                                            <h4 class="m-b-0">Jonathan Doe</h4>
                                            <p class=" m-b-0">jon@gmail.com</p>
                                        </div>
                                    </div>
                                    {{-- ========== NAME AND EMAIL END ========== --}}
        
        
        
                                    {{-- ========== PROFIL SECTION START ========== --}}
                                    <div class="profile-dis scrollable">
        
                                        {{-- ========== PROFIL BUTTON START ========== --}}
                                        
                                        <a class="btn dropdown-item" data-toggle="modal" data-target="#exampleModal">
                                            <i class="ti-user m-r-5 m-l-5"></i> 
                                            Profil
                                        </a>
                                        {{-- ========== PROFIL BUTTON END ========== --}}
        
        
        
                                        <div class="dropdown-divider"></div>
        
        
        
                                        {{-- ========== LOGOUT BUTTON START ========== --}}
                                        <form method="POST" action="{{ url('logout') }}">
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
        
                            {{-- ========== TITLE START ========== --}} 
                            <li class="nav-small-cap">
                                <i class="mdi mdi-dots-horizontal"></i>
                                <span class="hide-menu">DATA DAN PROFIL</span>
                            </li>
                            {{-- ========== TITLE END ========== --}} 
        
        
        
                            {{-- ========== STUDENT START ========== --}} 
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-face"></i>
                                    <span class="hide-menu">Data Siswa</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level m-l-20">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Kelas 7</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Kelas 8</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Kelas 9</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- ========== STUDENT END ========== --}} 
        
        
        
                            {{-- ========== CLASSROOM START ========== --}} 
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-book-open-variant"></i>
                                    <span class="hide-menu">Data Kelas</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Kelas 7</span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse  first-level">
                                            <li class="sidebar-item">
                                                <a class="sidebar-link">
                                                    <i class="mdi mdi-adjust"></i>
                                                    <span class="hide-menu">7 - 1</span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a class="sidebar-link">
                                                    <i class="mdi mdi-adjust"></i>
                                                    <span class="hide-menu">7 - 2</span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a class="sidebar-link">
                                                    <i class="mdi mdi-adjust"></i>
                                                    <span class="hide-menu">7 - 3</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Kelas 8</span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse  first-level">
                                            <li class="sidebar-item">
                                                <a class="sidebar-link">
                                                    <i class="mdi mdi-adjust"></i>
                                                    <span class="hide-menu">8 - 1</span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a class="sidebar-link">
                                                    <i class="mdi mdi-adjust"></i>
                                                    <span class="hide-menu">8 - 2</span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a class="sidebar-link">
                                                    <i class="mdi mdi-adjust"></i>
                                                    <span class="hide-menu">8 - 3</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Kelas 9</span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse  first-level">
                                            <li class="sidebar-item">
                                                <a class="sidebar-link">
                                                    <i class="mdi mdi-adjust"></i>
                                                    <span class="hide-menu">9 - 1</span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a class="sidebar-link">
                                                    <i class="mdi mdi-adjust"></i>
                                                    <span class="hide-menu">9 - 2</span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a class="sidebar-link">
                                                    <i class="mdi mdi-adjust"></i>
                                                    <span class="hide-menu">9 - 3</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            {{-- ========== CLASSROOM END ========== --}} 
        
        
        
                            {{-- ========== TEACHER START ========== --}} 
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-account-multiple"></i>
                                    <span class="hide-menu">Data Guru</span>
                                </a>
                            </li>
                            {{-- ========== TEACHER END ========== --}} 
        
        
        
                            {{-- ========== TITLE START ========== --}} 
                            <li class="nav-small-cap">
                                <i class="mdi mdi-dots-horizontal"></i>
                                <span class="hide-menu">KEGIATAN</span>
                            </li>
                            {{-- ========== TITLE END ========== --}} 
        
        
        
                            {{-- ========== SUBJECTS START ========== --}} 
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-newspaper"></i>
                                    <span class="hide-menu">Mata Pelajaran</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Kelas 7</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Kelas 8</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Kelas 9</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- ========== SUBJECTS END ========== --}} 
        
        
        
                            {{-- ========== EXTRACURRICULARS START ========== --}} 
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-newspaper"></i>
                                    <span class="hide-menu">Ekstrakurikuler</span>
                                </a>
                            </li>
                            {{-- ========== EXTRACURRICULARS END ========== --}} 
        
                        </ul>
                    </nav>
                </div>
            </aside>



            {{ $slot }}
        </div>



        {{-- ========== JAVASCRIPTS ========== --}}
        <x-dashboard.javascript />

        @stack('additional-script')

        @livewireScripts
    </body>

</html>