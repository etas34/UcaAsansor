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
                                                    <th>id</th>
                                                    <th>Asansör Kimlik No</th>
                                                    <th>Apartman Adı</th>
                                                    <th>Blok</th>
                                                    <th>Etiket</th>
                                                    <th>Revizyon Yapan</th>
                                                    <th>Revizyon Tarihi</th>
                                                    <th style="width: 15px;">Detaylar</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($revizyon as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->kimlik}}</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->apartman}}</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->blok}}</td>
                                                        <td><span class="badge p-2 @if($value->etiket=="Yeşil") bg-success @elseif($value->etiket=="Kırmızı") bg-danger @elseif($value->etiket=="Sarı") bg-warning @elseif($value->etiket=="Mavi") bg-primary @endif ">{{$value->etiket}}</span></td>
                                                        <td>{{App\User::find($value['user_id'])->name}}</td>
                                                        <td>{{$value->updated_at}}</td>
                                                        <td><a href="{{route('revizyon.detay',$value->id)}}"><span class="badge bg-primary p-2">Detaylar</span></a></td>
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
