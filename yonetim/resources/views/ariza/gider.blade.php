@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('ariza.updateGider',$ariza->id)}}" method="post" autocomplete="off">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title"><strong>Asansör Kimlik
                                            No:</strong> {{App\AsansorModel::find($ariza['asansor_id'])->kimlik}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Apartman Adı</label>
                                            <input type="text" id="GorevBasligi" name="baslik"
                                                   value="{{App\AsansorModel::find($ariza['asansor_id'])->apartman}}"
                                                   disabled class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Blok</label>
                                            <input type="text" id="GorevBasligi" name="baslik"
                                                   value="{{App\AsansorModel::find($ariza['asansor_id'])->blok}}"
                                                   disabled class="form-control">
                                        </div>
                                    </div>

                                    <label class="control-label">Arıza Türü</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox"
                                                           id="customCheckbox1" name="icindebiri" value=1 disabled
                                                           @if($ariza->icindebiri==1) checked @endif>
                                                    <label for="customCheckbox1" class="custom-control-label">İçeride
                                                        Birisi Kalmış</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox"
                                                           id="customCheckbox2" name="fotosel" value=1 disabled
                                                           @if($ariza->fotosel==1) checked @endif>
                                                    <label for="customCheckbox2" class="custom-control-label">Fotosel
                                                        Arızası</label>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox"
                                                           id="customCheckbox4" name="calismiyor" value=1 disabled
                                                           @if($ariza->calismiyor==1) checked @endif>
                                                    <label for="customCheckbox4" class="custom-control-label">Asansör
                                                        Çalışmıyor, Başka Bilgi Verilmedi</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox"
                                                           id="customCheckbox5" name="sesgeliyor" value=1 disabled
                                                           @if($ariza->sesgeliyor==1) checked @endif>
                                                    <label for="customCheckbox5" class="custom-control-label">Ses
                                                        Geliyor</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox"
                                                           id="customCheckbox6" name="kapisurtme" value=1 disabled
                                                           @if($ariza->kapisurtme==1) checked @endif>
                                                    <label for="customCheckbox6" class="custom-control-label">Kapı
                                                        Sürtmesi</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="control-label">Bunların Dışında</label>
                                            <textarea rows="4" name="disinda" class="form-control"
                                                      disabled>{{$ariza->disinda}}</textarea>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <button id="yeniEkle" class="btn btn-info" type="button">Yeni Parça &
                                                Malzeme Ekle
                                            </button>
                                            <div id="urunOzellikAlani"></div>

                                        </div>

                                        <div class="form-group clearfix">
                                            <div class="icheck-danger d-inline">
                                                <input type="checkbox" id="checkboxDanger1" name="buyuk_ariza"  value="1">
                                                <label for="checkboxDanger1">
                                                    Arıza Giderilemedi
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="control-label">Not Ekle</label>
                                            <input class="form-control" name="ariza_not" id="ariza_not" type="text"
                                                   value="{{$ariza->ariza_not}}">
                                        </div>

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
                                                   value="{{App\AsansorModel::find($ariza['asansor_id'])->yonetici_tel}}">


                                        </div>

                                        <label class="control-label">Mesaj</label>
                                        <textarea rows="4" name="mesaj" placeholder="Mesaj Giriniz" class="form-control"
                                                  id="txtMessage">Sayın {{App\AsansorModel::find($ariza['asansor_id'])->yonetici}}, {{App\AsansorModel::find($ariza['asansor_id'])->apartman}}  {{App\AsansorModel::find($ariza['asansor_id'])->blok}} arızası giderilmiştir. Bilgilerinize sunar, iyi günler dileriz. </textarea>
                                    </div>




                                </div>

                        </div>
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

var text = document.getElementById("text");

            $('#checkboxDanger1').change(function(){
                    if($(this).is(':checked')) {
                        // Checkbox is checked..
                        $( "#myCheck" ).prop( "checked", false );
                text.style.display = "none";
                } else {
                    // Checkbox is not checked..
                        $( "#myCheck" ).prop( "checked", true );
                text.style.display = "block";
                    }
                });

        function myFunction() {
            var checkBox = document.getElementById("myCheck");

            var text = document.getElementById("text");

            if (checkBox.checked == true ) {
                text.style.display = "block";
            } else {
                text.style.display = "none";
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
                '<input  type="text" class="form-control" name="parca[' + i + '][ad]"  required></div>';


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
