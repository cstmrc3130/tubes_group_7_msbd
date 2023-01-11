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
<script src="{{ asset("assets/libs/sweetalert2/dist/sweetalert2.all.min.js") }}"></script>
<script src="{{ asset("assets/libs/sweetalert2/sweet-alert.init.js") }}"></script>
<script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>



{{-- APPROVE AND ABORT STUDENT PROFILE INFO --}}
<script>
    $(function ()
    {
        window.addEventListener('configure-modal', event =>
        {
            notificationID = event.detail.notificationID 

            $('#studentProfileInfoModal').find('#old-name').val(event.detail.oldName)
            $('#studentProfileInfoModal').find('#old-place-of-birth').val(event.detail.oldPlaceOfBirth)
            $('#studentProfileInfoModal').find('#old-date-of-birth').val(event.detail.oldDateOfBirth)
            $('#studentProfileInfoModal').find('#old-father-name').val(event.detail.oldFatherName)
            $('#studentProfileInfoModal').find('#old-mother-name').val(event.detail.oldMotherName)
            $('#studentProfileInfoModal').find('#old-address').val(event.detail.oldAddress)
            $('#studentProfileInfoModal').find('#old-phone-number').val(event.detail.oldPhoneNumber)

            $('#studentProfileInfoModal').find('#new-name').val(event.detail.newName)
            $('#studentProfileInfoModal').find('#new-place-of-birth').val(event.detail.newPlaceOfBirth)
            $('#studentProfileInfoModal').find('#new-date-of-birth').val(event.detail.newDateOfBirth)
            $('#studentProfileInfoModal').find('#new-father-name').val(event.detail.newFatherName)
            $('#studentProfileInfoModal').find('#new-mother-name').val(event.detail.newMotherName)
            $('#studentProfileInfoModal').find('#new-address').val(event.detail.newAddress)
            $('#studentProfileInfoModal').find('#new-phone-number').val(event.detail.newPhoneNumber)
        })
        
        $('#studentProfileInfoModal').find('#abort-update').click(e =>
        {
            let notificationCount = parseInt($('#noti-count').html())
            
            notificationCount--;
            
            $('a').remove('#' + notificationID);
            $('div').remove('#' + notificationID);
            $('#noti-text').html(notificationCount + " New")
            
            if(notificationCount == 0)
            {
                $('#noti-count').remove();
            }
            else
            {
                $('#noti-count').text(notificationCount)
            }

            toastr.warning("Update dibatalkan dan notifikasi ditandai sudah dibaca!", 'Aborted!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });

            Livewire.emit('AbortUpdateProfileInfo', notificationID)
        })

        $('#studentProfileInfoModal').find('#approve-update').click(e =>
        {
            let notificationCount = parseInt($('#noti-count').html())

            notificationCount--;

            $("#" + notificationID).remove();
            $('#' + notificationID).remove();
            $('#noti-text').html(notificationCount + " New")

            if(notificationCount == 0)
            {
                $('#noti-count').remove();
            }
            else
            {
                $('#noti-count').text(notificationCount)
            }

            toastr.success("Update disetujui dan notifikasi ditandai sudah dibaca!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            
            Livewire.emit('ApproveUpdateProfileInfo', notificationID)
        })
    })
</script>



{{-- APPROVE AND ABORT STUDENT ABSENT --}}
<script>
    $(function ()
    {
        window.addEventListener('configure-absent-modal', event =>
        {
            notificationID = event.detail.notificationID
            absentID = event.detail.absentID

            $('#studentAbsentModal').find('#date').val(event.detail.oldDate)
            $('#studentAbsentModal').find('#name').val(event.detail.studentName)
            
            if(event.detail.description == "S")
            {
                $('#studentAbsentModal option[value=S]').attr('selected','selected');
            }
            else if(event.detail.description == "I")
            {
                $('#studentAbsentModal option[value=I]').attr('selected','selected');
            }
            else
            {
                $('#studentAbsentModal option[value=A]').attr('selected','selected');
            }
        })

        $('#studentAbsentModal').find('#abort-update').click(e =>
        {
            let notificationCount = parseInt($('#noti-count').html())
            
            notificationCount--;
            
            $('a').remove('#' + notificationID);
            $('div').remove('#' + notificationID);
            $('#noti-text').html(notificationCount + " New")
            
            if(notificationCount == 0)
            {
                $('#noti-count').remove();
            }
            else
            {
                $('#noti-count').text(notificationCount)
            }

            toastr.warning("Update dibatalkan dan notifikasi ditandai sudah dibaca!", 'Aborted!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });

            Livewire.emit('AbortUpdateAbsent', notificationID, absentID)
        })

        $('#studentAbsentModal').find('#approve-update').click(e =>
        {
            let notificationCount = parseInt($('#noti-count').html())

            notificationCount--;

            $("#" + notificationID).remove();
            $('#' + notificationID).remove();
            $('#noti-text').html(notificationCount + " New")

            if(notificationCount == 0)
            {
                $('#noti-count').remove();
            }
            else
            {
                $('#noti-count').text(notificationCount)
            }

            date = $('#studentAbsentModal').find('#date').val();
            description = $('#studentAbsentModal').find(':selected').val()

            toastr.success("Update disetujui dan notifikasi ditandai sudah dibaca!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            
            Livewire.emit('ApproveUpdateAbsent', notificationID, absentID, date, description)
        })
    })
</script>



{{-- UPDATE ADMIN LOGIN INFO  --}}
<script>
    $(function ()
    {
        // USING serializeArray()
        // $('#save').click(e =>
        // {
        //     let loginInfoData = $('#login-info-form').serializeArray();

        //     Livewire.emit('UpdateLoginInfo', loginInfoData)
        // })

        window.addEventListener('update-success', e =>
        {
            toastr.success("Informasi login berhasil di-update!", 'Success!', {"showMethod": "slideDown", "closeButton": true, 'progressBar': true });
            
            $(':input').not(':button, :submit, :reset, :hidden').removeAttr('checked').removeAttr('selected').not(':checkbox, :radio, select').val('');
            
            $("#loginInfoModal").find("[data-dismiss=modal]").trigger({ type: "click" })
        })
    })
</script>

