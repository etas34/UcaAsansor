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
                                <h3 class="card-title">Tamamlanan Görevler</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Görev Başlık</th>
                                        <th>Bildirim Türü</th>
                                        <th>Tarih</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bildirimler as $key=>$value)

                                            <tr>
                                                <td></td>
                                                <td><a style="color: #0b2e13" href="{{route('gorev.detay',$value->gorev_id)}}">{{$value->gorev_name}}</a></td>
                                                <td>{{$value->bildirim_name}}</td>
                                                <td>{{$value->created_at}}</td>
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
