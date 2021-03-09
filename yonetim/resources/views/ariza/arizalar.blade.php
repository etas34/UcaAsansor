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
                                                    <th>Atanan Kişi</th>
                                                    <th>Arıza Tarihi</th>
                                                    <th class="bg-danger">Geçen Süre</th>
                                                    <th>Önem</th>
                                                    <th style="width: 15px;">Düzenle</th>
                                                    <th style="width: 15px;">İşlemler</th>
                                                    <th style="width: 15px;">Sil</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ariza as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->kimlik}}</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->apartman}}</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->blok}}</td>
                                                        <td>@if($value['user_id']!=''){{App\User::find($value['user_id'])->name}}@endif</td>
                                                        <td>{{$value->created_at}}</td>
                                                        <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($value->created_at))->diffForHumans(null, true)}}</td>
                                                        <td><span class="badge bg-danger p-2">{{$value->buyuk_ariza}}</span></td>
                                                        <td><a href="{{route('ariza.edit',$value->id)}}"><span class="badge bg-warning p-2">Düzenle</span></a></td>
                                                        <td><a href="{{route('ariza.gider',$value->id)}}"><span class="badge bg-primary p-2">Arıza Gider</span></a></td>
                                                        <td>
                                                            <form  method="post" onSubmit="return confirm('Emin misiniz?')"
                                                                   action="{{route('ariza.delete',$value->id)}}">
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
