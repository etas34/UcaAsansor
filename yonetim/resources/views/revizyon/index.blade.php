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
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput" class="d-block">Revizyon Tarihi Filtre</label>
                                            <select class="form-control " id="ay_select" required>
                                                <option value="-1" selected>Tüm Aylar</option>
                                                @foreach(config('constants.aylar') as $key=>$value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- col -->
                                </div>
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
                                                    <th>Durum</th>
                                                    <th>Bir Sonraki Revizyon Tarihi</th>
                                                    <th>Etiket Değişim Tarihi</th>
                                                    <th>Etiket</th>
                                                    <th>İşlem</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($asansor as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td>{{$value->kimlik}}</td>
                                                        <td>{{$value->apartman}}</td>
                                                        <td>{{$value->blok}}</td>
                                                        <td><span class="badge p-2 @if($value->durum=="1") bg-success @elseif($value->durum=="2") bg-danger @endif ">@if($value->durum=="1") Aktif @elseif($value->durum=="2") Pasif @endif </span></td>
                                                        <td>{{$value->etiket_tarihi}}</td>
                                                        <td>{{$value->etiket_deg_tarihi}}</td>
                                                        <td><span class="badge p-2 @if($value->etiket=="Yeşil") bg-success @elseif($value->etiket=="Kırmızı") bg-danger @elseif($value->etiket=="Sarı") bg-warning @elseif($value->etiket=="Mavi") bg-primary @endif ">{{$value->etiket}}</span></td>
                                                        <td>
                                                            <a href="{{route('revizyon.teklifCreate',$value->id)}}" class="btn btn-warning">
                                                                Teklif Oluştur
                                                            </a>
                                                            <button type="button" class="btn btn-primary"
                                                                    data-toggle="modal" data-target="#modal-default"
                                                                    data-id="{{$value->id}}"
                                                                    data-renk="{{$value->etiket}}">
                                                                Etiket Değiştir
                                                            </button>
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

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{route('revizyon.etiketDegistir')}}" method="post" autocomplete="off">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h4 class="modal-title">Etiket Değiştir</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="custom-control custom-radio my-2">
                                    <input class="custom-control-input" type="radio" id="customRadio1" name="etiket"
                                           value="Yeşil">
                                    <label for="customRadio1" class="custom-control-label"><span
                                            class="badge p-2 bg-success">Yeşil Etiket</span></label>
                                </div>
                                <div class="custom-control custom-radio my-2">
                                    <input class="custom-control-input" type="radio" id="customRadio2" name="etiket"
                                           value="Mavi">
                                    <label for="customRadio2" class="custom-control-label"><span
                                            class="badge p-2 bg-primary">Mavi Etiket</span></label>
                                </div>
                                <div class="custom-control custom-radio my-2">
                                    <input class="custom-control-input" type="radio" id="customRadio3" name="etiket"
                                           value="Kırmızı">
                                    <label for="customRadio3" class="custom-control-label"><span
                                            class="badge p-2 bg-danger">Kırmızı Etiket</span></label>
                                </div>
                                <div class="custom-control custom-radio my-2">
                                    <input class="custom-control-input" type="radio" id="customRadio4" name="etiket"
                                           value="Sarı">
                                    <label for="customRadio4" class="custom-control-label"><span
                                            class="badge p-2 bg-warning">Sarı Etiket</span></label>
                                </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label>Sonraki Kontrol Tarihi</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                    </div>
                                    <input type="text" class="form-control pull-right datepicker" name="etiket_tarihi" id="datepicker_etiket" value="">
                                </div>
                                <!-- /.input group -->
                            </div>

                            </div>
                        </div>
                        <input type="hidden" id="inputid" name="asansor_id" value="0">
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
