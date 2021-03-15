@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">


                            <form action="{{route('muhasebe.fatura.update',$fatura->id)}}" method="post" autocomplete="off"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
{{--                                                                "id" => 2--}}
{{--                                                                "cari_unvan" => "C2"--}}
{{--                                                                "adres" => null--}}
{{--                                                                "telefon" => null--}}
{{--                                                                "ilgili_kisi" => "AHmet"--}}
{{--                                                                "alacak_bakiye" => "0.00"--}}
{{--                                                                "borc_bakiye" => "100.00"--}}
{{--                                                                "vergi_dairesi" => null--}}
{{--                                                                "vergi_numarasi" => null--}}
{{--                                                                "durum" => 1--}}
{{--                                                                "created_at" => "2020-10-26 14:27:57"--}}
{{--                                                                "updated_at" => "2020-10-27 10:17:12"--}}
{{--                                                                ]--}}

                                <div class="card-body">
                                    <div class="row">
                                        <input type="text" hidden name="cari_id" value="{{$cari->id}}">

                                        <div class="form-group col-md-6">
                                            <label class="control-label">Cari Ünvanı </label>
                                            <input type="text" disabled value="{{$cari->cari_unvan }}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="control-label">İlgili Kişi </label>
                                            <input type="text" disabled value="{{$cari->ilgili_kisi }}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="control-label">Vergi Numarası </label>
                                            <input type="text" disabled value="{{$cari->vergi_numarasi }}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="control-label">Vergi Dairesi </label>
                                            <input type="text" disabled value="{{$cari->vergi_dairesi }}"
                                                   class="form-control">
                                        </div>


                                        {{--                                        <div class="form-group col-md-12">--}}
                                        {{--                                            <label>Tür</label>--}}
                                        {{--                                            <select name="tur" class="form-control" required="">--}}
                                        {{--                                                <option  @if($cari->borc_bakiye > 0){{'selected=""'}} @endif value="1">--}}
                                        {{--                                                    Tahsilat--}}
                                        {{--                                                </option>--}}
                                        {{--                                                <option value="2" @if($cari->alacak_bakiye > 0){{'selected=""'}} @endif>--}}
                                        {{--                                                    Ödeme--}}
                                        {{--                                                </option>--}}

                                        {{--                                            </select>--}}
                                        {{--                                        </div>--}}

                                        {{--                                        <div class="form-group col-md-12">--}}
                                        {{--                                            <label class="control-label">Tutar</label>--}}
                                        {{--                                            <input type="number" step="0.01" required name="tutar" class="form-control">--}}
                                        {{--                                        </div>--}}





                                        <div class="form-group col-md-6">
                                            <label  class="control-label">Fatura Numarası </label>
                                            <input required name="fnumarasi" value="{{$fatura->fatura_no}}" type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label  class="control-label">Açıklama</label>
                                            <input  name="aciklama" value="{{$fatura->aciklama}}" type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Fatura Tarihi</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                </div>
                                                <input required type="text" value="{{\Carbon\Carbon::now()->format('Y-m-d') }}"
                                                       class="form-control pull-right datepicker" value="{{$fatura->tarih}}" name="tarih">
                                            </div>
                                        </div>











                                    </div>
                                    <!-- Table row -->
                                    <div class="row mt-2">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped" id="myTable">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Cins</th>
                                                    <th style="width: 100px;">Miktar #</th>
                                                    <th style="width: 150px;">Birim Fiyat (₺)</th>
                                                    <th style="width: 150px;">Toplam Fiyat</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($urun)
                                                    @foreach($urun as $key=>$value)
                                                        <tr>


                                                            <td style="padding: 0px !important;"> @if(isset($value->myid)) <input type="text" class="form-control" name="urun[{{$key}}][myid]" value="{{$value->myid}}" hidden> @endif
                                                                @if(isset($value->tur))  <input type="text" class="form-control" name="urun[{{$key}}][tur]" value="{{$value->tur}}" hidden> @endif <input type="text" class="form-control" name="urun[{{$key}}][aciklama]" value="{{$value->aciklama}}"></td>
                                                            <td style="padding: 0px !important;"><input type="number" id="miktar{{$key}}" min="0" class="form-control hesapla sayisay" name="urun[{{$key}}][miktar]" value="{{$value->miktar}}"></td>
                                                            <td style="padding: 0px !important;"><input type="number" id="fiyat{{$key}}" min="0" step="0.0001"  class="form-control hesapla" name="urun[{{$key}}][fiyat]" value="{{$value->fiyat}}"></td>
                                                            <td style="padding: 0px !important;"><input type="number" id="toplam{{$key}}" class="form-control toplamlar" name="urun[{{$key}}][toplam]" readonly  value="{{$value->toplam}}"></td>
                                                            <td style="padding: 0px !important; width: 5px"><input type="button" class="btn btn-danger" value="Sil"></td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.col -->


                                    </div>

                                    <div class="row float-right mb-5">
                                        <button id="yeniEkle" class="btn btn-info" type="button">Yeni Satır Ekle</button>

                                    </div>

                                    <!-- /.row -->

                                    <br><br>

                                    <div class="row mt-5">
                                        <!-- accepted payments column -->
                                        <div class="col-9">

                                        </div>
                                        <!-- /.col -->
                                        <div class="col-3 text-right">
                                            <div>
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <th style="width:150px">Toplam</th>
                                                        <td><input type="number" id="toplam" class="form-control" readonly name="alttoplam"
                                                                   value="{{$fatura->toplam}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <th> <label for="kdvsec">KDV &nbsp</label>
                                                            <select class="form-control-sm"  id="kdvsec" name="kdvsec">
                                                                <option value="0" @if($fatura->kdvsec=='0') selected @endif>0</option>
                                                                <option value="0.18" @if($fatura->kdvsec=='0.18') selected @endif>18</option>
                                                            </select></th>
                                                        <td><input type="number" step="0.01" id="kdv" class="form-control" name="altkdv"
                                                                   readonly value="{{$fatura->kdv}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Genel Toplam</th>
                                                        <td><input type="number" id="gentoplam" class="form-control" name="altgentoplam"
                                                                   readonly value="{{$fatura->gentoplam}}"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>

                                    {{--                                    <div class="form-group col-md-3">--}}
                                    {{--                                        <label class="control-label">Açıklama</label>--}}
                                    {{--                                        <textarea rows="3" name="aciklama" class="form-control"> </textarea>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <div class="card-footer pull-right">
                                    <input type="submit" class="btn btn-success px-5 float-right" value="Kaydet">
                                </div>

                            </form>
                        </div>


                    </div>

                </div>
            </div>
        </section>

    </div>

@endsection
@push('scripts')

    <script>



        $("#yeniEkle").click(function () {
            var k = $(".sayisay").length;
            $('#myTable').append('<tr><td style="padding: 0px !important;"><input type="text" name="urun['+k+'][aciklama]" class="form-control"></td><td style="padding: 0px !important;"><input type="number" name="urun['+k+'][miktar]" id="miktar' + k + '" min="0" value="1"  class="form-control hesapla sayisay"></td><td style="padding: 0px !important;"><input type="number" value="1" name="urun['+k+'][fiyat]" id="fiyat' + k + '" min="0" step="0.0001"  class="form-control hesapla"></td><td style="padding: 0px !important;"><input type="number" name="urun['+k+'][toplam]" id="toplam' + k + '" class="form-control toplamlar" readonly value="1"></td><td style="padding: 0px !important; width: 5px"><input type="button" class="btn btn-danger" value="Sil"></td></tr>')
            hesapla()
        });
        $('#myTable').on('click', 'input[type="button"]', function () {
            $(this).closest('tr').remove();
            hesapla()
        });

        $('#kdvsec').on('change', function (e) {
            hesapla()
        });
        function hesapla() {
            for (k = 0; k < $(".sayisay").length; k++) {

                var miktar = $("#miktar" + k).val();
                var fiyat = $("#fiyat" + k).val();
                var toplam = miktar * fiyat;
                $("#toplam" + k).val(toplam);
            }

            var kdvsec=$('#kdvsec').val();
            var sum = 0;
            $('.toplamlar').each(function () {
                sum += parseFloat(this.value);
            });
            $("#toplam").val(sum);
            var top = parseFloat($("#toplam").val());
            var kdv = top * kdvsec;
            kdv = kdv.toFixed(2).replace(/[.,]00$/, "");
            $("#kdv").val(kdv);

            var gentoplam = top + parseFloat(kdv);

            gentoplam = gentoplam.toFixed(2).replace(/[.,]00$/, "");
            $("#gentoplam").val(gentoplam);
        }
        $(document).on('input', '.hesapla', function () {


            for (k = 0; k < $(".sayisay").length; k++) {

                var miktar = $("#miktar" + k).val();
                var fiyat = $("#fiyat" + k).val();
                var toplam = miktar * fiyat;
                $("#toplam" + k).val(toplam);
            }
            var kdvsec=$('#kdvsec').val();
            var sum = 0;
            $('.toplamlar').each(function () {
                sum += parseFloat(this.value);
            });
            $("#toplam").val(sum);
            var top = parseFloat($("#toplam").val());
            var kdv = top * kdvsec;
            kdv = kdv.toFixed(2).replace(/[.,]00$/, "");
            $("#kdv").val(kdv);

            var gentoplam = top + parseFloat(kdv);

            gentoplam = gentoplam.toFixed(2).replace(/[.,]00$/, "");
            $("#gentoplam").val(gentoplam);


        });

    </script>
@endpush
