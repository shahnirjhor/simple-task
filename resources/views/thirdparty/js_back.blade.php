<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('plugins/alertifyjs/alertify.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>

<script>
    function selectChange(val) {
        $('#myForm').submit();
    }
</script>

<script>
    $(document).ready(function(){
        $(window).scrollTop(0);

        $(".flatpickr").flatpickr({
            enableTime: false
        });

        $(".flatpickr-pick-time").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });

        $(".flatpickr-date-time").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        $(".today-flatpickr").flatpickr({
            enableTime: false,
            defaultDate: "today"
        });
    });
</script>

