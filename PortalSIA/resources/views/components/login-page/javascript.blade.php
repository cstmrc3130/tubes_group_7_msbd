<script src="{{ asset("assets/libs/jquery/dist/jquery.min.js") }}"></script>
<script src="{{ asset("assets/libs/popper.js/dist/umd/popper.min.js") }}"></script>
<script src="{{ asset("assets/libs/bootstrap/dist/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("assets/libs/owl.carousel/dist/owl.carousel.min.js") }}"></script>
<script src="{{ asset("assets/js/custom.js") }}"></script>
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $(".preloader").fadeOut();
</script>