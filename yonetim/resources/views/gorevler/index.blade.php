@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Görevler</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Başlık</th>
                                        <th>Atayan Kişi</th>
                                        <th>Atanan Kişi</th>
                                        <th>Önem</th>
                                        <th>Durum</th>
                                        <th>Bitiş Tarihi</th>
                                        <th>Kalan Gün Sayısı</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gorevler as $key=>$value)
                                    <tr>
                                        <td></td>
                                        <td>{{$value->baslik}}</td>
                                        <td>{{App\User::find($value['sahip_id'])->name}}</td>
                                        <td>{{App\User::find($value['atanan_id'])->name}}</td>
                                        <td><span class="badge p-2 @if($value->onem_id==2 || $value->onem_id==3  ) bg-danger @endif" >{{$value->onem_name}}</span></td>
                                        <td><span class="badge p-2 @if($value->durum==1) bg-success
                                        @elseif($value->durum==2) bg-cyan @elseif($value->durum==3) bg-warning
                                        @elseif($value->durum==4) bg-gradient-green @endif">{{$value->durum_name}}</span></td>
                                        <td>{{$value->bitis_zaman}}</td>
                                        <td>{{Carbon\Carbon::now()->startOfDay()->diffInDays(Carbon\Carbon::parse($value->bitis_zaman),false) }}</td>
                                        <td><a href="{{route('gorev.edit',$value->id)}}"><span class="badge bg-orange p-2" >Düzenle</span></a>
                                            <a href="{{route('gorev.detay',$value->id)}}"><span class="badge bg-olive p-2" >İşlem Yap</span></a></td>
                                    </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>



                    </div>

                </div>
            </div>
        </section>

    </div>

@endsection
