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
                                <h3 class="card-title">{{$ariza->first()->apartman}} {{$ariza->first()->blok}}</h3>
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
                                                    <th style="width:5px ">No</th>
                                                    <th style="width:15px ">İçeride Birisi Kalmış</th>
                                                    <th style="width:15px ">Asansör Çalışmıyor</th>
                                                    <th style="width:15px ">Fotosel Arızası</th>
                                                    <th style="width:15px ">Ses Geliyor</th>
                                                    <th style="width:15px ">Kabin İçi Lamba Sürekli Yanıyor</th>
                                                    <th style="width:15px ">Kapı Sürtmesi</th>
                                                    <th>Bunların Dışında</th>
                                                    <th>Arıza Gideren</th>
                                                    <th>Arızacı Notu</th>
                                                    <th>Arıza Zamanı</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ariza as $key=>$value)
                                                    <tr role="row" class="odd text-center">
                                                        <td></td>
                                                        <td>@if($value->icindebiri==1)<span class="badge bg-danger p-2"><i class="fa fa-check" aria-hidden="true"></i></span>@endif</td>
                                                        <td>@if($value->calismiyor==1)<span class="badge bg-danger p-2"><i class="fa fa-check" aria-hidden="true"></i></span>@endif</td>
                                                        <td>@if($value->fotosel==1)<span class="badge bg-danger p-2"><i class="fa fa-check" aria-hidden="true"></i></span>@endif</td>
                                                        <td>@if($value->sesgeliyor==1)<span class="badge bg-danger p-2"><i class="fa fa-check" aria-hidden="true"></i></span>@endif</td>
                                                        <td>@if($value->lamba==1)<span class="badge bg-danger p-2"><i class="fa fa-check" aria-hidden="true"></i></span>@endif</td>
                                                        <td>@if($value->kapisurtme==1)<span class="badge bg-danger p-2"><i class="fa fa-check" aria-hidden="true"></i></span>@endif</td>
                                                        <td>{{$value->disinda}}</td>
                                                        <td>{{App\User::find($value['user_id'])->name}}</td>
                                                        <td>{{$value->ariza_not}}</td>
                                                        <td>{{$value->created_at}}</td>
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
