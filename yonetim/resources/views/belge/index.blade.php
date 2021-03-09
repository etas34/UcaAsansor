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
                                <h3 class="card-title">Belgeler</h3>
                                <div style="float: right !important;">
                                    <a href="{{route('belge.create')}}" class="btn btn-success">Yeni Belge Ekle</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table  class="table table-striped">
                                                <thead>
                                                <tr role="row">
                                                    <th>No</th>
                                                    <th>Belge Adı</th>
                                                    <th>Hatırlatma Zamanı</th>
                                                    <th>Geçerlilik Tarihi</th>
                                                    <th>Durum</th>
                                                    <th>Dosya</th>
                                                    <th style="width: 15px;">Düzenle</th>
                                                    <th style="width: 10px;">Kaldır</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($belge as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td>{{$value->id}}</td>
                                                        <td>{{$value->ad }}</td>
                                                        <td>{{$value->hatirlatma }} @if($value->hatirlatma != 15)Ay @else Gün @endif </td>
                                                        <td>{{$value->gecerlilik}}


                                                        </td>
                                                        <td>
                                                            @if(15 == $value->hatirlatma)
                                                                @if(  (\Carbon\Carbon::now()) >= (\Carbon\Carbon::createFromTimeStamp(strtotime($value->gecerlilik))->subDay($value->hatirlatma))  and (\Carbon\Carbon::createFromTimeStamp(strtotime($value->gecerlilik))) > (\Carbon\Carbon::now()) )
                                                                    <div class="bg-warning">
                                                                        <span style="color: white">Kalan Süre: <b>  {{(\Carbon\Carbon::createFromTimeStamp(strtotime($value->gecerlilik))->diffForHumans(null, true))}}</b></span>
                                                                    </div>

                                                                @elseif((\Carbon\Carbon::createFromTimeStamp(strtotime($value->gecerlilik))) < (\Carbon\Carbon::now()))
                                                                    <div class="bg-danger">
                                                                        <span style="color: white">Geçerlilik tarihi bitti.<br></span>
                                                                    </div>
                                                                @endif





                                                            @else
                                                            @if(  (\Carbon\Carbon::now()) >= (\Carbon\Carbon::createFromTimeStamp(strtotime($value->gecerlilik))->subMonth($value->hatirlatma))  and (\Carbon\Carbon::createFromTimeStamp(strtotime($value->gecerlilik))) > (\Carbon\Carbon::now()) )
                                                                <div class="bg-warning">
                                                                    <span style="color: white">
                                                                              Kalan Süre: <b>  {{(\Carbon\Carbon::createFromTimeStamp(strtotime($value->gecerlilik))->diffForHumans(null, true))}}</b>


                                                            </span>
                                                                </div>

                                                            @elseif((\Carbon\Carbon::createFromTimeStamp(strtotime($value->gecerlilik))) < (\Carbon\Carbon::now()))
                                                                <div class="bg-danger">
                                                                <span style="color: white">Geçerlilik tarihi bitti.<br></span>
                                                                </div>
                                                            @endif
                                                            @endif

                                                        </td>


                                                        <td><a target="_blank"
                                                               href="{{$value->image }}"> {{$value->image }} </a></td>
                                                        <td><a href="{{route('belge.edit',$value->id)}}"><span
                                                                    class="badge bg-orange p-2">Düzenle</span></a></td>
                                                        <td>
                                                            <form action="{{route('belge.delete',$value->id)}}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                        onclick="return confirm('Belge silinecek. Emin Misiniz?')"
                                                                        class="badge bg-red p-2">Sil
                                                                </button>
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

