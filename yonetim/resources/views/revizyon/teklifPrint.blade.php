<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>İş Takip Programı</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Theme style -->

    <link type="text/css" media="all" rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">

    <style>
        @media print {
            #myTable th {
                background-color: #e9ecef !important;
            }
        }

        input {
            border-width: 0px !important;
            border: none !important;
        }

        p {
            line-height: 10px;
        }
    </style>


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->


    <div class="content-wrapper"
         style="height: 1650px; width: 1200px; margin-top: 50px; padding: 20px; position: relative;">
        <!-- Main content -->

        <!-- title row -->
        <div class="row">
            <div class="col-4">
                <img src="{{asset('public/images/logo/logo.png')}}" style="margin-top: -10px;">
            </div>

            <div class="col-8 text-right" style="line-height:10px !important;">
                <h4>ÇİFTÇİLER ELK.MAK.İNŞ.TAAH.SAN.TİC.LTD.ŞTİ</h4>
                <p>Organize San.Böl.1.Cadde 9.Sokak No:1 </p>
                <p>AFYONKARAHİSAR</p>
                <p>Tel: 444 1 671 / F.0 272 215 85 23</p>
                <p>info@ciftcilerasansor.com.tr / www.cifcilerasansor.com.tr</p>
            </div>
            <!-- /.col -->
            <hr>
        </div>

        <div class="row justify-content-end" >
            <div class="col-8"></div>

            <div class="col-4 text-right" style="line-height:10px !important;">

                <div class="form-group-sm">
                    <label>TARİH : </label>

                    <input type="date" id="datePicker" class="text-right" name="tarih" value="{{$tarih}}">
                    <!-- /.input group -->
                </div>
                <div class="form-group-sm">
                    <label>RAPOR TARİHİ : </label>

                    <input type="date" id="datePicker2" class="text-right" name="rapor_tarihi"
                           value="{{$rapor_tarihi}}">
                    <!-- /.input group -->
                </div>

            </div>
            <!-- /.col -->
            <hr>
        </div>
        <!-- info row -->
        <div class="row" style=" margin-top: 30px; margin-bottom: 30px; position: absolute; top: 200px; width:100%;">
            <div class="col-6 border py-1"
                 style="border-width:2px !important; border-color: rgba(11,46,19,0.73) !important;">
                <h3 class="text-center font-weight-bold ">MÜŞTERİ BİLGİLERİ</h3>

                <div class="form-group-sm row">
                    <label for="input1" class="col-sm-3 col-form-label">FİRMA/KURUM ADI</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input1" value="{{$apartman}}">
                    </div>
                </div>

                <div class="form-group-sm row">
                    <label for="input2" class="col-sm-3 col-form-label">İLGİLİ KİŞİ</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input2" value="{{$yonetici}}">
                    </div>
                </div>

                <div class="form-group-sm row">
                    <label for="input3" class="col-sm-3 col-form-label">TELEFON</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input3" value="{{$yonetici_tel}}">
                    </div>
                </div>

            </div>
            <!-- /.col -->

            <div class="col-6 border py-1"
                 style="border-width:2px !important; border-color: rgba(11,46,19,0.73) !important;">
                <h3 class="text-center font-weight-bold">ÇİFTÇİLER ASANSÖR</h3>


                <div class="form-group-sm row">
                    <label for="input4" class="col-sm-3 col-form-label">ADI SOYADI</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input4" value="{{$burak}}">
                    </div>
                </div>

                <div class="form-group-sm row">
                    <label for="input5" class="col-sm-3 col-form-label">GÖREV</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input5" value="{{$burak_gorev}}">
                    </div>
                </div>

                <div class="form-group-sm row">
                    <label for="input6" class="col-sm-3 col-form-label">TELEFON</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input6" value="{{$burak_tel}}">
                    </div>
                </div>


                <div class="form-group-sm row">
                    <label for="input7" class="col-sm-3 col-form-label">E-POSTA</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input7" value="{{$burak_mail}}">
                    </div>
                </div>


            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row border"
             style="border-width:2px !important; border-color: rgba(11,46,19,0.73) !important; position: absolute; bottom: 600px; height: 600px; width:100%;">

            <!-- Table row -->
            <div class="col-12 mt-3 table-responsive">
                <table class="table table-striped" id="myTable">
                    <thead style="background: #e9ecef;">
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
                            <td style="padding: 0px !important;"><input type="text" class="form-control"
                                                                        value="{{$value['aciklama']}}"></td>
                            <td style="padding: 0px !important;"><input type="number" id="miktar0" min="0"
                                                                        class="form-control hesapla sayisay"
                                                                        value="{{$value['miktar']}}"></td>
                            <td style="padding: 0px !important;"><input type="number" id="fiyat0" min="0" step="0.0001"
                                                                        class="form-control hesapla"
                                                                        value="{{$value['fiyat']}}"></td>
                            <td style="padding: 0px !important;"><input type="number" id="toplam0"
                                                                        class="form-control toplamlar"
                                                                        value="{{$value['toplam']}}"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->


            <!-- accepted payments column -->
            <div class="col-8">

            </div>
            <!-- /.col -->
            <div class="col-4 text-right">
                <div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th style="width:150px; padding-top: 20px;">Toplam</th>
                            <td><input type="number" id="toplam" class="form-control" value="{{$alttoplam}}"></td>
                        </tr>
                        <tr>
                            <th style="width:150px; padding-top: 20px; ">KDV (%18)</th>
                            <td><input type="number" step="0.01" id="kdv" class="form-control" value="{{$altkdv}}"></td>
                        </tr>
                        <tr>
                            <th style="width:150px;padding-top: 20px;">Genel Toplam</th>
                            <td><input type="number" id="gentoplam" class="form-control" disabled
                                       value="{{$altgentoplam}}" style="font-size: large; font-weight: bold"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col -->


        </div>
        <!-- /.row -->
        <div class="row" style="position: absolute; bottom: 350px; width:100%;">
            <div class="col-12">
                <h3>TEKLİF KOŞULLARI</h3>
                <ol>
                    <li>Teklifin uygun görülmesi halinde bu belge onaylanıp tarafımıza ulaştırıldığında sözleşme yerine
                        geçmektedir
                    </li>
                    <li>Teklifimizin geçerlilik süresi teklif tarihinden itibaren 10 gündür.</li>
                    <li>Teklifimizde yer alan fiyatlar peşin ödeme esasına göre hazırlanmıştır.</li>
                    <li>Son ödeme tarihinde ödenmeyen faturalar için kur ve vade farkı uygulanır.</li>
                </ol>

                <h3>GİZLİLİK KOŞULLARI</h3>
                <p style="line-height:5px !important;">Bu teklif ve ekinde sunulan tüm bilgiler, verildiği kurum için
                    özel olarak hazırlanmış olup sadece teklif verilen'in kullanımına özeldir.</p>
                <p style="line-height:5px !important;">Teklifi veren ve alan dışındaki üçüncü kurum/şahıslara
                    iletilemez.</p>

            </div>

        </div>

        <div class="row" style="position: absolute; bottom: 0; width:100%; padding: 20px;">
            <div class="col-6 border py-1"
                 style="border-width:2px !important; border-color: rgba(11,46,19,0.73) !important;">
                <h3 class="text-center font-weight-bold border ">MÜŞTERİ ONAYI</h3>

                <p class="text-center">Kaşe İmza</p>
                <br><br><br><br><br>
                <p class="text-center"> TARİH: ………/………/……………</p>
            </div>
            <!-- /.col -->

            <div class="col-6 border py-1"
                 style="border-width:2px !important; border-color: rgba(11,46,19,0.73) !important; padding: 20px; overflow:hidden;">
                <h3 class="text-center font-weight-bold border">TEKLİF VE ONAY</h3>
                <img src="{{asset('public/images/logo/imza.jpg')}}" style="height: 250px; width: 500px;">


            </div>
            <!-- /.col -->
        </div>
        <!-- this row will not appear when printing -->


    </div>


    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Bootstrap 4 -->
<script src="{{asset('public/admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>

</body>
</html>
