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
                                                    <th>No</th>
                                                    <th>Asansör Kimlik No</th>
                                                    <th>Apartman Adı</th>
                                                    <th>Blok</th>
                                                    <th>Teklif Tarihi</th>
                                                    <th>Revizyon Raporu</th>
                                                    <th style=" width: 50px">Düzenle</th>
                                                    <th style=" width: 200px">İşlem</th>
                                                    <th style=" width: 40px">Kaldır</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($teklifler as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td>{{$value->apt_kimlik}}</td>
                                                        <td>{{$value->apt_apartman}}</td>
                                                        <td>{{$value->apt_blok}}</td>
                                                        <td>{{$value->tarih}}</td>
                                                        <td>@if($value->pdf!=null) <a href="{{route('revizyon.pdfGetir',$value->id)}}" target="_blank"> <span class="badge bg-gradient-light p-2" ><img src="{{asset('public/images/pdf.png')}}">Revizyon Raporu</span></a>@endif</td>
                                                        <td><a href="{{route('revizyon.teklifEdit',$value->id)}}"><span class="badge bg-warning p-2">Düzenle</span></a></td>
                                                        <td>
                                                            <button  type="submit" class="btn btn-primary" onclick="submitForm()"
                                                                    data-toggle="modal" data-target="#modal-default"
                                                                    data-id="{{$value->id}}"
                                                                    data-renk="{{$value->etiket}}">
                                                                Sözleşme
                                                            </button>

                                                            <button type="button" class="btn btn-success"
                                                                    data-toggle="modal" data-target="#modal-default2"
                                                                    data-id="{{$value->id}}">
                                                                Rapor Yükle
                                                            </button>

                                                        </td>
                                                        <td>
                                                            <form  method="post" onSubmit="return confirm('Emin misiniz?')"
                                                                   action="{{route('revizyon.teklifDelete',$value->id)}}">
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

                <form action="{{route('revizyon.sozlesmeDegistir')}}" method="post" autocomplete="off">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h4 class="modal-title">Etiket Değiştir</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="custom-control custom-radio my-2">
                                        <input class="custom-control-input" type="radio" id="customRadio3" name="sozlesme"
                                               value="Onaylandı" checked>
                                        <label for="customRadio3" class="custom-control-label">Onaylandı</label>
                                    </div>
                                    <div class="custom-control custom-radio my-2">
                                        <input class="custom-control-input" type="radio" id="customRadio4" name="sozlesme"
                                               value="Reddedildi">
                                        <label for="customRadio4" class="custom-control-label">Reddedildi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kişiye Ata</label>
                                    <select name="user_id" class="form-control">
                                        <option value="" disabled selected>Atanacak Kişi Seçiniz</option>
                                        @foreach($user as $key=>$value)
                                            <option value="{{$value->id}}">
                                                {{$value->name}}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="pasifCheck" value="1">
                                <label for="customCheckbox1" class="custom-control-label">Asansörü Bakım Listesinden Çıkar (Pasife Al)</label>
                            </div>
                        </div>

                        <input type="hidden" id="inputid" name="teklif_id" value="0">
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
    <div class="modal fade" id="modal-default2">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{route('revizyon.pdfDegistir')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h4 class="modal-title">Revizyon Raporu Yükle</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <!-- <label for="customFile">Custom File</label> -->
                            <label>Revizyon Kontrol Raporu</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile2" name="pdf" accept="application/pdf">
                                <label class="custom-file-label" for="customFile">PDF Seçiniz</label>
                            </div>
                        </div>
                        <input type="hidden" id="inputid2" name="teklif_id" value="0">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary" id="modalsubmit2">Kaydet</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
