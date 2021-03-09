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
                                <a href="{{route('asansor.create')}}" class="btn btn-info" style="float: right !important;">Yeni Asansör Ekle</a>
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
                                                    <th style="width: 10px;">id</th>
                                                    <th>Asansör Kimlik No</th>
                                                    <th>Apartman Adı</th>
                                                    <th>Blok</th>
                                                    <th>Yönetici</th>
                                                    <th>Yönetici Tel</th>
                                                    <th>Adres</th>
                                                    <th>Son Aylık Bakım</th>
                                                    <th>Etiket Tarihi</th>
                                                    <th style="width: 15px;">Düzenle</th>
                                                    <th style="width: 15px;">Aktif</th>
                                                    <th style="width: 10px;">Kaldır</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($asansor as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1"></td>
                                                        <td>{{$value->kimlik}}</td>
                                                        <td>{{$value->apartman}}</td>
                                                        <td>{{$value->blok}}</td>
                                                        <td>{{$value->yonetici}}</td>
                                                        <td>{{$value->yonetici_tel}}</td>
                                                        <td>{{$value->adres}}</td>
                                                        <td>{{$value->aylik_bakim}}</td>
                                                        <td>{{$value->etiket_tarihi}}</td>
                                                        <td><a href="{{route('asansor.edit',$value->id)}}"><span class="badge bg-primary p-2">Düzenle</span></a></td>
                                                        <td><form method="post" onSubmit="return confirm('Emin misiniz?')"
                                                                  action="{{route('asansor.aktifeAl',$value->id)}}">
                                                                {{csrf_field()}}
                                                                <button type="submit" class="badge bg-orange p-2">Aktife Al</button>
                                                            </form></td>
                                                        <td>
                                                            <form method="post" onSubmit="return confirm('Emin misiniz?')"
                                                            action="{{route('asansor.delete',$value->id)}}">
                                                                {{csrf_field()}}
                                                                {{method_field('delete')}}
                                                                <button type="submit" class="badge bg-danger p-2">Sil</button>
                                                            </form>
                                                        </td>
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
