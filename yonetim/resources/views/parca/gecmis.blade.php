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
                                <a href="{{route('parca.export')}}" class="btn btn-info" style="float: right !important;">Excel Olarak İndir</a>
w
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
                                                    <th>No</th>
                                                    <th>Asansör Kimlik No</th>
                                                    <th>Apartman Adı</th>
                                                    <th>Blok</th>
                                                    <th>Değişen Parça & Malzeme</th>
                                                    <th>Miktar</th>
                                                    <th>Birim</th>
                                                    <th>Değiştiren Kişi</th>
                                                    <th>Tarih</th>
                                                    <th>Değişim Şekli</th>
                                                    <th>Fatura No</th>
                                                    <th>Düzenle</th>
                                                    <th>Sil</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($parca as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->kimlik}}</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->apartman}}</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->blok}}</td>
                                                        <td>{{$value->parca}}</td>
                                                        <td>{{$value->miktar}}</td>
                                                        <td>{{$value->birim}}</td>
                                                        <td>@if($value['user_id']!=''){{App\User::find($value['user_id'])->name}}@endif</td>
                                                        <td>{{$value->tarih}}</td>
                                                        <td>{{$value->sekil}}</td>
                                                        <td>{{$value->fatura_no}}</td>
                                                        <td><a href="{{route('parca.edit',$value->id)}}"><span class="badge bg-primary p-2">Düzenle</span></a></td>
                                                        <td>
                                                            <form method="post" class="form-delete"
                                                                  action="{{route('parca.delete',$value->id)}}">
                                                                {{csrf_field()}}
                                                                {{method_field('delete')}}
                                                                <button class="badge bg-danger p-2">Sil</button>
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

