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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="d-block">Bölge Filtre</label>
                                        <select class="form-control " id="asansor_select"  required>
                                            <option value="1"  selected>Tüm Bölgeler</option>
                                            @foreach(\App\BolgeModel::all() as $bolge)
                                                <option value="{{$bolge->ad}}">{{$bolge->ad}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- col -->
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
                                                    <th>Bakım Yapan</th>
                                                    <th>Bölge</th>
                                                    <th>Bakım Tarihi</th>
                                                    <th>Fatura</th>
                                                    <th style="width: 15px;">Düzenle</th>
                                                    <th style="width: 15px;">Detaylar</th>
                                                    <th style="width: 15px;">Sil</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($bakim as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->kimlik}}</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->apartman}}</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->blok}}</td>
                                                        <td>{{App\User::find($value['user_id'])->name}}</td>
                                                        <td>{{\App\BolgeModel::find(App\AsansorModel::find($value['asansor_id'])->bolge_id)['ad'] ?? $value->bolge_id}}</td>
                                                        <td>{{$value->updated_at}}</td>
                                                        <td>{{$value->fatura_no}}</td>
                                                        <td><a href="{{route('bakim.edit',$value->id)}}"><span class="badge bg-warning p-2">Düzenle</span></a></td>
                                                        <td><a href="{{route('bakim.detay',$value->id)}}"><span class="badge bg-primary p-2">Detaylar</span></a></td>
                                                        <td><form  method="post" onSubmit="return confirm('Emin misiniz?')"
                                                                   action="{{route('bakim.delete',$value->id)}}">
                                                                {{csrf_field()}}
                                                                {{method_field('delete')}}
                                                                <button class="badge bg-danger p-2">Sil</button>
                                                            </form></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>d
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
