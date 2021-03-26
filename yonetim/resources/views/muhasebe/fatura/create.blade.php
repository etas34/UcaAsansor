@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">


                            <form action="{{route('muhasebe.fatura.store',$cari->id)}}" method="post" autocomplete="off"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
{{--                                                                                                "id" => 2--}}
{{--                                                                                                "cari_unvan" => "C2"--}}
{{--                                                                                                "adres" => null--}}
{{--                                                                                                "telefon" => null--}}
{{--                                                                                                "ilgili_kisi" => "AHmet"--}}
{{--                                                                                                "alacak_bakiye" => "0.00"--}}
{{--                                                                                                "borc_bakiye" => "100.00"--}}
{{--                                                                                                "vergi_dairesi" => null--}}
{{--                                                                                                "vergi_numarasi" => null--}}
{{--                                                                                                "durum" => 1--}}
{{--                                                                                                "created_at" => "2020-10-26 14:27:57"--}}
{{--                                                                                                "updated_at" => "2020-10-27 10:17:12"--}}
{{--                                                                                                ]--}}

                                <div class="card-body">
                                    <div class="row">
                                        <input type="text" hidden name="cari_id" value="{{$cari->id}}">

                                        <div class="form-group col-md-6">
                                            <label class="control-label">Cari Ünvanı </label>
                                            <input type="text"  name="cari_unvan" value="{{$cari->cari_unvan }}"
                                                disabled   class="form-control"><input hidden type="text"  name="cari_unvan"  value="{{$cari->cari_unvan }}">
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
                                            <label class="control-label">Fatura Numarası </label>
                                            <input required name="fnumarasi" type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Açıklama</label>
                                            <input  name="aciklama" type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Fatura Tarihi</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                </div>
                                                <input required type="text"
                                                       value="{{\Carbon\Carbon::now()->format('Y-m-d') }}"
                                                       class="form-control pull-right datepicker" name="tarih">
                                            </div>
                                        </div>


                                        <div class="modal fade" id="modal1">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"> Bakım Faturası Ekle</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <div class="row">
                                        <!-- /.modal -->


                                        <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="card-body p-0" style="max-height : 300px;overflow-y: auto;">
                                                                        <table class="table table-condensed" >
                                                                            <thead>
                                                                            <tr>
                                                                                <th style="width: 10px">Seç</th>
                                                                                <th>Apartman Adı</th>
                                                                                <th>Blok</th>
                                                                                <th>Bakım Tarih</th>
{{--                                                                                <th>Bakım id</th>--}}

                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach($bakimlar as $key=>$value)

                                                                                      @if(!$value->fatura_no)

                                                                                    <tr>

                                                                                        <td><input id="bakimid" type="checkbox" value="{{\Carbon\Carbon::parse($value->created_at)->monthName}} ,{{$value->apartman}},{{$value->blok}},{{$value->bakim_ucreti}},{{$value->id}}"
                                                                                                   name="bakim"></td>
                                                                                        <td>{{$value->apartman}}</td>
                                                                                        <td>{{$value->blok}}</td>
                                                                                        <td>{{$value->created_at}}</td>
    {{--                                                                                    <td></td>--}}
                                                                                    </tr>
                                                                                        @endif
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>


                                                                    {{--                                                                    <label>Multiple</label>--}}
                                                                    {{--                                                                    <select name="bakim[]" class="form-control select2" multiple="multiple" data-placeholder="Select a State"--}}
                                                                    {{--                                                                            style="width: 100%;">--}}

                                                                    {{--                                                                    @foreach($asansor as $value)--}}
                                                                    {{--                                                                                        <option value="{{$value->asansor_id}}">{{$value->apartman}} --> Oluşturma Tarihi: {{$value->created_at}}</option>--}}
                                                                    {{--                                                                                    @endforeach--}}
                                                                    {{--                                                                    </select>--}}
                                                                </div>
                                                            </div>




                                                        </div>


                                                    </div>

                                                    <div class="modal-footer">



                                                        <button type="button" class="btn btn-success tx-13" id="buttontamam"  data-dismiss="modal" value="durum">Tamam
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


