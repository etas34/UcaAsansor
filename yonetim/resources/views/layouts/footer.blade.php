<footer class="main-footer">
    <strong>Copyright &copy;2019 <a href="http://cmsyazilim.net/">CMS Yazılım</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('public/admin_lte/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/admin_lte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
{{--<script src="{{asset('public/admin_lte/plugins/datatables/jquery.dataTables.js')}}"></script>--}}
{{--<script src="{{asset('public/admin_lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>--}}
{{--<script src="{{asset('https://cdn.datatables.net/rowreorder/1.2.6/js/dataTables.rowReorder.min.js')}}"></script>--}}
{{--<script src="{{asset('public/admin_lte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>--}}
{{--<script src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/turkish-string.js"></script>--}}

<script src="{{asset('public/admin_lte/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/jszip/jszip.min.js')}}"></script>


<!-- ChartJS -->
<script src="{{asset('public/admin_lte/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('public/admin_lte/plugins/sparklines/sparkline.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('public/admin_lte/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/moment/locale/tr.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('public/admin_lte/plugins/datepicker/datepicker.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/datepicker/datepicker.tr.js')}}"></script>
<!-- datetimepicker -->
<script src="{{asset('public/admin_lte/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/datetimepicker/js/locales/bootstrap-datetimepicker.tr.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script
    src="{{asset('public/admin_lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('public/admin_lte/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('public/admin_lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/admin_lte/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('public/admin_lte/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/admin_lte/dist/js/demo.js')}}"></script>
<!-- Sweet alert -->
<script src="{{asset('public/js/sweetalert/sweetalert2.all.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('public/admin_lte/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- Bootstrap Switch -->
<script src="{{asset('public/admin_lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('public/admin_lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{asset('public/admin_lte/plugins/fullcalendar/main.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/fullcalendar-daygrid/main.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/fullcalendar-timegrid/main.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/fullcalendar-interaction/main.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/fullcalendar-bootstrap/main.min.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/fullcalendar/locales/tr.js')}}"></script>
<script src="{{asset('public/admin_lte/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('public/admin_lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
@toastr_js
@toastr_render

<script>

    $('.bugun_tarih').daterangepicker({
        timePicker: true,
        singleDatePicker: true,
        timePicker24Hour: true,
        timePickerIncrement: 30,
        startDate: moment().startOf('hour'),
        locale: {
            format: 'YYYY-MM-DD',
            language: 'tr'
        }
    });

    @if(count($errors) > 0)
    @foreach($errors->all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
    @endif
    function bildirimoku() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('gorev.bildirimokundu')}}',
            type: "post",

        });
    };


    // jQuery plugin to prevent double submission of forms
    jQuery.fn.preventDoubleSubmission = function () {
        $(this).on('submit', function (e) {
            var $form = $(this);

            if ($form.data('submitted') === true) {
                // Previously submitted - don't submit again
                e.preventDefault();
            } else {
                // Mark it so that the next submit can be ignored
                $form.data('submitted', true);
            }
        });

        // Keep chainability
        return this;
    };
    $(function () {

        //input file
        bsCustomFileInput.init();

        //double click engelleme
        $('form').preventDoubleSubmission();


        $('#modal-default').on('show.bs.modal', function (e) {
            if (e.target.id === 'modal-default') {
                //get data-id attribute of the clicked element
                var Id = $(e.relatedTarget).data('id');
                var etiket = $(e.relatedTarget).data('renk');

                $('#inputid').val(Id);

                if (etiket != '') {

                    var $radios = $('input:radio[name=etiket]');
                    $radios.filter("[value=" + etiket + "]").prop('checked', true);
                }
            }

        });

        $('#modal-default2').on('show.bs.modal', function (e) {
            if (e.target.id === 'modal-default2') {
                //get data-id attribute of the clicked element
                var Id = $(e.relatedTarget).data('id');

                $('#inputid2').val(Id);

            }

        });


        $("#checkboxDanger1").change(function () {
            if (this.checked) {
                $("#ariza_not").prop('required', true);
            } else {

                $("#ariza_not").prop('required', false);
            }
        });

        $("#Radio1, #Radio2,#Radio3,#Radio4").change(function () {
            if ($("#Radio3").is(":checked")) {
                $('#sebep_id').show();
                $("#sebep_text").prop('required', true);
            } else if ($("#Radio4").is(":checked")) {
                $('#sebep_id').show();
                $("#sebep_text").prop('required', true);
            } else {

                $('#sebep_id').hide();
                $("#sebep_text").prop('required', false);
            }
        });
        $('#customFile2').change(function () {
            var fileExtension = ['pdf'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) === -1) {
                alert("Sadece PDF yükleyebilirsiniz " + fileExtension.join(', '));
                $(this).val("");
            }
        });

        $('#modalsubmit2').bind("click", function () {
            var img = $('#customFile2');
            if (img.val() === '') {
                alert("Lütfen Dosya Seçiniz");

                return false;
            }

            // if ($('#file_input').files[0].size)
        });

        var table = $('#example1').DataTable({
            "autoWidth": false,
            responsive: true,
            columnDefs: [
                {targets: "_all", className: "desktop"},
                {targets: [0, 2, 3], className: "tablet, mobile"},
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                },
            ],


            // "aaSorting": [[0,'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Turkish.json'
            }
        });
        table.on('order.dt search.dt', function () {
            table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        setTimeout(function () {
            $('div.dataTables_filter input').focus();
        }, 10);


        //ayarlar sayfası için
        $('[data-mask]').inputmask()
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
        //Date picker
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            language: 'tr'
        });


        $("#datepicker_etiket").datepicker().datepicker("setDate", new Date());


        $('#bas_zamani').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 30,
            startDate: moment().startOf('hour'),
            locale: {
                format: 'YYYY-MM-DD H:mm',
                language: 'tr'
            }
        }).on("change", function () {
            var bas_tarih = new Date($("#bas_zamani").val());
            var bit_tarih = new Date($("#bit_zamani").val());

            if (bas_tarih > bit_tarih) {
                var date = $("#bas_zamani").val();
                $("#bit_zamani").val(date);
            }
        });


        $('#bit_zamani').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 30,
            startDate: moment().startOf('hour'),
            locale: {
                format: 'YYYY-MM-DD H:mm',
                language: 'tr'
            }
        }).on("change", function () {
            var bas_tarih = new Date($("#bas_zamani").val());
            var bit_tarih = new Date($("#bit_zamani").val());

            if (bas_tarih > bit_tarih) {
                var date = $("#bas_zamani").val();
                $("#bit_zamani").val(date);
            }
        });


        $(".form-delete").on("submit", function () {
            return confirm("Kayıt Silinecek Emin misiniz?");
        });

        $(".form-genel").on("submit", function () {
            return confirm("İşlemden Emin misiniz?");
        });
        $(document).ready(function(){
            $('#kimlik_no').inputmask("999999999/99");  //static mask
        });
        // gorev edit sf sı için
        // $('.durumSelect').on('change', function () {
        //
        //     var durum_id = ($(this).attr("data-durumid"));
        //     var user_id = ($(this).attr("data-userid"));
        //     var sahip_id = ($(this).attr("data-sahipid"));
        //     if (this.value == 4 && user_id !== sahip_id) {
        //         alert("Görevi Sadece Görev Sahibi Kapatabilir !");
        //         this.value = durum_id;
        //     }
        //
        // });


        if ($('#asansor_select').length) {
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    let durum = $('#asansor_select').val();
                    let kolon = data[5]; // use data for the age column
                    // alert(kolon)
                    // alert(table)
                    return (kolon == durum || durum == '1')
                }
            );


            // Event listener to the two range filtering inputs to redraw on input
            $('#asansor_select').on('change', function () {
                table.draw();
            });
        }
        var dt = new Date();
        if ($('#ay_select').length) {
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    let durum = parseInt($('#ay_select').val());
                    let kolon = new Date(data[5]) // use data for the age column
                    return ((kolon.getFullYear() === dt.getFullYear() && kolon.getMonth() === durum ) || durum === -1)



                }
            );


            // Event listener to the two range filtering inputs to redraw on input
            $('#ay_select').on('change', function () {
                table.draw();
            });
        }


    });


</script>


@if(session('success'))
@php
    echo  "<script> Swal.fire(
              'Tebrikler!',
              '".session('success')."',
              'success'
          )
      </script>";
@endphp
@elseif(session('error'))
@php
    echo  "<script> Swal.fire(
              'Dikkat!',
              '".session('error')."',
              'error'
          )
      </script>";

@endphp
@endif
</body>
</html>
