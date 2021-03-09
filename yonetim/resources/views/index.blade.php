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
                    <div class="col-lg-3 col-md-6">
                        <!-- small box -->

                        <div class="card bg-info">
                            <div class="card-header  text-center">
                                <h4 class="card-title text-bold" style="float: none;">ASANSÖR LİSTESİ</h4>
                            </div>
                            <div class="card-body" style="padding-bottom:10px !important;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{route('asansor.index',1)}}"><span class="btn btn-block  bg-success">Tüm Liste</span></a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{route('asansor.index',2)}}"><span class="btn btn-block  bg-warning">Sarı</span></a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{route('asansor.index',3)}}"><span class="btn btn-block bg-danger ">Kırmızı</span></a>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>

                        <a class="small-box " href="{{route('parca.index')}}">
                            <div class="card bg-info">
                                <div class="card-header">
                                    <h4 class="card-title text-bold">Parça & Malzeme </h4>
                                </div>
                                <div class="card-body">
                                    Ekle
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </a>

                        <a class="small-box " href="{{route('parca.gecmis')}}">
                            <div class="card bg-info">
                                <div class="card-header">
                                    <h4 class="card-title text-bold">Parça & Malzeme </h4>
                                </div>
                                <div class="card-body">
                                    Geçmiş
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </a>

                    </div>
                    <!-- ./col -->

                    @if(in_array(3,explode(",",Auth::user()->yetki)))
                        <div class="col-lg-3 col-md-6">
                            <!-- small box -->

                            <a class="small-box" href="{{route('bakim.index',1)}}">
                                <div class="card bg-success">
                                    <div class="card-header text-center">
                                        <h4 class="card-title text-bold" style="float: none;">BAKIM</h4>
                                    </div>
                                    <div style="padding:6px 20px" class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h3>{{$bakim_olmayan_aylik->count()}}</h3>
                                            </div>
                                            <div  class="col-md-8 mt-3"> <p>Bu Ay Bakım Yapılmayanlar</p></div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </a>

                            <!-- small box -->
{{--                            <a >--}}
{{--                                <div class="small-box bg-success">--}}
{{--                                    <div class="inner">--}}
{{--                                        <h3>{{$bakim_olmayan_aylik->count()}}</h3>--}}

{{--                                        <p>Bu Ay Bakım Yapılmayanlar</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="icon">--}}
{{--                                        <i class="ion ion-medkit"></i>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </a>--}}

                            <!-- small box -->

                            <div class="card">
                                <div class="card-header bg-success">
                                    <h3 class="card-title">Atanan Bakımlar</h3>
                                </div>
                                <div class="card-body">
                                    <table
                                       class="table table-sm">
                                        <tr>
                                            <th>Bakımcı</th>
                                            <th style="width: 25px;">Geçmiş</th>
                                            <th style="width: 25px;">Bugün</th>
                                            <th style="width: 25px;">Gelecek</th>
                                        </tr>
                                        @foreach($user as $key => $value)
                                                <tr>
                                                    <td><a href="{{route('bakim.bakimci_asansor',$value)}}"> {{$value->name}}</a></td>
                                                    <td class="text-center">
                                                        <span
                                                            class="badge bg-danger">{{($value->asansors()->whereDate('bu_ay_bakim_tarih','<',$date)->count())}}</span>

                                                    </td>
                                                    <td class="text-center">
                                                        <span
                                                            class="badge bg-warning">{{($value->asansors()->whereDate('bu_ay_bakim_tarih','=',$date)->count())}}</span>
                                                    </td>
                                                    <td class="text-center"><span
                                                            class="badge bg-success">{{($value->asansors()->whereDate('bu_ay_bakim_tarih','>',$date)->count())}}</span>
                                                    </td>
                                                </tr>

                                        @endforeach
                                    </table>
                                </div>
                            </div>


                            <a href="{{route('bakim.bakimlar',2)}}">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{$bakim_gunluk->count()}}</h3>

                                        <p>Bugün Bakım Yapılanlar</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-medkit"></i>
                                    </div>

                                </div>
                            </a>
                            <!-- small box -->
                            <a href="{{route('bakim.bakimlar',1)}}">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{$bakim_aylik->count()}}</h3>

                                        <p>Bu Ay Bakım Yapılanlar</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-medkit"></i>
                                    </div>

                                </div>
                            </a>
                        </div>
                    @endif
                <!-- ./col -->


                    @if(in_array(4,explode(",",Auth::user()->yetki)))
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <a class="small-box " href="{{route('revizyon.revizyonYap')}}">
                                <div class="card bg-warning">
                                    <div class="card-header text-center">
                                        <h4 class="card-title text-bold" style="float: none;">REVİZYON</h4>
                                    </div>
                                    <div class="card-body">
                                        Teklif Ver & Etiket Değiştir
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </a>

                            <a href="{{route('revizyon.sozlesmeBekleyen')}}">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{$teklifler->count()}}</h3>

                                        <p>Teklif Verilen Asansörler</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-refresh"></i>
                                    </div>
                                </div>
                            </a>


                            <a href="{{route('revizyon.teklifGecmis')}}">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{$gecmis_teklifler->count()}}</h3>

                                        <p>Geçmiş Teklifler</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-refresh"></i>
                                    </div>
                                </div>
                            </a>

                            <a href="{{route('revizyon.revizyonGereken')}}">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{$revizyon->count()}}</h3>

                                        <p>Revizyon Yapılacak Asansörler</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-refresh"></i>
                                    </div>
                                </div>
                            </a>

                            <a href="{{route('revizyon.revizyonGecmis')}}">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{$revizyonGecmis->count()}}</h3>

                                        <p>Revizyon Yapılan Asansörler</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-refresh"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                <!-- ./col -->
                    @if(in_array(2,explode(",",Auth::user()->yetki)))
                        <div class="col-lg-3 col-6">
                            <!-- small box -->

                            <a class="small-box " href="{{route('ariza.index')}}">
                                <div class="card bg-danger">
                                    <div class="card-header text-center">
                                        <h4 class="card-title text-bold" style="float: none;">ARIZA</h4>
                                    </div>
                                    <div class="card-body">
                                        Kayıt Aç & Asansör Arıza Geçmişleri
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </a>

                            <a href="{{route('ariza.arizalar')}}">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{$ariza->count()}}</h3>

                                        <p>Arıza Kaydı Açılanlar</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-settings"></i>
                                    </div>
                                </div>
                            </a>


                            <a href="{{route('ariza.gecmis')}}">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{$ariza_gecmis->count()}}</h3>

                                        <p>Arıza Geçmişi</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-settings"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                @endif
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
