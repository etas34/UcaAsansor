@extends('layouts.main')
@section('content')
    <form action="{{route('bakim.bakimci_ata')}}" id="myForm" method="post">
        @csrf
        <div class="content-wrapper" style="min-height: 1203.6px;">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">


                                    <h3 class="card-title">Asansör Listesi</h3>
                                    <a href="{{route('bakim.export')}}" class="btn btn-info"
                                       style="float: right !important; margin: 5px;">Excel Olarak İndir</a>
                                    <button type="button" data-toggle="modal" data-target="#exampleModal"
                                            style="float: right !important;  margin: 5px;" class="btn btn-warning">Tarih
                                        Ve Bakımcı Ata
                                    </button>
                                </div>
                                <!-- /.card-header -->
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{--                                                <label for="formGroupExampleInput" class="d-block">Bölge Filtre</label>--}}
                                                <select class="form-control " id="asansor_select" required>
                                                    <option value="1" selected>Tüm Bölgeler</option>
                                                    @foreach(\App\BolgeModel::where('durum','=',1)->orderBy('ad','asc')->get() as $bolge)
                                                        <option value="{{$bolge->ad}}">{{$bolge->ad}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><!-- col -->
                                    </div>

                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table id="example1"
                                                       class="table table-bordered table-striped dataTable"
                                                       role="grid" aria-describedby="example1_info">
                                                    <thead>
                                                    <tr role="row">
                                                        <th>No</th>
                                                        <th><input type="checkbox" id="select-all"></th>
                                                        <th>Asansör Kimlik No</th>
                                                        <th>Apartman Adı</th>
                                                        <th>Blok</th>
                                                        <th>Bölge</th>
                                                        <th>Etiket</th>
                                                        <th>Bu Ayki Bakım Tarihi</th>
                                                        <th>Bakımcı</th>
                                                        {{--                                                        <th class="bg-danger">Kaç Gün Gecikti</th>--}}
                                                        <th style="width: 15px;">Bakım</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($asansor as $key=>$value)
                                                        <tr role="row" class="odd">
                                                            <td></td>
                                                            <td><input type="checkbox" class="cb_asansor" value="{{$value->id }}"
                                                                       name="checkbox[{{$key}}]"></td>
                                                            <td>{{$value->kimlik}}</td>
                                                            <td>{{$value->apartman}}</td>
                                                            <td>{{$value->blok}}</td>
                                                            <td>{{\App\BolgeModel::find($value->bolge_id)['ad'] ?? ''}}</td>
                                                            <td><span
                                                                    class="badge p-2 @if($value->etiket=="Yeşil") bg-success @elseif($value->etiket=="Kırmızı") bg-danger @elseif($value->etiket=="Sarı") bg-warning @elseif($value->etiket=="Mavi") bg-primary @endif ">{{$value->etiket}}</span>
                                                            </td>
                                                            <td>{{$value->bu_ay_bakim_tarih}}</td>
                                                            <td>{{\App\User::find($value->bakimci_id)['name'] ?? ''}}</td>
                                                            {{--                                                            <td @if(Carbon\Carbon::parse($value->aylik_bakim)->addMonthsNoOverflow(1)->diffInDays(Carbon\Carbon::now()->startOfDay(),false)>=0 ) class="text-danger" @endif>{{Carbon\Carbon::parse($value->aylik_bakim)->addMonthsNoOverflow(1)->diffInDays(Carbon\Carbon::now()->startOfDay(),false) }}</td>--}}
                                                            <td>
                                                                <a href=" @if($value->etiket=="Kırmızı") # @else {{route('bakim.create',$value->id)}} @endif"><span
                                                                        class="badge @if($value->etiket=="Kırmızı") bg-danger @else bg-primary @endif p-2">@if($value->etiket=="Kırmızı")
                                                                            Bakım Yapılamaz @else Bakım
                                                                            Yap @endif</span></a></td>
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
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tarih Ve Bakımcı Ata</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group clearfix">
                            <div class="icheck-danger d-inline">
                                <input type="checkbox" id="checkboxDanger1" name="atama_sil" value="1">
                                <label for="checkboxDanger1">
                                    Atamayı Sil
                                </label>
                            </div>
                        </div>

                        <div class="form-group sakla">
                            <label>Bakımcı</label>
                            <select name="bakimci_id" id="bakimci_id" class="form-control">
                                <option value="" disabled selected>Bakımcı Seç</option>
                                @foreach($user as $key=>$value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group sakla">
                            <label>Bu Ayki Bakım Zamanı</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                </div>
                                <input type="text" class="form-control pull-right datepicker" id="bu_ay_bakim_tarih"
                                       name="bu_ay_bakim_tarih" autocomplete="off" placeholder="Tarih Boş">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
@push('scripts')
    <script>
        $('#select-all').click(function (event) {
            if (this.checked) {
                // Iterate each checkbox
                $('.cb_asansor').each(function () {
                    this.checked = true;
                });
            } else {
                $('.cb_asansor').each(function () {
                    this.checked = false;
                });
            }
        });

        $(function() {
            var checkbox = $("#checkboxDanger1");
            var hidden = $(".sakla");
            checkbox.change(function() {
                if (checkbox.is(':checked')) {
                    hidden.hide();
                    $('#bu_ay_bakim_tarih').prop('required', false); //to add required
                    $('#bakimci_id').prop('required', false); //to add required
                    $('#bu_ay_bakim_tarih').val('');
                    $('#bakimci_id').val('');
                } else {
                    hidden.show();
                    $('#bu_ay_bakim_tarih').prop('required', true); //to add required
                    $('#bakimci_id').prop('required', true); //to add required
                }
            });
        });


    </script>
@endpush
