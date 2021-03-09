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
                                <a href="{{route('asansor.create')}}" class="btn btn-info"
                                   style="float: right !important;">Yeni Asansör Ekle</a>
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
                                                    <th>Yönetici</th>
                                                    <th>Yönetici Tel</th>
                                                    <th>SMS Gönder</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($asansor as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td>{{$value->kimlik}}</td>
                                                        <td>{{$value->apartman}}</td>
                                                        <td>{{$value->blok}}</td>
                                                        <td>{{$value->yonetici}}</td>
                                                        <td>{{$value->yonetici_tel}}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary"
                                                                    data-toggle="modal" data-target="#modal-default3"
                                                                    data-yonetici="{{$value->yonetici}}"
                                                                    data-tel="{{$value->yonetici_tel}}">
                                                                SMS Gönder
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

    <div class="modal fade" id="modal-default3">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{route('sms.store')}}"  enctype="multipart/form-data" method="post" autocomplete="off">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h4 class="modal-title">SMS Gönder</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class="control-label">Yönetici</label>
                                <input readonly class="form-control" id="yonetici">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Telefon</label>
                                <input readonly class="form-control" id="telefon" name="phone">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Mesaj</label>
                                    <textarea rows="4" name="mesaj" placeholder="Mesaj Giriniz"

                                              class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <!-- <label for="customFile">Custom File</label> -->
                                    <label>PDF veya Resim Ekle</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="pdf"
                                               accept="application/pdf,image/*">
                                        <label class="custom-file-label" for="customFile">Lütfen Sadece PDF veya Resim
                                            Yükleyiniz</label>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary" id="modalsubmit">Gönder</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@push('scripts')
    <script>

        $(function () {


            $('#modal-default3').on('show.bs.modal', function (e) {
                if (e.target.id === 'modal-default3') {
                    //get data-id attribute of the clicked element
                    var Id = $(e.relatedTarget).data('id');
                    var yonetici = $(e.relatedTarget).data('yonetici');
                    var tel = $(e.relatedTarget).data('tel');

                    $('#yonetici').val(yonetici);
                    $('#telefon').val(tel);

                }

            });


        });

    </script>
@endpush
