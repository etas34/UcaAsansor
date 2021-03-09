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
                <!-- Small boxes (Stat box) -->


                <div class="row">

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="ion ion-cash"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Cari Toplam Borç Bakiye</span>
                                <h2><span class="info-box-number">{{$toplamBorcBakiye}} ₺</span></h2>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="ion ion-cash"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Cari Toplam Alacak Bakiye</span>
                                <h2><span class="info-box-number">{{$toplamAlacakBakiye}} ₺</span></h2>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Bu Ay Kesilen Toplam Fatura Tutarı</span>
                                <h3><span class="info-box-number">{{($faturaTop)}} ₺</span></h3>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Bu Ay Yapılan Toplam Tahsilat</span>
                                <h3><span class="info-box-number">{{$topTahsilat}} ₺</span></h3>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>


                <div class="row">
                    <div class="col-lg-3 col-6">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b>Cari İşlemler</b></h3>

                                <div class="card-tools">
                                    {{--                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
                                    {{--                                        <i class="fas fa-minus"></i>--}}
                                    {{--                                    </button>--}}
                                    {{--                                    <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
                                    {{--                                        <i class="fas fa-times"></i>--}}
                                    {{--                                    </button>--}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <li class="item">
                                        <a href="{{route('muhasebe.cari.index')}}">

                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fa fa-list"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">&nbsp;</span>
                                                    <span class="info-box-number">Cari Listesi</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>

                                            {{--                                            <div class="card bg-info">--}}
                                            {{--                                                <div class="card-header text-center">--}}
                                            {{--                                                    <h4 class="card-title text-bold" style="float: none;">CARİ</h4>--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <div class="card-body">--}}
                                            {{--                                                    Cari Listesi--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <!-- /.card-body -->--}}
                                            {{--                                            </div>--}}
                                        </a>
                                        <a href="{{route('muhasebe.cari.cariasansor')}}">

                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fa fa-credit-card"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">&nbsp;</span>
                                                    <span class="info-box-number">Cari Asansör Eşleştir</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <a href="{{route('muhasebe.cariharaket.tumgecmis')}}">
                                                <div class="info-box mb-3 bg-info">
                                                    <span class="info-box-icon">  <i class="fas fa-history"></i></span>

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">&nbsp;</span>
                                                        <span class="info-box-number">Tüm Haraketler</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>

                                                {{--                                                                            <div class="small-box bg-success">--}}
                                                {{--                                                                                <div class="inner">--}}
                                                {{--                                                                                    <h4></h4>--}}

                                                {{--                                                                                    <p>r</p>--}}
                                                {{--                                                                                </div>--}}
                                                {{--                                                                                <div class="icon">--}}
                                                {{--                                                                                    <i class="fas fa-coins"></i>--}}
                                                {{--                                                                                </div>--}}

                                                {{--                                                                            </div>--}}
                                            </a>
                                            {{--                                            <div class="card bg-info">--}}
                                            {{--                                                <div class="card-header text-center">--}}
                                            {{--                                                    <h4 class="card-title text-bold" style="float: none;">CARİ</h4>--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <div class="card-body">--}}
                                            {{--                                                    Cari Listesi--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <!-- /.card-body -->--}}
                                            {{--                                            </div>--}}
                                        </a>
                                    </li>
                                    <!-- /.item -->
                                {{--                                    <li class="item"></li>--}}
                                {{--                                    <!-- /.item -->--}}
                                {{--                                    <li class="item">-</li>--}}
                                {{--                                    <!-- /.item -->--}}
                                {{--                                    <li class="item">-</li>--}}
                                <!-- /.item -->
                                </ul>
                            </div>
                            {{--                            <!-- /.card-body -->--}}
                            {{--                            <div class="card-footer text-center">--}}
                            {{--                                <a href="javascript:void(0)" class="uppercase">View All Products</a>--}}
                            {{--                            </div>--}}
                            {{--                            <!-- /.card-footer -->--}}
                        </div>

                        {{--                        <a class="small-box " href="{{route('muhasebe.cari.index')}}">--}}
                        {{--                            <div class="card bg-info">--}}
                        {{--                                <div class="card-header text-center">--}}
                        {{--                                    <h4 class="card-title text-bold" style="float: none;">CARİ</h4>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="card-body">--}}
                        {{--                                    Cari Listesi--}}
                        {{--                                </div>--}}
                        {{--                                <!-- /.card-body -->--}}
                        {{--                            </div>--}}
                        {{--                        </a>--}}
                        {{--                        <a href="{{route('muhasebe.cari.create')}}">--}}
                        {{--                            <div class="small-box bg-info">--}}
                        {{--                                <div class="inner">--}}
                        {{--                                    <h4>Cari Hesap</h4>--}}

                        {{--                                    <p>Ekle</p>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="icon">--}}
                        {{--                                    <i class="ion ion-android-add"></i>--}}
                        {{--                                </div>--}}

                        {{--                            </div>--}}
                        {{--                        </a>--}}


                        {{--                        <div class="info-box bg-info">--}}
                        {{--                            <span class="info-box-icon"><i class="ion-cash"></i></span>--}}

                        {{--                            <div class="info-box-content">--}}
                        {{--                                <span class="info-box-text">Toplam Borç Bakiyesi</span>--}}
                        {{--                                <span class="info-box-number">{{163,921}}</span>--}}

                        {{--                                <div class="progress">--}}
                        {{--                                    <div class="progress-bar" style="width: 40%"></div>--}}
                        {{--                                </div>--}}
                        {{--                                <span class="progress-description">--}}
                        {{--                                    40% Increase in 30 Days--}}
                        {{--                                  </span>--}}
                        {{--                            </div>--}}
                        {{--                            <!-- /.info-box-content -->--}}
                        {{--                        </div>--}}



                        {{--                            <a class="small-box " href="{{route('muhasebe.cari.create')}}">--}}
                        {{--                                <div class="card bg-info">--}}
                        {{--                           --}}
                        {{--                                    <div class="card-body">--}}
                        {{--                                        Cari Hesap Ekle--}}
                        {{--                                    </div>--}}
                        {{--                                    <!-- /.card-body -->--}}
                        {{--                                </div>--}}
                        {{--                            </a>--}}

                        {{--                                                 <a class="small-box " href="{{route('muhasebe.cariharaket.index')}}">--}}
                        {{--                                                    <div class="card bg-info">--}}
                        {{--                                                        <div class="card-header">--}}
                        {{--                                                            <h4 class="card-title text-bold">Tahsilat / Ödeme Geçmişi </h4>--}}
                        {{--                                                        </div>--}}
                        {{--                                                        <div class="card-body">--}}
                        {{--                                                           Geçmiş--}}
                        {{--                                                        </div>--}}

                        {{--                                                    </div>--}}
                        {{--                                                </a>--}}

                    </div>

                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <!-- small box -->


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b>Sözleşme İşlemleri</b></h3>

                                <div class="card-tools">
                                    {{--                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
                                    {{--                                        <i class="fas fa-minus"></i>--}}
                                    {{--                                    </button>--}}
                                    {{--                                    <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
                                    {{--                                        <i class="fas fa-times"></i>--}}
                                    {{--                                    </button>--}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <li class="item">


                                        <a class="small-box " href="{{route('muhasebe.cariharaket.index')}}">


                                            <div class="info-box mb-3 bg-success">
                                                <span class="info-box-icon"><i class="fas fa-file"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">&nbsp;</span>
                                                    <span class="info-box-number">Sözleşme Yap</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>

                                            <a class="small-box " href="{{route('muhasebe.cariharaket.tarihGecmis')}}">


                                                <div class="info-box mb-3 bg-success">
                                                    <span class="info-box-icon"><i class="fas fa-file"></i></span>

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Sözleşme Tarihi Geçen Yada Olmayanlar</span>
                                                        <span class="info-box-number"><h4> {{\App\Cari::where('durum',1)->
                                                                                           where(function($query){
                                                                                               $query->where('sozlesme_tarih',null)
                                                                                                   ->orWhereRaw(" NOW() > sozlesme_tarih ");
                                                                                           })->count()}}</h4></span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>


                                                {{--                                            <div class="card bg-success">--}}
                                                {{--                                                <div class="card-header text-center">--}}
                                                {{--                                                    <h4 class="card-title text-bold" style="float: none;"></h4>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="card-body">--}}

                                                {{--                                                </div>--}}
                                                {{--                                                <!-- /.card-body -->--}}
                                                {{--                                            </div>--}}
                                            </a>
                                        </a>
                                        {{--                                        <a href="{{route('muhasebe.cariharaket.tumgecmis')}}">--}}
                                        {{--                                            <div class="info-box mb-3 bg-success">--}}
                                        {{--                                                <span class="info-box-icon">  <i class="fas fa-history"></i></span>--}}

                                        {{--                                                <div class="info-box-content">--}}
                                        {{--                                                    <span class="info-box-text">&nbsp;</span>--}}
                                        {{--                                                    <span class="info-box-number">Tüm Haraketler</span>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <!-- /.info-box-content -->--}}
                                        {{--                                            </div>--}}

                                        {{--                                            --}}{{--                                                                            <div class="small-box bg-success">--}}
                                        {{--                                            --}}{{--                                                                                <div class="inner">--}}
                                        {{--                                            --}}{{--                                                                                    <h4></h4>--}}

                                        {{--                                            --}}{{--                                                                                    <p>r</p>--}}
                                        {{--                                            --}}{{--                                                                                </div>--}}
                                        {{--                                            --}}{{--                                                                                <div class="icon">--}}
                                        {{--                                            --}}{{--                                                                                    <i class="fas fa-coins"></i>--}}
                                        {{--                                            --}}{{--                                                                                </div>--}}

                                        {{--                                            --}}{{--                                                                            </div>--}}
                                        {{--                                        </a>--}}
                                    </li>
                                    <!-- /.item -->
                                {{--                                                                    <li class="item">--}}



                                {{--                                                                    </li>--}}
                                {{--                                    <!-- /.item -->--}}
                                {{--                                    <li class="item">-</li>--}}
                                {{--                                    <!-- /.item -->--}}
                                {{--                                    <li class="item">-</li>--}}
                                <!-- /.item -->
                                </ul>
                            </div>
                            {{--                            <!-- /.card-body -->--}}
                            {{--                            <div class="card-footer text-center">--}}
                            {{--                           <a href="javascript:void(0)" class="uppercase">View All Products</a>--}}
                            {{--                            </div>--}}
                            {{--                            <!-- /.card-footer -->--}}
                        </div>


                        <!-- small box -->

                        {{--                        <div class="info-box bg-green">--}}
                        {{--                            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>--}}

                        {{--                            <div class="info-box-content">--}}
                        {{--                                <span class="info-box-text">Mentions</span>--}}
                        {{--                                <span class="info-box-number">92,050</span>--}}

                        {{--                                <div class="progress">--}}
                        {{--                                    <div class="progress-bar" style="width: 20%"></div>--}}
                        {{--                                </div>--}}
                        {{--                                <span class="progress-description">--}}
                        {{--                                                        20% Increase in 30 Days--}}
                        {{--                                                          </span>--}}
                        {{--                            </div>--}}
                        {{--                            <!-- /.info-box-content -->--}}
                        {{--                        </div>--}}

                        {{--                            <!-- small box -->--}}
                        {{--                            <a href="">--}}
                        {{--                                <div class="small-box bg-success">--}}
                        {{--                                    <div class="inner">--}}
                        {{--                                        <h3>()}}</h3>--}}

                        {{--                                        <p>Bugün Bakım Yapılanlar</p>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="icon">--}}
                        {{--                                        <i class="ion ion-medkit"></i>--}}
                        {{--                                    </div>--}}

                        {{--                                </div>--}}
                        {{--                            </a>--}}

                        {{--                            <!-- small box -->--}}
                        {{--                            <a href="bakim.bakimlar',1)}}">--}}
                        {{--                                <div class="small-box bg-success">--}}
                        {{--                                    <div class="inner">--}}
                        {{--                                        <h3> </h3>--}}

                        {{--                                        <p>Bu Ay Bakım Yapılanlar</p>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="icon">--}}
                        {{--                                        <i class="ion ion-medkit"></i>--}}
                        {{--                                    </div>--}}

                        {{--                                </div>--}}
                        {{--                            </a>--}}


                    </div>


                    <div class="col-lg-6 col-12">


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b>Fatura İşlemleri</b></h3>

                                <div class="card-tools">
                                    {{--                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
                                    {{--                                        <i class="fas fa-minus"></i>--}}
                                    {{--                                    </button>--}}
                                    {{--                                    <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
                                    {{--                                        <i class="fas fa-times"></i>--}}
                                    {{--                                    </button>--}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0 ">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <li class="item row">

                                        <a class="col-md-6" href="{{route('muhasebe.fatura.index')}}">
                                            <div class="info-box mb-3 bg-warning">
                                                <span class="info-box-icon">  <i class="fas fa-file-invoice-dollar"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Fatura</span>
                                                    <span class="info-box-number">Fatura Kes</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>

                                            {{--                                                                            <div class="small-box bg-success">--}}
                                            {{--                                                                                <div class="inner">--}}
                                            {{--                                                                                    <h4></h4>--}}

                                            {{--                                                                                    <p>r</p>--}}
                                            {{--                                                                                </div>--}}
                                            {{--                                                                                <div class="icon">--}}
                                            {{--                                                                                    <i class="fas fa-coins"></i>--}}
                                            {{--                                                                                </div>--}}

                                            {{--                                                                            </div>--}}
                                        </a>

                                        <a class="col-md-6" href="{{route('muhasebe.fatura.tumgecmis')}}">
                                            <div class="info-box mb-3 bg-warning">
                                                <span class="info-box-icon">  <i class="fas fa-history"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Faturalar</span>
                                                    <span class="info-box-number">Geçmiş Faturalar</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>

                                            {{--                                                                            <div class="small-box bg-success">--}}
                                            {{--                                                                                <div class="inner">--}}
                                            {{--                                                                                    <h4></h4>--}}

                                            {{--                                                                                    <p>r</p>--}}
                                            {{--                                                                                </div>--}}
                                            {{--                                                                                <div class="icon">--}}
                                            {{--                                                                                    <i class="fas fa-coins"></i>--}}
                                            {{--                                                                                </div>--}}

                                            {{--                                                                            </div>--}}
                                        </a>

                                        <a class="col-md-6" href="{{route('muhasebe.fatura.faturabakim')}}">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i
                                                        class="fas fa-file-invoice"></i></span>

                                                <div class="info-box-content">
                                                    <span style="color: black" class="info-box-text">Faturası Kesilmeyen Bakımlar</span>
                                                    <h3><span style="color: black"
                                                              class="info-box-number">{{$bakimlar}}</span></h3>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->

                                            {{--                                            <div class="info-box mb-3 bg-warning">--}}
                                            {{--                                                <span class="info-box-icon">  <i class="fas fa-cog"></i></span>--}}

                                            {{--                                                <div class="info-box-content">--}}
                                            {{--                                                    <span class="info-box-text">Faturalar</span>--}}
                                            {{--                                                    <span class="info-box-number">Faturası Kesilmeyen Bakımlar</span>--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <!-- /.info-box-content -->--}}
                                            {{--                                            </div>--}}

                                            {{--                                                                            <div class="small-box bg-success">--}}
                                            {{--                                                                                <div class="inner">--}}
                                            {{--                                                                                    <h4></h4>--}}

                                            {{--                                                                                    <p>r</p>--}}
                                            {{--                                                                                </div>--}}
                                            {{--                                                                                <div class="icon">--}}
                                            {{--                                                                                    <i class="fas fa-coins"></i>--}}
                                            {{--                                                                                </div>--}}

                                            {{--                                                                            </div>--}}
                                        </a>

                                        <a class="col-md-6" href="{{route('muhasebe.fatura.faturaParca')}}">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i
                                                        class="fas fa-th-list"></i></span>

                                                <div class="info-box-content">
                                                    <span style="color: black">Faturası Kesilmeyen Parçalar</span>
                                                    <h3><span style="color: black"
                                                              class="info-box-number">{{$parcalar}}</span></h3>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>

                                            {{--                                                                            <div class="small-box bg-success">--}}
                                            {{--                                                                                <div class="inner">--}}
                                            {{--                                                                                    <h4></h4>--}}

                                            {{--                                                                                    <p>r</p>--}}
                                            {{--                                                                                </div>--}}
                                            {{--                                                                                <div class="icon">--}}
                                            {{--                                                                                    <i class="fas fa-coins"></i>--}}
                                            {{--                                                                                </div>--}}

                                            {{--                                                                            </div>--}}
                                        </a>


                                    {{--                                        <a class="small-box " href="{{route('muhasebe.fatura.index')}}">--}}
                                    {{--                                            <div class="card bg-warning">--}}
                                    {{--                                                <div class="card-header text-center">--}}
                                    {{--                                                    <h4 class="card-title text-bold" style="float: none;">Fatura</h4>--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <div class="card-body">--}}
                                    {{--                                                    Fatura Kes--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <!-- /.card-body -->--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <!-- /.item -->--}}



                                    {{--                                                                    <li class="item">--}}

                                    {{--                                                                        <a href="{{route('muhasebe.fatura.tumgecmis')}}">--}}
                                    {{--                                                                            <div class="small-box bg-warning">--}}
                                    {{--                                                                                <div class="inner">--}}
                                    {{--                                                                                    <h4>Faturalar</h4>--}}

                                    {{--                                                                                    <p>Geçmiş Faturalar</p>--}}
                                    {{--                                                                                </div>--}}
                                    {{--                                                                                <div class="icon">--}}
                                    {{--                                                                                    <i class="ion ion-document-text"></i>--}}
                                    {{--                                                                                </div>--}}
                                    {{--                                                                            </div>--}}
                                    {{--                                                                        </a>--}}


                                    {{--                                                                    </li>--}}
                                    {{--                                    <!-- /.item -->--}}
                                    {{--                                    <li class="item">-</li>--}}
                                    {{--                                    <!-- /.item -->--}}
                                    {{--                                    <li class="item">-</li>--}}
                                    <!-- /.item -->
                                </ul>
                            </div>
                            {{--                            <!-- /.card-body -->--}}
                            {{--                            <div class="card-footer text-center">--}}
                            {{--                                <a href="javascript:void(0)" class="uppercase">View All Products</a>--}}
                            {{--                            </div>--}}
                            {{--                            <!-- /.card-footer -->--}}
                        </div>


                        <!-- small box -->


                    {{--                        <!-- Info Boxes Style 2 -->--}}
                    {{--                        <div class="info-box bg-yellow">--}}
                    {{--                            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>--}}

                    {{--                            <div class="info-box-content">--}}
                    {{--                                <span class="info-box-text">Inventory</span>--}}
                    {{--                                <span class="info-box-number">5,200</span>--}}

                    {{--                                <div class="progress">--}}
                    {{--                                    <div class="progress-bar" style="width: 50%"></div>--}}
                    {{--                                </div>--}}
                    {{--                                <span class="progress-description">--}}
                    {{--                                50% Increase in 30 Days--}}
                    {{--                              </span>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.info-box-content -->--}}
                    {{--                        </div>--}}

                    <!-- small box -->


                        {{--                            <a href="revizyon.teklifGecmis')}}">--}}
                        {{--                                <div class="small-box bg-warning">--}}
                        {{--                                    <div class="inner">--}}
                        {{--                                        <h3>()}}</h3>--}}

                        {{--                                        <p>Geçmiş Teklifler</p>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="icon">--}}
                        {{--                                        <i class="ion ion-ios-refresh"></i>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </a>--}}

                        {{--                            <a href="revizyon.revizyonGereken')}}">--}}
                        {{--                                <div class="small-box bg-warning">--}}
                        {{--                                    <div class="inner">--}}
                        {{--                                        <h3>()}}</h3>--}}

                        {{--                                        <p>Revizyon Yapılacak Asansörler</p>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="icon">--}}
                        {{--                                        <i class="ion ion-ios-refresh"></i>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </a>--}}

                        {{--                            <a href="revizyon.revizyonGecmis')}}">--}}
                        {{--                                <div class="small-box bg-warning">--}}
                        {{--                                    <div class="inner">--}}
                        {{--                                        <h3>()}}</h3>--}}

                        {{--                                        <p>Revizyon Yapılan Asansörler</p>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="icon">--}}
                        {{--                                        <i class="ion ion-ios-refresh"></i>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </a>--}}
                    </div>
                {{--                    @endif--}}
                <!-- ./col -->
                {{--                    @if(in_array(2,explode(",",Auth::user()->yetki)))--}}
                {{--                    <div class="col-lg-3 col-6">--}}

                {{--                        <!-- Info Boxes Style 2 -->--}}
                {{--                        <div class="info-box bg-yellow">--}}
                {{--                            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>--}}

                {{--                            <div class="info-box-content">--}}
                {{--                                <span class="info-box-text">Inventory</span>--}}
                {{--                                <span class="info-box-number">5,200</span>--}}

                {{--                                <div class="progress">--}}
                {{--                                    <div class="progress-bar" style="width: 50%"></div>--}}
                {{--                                </div>--}}
                {{--                                <span class="progress-description">--}}
                {{--                                50% Increase in 30 Days--}}
                {{--                              </span>--}}
                {{--                            </div>--}}
                {{--                            <!-- /.info-box-content -->--}}
                {{--                        </div>--}}
                {{--                        <!-- /.info-box -->--}}
                {{--                        <div class="info-box bg-green">--}}
                {{--                            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>--}}

                {{--                            <div class="info-box-content">--}}
                {{--                                <span class="info-box-text">Mentions</span>--}}
                {{--                                <span class="info-box-number">92,050</span>--}}

                {{--                                <div class="progress">--}}
                {{--                                    <div class="progress-bar" style="width: 20%"></div>--}}
                {{--                                </div>--}}
                {{--                                <span class="progress-description">--}}
                {{--                                                        20% Increase in 30 Days--}}
                {{--                                                          </span>--}}
                {{--                            </div>--}}
                {{--                            <!-- /.info-box-content -->--}}
                {{--                        </div>--}}
                {{--                        <!-- /.info-box -->--}}
                {{--                        <div class="info-box bg-red">--}}
                {{--                            <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>--}}

                {{--                            <div class="info-box-content">--}}
                {{--                                <span class="info-box-text">Downloads</span>--}}
                {{--                                <span class="info-box-number">114,381</span>--}}

                {{--                                <div class="progress">--}}
                {{--                                    <div class="progress-bar" style="width: 70%"></div>--}}
                {{--                                </div>--}}
                {{--                                <span class="progress-description">--}}
                {{--                                                        70% Increase in 30 Days--}}
                {{--                                              </span>--}}
                {{--                            </div>--}}
                {{--                            <!-- /.info-box-content -->--}}
                {{--                        </div>--}}
                {{--                        <!-- /.info-box -->--}}
                {{--                        <div class="info-box bg-info">--}}
                {{--                            <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>--}}

                {{--                            <div class="info-box-content">--}}
                {{--                                <span class="info-box-text">Direct Messages</span>--}}
                {{--                                <span class="info-box-number">163,921</span>--}}

                {{--                                <div class="progress">--}}
                {{--                                    <div class="progress-bar" style="width: 40%"></div>--}}
                {{--                                </div>--}}
                {{--                                <span class="progress-description">--}}
                {{--                                    40% Increase in 30 Days--}}
                {{--                                  </span>--}}
                {{--                            </div>--}}
                {{--                            <!-- /.info-box-content -->--}}
                {{--                        </div>--}}


                {{--                        <!-- small box -->--}}

                {{--                        --}}{{--                                                    <div class="small-box ">--}}
                {{--                        --}}{{--                                                        <div class="card bg-danger">--}}
                {{--                        --}}{{--                                                            <div class="card-header text-center">--}}
                {{--                        --}}{{--                                                                <h4 class="card-title text-bold" style="float: none;">Hesap</h4>--}}
                {{--                        --}}{{--                                                            </div>--}}

                {{--                        --}}{{--                                                            <div class="card-body">--}}
                {{--                        --}}{{--                                                               <h1> Kayıt Aç & Asansör Arıza Geçmişleri</h1>--}}
                {{--                        --}}{{--                                                            </div>--}}
                {{--                        --}}{{--                                                            <!-- /.card-body -->--}}
                {{--                        --}}{{--                                                        </div>--}}
                {{--                        --}}{{--                                                    </div>--}}

                {{--                        --}}{{--                                                    <div class="small-box bg-danger">--}}
                {{--                        --}}{{--                                                        <div class="inner">--}}
                {{--                        --}}{{--                                                            <h3>53<sup style="font-size: 20px">%</sup></h3>--}}

                {{--                        --}}{{--                                                            <p>Bounce Rate</p>--}}
                {{--                        --}}{{--                                                        </div>--}}
                {{--                        --}}{{--                                                        <div class="icon">--}}
                {{--                        --}}{{--                                                            <i class="ion ion-stats-bars"></i>--}}
                {{--                        --}}{{--                                                        </div>--}}
                {{--                        --}}{{--                                                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                {{--                        --}}{{--                                                    </div>--}}


                {{--                        --}}{{--                                                    <a href="')}}">--}}
                {{--                        --}}{{--                                                        <div class="small-box bg-danger">--}}
                {{--                        --}}{{--                                                            <div class="inner">--}}
                {{--                        --}}{{--                                                                <h3></h3>--}}

                {{--                        --}}{{--                                                                <p>Arıza Kaydı Açılanlar</p>--}}
                {{--                        --}}{{--                                                            </div>--}}
                {{--                        --}}{{--                                                            <div class="icon">--}}
                {{--                        --}}{{--                                                                <i class="ion ion-settings"></i>--}}
                {{--                        --}}{{--                                                            </div>--}}
                {{--                        --}}{{--                                                        </div>--}}
                {{--                        --}}{{--                                                    </a>--}}


                {{--                        --}}{{--                                                    <a href="')}}">--}}
                {{--                        --}}{{--                                                        <div class="small-box bg-danger">--}}
                {{--                        --}}{{--                                                            <div class="inner">--}}
                {{--                        --}}{{--                                                                <h3></h3>--}}

                {{--                        --}}{{--                                                                <p>Arıza Geçmişi</p>--}}
                {{--                        --}}{{--                                                            </div>--}}
                {{--                        --}}{{--                                                            <div class="icon">--}}
                {{--                        --}}{{--                                                                <i class="ion ion-settings"></i>--}}
                {{--                        --}}{{--                                                            </div>--}}
                {{--                        --}}{{--                                                        </div>--}}
                {{--                        --}}{{--                                                    </a>--}}
                {{--                    </div>--}}
                {{--                                        @endif--}}
                <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>




@endsection
{{--@push('scripts')--}}
{{--    <script>alert(true)</script>--}}
{{--@endpush--}}
