@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <form action="{{route('revizyon.teklifUpdate',$teklif->id)}}" method="post" autocomplete="off">
                        {{csrf_field()}}
                        <div class="col-md-12">
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-6">
                                        <img src="{{asset('public/images/logo/logo.png')}}" style="margin-top: -10px;">
                                    </div>

                                    <div class="col-6 text-right" style="line-height:10px !important;">
                                        <h4>ÇİFTÇİLER ELK.MAK.İNŞ.TAAH.SAN.TİC.LTD.ŞTİ</h4>
                                        <p>Organize San.Böl.1.Cadde 9.Sokak No:1 </p>
                                        <p>AFYONKARAHİSAR</p>
                                        <p>Tel: 444 1 671 / F.0 272 215 85 23</p>
                                        <p>info@ciftcilerasansor.com.tr / www.cifcilerasansor.com.tr</p>
                                    </div>
                                    <!-- /.col -->
                                    <hr>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-8"></div>

                                    <div class="col-4 text-right" style="line-height:10px !important;">

                                        <div class="form-group-sm">
                                            <label>TARİH : </label>

                                            <input type="date" id="datePicker" class="text-right" name="tarih" value="{{$teklif->tarih}}">
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group-sm">
                                            <label>TARİH : </label>

                                            <input type="date" id="datePicker2" class="text-right" name="rapor_tarihi" value="{{$teklif->rapor_tarihi}}">
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <hr>
                                </div>
                                <!-- info row -->
                                <div class="row">
                                    <div class="col-6 border py-1" style="border-width:2px !important; border-color: rgba(11,46,19,0.73) !important;">
                                        <h3 class="text-center font-weight-bold ">MÜŞTERİ BİLGİLERİ</h3>

                                        <div class="form-group-sm row">
                                            <label for="input1" class="col-sm-3 col-form-label">FİRMA/KURUM ADI</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="input1" name="apartman" value="{{$teklif->musteri}}">
                                            </div>
                                        </div>

                                        <div class="form-group-sm row">
                                            <label for="input2" class="col-sm-3 col-form-label">İLGİLİ KİŞİ</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="input2" name="yonetici" value="{{$teklif->musteri_yetkili}}">
                                            </div>
                                        </div>

                                        <div class="form-group-sm row">
                                            <label for="input3" class="col-sm-3 col-form-label">TELEFON</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="input3" name="yonetici_tel" value="{{$teklif->musteri_tel}}">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.col -->

                                    <div class="col-6 border py-1" style="border-width:2px !important; border-color: rgba(11,46,19,0.73) !important;">
                                        <h3 class="text-center font-weight-bold">ÇİFTÇİLER ASANSÖR</h3>


                                        <div class="form-group-sm row">
                                            <label for="input4" class="col-sm-3 col-form-label">ADI SOYADI</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="input4" name="burak" value="{{$teklif->sirket_yetkili}}">
                                            </div>
                                        </div>

                                        <div class="form-group-sm row">
                                            <label for="input5" class="col-sm-3 col-form-label">GÖREV</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="input5" name="burak_gorev"
                                                       value="{{$teklif->sirket_gorev}}">
                                            </div>
                                        </div>

                                        <div class="form-group-sm row">
                                            <label for="input6" class="col-sm-3 col-form-label">TELEFON</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="burak_tel" id="input6"
                                                       value="{{$teklif->sirket_tel}}">
                                            </div>
                                        </div>


                                        <div class="form-group-sm row">
                                            <label for="input7" class="col-sm-3 col-form-label">E-POSTA</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="input7" name="burak_mail"
                                                       value="{{$teklif->sirket_email}}">
                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row mt-2">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped" id="myTable">
                                            <thead  style="background: #e9ecef;">
                                            <tr>
                                                <th class="text-center">Açıklama</th>
                                                <th style="width: 100px;">Miktar #</th>
                                                <th style="width: 150px;">Birim Fiyat (₺)</th>
                                                <th style="width: 150px;">Toplam Fiyat</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($urun as $key=>$value)
                                                <tr>
                                                    <td><input type="text" class="form-control" name="urun[{{$key}}][aciklama]" value="{{$value->aciklama}}"></td>
                                                    <td><input type="number" id="miktar{{$key}}" min="0" class="form-control hesapla sayisay" name="urun[{{$key}}][miktar]" value="{{$value->miktar}}"></td>
                                                    <td><input type="number" id="fiyat{{$key}}" min="0" step="0.0001"  class="form-control hesapla" name="urun[{{$key}}][fiyat]" value="{{$value->fiyat}}"></td>
                                                    <td><input type="number" id="toplam{{$key}}" class="form-control toplamlar" name="urun[{{$key}}][toplam]" readonly  value="{{$value->toplam}}"></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->


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
                                                    <th style="width:100px">Toplam</th>
                                                    <td><input type="number" id="toplam" class="form-control" readonly name="alttoplam"
                                                               value="{{$teklif->toplam}}"></td>
                                                </tr>
                                                <tr>
                                                    <th>KDV (%18)</th>
                                                    <td><input type="number" step="0.01" id="kdv" class="form-control" name="altkdv"
                                                               readonly value="{{$teklif->kdv}}"></td>
                                                </tr>
                                                <tr>
                                                    <th>Genel Toplam</th>
                                                    <td><input type="number" id="gentoplam" class="form-control" name="altgentoplam"
                                                               readonly value="{{$teklif->gentoplam}}"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <div class="row mb-5">
                                    <div class="col-12">
                                        <h3>TEKLİF KOŞULLARI</h3>
                                        <ol>
                                            <li>Teklifin uygun görülmesi halinde bu belge onaylanıp tarafımıza
                                                ulaştırıldığında sözleşme yerine geçmektedir
                                            </li>
                                            <li>Teklifimizin geçerlilik süresi teklif tarihinden itibaren 10 gündür.
                                            </li>
                                            <li>Teklifimizde yer alan fiyatlar peşin ödeme esasına göre
                                                hazırlanmıştır.
                                            </li>
                                            <li>Son ödeme tarihinde ödenmeyen faturalar için kur ve vade farkı
                                                uygulanır.
                                            </li>
                                        </ol>

                                        <h3>GİZLİLİK KOŞULLARI</h3>
                                        <p style="line-height:5px !important;">Bu teklif ve ekinde sunulan tüm bilgiler,
                                            verildiği kurum için özel olarak hazırlanmış olup sadece teklif verilen'in
                                            kullanımına özeldir.</p>
                                        <p style="line-height:5px !important;">Teklifi veren ve alan dışındaki üçüncü
                                            kurum/şahıslara iletilemez.</p>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-6 border py-1" style="border-width:2px !important; border-color: rgba(11,46,19,0.73) !important;">
                                        <h3 class="text-center font-weight-bold border ">MÜŞTERİ ONAYI</h3>

                                        <p class="text-center">Kaşe İmza</p>
                                        <br><br><br><br><br><br>
                                        <p class="text-center"> TARİH: ………/………/……………</p>
                                    </div>
                                    <!-- /.col -->

                                    <div class="col-6 border py-1" style="border-width:2px !important; border-color: rgba(11,46,19,0.73) !important; overflow:hidden;">
                                        <h3 class="text-center font-weight-bold border">TEKLİF VE ONAY</h3>
                                        <img src="{{asset('public/images/logo/imza.jpg')}}" style="height: 250px; width: 500px;">

                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-12">
                                        <button type="submit" formtarget="_blank" class="btn btn-default" name="action" value="print"><i class="fas fa-print"></i> Yazdır</button>
{{--                                        <button type="button" class="btn btn-primary float-right"--}}
{{--                                                style="margin-right: 5px;">--}}
{{--                                            <i class="fas fa-download"></i>&nbsp PDF Oluştur--}}
{{--                                        </button>--}}
                                    </div>
                                </div>
                            </div>


                        </div>

                    </form>
                </div>

            </div>
        </section>

    </div>

@endsection

@push('scripts')
    <script>

        $(document).on('input', '.hesapla', function () {


            for (k = 0; k < $(".sayisay").length; k++) {

                var miktar = $("#miktar" + k).val();
                var fiyat = $("#fiyat" + k).val();
                var toplam = miktar * fiyat;
                $("#toplam" + k).val(toplam);
            }
            var sum = 0;
            $('.toplamlar').each(function () {
                sum += parseFloat(this.value);
            });
            $("#toplam").val(sum);
            var top = parseFloat($("#toplam").val());
            var kdv = top * 0.18;
            kdv = kdv.toFixed(2).replace(/[.,]00$/, "");
            $("#kdv").val(kdv);

            var gentoplam = top + parseFloat(kdv);

            gentoplam = gentoplam.toFixed(2).replace(/[.,]00$/, "");
            $("#gentoplam").val(gentoplam);


        });

    </script>
@endpush
