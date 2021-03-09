@extends('layouts.main')
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @if(session('success'))

    @elseif(session('error'))

    @endif
    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="sticky-top mb-3 d-none d-lg-block">

                            <div class="card card-primary">

                                <form action="{{route('takvim.create')}}" method="post" autocomplete="off">
                                    {{csrf_field()}}
                                    <div class="card-header">
                                        <h3 class="card-title">Yeni Program Ekle</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="text" id="event_id" name="title"
                                                   placeholder="Başlık Giriniz..." required class="form-control">
                                            <input type="hidden" name="color" value="#1fc8e3" id="color">
                                        </div>
                                        <div class="form-group">
                                            <label>Renk Seçiniz</label>
                                            <ul class="fc-color-picker" id="color-chooser">
                                                <li><a style="color: #1fc8e3" href="#"><i class="fas fa-square"></i></a>
                                                </li>
                                                <li><a style="color: #ecff0a" href="#"><i class="fas fa-square"></i></a>
                                                </li>
                                                <li><a style="color: #8eff42" href="#"><i class="fas fa-square"></i></a>
                                                </li>
                                                <li><a style="color: #ff2754" href="#"><i class="fas fa-square"></i></a>
                                                </li>
                                                <li><a style="color: #c6bbc5" href="#"><i class="fas fa-square"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <br>


                                        <div class="form-group">
                                            <label>Başlangıç Zamanı</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>
                                                <input type="text" class="form-control float-right takvim_tarih"
                                                       name="start" id="bas_zamani">
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>Bitiş Zamanı</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>
                                                <input type="text" class="form-control float-right takvim_tarih"
                                                       name="end" id="bit_zamani">
                                            </div>
                                            <!-- /.input group -->
                                        </div>


                                    </div>
                                    <div class="card-footer pull-right">
                                        <input type="submit" class="btn btn-success px-5 float-right" value="Kaydet">
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="sticky-bottom mb-3">
                            <div class="card">
                                <div class="card-header">Kullanıcılar</div>
                                <div class="card-body">
                                    <!-- the events -->
                                    <div id="external-events">
                                        @foreach($user as $key => $value)
                                            <div style="cursor: default; background-color:{{$value->renk}} !important;" class="external-event text-white">{{$value->name}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card card-primary">
                            <div class="card-body p-0">
                                <!-- THE CALENDAR -->
                                <div id="calendar2" class="fc fc-ltr fc-unthemed" style=""></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>




@endsection

@push('scripts')
    <script>


        $(function () {


            // takvim full calendar

            $('.takvim_tarih').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                timePicker24Hour: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'YYYY-MM-DD H:mm',
                    language: 'tr'
                }
            });

            var date = new Date();
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();

            var Calendar = FullCalendar.Calendar;

            var calendarEl = document.getElementById('calendar2');

            // initialize the external events
            // -----------------------------------------------------------------

            var calendar = new Calendar(calendarEl, {

                plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                locale: 'tr',
                //Random default events
                eventSources: [{
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('takvim.events') }}',
                    type: 'GET',
                    dataType: 'json',
                    error: function () {
                        alert('there was an error while fetching events!');
                    },
                    success: function (reply) {
                        console.log(reply.first);
                    },
                }],

                eventOrder:'Color',

                {{--eventClick: function (info) {--}}
                {{--    var deleteMsg = confirm("Programı Silinecek, Emin misiniz?");--}}
                {{--    if (deleteMsg) {--}}
                {{--        var eventid = info.event.id;--}}
                {{--        $.ajaxSetup({--}}
                {{--            headers: {--}}
                {{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                {{--            }--}}
                {{--        });--}}
                {{--        $.ajax({--}}
                {{--            url: '{{url('/')}}' + '/takvim/delete/' + eventid,--}}
                {{--            type: "post",--}}
                {{--            success: function (response) {--}}
                {{--                if (parseInt(response) > 0) {--}}
                {{--                    window.location.href = '{{url('/')}}' + '/takvim/';--}}
                {{--                }--}}
                {{--            }--}}
                {{--        });--}}
                {{--    }--}}
                {{--}--}}

            });

            calendar.render();


            var currColor = '#6e9bbc' //Red by default
            //Color chooser button
            var colorChooser = $('#color-chooser-btn')
            $('#color-chooser > li > a').click(function (e) {
                e.preventDefault()
                //Save color
                currColor = $(this).css('color')
                //Add color effect to button
                $('#event_id').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
                $('#color').val(currColor);
            });

        });
    </script>
@endpush
