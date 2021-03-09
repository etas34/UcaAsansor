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
                                <h3 class="card-title">Sözleşme Yap</h3>

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
                                                    <th>Cari Ünvan</th>
                                                    <th>İlgili Kişi</th>
                                                    <th>İlgili Telefon</th>
                                                    <th>Asansörler</th>
                                                    <th>Sözleşme Tarihi</th>
                                                    <th style="width: 250px;">İşlemler</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($cari as $key=>$value)
                                                    @if(\App\AsansorModel::where('durum',1)->where('cari_id','=',$value->id)->count() > 0)
                                                        <tr role="row" class="odd">
                                                        <td></td>

                                                        <td>{{$value->cari_unvan}}</td>
                                                        <td>{{$value->ilgili_kisi }}</td>
                                                        <td>{{$value->telefon }}</td>
                                                        <td>

{{--      @dd(\App\AsansorModel::where('cari_id','=',4)->get())--}}

                                                            @foreach(\App\AsansorModel::where('durum',1)->where('cari_id','=',$value->id)->get() as $key=>$valueII )
                                                                <b>{{$valueII->apartman}} {{$valueII->blok}}</b><br/>
                                                            @endforeach</td>
                                                        <td>{{$value->sozlesme_tarih}}</td>

                                                        <td>
{{--                                                       <a href="{{route('muhasebe.cariharaket.gecmis',$value->id)}}"><span--}}
{{--                                                                    class="badge bg-success p-2">Haraketler</span></a>--}}
                                                            <a type="button" class="badge bg-primary p-2"
                                                               data-toggle="modal" data-target="#modal-default"
                                                               data-id="{{$value->id}}">
                                                                Sözleşme Tarihi Değiştir
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endif
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

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{route('muhasebe.cariharaket.sozlesmeDegistir')}}" method="post" autocomplete="off">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h4 class="modal-title">Sözleşeme Tarihi Değiştir</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">


                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Sözleşeme Tarihi</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                        </div>
                                        <input type="text" class="form-control pull-right datepicker" name="sozlesme_tarih" id="datepicker_etiket" value="">
                                    </div>
                                    <!-- /.input group -->
                                </div>

                            </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                        </div>
                                        <button type="button" onclick="document.getElementById('datepicker_etiket').value = ''" class="btn btn-danger" >Temizle</button>

                                    </div>
                                    <!-- /.input group -->
                                </div>

                            </div>



                        </div>
                        <input type="hidden" id="inputid" name="cari_id" value="0">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary" id="modalsubmit">Kaydet</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>




@endsection
