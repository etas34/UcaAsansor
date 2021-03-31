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


                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">

                                        <a href="{{route('muhasebe.cari.index')}}">

                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fa fa-list"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">&nbsp;</span>
                                                    <span class="info-box-number">Cari Listesi</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>


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
                                        </a>
                                        <a href="{{route('muhasebe.cari.cariPersonel')}}">

                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fa fa-user"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">&nbsp;</span>
                                                    <span class="info-box-number"> Bu Ay Yapılan, Kullanıcı Tahsilatları</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                        </a>



                                    <a href="{{route('muhasebe.cariharaket.tumgecmis')}}">

                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon">  <i class="fas fa-history"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">&nbsp;</span>
                                                    <span class="info-box-number">Tüm Haraketler</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>



                                        </a>


                            </div>


                        </div>


                    </div>

                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <!-- small box -->


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b>Sözleşme İşlemleri</b></h3>

                                <div class="card-tools">


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


                                            </a>
                                        </a>


                                    </li>
                                    <!-- /.item -->


                                    <!-- /.item -->
                                </ul>
                            </div>


                        </div>


                        <!-- small box -->


                    </div>


                    <div class="col-lg-6 col-12">


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b>Fatura İşlemleri</b></h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">

                                <div class="row">


                                    <div class="col-md-6">


                                        <a href="{{route('muhasebe.fatura.index')}}">
                                            <div class="info-box mb-3 bg-warning">
                                                <span class="info-box-icon">  <i class="fas fa-file-invoice-dollar"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Fatura</span>
                                                    <span class="info-box-number">Fatura Kes</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>


                                        </a>
                                    </div>


                                    <div class="col-md-6">


                                        <a href="{{route('muhasebe.fatura.tumgecmis')}}">
                                            <div class="info-box mb-3 bg-warning">
                                                <span class="info-box-icon">  <i class="fas fa-history"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Faturalar</span>
                                                    <span class="info-box-number">Geçmiş Faturalar</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>


                                        </a>
                                    </div>


                                    <div class="col-md-6">


                                        <a href="{{route('muhasebe.fatura.faturabakim')}}">
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


                                        </a>
                                    </div>
                                    <div class="col-md-6">

                                        <a href="{{route('muhasebe.fatura.faturaParca')}}">
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


                                        </a>
                                    </div>
                                    <div class="col-md-6">

                                        <a href="{{route('muhasebe.fatura.faturaRevizyon')}}">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i
                                                        class="fas fa-th-list"></i></span>

                                                <div class="info-box-content">
                                                    <span style="color: black">Faturası Kesilmeyen Revizyonlar</span>
                                                    <h3><span style="color: black"
                                                              class="info-box-number">{{$revizyon}}</span></h3>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>


                                        </a>
                                    </div>


                                </div>
                            </div>
                        </div>


                        <!-- small box -->


                        <!-- small box -->


                    </div>

                    <!-- ./col -->


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



