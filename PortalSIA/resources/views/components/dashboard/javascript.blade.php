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

{{-- REMOVE 08 OR 62 IN PHONE NUMBER --}}
<script>
    $(function ()
    {
        let phoneNumber = $('#phone_numbers').val();

        phoneNumber.substring(0, 2) == '62' ? $('#phone_numbers').val(phoneNumber.substring(2, phoneNumber.length)) : ''
        phoneNumber.substring(0, 2) == '08' ? $('#phone_numbers').val(phoneNumber.substring(2, phoneNumber.length)) : ''
        
        $('#phone_numbers').bind('keyup', function (event)
        {
            phoneNumber = event.target.value;

            phoneNumber.substring(0, 2) == '62' ? $('#phone_numbers').val(phoneNumber.substring(2, phoneNumber.length)) : ''
            phoneNumber.substring(0, 2) == '08' ? $('#phone_numbers').val(phoneNumber.substring(2, phoneNumber.length)) : ''
        })
    })
</script>



{{-- STUDENT PROFILE INFO SUBMIT BUTTON --}}
<script>
    $(function ()
    {
        const previousState = $('#student-profile-form').serialize();

        $('#student-profile-form').on('input', function()
        {
            $(this).find('input:submit, button:submit').prop('disabled', previousState == $(this).serialize());
        }).find('input:submit, button:submit').prop('disabled', true);

        window.addEventListener('toggle-submit-button', event =>
        {
            $('#student-profile-form').find('input:submit, button:submit').prop('disabled', previousState == $('#student-profile-form').serialize());

            $('#student-profile-form').submit(function (event) {
                if (previousState == $(this).serialize())
                {
                    event.preventDefault();
                }
            });
        })
    })
</script>



{{-- STUDENT LOGIN INFO UPDATE TOAST --}}
<script>
    $(function()
    {
        window.addEventListener('login-info-update-result', event =>
        {
            if (event.detail.response == 'success')
            {
                toastr.success('Informasi login berhasil di-update!', 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            }
            else
            {
                toastr.error('Harap tunggu 5 menit sebelum melakukan update!', 'Failure!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            }

            $('#student-login-form').find("input[type='password']").val('');
        })
    })
</script>



{{-- PERSIST BOOTSTRAP TAB UPON RELOAD --}}
<script>
    $(function()
    {
        window.addEventListener('persisting-last-tab', event => {
            $('#pills-timeline-tab').toggleClass('active');
            $('#pills-setting-tab').toggleClass('active show');

            $('#student-profile-info').toggleClass('show active');
            $('#'+event.detail['tab-ID']).toggleClass('show active');
            $('#'+event.detail['tab-ID']).tab('show');
        })
        
        $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
            localStorage.setItem('tab-used', $(this).attr('href'));
        });

        var lastTab = localStorage.getItem('tab-used');
        
        if (lastTab) {
            $('[href="' + lastTab + '"]').tab('show');
        }
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
            toastr.success('Foto profil berhasil di-update!', 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
        },
        onError:function(message, element, status){
            toastr.error('Foto profil gagal di-update!', 'Failure!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
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
                    Livewire.emit('StudentIntendedToUpdate');
                } else {     
                    swal("Gagal", "Perbaruan profil dibatalkan!", "error");   
                } 
            });
    });

    // CONVERT STRING INTO TITLE CASE
    function ToTitleCase(str) {
        return str.replace(
            /\w\S*/g,
            function(txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            }
        );
    }

    window.addEventListener('send-notification-to-admin', event => {
        toastr.success('Profilmu akan segera diperbarui apabila admin menyetujuinya!', "" + ToTitleCase(event.detail.response) + "", {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
    })
</script>




