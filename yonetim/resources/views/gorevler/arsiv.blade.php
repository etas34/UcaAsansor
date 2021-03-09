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
                                <h3 class="card-title">Arşivdeki Görevler</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Başlık</th>
                                        <th>Atanan Kişi</th>
                                        <th>Önem</th>
                                        <th>Başlangıç Tarihi</th>
                                        <th>Bitiş Tarihi</th>
                                        <th>Detaylar</th>
                                        <th>Sil</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gorevler as $key=>$value)
                                        <tr>
                                            <td></td>
                                            <td>{{$value->baslik}}</td>
                                            <td>{{App\User::find($value['atanan_id'])->name}}</td>
                                            <td>{{$value->onem_name}}</td>
                                            <td>{{$value->bas_zaman}}</td>
                                            <td>{{$value->bitis_zaman}}</td>
                                            <td><a href="{{route('gorev.edit',$value->id)}}"><span
                                                        class="badge bg-primary p-2">Detay/İşlem</span></a></td>

                                            <td>
                                                <form method="post" class="form-delete"
                                                      action="{{route('gorev.delete',$value->id)}}">
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
                            <!-- /.card-body -->
                        </div>


                    </div>

                </div>
            </div>
        </section>

    </div>

@endsection