{{--                                        Data Model '--}}



                                        <div class="modal fade" id="modal2">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Parça Ekle</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <!-- /.modal -->


                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="card-body p-0" style="max-height : 300px;overflow-y: auto;">
                                                                        <table class="table table-condensed" >
                                                                            <thead>
                                                                            <tr>
                                                                                <th style="width: 10px">Seç</th>
                                                                                <th>Parça</th>
                                                                                <th>Miktar</th>
                                                                                <th>Birim</th>
                                                                                <th>Değişim Şekli</th>
                                                                                <th>Parça Değişim Tarih</th>
                                                                                <th>Apartman</th>

                                                                                {{--                                                                                <th>Bakım id</th>--}}

                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                            @foreach($parcalar as $key=>$value)
                                                                                @if(!$value->fatura_no)


{{--                                                                            {{$value->parca}}--}}
                                                                                    <tr>
                                                                                        <td><input id="bakimid" type="checkbox" value="{{$value->parca}},{{$value->miktar}},{{$value->birim}},{{$value->id}}"
                                                                                                   name="bakim"></td>
                                                                                        <td>{{$value->parca}}</td>
                                                                                        <td>{{$value->miktar}}</td>
                                                                                        <td>{{$value->birim}}</td>
                                                                                        <td>{{$value->sekil}}</td>
                                                                                        <td>{{$value->tarih}}</td>
                                                                                        <td>{{$value->apartman}} {{$value->blok}}</td>


                                                                                        {{--                                                                                    <td></td>--}}
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>


                                                                    {{--                                                                    <label>Multiple</label>--}}
                                                                    {{--                                                                    <select name="bakim[]" class="form-control select2" multiple="multiple" data-placeholder="Select a State"--}}
                                                                    {{--                                                                            style="width: 100%;">--}}

                                                                    {{--                                                                    @foreach($asansor as $value)--}}
                                                                    {{--                                                                                        <option value="{{$value->asansor_id}}">{{$value->apartman}} --> Oluşturma Tarihi: {{$value->created_at}}</option>--}}
                                                                    {{--                                                                                    @endforeach--}}
                                                                    {{--                                                                    </select>--}}
                                                                </div>
                                                            </div>



                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">



                                                        <button type="button" class="btn btn-success tx-13" id="buttontamam2"  data-dismiss="modal" value="durum">Tamam
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="modal fade" id="modal3">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Revizyon Ekle</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <!-- /.modal -->

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="card-body p-0" style="max-height : 300px;overflow-y: auto;">
                                                                        <table class="table table-condensed" >
                                                                            <thead>
                                                                            <tr>
                                                                                <th style="width: 10px">Seç</th>
                                                                                <th>Apartman Adı</th>
                                                                                <th>Blok</th>
                                                                                <th>Genel Toplam</th>
                                                                                <th>Revizyon Tarih</th>
                                                                                {{--                                                                                <th>Bakım id</th>--}}

                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach($revizyon as $key=>$value)


                                                                                    <tr>

                                                                                        <td><input id="bakimid" type="checkbox"
                                                                                                   value="{{$value->gentoplam.','.$value->apartman.' '.$value->blok.','.$value->id}}"
                                                                                                   name="bakim"></td>
                                                                                        <td>{{$value->apartman}}</td>
                                                                                        <td>{{$value->blok}}</td>
                                                                                        <td>{{$value->gentoplam}}</td>
                                                                                        <td>{{$value->tarih}}</td>
                                                                                        {{--                                                                                    <td></td>--}}
                                                                                    </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>


                                                                    {{--                                                                    <label>Multiple</label>--}}
                                                                    {{--                                                                    <select name="bakim[]" class="form-control select2" multiple="multiple" data-placeholder="Select a State"--}}
                                                                    {{--                                                                            style="width: 100%;">--}}

                                                                    {{--                                                                    @foreach($asansor as $value)--}}
                                                                    {{--                                                                                        <option value="{{$value->asansor_id}}">{{$value->apartman}} --> Oluşturma Tarihi: {{$value->created_at}}</option>--}}
                                                                    {{--                                                                                    @endforeach--}}
                                                                    {{--                                                                    </select>--}}
                                                                </div>
                                                            </div>



                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">



                                                        <button type="button" class="btn btn-success tx-13" id="buttontamam3"  data-dismiss="modal" value="durum">Tamam
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        End Of Data Model '--}}

                                    </div>
                                    <div class="btn-group form-group">
{{--                                        <div class="form-group col-2">--}}
                                            <button style=" border-color: #e7e7e7;" type="button" id="clearcb" data-toggle="modal" data-target="#modal1"
                                                    class="btn btn-md pd-x-15 btn-success btn-uppercase mg-l-5"><i
                                                    data-feather="database" class="wd-10 mg-r-5"></i>Bakım Faturası Ekle
                                            </button>
{{--                                        </div>--}}

{{--                                        <div class="form-group col-2">--}}
                                        <button type="button" style=" border-color: #e7e7e7;" id="clearcb2" data-toggle="modal" data-target="#modal2"
                                                class="btn btn-md pd-x-15 btn-success btn-uppercase mg-l-5"><i
                                                data-feather="database" class="wd-10 mg-r-5"></i>Parça Faturası Ekle
                                        </button>
                                        <button type="button" style=" border-color: #e7e7e7;" id="clearcb3" data-toggle="modal" data-target="#modal3"
                                                class="btn btn-md pd-x-15 btn-success btn-uppercase mg-l-5"><i
                                                data-feather="database" class="wd-10 mg-r-5"></i>Revizyon Faturası Ekle
                                        </button>
{{--                                    </div>--}}

                                    </div>

                                    <!-- Table row -->
                                    <div class="row">
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

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.col -->


                                    </div>

                                    <div class="row float-right mb-5">
                                        <button id="yeniEkle" class="btn btn-info" type="button">Yeni Satır Ekle
                                        </button>

                                    </div>
                                    <!-- /.row -->

                                    <br><br>
                                    <div class="row mt-5">
                                        <div class="col-9">

                                        </div>
                                        <div class="col-3 text-right">
                                            <div>
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <th style="width:150px">Toplam</th>
                                                        <td><input type="number" id="toplam" class="form-control"
                                                                   readonly name="alttoplam"
                                                                   value=""></td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <label for="kdvsec">KDV &nbsp</label>
                                                            <select class="form-control-sm"  id="kdvsec" name="kdvsec">
                                                                <option value="0">0</option>
                                                                <option value="0.18">18</option>
                                                            </select></th>
                                                        <td><input type="number" step="0.01" id="kdv"
                                                                   class="form-control" name="altkdv"
                                                                   readonly value=""></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Genel Toplam</th>
                                                        <td><input type="number" id="gentoplam" class="form-control"
                                                                   name="altgentoplam"
                                                                   readonly value=""></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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


        $('.select2').select2()
        $("#yeniEkle").click(function () {

            var k = $(".sayisay").length;
            $('#myTable').append('<tr><td style="padding: 0px !important;"><input type="text" name="urun[' + k + '][aciklama]" class="form-control"></td><td style="padding: 0px !important;"><input type="number" name="urun[' + k + '][miktar]" id="miktar' + k + '" min="0"  class="form-control hesapla sayisay"></td><td style="padding: 0px !important;"><input type="number" name="urun[' + k + '][fiyat]" id="fiyat' + k + '" min="0" step="0.0001"  class="form-control hesapla"></td><td style="padding: 0px !important;"><input type="number" name="urun[' + k + '][toplam]" id="toplam' + k + '" class="form-control toplamlar" readonly value=""></td><td style="padding: 0px !important; width: 5px"><input type="button" class="btn btn-danger" value="Sil"></td></tr>')


        });
        // $("#buttontamam").click(function() {
        //     alert( "Handler for .click() called." );
        // });
        $("#buttontamam").click(function(){
            // var favorite = [];
            //     $.each($("input[name='bakim']:checked"), function(){
            //         favorite.push($(this).val());
            //     });
            //


            values=[];
            $.each($("input[name='bakim']:checked"),function(){
                if($(this).is(":checked"))
                    values.push($(this).val());
            });




            for (var i = 0 ; i< values.length ; i++){
                var k = $(".sayisay").length;
                var apartman = values[i].split(',')
                $('#myTable').append('<tr><td style="padding: 0px !important;"><input type="text"  hidden name="bakim_ids[]" value="'+apartman[4] +'" ><input type="text" name="urun['+k+'][tur]" value="'+1+'" hidden><input type="text" name="urun['+k+'][myid]" value="'+apartman[4] +'" hidden> <input type="text" value="'+ apartman[0].toUpperCase() +'AYI '+ apartman[1] + `, ${apartman[2]} `+ 'BAKIM HIZMET BEDELI" name="urun[' + k + '][aciklama]" class="form-control"></td><td style="padding: 0px !important;"><input type="number" value="1" name="urun[' + k + '][miktar]" id="miktar' + k + '" min="0"  class="form-control hesapla sayisay"></td><td style="padding: 0px !important;"><input type="number" value="'+apartman[3]+'" name="urun[' + k + '][fiyat]" id="fiyat' + k + '" min="0" step="0.0001"  class="form-control hesapla"></td><td style="padding: 0px !important;"><input type="number" name="urun[' + k + '][toplam]" id="toplam' + k + '" class="form-control toplamlar" readonly value=""></td><td style="padding: 0px !important; width: 5px"><input type="button" class="btn btn-danger" value="Sil"></td></tr>')
                hesapla()
            }



            // alert( favorite.length/* favorite.join(", ")*/);



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

        $("#buttontamam2").click(function(){

            // var favorite = [];
            //     $.each($("input[name='bakim']:checked"), function(){
            //         favorite.push($(this).val());
            //     });
            //


            values=[];
            $.each($("input[name='bakim']:checked"),function(){
                if($(this).is(":checked"))
                    values.push($(this).val());
            });





            for (var i = 0 ; i< values.length ; i++){
                var k = $(".sayisay").length;
                var parca = values[i].split(',')
                // if(typeof  parca[2] == "number")
                //     var birim = parca[2]
                // else
                //     alert(typeof  parca[2])

                // var birim = 1
                $('#myTable').append('<tr><td style="padding: 0px !important;"><input type="text" name="parca_ids[]" value="'+parca[3] +'" hidden><input type="text" name="urun['+k+'][myid]" value="'+parca[3] +'" hidden><input type="text" name="urun['+k+'][tur]" value="'+2+'" hidden> <input type="text" value="'+  parca[0] +', '+parca[1]+' ' +parca[2] + ' PARÇA BEDELİ" name="urun[' + k + '][aciklama]" class="form-control"></td><td style="padding: 0px !important;"><input type="number" value="'+parca[1]+'" name="urun[' + k + '][miktar]" id="miktar' + k + '" min="0"  class="form-control hesapla sayisay"></td><td style="padding: 0px !important;"><input type="number" value="1" name="urun[' + k + '][fiyat]" id="fiyat' + k + '" min="0" step="0.0001"   class="form-control hesapla"></td><td style="padding: 0px !important;"><input type="number" name="urun[' + k + '][toplam]" id="toplam' + k + '" class="form-control toplamlar" readonly value=""></td><td style="padding: 0px !important; width: 5px"><input type="button" class="btn btn-danger" value="Sil"></td></tr>')
                hesapla()
            }

            // alert( favorite.length/* favorite.join(", ")*/);



        });
        $("#buttontamam3").click(function(){

            // var favorite = [];
            //     $.each($("input[name='bakim']:checked"), function(){
            //         favorite.push($(this).val());
            //     });
            //


            values=[];
            $.each($("input[name='bakim']:checked"),function(){
                if($(this).is(":checked"))
                    values.push($(this).val());
            });





            for (var i = 0 ; i< values.length ; i++){
                var k = $(".sayisay").length;
                var parca = values[i].split(',')
                console.log(parca[0])
                // if(typeof  parca[2] == "number")
                //     var birim = parca[2]
                // else
                //     alert(typeof  parca[2])

                // var birim = 1

                $('#myTable').append('<tr>' +
                    '<td style="padding: 0px !important;">' +
                    '<input hidden type="text" name="revizyon_ids[]" value="'+parca[2]+'">' +
                    '<input type="text" value="'+parca[1]+'REVİZYON İŞLEMİ " name="urun[' + k + '][aciklama]" class="form-control"></td>' +
                    '<td style="padding: 0px !important;"><input type="number" value="1"  name="urun[' + k + '][miktar]" id="miktar' + k + '" min="0"  class="form-control hesapla sayisay"></td>' +
                    '<td style="padding: 0px !important;"><input type="number" value="'+parca[0]+'" name="urun[' + k + '][fiyat]" id="fiyat' + k + '" min="0" step="0.0001"  class="form-control hesapla"></td>' +
                    '<td style="padding: 0px !important;"><input type="number" name="urun[' + k + '][toplam]" id="toplam' + k + '" class="form-control toplamlar" readonly value=""></td>' +
                    '<td style="padding: 0px !important; width: 5px"><input type="button" class="btn btn-danger" value="Sil"></td>' +
                    '</tr>')

                hesapla()
            }

            // alert( favorite.length/* favorite.join(", ")*/);



        });






        $("#clearcb").click(function(){

            $('input[type=checkbox]').each(function()
            {
                this.checked = false;
            });
            //
            // for (var i = 0 ; i< values.length ; i++)
            // $('#bakimid').prop('checked', false);

        });
        $("#clearcb2").click(function(){

            $('input[type=checkbox]').each(function()
            {
                this.checked = false;
            });
            //
            // for (var i = 0 ; i< values.length ; i++)
            // $('#bakimid').prop('checked', false);

        });



        $('#myTable').on('click', 'input[type="button"]', function () {
            $(this).closest('tr').remove();
            hesapla();
        });


        $(document).on('input', '.hesapla', function () {


            hesapla()



        });

    </script>
@endpush
