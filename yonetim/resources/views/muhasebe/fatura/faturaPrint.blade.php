<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .subpage {
            padding: 1cm;
            height: 257mm;
        }


        @page {
            size: A4;
            margin: 0;
        }
        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
            }
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }

            #musteri {
                position: absolute;
                height: 200px;
                width: 8cm;
                top: 4cm;
                left: 43px;


            }
            #tarih {
                position: absolute;
                height: 200px;
                width: 100px;
                top: 5.2cm;
                left: 16.2cm;


            }    #yalnız {
                     position: absolute;
                     height: 200px;
                     width: 10cm;
                     top: 21.8cm;
                     left: 5cm;


                 }
            #aciklama {
                     position: absolute;
                     height: 200px;
                     width: 10cm;
                     top: 22.3cm;
                     left: 40px;


                 }    #tablo {
                          position: absolute;
                          height: 13cm;
                          width: 19cm;
                          top: 8.3cm;
                          left: 40px;


                      }
            #toplam {
                position: absolute;
                height: 200px;
                width: 120px;
                top: 21.7cm;
                left: 16.9cm;


            }
        }
    </style>
</head>
<body>

<div class="book">
    <div class="page">
        <div class="subpage">

            <div id="musteri">

                <div>

                     {{$cari->cari_unvan}} {{$cari->ilgili_kisi}}

                </div>
                <div>
                    {{$cari->adres}}
                </div>
                <div>
                    {{$cari->vergi_dairesi}} @if($cari->vergi_dairesi and $cari->vergi_numarasi )/@endif {{$cari->vergi_numarasi}}
                </div>

            </div>
            <div id="tarih">
                <div>
                    05.02.2020
                </div>


            </div>
            <div id="tablo">

                <table style="width:100%">

                    @if($fatura->urun != 'null')
                        @foreach(json_decode($fatura->urun) as $value)
                            <tr>
                                <td style="width: 10.5cm;">{{$value->aciklama}}</td>
                                <td style="width: 3cm;">{{$value->miktar}} ADET</td>
                                <td style="width: 2.5cm;">{{$value->fiyat}} ₺</td>
                                <td style="width: 3cm;">{{$value->toplam}} ₺</td>
                            </tr>
                        @endforeach
                  @endif

                </table>


            </div>


            <div id="yalnız">
                <div>
                   {{$yazi}}
                </div>
             </div>

                 <div id="aciklama">

                <div>

                  @if($fatura->aciklama)Açıklama: {{$fatura->aciklama}}@endif
                </div>

            </div>



            <div id="toplam">
                <div>
                    {{$fatura->toplam}} ₺
                </div>
                <div>
                    {{$fatura->kdv}} ₺
                </div>
                <div>
                    {{$fatura->gentoplam}} ₺
                </div>


            </div>


        </div>
    </div>

</div>


</body>
<script>
    window.onload = function() { window.print(); }
</script>
</html>
