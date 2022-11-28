<!DOCTYPE html>
<html lang="en">

<head>

    {{-- ========== ASSETS AND META COMPONENT ========== --}}
    <x-school-events.assets-and-meta />
</head>

<body>

    <div id="main-wrapper">

        {{-- ========== HEADER START ========== --}}
        <header class="topbar">
            <div class="container">
                <div class="header p-t-20">

                    {{-- ========== NAVBAR START ========== --}}
                    <nav class="navbar navbar-expand-md navbar-light rounded border-bottom">

                        {{-- ========== APPS NAME AND ICON START ========== --}}
                        <a class="navbar-brand d-flex align-items-center" href="/">
                            <img src="{{ asset("assets/images/landing-icon.png") }}" alt="logo" class="img-fluid w-2" width="60" length="60">
                            <span class="font-weight-bold ml-3">SIA - MTsN 1 Labuhanbatu </span>
                        </a>
                        {{-- ========== APPS NAME AND ICON END ========== --}}



                        {{-- ========== TOGGLER BUTTON FOR SMALL DEVICE START ========== --}}
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        {{-- ========== TOGGLER BUTTON FOR SMALL DEVICE END ========== --}}



                        {{-- ========== LOGIN BUTTON AND DROPDOWN START ========== --}}
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">
                                    <div class="dropleft show">
                                        <a class="nav-link btn dropdown-toggle m-r-15" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Opsi
                                        </a>
    
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#">E-Rapor</a>
                                            <a class="dropdown-item" href="#">Direktori</a>
                                        </div>
                                    </div>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-info text-light" href="{{ url("login") }}">Login</a>
                                </li>
                            </ul>
                        </div>
                        {{-- ========== LOGIN BUTTON AND DROPDOWN END ========== --}}

                    </nav>
                    {{-- ========== NAVBAR END ========== --}}
                </div>
            </div>
        </header>
        {{-- ========== HEADER END ========== --}}


        {{-- ========== EVENTS START ========== --}}
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="align-self-start m-t-20 m-b-20 " style="text-align:center">
                        <h3 class="font-bold">Recindy Natalia Memenangkan Lomba Makan Kerupuk</h3>
                        Oleh: Admin
                    </div>
                <div class="container align-self-start" style="text-align:justify; color:black;">
                        <div class="container m-b-30" style="text-align:center">
                            <img class="img-responsive" style="max-width: 60%" src="{{ asset("assets/images/trophies2.jpg")}}" alt="Card image cap">
                        </div>
                            <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec congue, metus vitae eleifend suscipit, enim ligula volutpat elit, a finibus dolor purus eget lectus. Etiam malesuada ut arcu tempor gravida. Ut luctus consequat eros in ornare. Vivamus vitae massa massa. Integer sed metus pretium, elementum felis at, elementum diam. Vivamus sapien justo, maximus ut leo sed, semper faucibus dui. Etiam malesuada efficitur varius. Etiam in maximus urna. Duis faucibus bibendum egestas. In lacinia laoreet mi eu sagittis. Etiam pharetra non mi id sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque erat augue, fermentum ac aliquam vitae, ultrices eu diam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                        </p>
                        <p>
                            Aliquam porta, arcu sed varius euismod, dolor mi tempus felis, ut iaculis erat neque et risus. Nullam quis nibh luctus, egestas mi euismod, cursus lorem. Curabitur ut nulla varius, ullamcorper nibh id, consectetur mi. Donec nec congue dolor. Etiam auctor eget diam eleifend ultrices. Cras hendrerit ornare diam vitae suscipit. Praesent finibus metus sed elit malesuada, nec aliquet turpis convallis. Curabitur eu lorem id tellus venenatis aliquam. Cras lectus elit, tristique vitae est vel, suscipit molestie dui. Morbi facilisis hendrerit nunc, et hendrerit urna mattis elementum.
                        </p>
                        <p>
                            In turpis ipsum, feugiat eu ante id, bibendum dapibus arcu. Aliquam molestie ante sit amet nunc dapibus venenatis. Donec vestibulum id tortor bibendum tempor. Aenean vitae porta lorem, in elementum tellus. Integer consequat est non nisi euismod, eu facilisis enim venenatis. Mauris ac lacus dignissim, faucibus velit sit amet, vulputate enim. Nulla orci arcu, interdum sed nibh eu, sodales tempus velit. Maecenas arcu dolor, iaculis at odio id, consectetur aliquet massa.
                        </p>
                        <p>
                            Sed cursus vehicula mattis. Maecenas lacinia, felis sed ultricies finibus, est lorem faucibus ligula, ac malesuada ex dui et ipsum. Nam faucibus arcu in nunc aliquam posuere. Curabitur quis pellentesque metus. Aenean eu ipsum tortor. Aenean eget hendrerit purus. Etiam ut dui et enim venenatis dictum. Cras sed tortor et magna venenatis volutpat. Proin vel erat dolor. Etiam sed vehicula dui, in bibendum est. Proin semper dapibus fermentum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut condimentum semper magna, at malesuada nunc facilisis eget. Vivamus sed vehicula magna.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- ========== EVENTS END ========== --}}



        {{-- ========== FOOTER START ========== --}}
        <x-school-events.footer/>
        {{-- ========== FOOTER END ========== --}}

    </div>



    {{-- ========== JAVASCRIPTS ========== --}}
    <x-landing-page.javascript />

</body>



</html>