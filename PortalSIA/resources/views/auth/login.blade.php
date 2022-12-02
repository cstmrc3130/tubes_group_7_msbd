<!DOCTYPE html>
<html dir="ltr">

<head>

    {{-- ========== ASSETS AND META COMPONENT ========== --}}
    <x-login-page.assets-and-meta />

    @livewireStyles
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
            <div class="auth-box m-0">

                {{-- ========== LOGIN FORM START ========== --}}
                <div id="loginform">

                    {{-- ========== LOGO START ========== --}}
                    <div class="logo">
                        <span class="db"><img src="{{ asset("assets/images/landing-icon.png") }}" alt="logo" width="60" length="60"/></span>
                        <h5 class="font-medium m-b-20">Sign In</h5>
                    </div>
                    {{-- ========== LOGO END ========== --}}



                    {{ $slot }}
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

    @livewireScripts
</body>

</html>