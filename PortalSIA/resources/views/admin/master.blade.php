<!DOCTYPE html>
<html dir="ltr" lang="en">

    <head>

        {{-- ========== ASSETS AND META COMPONENT ========== --}}
        <x-dashboard.assets-and-meta :title="$title"/>

        @stack('additional-style')

        @livewireStyles
        @powerGridStyles
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
        
                            {{-- ========== NOTIFICATION START ========== --}} 
                            <li class="nav-item dropdown border-right">

                                @php 
                                    $recentNotification = Auth::user()->query()->where('role', '0')->first()->unreadNotifications->where("created_at", '>=', now()->subDays(1)->toDateTimeString());
                                @endphp
        
                                {{-- ========== NOTIFICATION COUNT START ========== --}}
                                @if(!Str::contains(url()->current(), 'all-notifications')) 
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-bell-outline font-22"></i>
                                    @if($recentNotification->count() > 0)
                                    <span class="badge badge-pill badge-info noti" id="noti-count">{{ $recentNotification->count() }}</span>
                                    @endif
                                </a>
                                @endif
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
                                                <h4 class="m-b-0 m-t-5" id="noti-text">{{ $recentNotification->count() }} New</h4>
                                                <span class="font-light">Notifications</span>
                                            </div>
                                        </li>
                                        {{-- ========== TITLE END ========== --}}
        
        

                                        {{-- ========== NOTIFICATION ITEMS START ========== --}}
                                        <li>
                                            <div class="message-center notifications h-auto" >
                                                @foreach($recentNotification as $notification)
                                                    @livewire('admin.notification-inline', 
                                                        [
                                                            'notificationID' => $notification->id, 
                                                            'name' => \App\Models\User::find($notification->data['user_id'])->student->name, 
                                                            'createdAt' => $notification->created_at->diffForHumans()
                                                        ])
                                                @endforeach
                                            </div>
                                        </li>
                                        {{-- ========== NOTIFICATION ITEMS END ========== --}}
        


                                        {{-- ========== VIEW ALL START ========== --}}
                                        <li>
                                            <a class="nav-link text-center m-b-5 text-dark" href="{{ route('admin.all-notifications') }}">
                                                <strong>Lihat semua notifikasi</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </li>
                                        {{-- ========== VIEW ALL END ========== --}}
        
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
                                    <span class="m-l-5 font-medium d-none d-sm-inline-block">{{ Auth::user()->email }}<i class="mdi mdi-chevron-down"></i></span>
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
                                            <h4 class="m-b-0">Admin MTsN</h4>
                                            <p class=" m-b-0">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                    {{-- ========== NAME AND EMAIL END ========== --}}
        
        
        
                                    {{-- ========== PROFILE SECTION START ========== --}}
                                    <div class="profile-dis scrollable">
        
                                        {{-- ========== PROFIL BUTTON START ========== --}}
                                        
                                        <a class="btn dropdown-item" data-toggle="modal" data-target="#loginInfoModal">
                                            <i class="ti-user m-r-5 m-l-5"></i> 
                                            Login Info
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
                                    {{-- ========== PROFILE SECTION END ========== --}}
        
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
                                <a class="sidebar-link waves-effect has-arrow waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-face"></i>
                                    <span class="hide-menu">Data Siswa</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a href="{{ route('admin.student-list') }}"  class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Daftar Siswa</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{ route('admin.student-taking-extracurricular') }}" class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Ekstrakurikuler Siswa</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{ url('test') }}" class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Rapor Siswa</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- ========== STUDENT END ========== --}} 



                            {{-- ========== TEACHER START ========== --}} 
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect has-arrow waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-account-multiple"></i>
                                    <span class="hide-menu">Data Guru</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a href="{{ route('admin.teacher-list') }}"  class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Daftar Guru</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{ route("admin.teacher-teaching-subject") }}" class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Mata Pelajaran Guru</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{ route("admin.teacher-teaching-extracurricular") }}" class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi mdi-adjust"></i>
                                            <span class="hide-menu">Ekstrakurikuler Guru</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- ========== TEACHER END ========== --}} 



                            {{-- ========== CLASSROOM START ========== --}} 
                            <li class="sidebar-item">
                                <a href="{{ route('admin.class-list') }}" class="sidebar-link waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-book-open-variant"></i>
                                    <span class="hide-menu">Data Kelas</span>
                                </a>
                            </li>
                            {{-- ========== CLASSROOM END ========== --}} 



                            {{-- ========== TITLE START ========== --}} 
                            <li class="nav-small-cap">
                                <i class="mdi mdi-dots-horizontal"></i>
                                <span class="hide-menu">KEGIATAN INTI</span>
                            </li>
                            {{-- ========== TITLE END ========== --}} 



                            {{-- ========== SUBJECTS START ========== --}} 
                            <li class="sidebar-item">
                                <a href="{{ route('admin.subject-list') }}" class="sidebar-link waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-book-open"></i>
                                    <span class="hide-menu">Mata Pelajaran</span>
                                </a>
                            </li>
                            {{-- ========== SUBJECTS END ========== --}} 



                            {{-- ========== EXTRACURRICULARS START ========== --}} 
                            <li class="sidebar-item">
                                <a href="{{ route('admin.extracurricular-list') }}" class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-football"></i>
                                    <span class="hide-menu">Ekstrakurikuler</span>
                                </a>
                            </li>
                            {{-- ========== EXTRACURRICULARS END ========== --}}



                            {{-- ========== TITLE START ========== --}} 
                            <li class="nav-small-cap">
                                <i class="mdi mdi-dots-horizontal"></i>
                                <span class="hide-menu">SESI DAN TAHUN AJARAN</span>
                            </li>
                            {{-- ========== TITLE END ========== --}} 



                            {{-- ========== SCHOOL YEAR START ========== --}} 
                            <li class="sidebar-item">
                                <a href="{{ route('admin.school-year') }}" class="sidebar-link waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-calendar"></i>
                                    <span class="hide-menu">Tahun Ajaran</span>
                                </a>
                            </li>
                            {{-- ========== SCHOOL YEAR END ========== --}} 



                            {{-- ========== SCORING SESSION START ========== --}} 
                            <li class="sidebar-item">
                                <a href="{{ route('admin.scoring-session') }}" class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-alarm-check"></i>
                                    <span class="hide-menu">Sesi Penilaian</span>
                                </a>
                            </li>
                            {{-- ========== SCORING SESSION END ========== --}}



                            {{-- ========== TITLE START ========== --}} 
                            <li class="nav-small-cap">
                                <i class="mdi mdi-dots-horizontal"></i>
                                <span class="hide-menu">BERITA</span>
                            </li>
                            {{-- ========== TITLE END ========== --}} 



                            {{-- ========== NEWS START ========== --}} 
                            <li class="sidebar-item">
                                <a href="{{ route('admin.news') }}" class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-newspaper"></i>
                                    <span class="hide-menu">Daftar Berita</span>
                                </a>
                            </li>
                            {{-- ========== NEWS END ========== --}}
        
                        </ul>
                    </nav>
                </div>
            </aside>



            {{ $slot }}
        </div>



        {{-- ========== NOTIFICATION MODAL START ========== --}}
        <div class="modal fade show" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="notificationModalLabel1">Update Data Siswa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                
                                {{-- ========== OLD DATA START ========== --}}
                                <div class="col-6 border-right border-dark">
                                    <h4 class="text-center font-bold mb-3">Data Lama</h4>

                                    <div class="form-group row">
                                        {{ Form::label('old-name', 'Nama Lengkap', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::text('old-name', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        {{ Form::label('old-place-of-birth', 'Tempat Lahir', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::text('old-place-of-birth', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        {{ Form::label('old-date-of-birth', 'Tanggal Lahir', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::date('old-date-of-birth', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        {{ Form::label('old-father-name', 'Nama Ayah', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::text('old-father-name', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        {{ Form::label('old-mother-name', 'Nama Ibu', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::text('old-mother-name', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {{ Form::label('old-address', 'Alamat', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::text('old-address', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {{ Form::label('old-phone-number', 'Nomor Handphone', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::text('old-phone-number', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>
        
                                </div>
                                {{-- ========== OLD DATA END ========== --}}



                                {{-- ========== NEW DATA START ========== --}}
                                <div class="col-6">
                                    <h4 class="text-center font-bold mb-3">Data Baru</h4>

                                    <div class="form-group row">
                                        {{ Form::label('new-name', 'Nama Lengkap', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::text('new-name', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        {{ Form::label('new-place-of-birth', 'Tempat Lahir', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::text('new-place-of-birth', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        {{ Form::label('new-date-of-birth', 'Tanggal Lahir', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::date('new-date-of-birth', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        {{ Form::label('new-father-name', 'Nama Ayah', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::text('new-father-name', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        {{ Form::label('new-mother-name', 'Nama Ibu', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::text('new-mother-name', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {{ Form::label('new-address', 'Alamat', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::text('new-address', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {{ Form::label('new-phone-number', 'Nomor Handphone', ["class" => "col-md-4 col-form-label font-bold text-info"]) }}
                                        <div class="col-md-8">
                                            {{ Form::text('new-phone-number', '', ['class' => 'form-control form-control-line bg-transparent']) }}
                                        </div>
                                    </div>
        
                                </div>
                                {{-- ========== NEW DATA END ========== --}}

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="abort-update" class="btn btn-danger" data-dismiss="modal">Tolak</button>
                        <button type="button" id="approve-update" class="btn btn-success" data-dismiss="modal">Setujui</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- ========== NOTIFICATION MODAL END ========== --}}



        {{-- ========== LOGIN INFO MODAL START ========== --}}
        @livewire('admin.login-info-inline')
        {{-- ========== LOGIN INFO MODAL END ========== --}}



        {{-- ========== JAVASCRIPTS ========== --}}
        <x-dashboard.javascript />
        
        @livewireScripts
        @powerGridScripts

        @stack('additional-script')

    </body>

</html>