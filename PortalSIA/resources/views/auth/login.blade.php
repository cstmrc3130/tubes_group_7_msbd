<!DOCTYPE html>
<html dir="ltr">

<head>

    {{-- ========== ASSETS AND META COMPONENT ========== --}}
    <x-login-page.assets-and-meta />

</head>

<body>
    <div class="main-wrapper">

        {{-- ========== PRELOADER START ========== --}}
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        {{-- ========== PRELOADER END ========== --}}


        {{-- ========== WRAPPER START ========== --}}
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{"assets/images/auth-bg.jpg"}}) no-repeat center center;">
            <div class="auth-box">

                {{-- ========== LOGIN FORM START ========== --}}
                <div id="loginform">

                    {{-- ========== LOGO START ========== --}}
                    <div class="logo">
                        <span class="db"><img src="{{ asset("assets/images/landing-icon.png") }}" alt="logo" width="60" length="60"/></span>
                        <h5 class="font-medium m-b-20">Sign In</h5>
                    </div>
                    {{-- ========== LOGO END ========== --}}



                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" id="loginform" action="index.html">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" name="NIP/NISN" class="form-control form-control-lg" placeholder="NIP/NISN" aria-label="NIP/NISN" aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <a href="javascript:void(0)" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Forgot password?</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <div class="col-xs-12">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                {{-- ========== LOGIN FORM END ========== --}}



                {{-- ========== RECOVER FORM START ========== --}}
                <div id="recoverform">
                    <div class="logo">
                        <span class="db"><img src="{{ asset("assets/images/landing-icon.png") }}" alt="logo" width="60" length="60"/></span>
                        <h5 class="font-medium m-b-20">Recover Password</h5>
                        <span>Enter your Email and instructions will be sent to you!</span>
                    </div>
                    <div class="row m-t-20">

                        <form class="col-12" action="index.html">

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control form-control-lg" type="email" required="" placeholder="Email address">
                                </div>
                            </div>

                            <div class="row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-block btn-lg btn-danger" type="submit" name="action">Reset</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                {{-- ========== RECOVER FORM END ========== --}}

            </div>
        </div>
        {{-- ========== WRAPPER END ========== --}}

    </div>



    {{-- ========== JAVASCRIPTS ========== --}}
    <x-login-page.javascript />

</body>

</html>