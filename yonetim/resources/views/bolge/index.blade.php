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
                                <h3 class="card-title">Bölgeler</h3>
                                <a href="{{route('bolge.create')}}" class="btn btn-info" style="float: right !important;">Yeni Bölge Ekle</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">id</th>
                                        <th>Bolge Adı</th>
                                        <th>Düzenle</th>
                                        <th>Kaldır</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bolge as $key=>$value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->ad}}</td>

                                        <td><a href="{{route('bolge.edit',$value->id)}}"><span class="badge bg-warning p-2">Düzenle</span></a></td>
                                        <td>
                                            <form method="post" class="form-delete"
                                                  action="{{route('bolge.delete',$value->id)}}">
                                                {{csrf_field()}}
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
