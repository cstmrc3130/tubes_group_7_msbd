<!DOCTYPE html>
<html dir="ltr">

<head>

    {{-- ========== ASSETS AND META COMPONENT ========== --}}
    <x-login-page.assets-and-meta />

    <style>
        body {
            background: linear-gradient(45deg, #f6f8f9, #abdef9, #7fe1e6, #558dd1);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>

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
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
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