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
                                <h3 class="card-title">Asansör Listesi</h3>
                                <div style="float: right !important;">
                                    <a href="{{route('revizyon.exportGecmis')}}" class="btn btn-info">Excel Olarak İndir</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="example1" class="table table-bordered table-striped dataTable"
                                                   role="grid" aria-describedby="example1_info">
                                                <thead>
                                                <tr role="row">
                                                    <th>id</th>
                                                    <th>Asansör Kimlik No</th>
                                                    <th>Apartman Adı</th>
                                                    <th>Blok</th>
                                                    <th>Etiket</th>
                                                    <th>Revizyon Yapan</th>
                                                    <th>Revizyon Tarihi</th>
                                                    <th>Sonraki Kontrol Tarihi</th>
                                                    <th>Revizyon Raporu</th>
                                                    <th style="width: 15px;">İşlem</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($revizyon as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->kimlik}}</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->apartman}}</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->blok}}</td>
                                                        <td><span class="badge p-2 @if(App\AsansorModel::find($value['asansor_id'])->etiket=="Yeşil") bg-success @elseif(App\AsansorModel::find($value['asansor_id'])->etiket=="Kırmızı") bg-danger @elseif(App\AsansorModel::find($value['asansor_id'])->etiket=="Sarı") bg-warning @elseif(App\AsansorModel::find($value['asansor_id'])->etiket=="Mavi") bg-primary @endif ">{{App\AsansorModel::find($value['asansor_id'])->etiket}}</span></td>
                                                        <td>{{App\User::find($value['user_id'])->name}}</td>
                                                        <td>{{$value->tarih}}</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->etiket_tarihi}}</td>
                                                        <td>@if($value->pdf!=null) <a href="{{route('revizyon.pdfGetir',$value->id)}}" target="_blank"> <span class="badge bg-gradient-light p-2" ><img src="{{asset('public/images/pdf.png')}}">Revizyon Raporu</span></a>@endif</td>
                                                        <td><a href="{{route('revizyon.edit',$value->id)}}"><span class="badge bg-warning p-2">Düzenle / Göster</span></a></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>



                    </div>

                </div>
            </div>
        </section>

    </div>

@endsection
