@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('bakim.store',$asansor->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title"><strong>Asansör Kimlik No:</strong> {{$asansor->kimlik}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Apartman Adı</label>
                                            <input type="text" name="baslik" value="{{$asansor->apartman}}" disabled
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Blok</label>
                                            <input type="text" name="baslik" value="{{$asansor->blok}}" disabled
                                                   class="form-control">
                                        </div>
                                    </div>

                                    {{--                                    <label class="control-label">Yapılan İşlemler</label>--}}
                                    <div class="row">
                                    {{--                                        <div class="col-md-6">--}}
                                    <!-- checkbox -->
                                        {{--                                            <div class="form-group">--}}
                                        {{--                                                <div class="custom-control custom-checkbox">--}}
                                        {{--                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="yag" checked value=1>--}}
                                        {{--                                                    <label for="customCheckbox1" class="custom-control-label">Bakım Yapıldı</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="custom-control custom-checkbox">--}}
                                        {{--                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="makina" checked value=1>--}}
                                        {{--                                                    <label for="customCheckbox2" class="custom-control-label">Makina Daire Temizlik - Kontrol</label>--}}
                                        {{--                                                </div>--}}

                                        {{--                                                <div class="custom-control custom-checkbox">--}}
                                        {{--                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox3" name="kabin" checked value=1>--}}
                                        {{--                                                    <label for="customCheckbox3" class="custom-control-label">Kabin İçi Temizlik - Kontrol</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}


                                        {{--                                        <div class="col-md-6">--}}
                                        {{--                                            <!-- checkbox -->--}}
                                        {{--                                            <div class="form-group">--}}
                                        {{--                                                <div class="custom-control custom-checkbox">--}}
                                        {{--                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox4" name="pano" checked value=1 >--}}
                                        {{--                                                    <label for="customCheckbox4" class="custom-control-label">Pano İçi Temizlik - Kontrol </label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="custom-control custom-checkbox">--}}
                                        {{--                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox5" name="kuyu" checked value=1 >--}}
                                        {{--                                                    <label for="customCheckbox5" class="custom-control-label">Kuyu Dibi Temizlik - Kontrol</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}


                                        <div class="form-group col-md-12 custom-control custom-checkbox ml-2">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox1"
                                                   name="yag" checked disabled value=1>
                                            <label for="customCheckbox1" class="custom-control-label">Bakım
                                                Yapıldı</label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label">Ekstra Yapılanlar</label>
                                            <textarea rows="4" name="ekstra" class="form-control"></textarea>
                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <button id="yeniEkle" class="btn btn-info" type="button">Yeni Parça & Malzeme Ekle</button>
                                        <div id="urunOzellikAlani"></div>

                                    </div>


                                    <div class="form-group">
                                            <label class="control-label">Fotoğraf Yükle</label>
                                            <input type="file" name="images[]" multiple class="form-control" id="image-input"
                                                   accept="image/*">
                                        </div>


                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="myCheck"
                                               onclick="myFunction()" checked=true name="CbMesaj">
                                        <label for="myCheck" class="custom-control-label">Yöneticiye Mesaj
                                            Gönder</label>
                                    </div>
                                    <div class="form-group" id="text">
                                        <label>Yönetici Telefon</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="(532)777-8899"
                                                   name="yonetici_tel"
                                                   data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;"
                                                   data-mask="" im-insert="true"
                                                   value="{{$asansor->yonetici_tel}}">


                                        </div>

                                        <label class="control-label">Mesaj</label>
                                        <textarea rows="4" name="mesaj" placeholder="Mesaj Giriniz" class="form-control"
                                                  id="txtMessage">Sayın {{$asansor->yonetici}}, {{$asansor->apartman}}  {{$asansor->blok}} 'nin aylık periyodik bakımı yapılmıştır. Asansörünüzün bakım ve arıza geçmişini görmek için http://ucaasansor.net/asansor.php?q={{$asansor['kimlik']}}   Uca Asansör </textarea>
                                    </div>




                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="myCheck2"
                                               onclick="myFunction2()"  name="CbMesaj2">
                                        <label for="myCheck2" class="custom-control-label">Tahsilat Ekle</label>
                                    </div>
                                    <div id="text2" style="display: none">

                                        <div class="form-group col-md-12">
                                            <label class="control-label">Tutar</label>
                                            <input type="number" step="0.01" required name="tutar" value="{{$asansor->bakim_ucreti}}" class="form-control">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="control-label">Açıklama</label>
                                            <input name="aciklama" class="form-control" value="{{$asansor->apartman}} {{$asansor->blok}} {{ \Carbon\Carbon::now()->monthName}} Ayı Bakım Ücreti">
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{$asansor->cari_id}}" id="cari_id">



                                    <div class="preview-area row"></div>



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
        var inputLocalFont = document.getElementById("image-input");
        inputLocalFont.addEventListener("change",previewImages,false);
        function previewImages(){

            $('.preview-area').empty();
            var fileList = this.files;

            var anyWindow = window.URL || window.webkitURL;

            for(var i = 0; i < fileList.length; i++){
                var objectUrl = anyWindow.createObjectURL(fileList[i]);
                $('.preview-area').append('<div class="col-md-3"><img height="400px" width="400px" src="' + objectUrl + '" /></div>');
                window.URL.revokeObjectURL(fileList[i]);
            }


        }

    </script>

    <script>



        function myFunction() {
            var checkBox = document.getElementById("myCheck");

            var text = document.getElementById("text");

            if (checkBox.checked == true ) {
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
        }

        function myFunction2() {
            var checkBox2 = document.getElementById("myCheck2");
            var cari_id = document.getElementById("cari_id").value;
            if(cari_id=='')
            {
                alert('Asansöre Ait Cari Kaydı Yok')
                checkBox2.checked=false;
                return false;
            }
            else {
                var text2 = document.getElementById("text2");

                if (checkBox2.checked == true ) {
                    text2.style.display = "block";
                } else {
                    text2.style.display = "none";
                }

            }


        }

        function enableDisable(bEnable, textBoxID)
        {
            document.getElementById(textBoxID).disabled = !bEnable
        }

        var i = $(".items").length;
        $("#yeniEkle").click(function () {

            var temp = '<div class="items row">  <div class="col-md-6">' +
                '<label>Parça Adı- Markası - Modeli</label>' +
                '<input  type="text" class="form-control" name="parca[' + i + '][ad]"  required></div>' ;



            temp += '<div class="col-md-2"><label>Miktar</label>' +
                '<input  type="number" class="form-control" name="parca[' + i + '][miktar]" step="0.01"  required></div>' +
                '<div class="col-md-2"><label>Birim (Adet-Lt-Paket vs.)</label>' +
                '<input  type="text" class="form-control" name="parca[' + i + '][birim]"  required></div>' +
                '<div class="col-md-2">' +
                '<button type="button" id="removeitem" class="btn btn-danger" style="margin-top:28px;">Sil</button> ' +
                '</div></div>';
            $("#urunOzellikAlani").append(temp);

            i++;

        });

        $('body').on("click", "#removeitem", function () {
            $(this).closest(".items").remove();
        });



    </script>
@endpush
