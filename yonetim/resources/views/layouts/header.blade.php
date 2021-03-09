<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>İş Takip Programı</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/datatables-responsive/css/responsive.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">


    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/select2/css/select2.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/admin_lte/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Date picker -->
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/datepicker/datepicker.css')}}">
    <!-- Date Time picker -->
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/summernote/summernote-bs4.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/fullcalendar/main.min.css')}}">

    <!-- main -->
    <link rel="stylesheet" href="{{asset('public/css/main.css')}}">

    {{--    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/fullcalendar-interaction/main.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/fullcalendar-daygrid/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/fullcalendar-timegrid/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin_lte/plugins/fullcalendar-bootstrap/main.min.css')}}">
    @toastr_css
    <style>
        .fc-title{
        color:white;
        }

    </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">


<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-secondary">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('home')}}" class="nav-link">Anasayfa</a>
            </li>

        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Bildirim Menu -->
            <li class="nav-item dropdown" onclick="bildirimoku()">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell" style="font-size: 40px;"></i>
                    <span class="badge badge-warning navbar-badge" style="font-size: 25px;">{{$bildirim->where('okundu', 0) ->count()}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    @foreach($bildirim->take(5) as $key=>$value)
                    <a href="{{route('gorev.detay',$value->gorev_id)}}" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">

                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    {{App\BildirimTur::find($value['bildirim_turu'])->name}}
                                    <span class="float-right text-sm @if($value->okundu==0) text-warning @else text-muted @endif"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">{{$value->gorev_name}}</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{$value->created_at}}</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    @endforeach
                    <a href="{{route('gorev.bildirimler')}}" class="dropdown-item dropdown-footer">Son 20 Bildirimi Göster</a>
                </div>
            </li>

            <!-- Notifications Dropdown Menu -->

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <span>{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="{{route('logout')}}" class="dropdown-item dropdown-footer">ÇIKIŞ</a>
                </div>
            </li>


        </ul>
    </nav>
