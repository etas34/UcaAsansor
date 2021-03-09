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
                                <h3 class="card-title">Kullanıcılar</h3>
                                <a href="{{route('user.create')}}" class="btn btn-info" style="float: right !important;">Yeni Kullanıcı Ekle</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">id</th>
                                        <th>Kullanıcı Ad</th>
                                        <th>Mail</th>
                                        <th>Renk</th>
                                        <th>Düzenle</th>
                                        <th>Kaldır</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user as $key=>$value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td><span class="badge bg-{{$value->renk}}  p-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                        <td><a href="{{route('user.edit',$value->id)}}"><span class="badge bg-warning p-2">Düzenle</span></a></td>
                                        <td>
                                            <form method="post" class="form-delete"
                                                  action="{{route('user.delete',$value->id)}}">
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
