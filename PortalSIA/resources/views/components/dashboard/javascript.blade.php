<script src="{{ asset("assets/libs/jquery/dist/jquery.min.js") }}"></script>
<script src="{{ asset("assets/libs/popper.js/dist/umd/popper.min.js") }}"></script>
<script src="{{ asset("assets/libs/bootstrap/dist/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("dist/js/app.min.js") }}"></script>
<script src="{{ asset("dist/js/app.init.js") }}"></script>
<script src="{{ asset("dist/js/app-style-switcher.js") }}"></script>
<script src="{{ asset("assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js") }}"></script>
<script src="{{ asset("assets/extra-libs/sparkline/sparkline.js") }}"></script>
<script src="{{ asset("dist/js/waves.js") }}"></script>
<script src="{{ asset("dist/js/sidebarmenu.js") }}"></script>
<script src="{{ asset("dist/js/custom.min.js") }}"></script>
<script src="{{ asset("assets/libs/toastr/build/toastr.min.js") }}"></script>
<script src="{{ asset("assets/extra-libs/toastr/toastr-init.js") }}"></script>
<script src="{{ asset("assets/libs/chartist/dist/chartist.min.js") }}"></script>
<script src="{{ asset("assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js") }}"></script>
<script src="{{ asset("assets/extra-libs/c3/d3.min.js") }}"></script>
<script src="{{ asset("assets/extra-libs/c3/c3.min.js") }}"></script>
<script src="{{ asset("assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js") }}"></script>
<script src="{{ asset("assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js") }}"></script>
<script src="{{ asset("dist/js/pages/dashboards/dashboard1.js") }}"></script>

{{-- REMOVE FIRST 0 IN PHONE NUMBER --}}
<script>
    $(function ()
    {
        let phoneNumber = $('#phone_numbers').val();

        phoneNumber.substring(0, 2) == '08' ? $('#phone_numbers').val(phoneNumber.substring(1, phoneNumber.length)) : ''
        
        $('#phone_numbers').bind('keyup', function (event)
        {
            phoneNumber = event.target.value;
            phoneNumber.substring(0, 2) == '08' ? $('#phone_numbers').val(phoneNumber.substring(1, phoneNumber.length)) : ''
        })
    })
</script>


{{-- STUDENT PROFILE INFO SUBMIT BUTTON SCRIPT --}}
<script>
    $(function ()
    {
        const previousState = $('#student-profile-form').serialize();

        console.log(previousState)

        $('#student-profile-form').on('input', function()
        {
            console.log($(this).serialize())
            $(this).find('input:submit, button:submit').prop('disabled', previousState == $(this).serialize());
        }).find('input:submit, button:submit').prop('disabled', true);

        $('#student-profile-form').submit(function (event) {
            if (previousState == $(this).serialize())
            {
                event.preventDefault();
            }
        });
    })
    
    
</script>


{{-- IJABOCROPTOOL --}}
<script src="{{ asset('assets/js/ijaboCropTool.min.js') }}"></script>
<script>
    $(document).on("click", "#button_select_image", () =>
    {
        $("#select_image").click();
    })

    $("#select_image").ijaboCropTool(
    {
        preview : '.rounded-circle',
        setRatio:1,
        allowedExtensions: ['jpg', 'jpeg', 'png'],
        buttonsText:['CROP','BATAL'],
        buttonsColor:['#30bf7d','#ee5155', -15],
        processUrl:'{{ route("student.update-profile-picture") }}',
        withCSRF:['_token','{{ csrf_token() }}'],
        onSuccess:function(message){
            toastr.success('Foto profil anda berhasil di-update!', 'Sukses!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
        },
        onError:function(message, element, status){
            alert(message, status);
        }
    }); 
</script>



{{-- SWEETALERT UPDATE PROFILE --}}
<script src="{{ asset("assets/libs/sweetalert2/dist/sweetalert2.all.min.js") }}"></script>
<script src="{{ asset("assets/libs/sweetalert2/sweet-alert.init.js") }}"></script>
<script>
    $('#student-profile-form').submit(function(event){
        event.preventDefault();
        swal({   
            title: "Update Profile",   
            text: "Kamu harus menunggu konfirmasi admin agar profilmu dapat di-update!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Lanjutkan",   
            cancelButtonText: "Batalkan",   
        }).then((isConfirm) => 
            {   
                if (isConfirm && isConfirm.dismiss != 'cancel') {     
                    swal("Sukses!", "Profilmu akan segera diperbarui apabila admin menyetujuinya", "success");
                    this.submit();
                } else {     
                    swal("Gagal", "Perbaruan profil dibatalkan!", "error");   
                } 
            });
    });
</script>




