@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('parca.store',$asansor->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
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



                                        <div class="form-group">
                                            <label>Değiştirme Tarihi</label>
                                            <input type="text" name="tarih" class="form-control" id="tarih" value="" />
                                        </div>


                                        <div class="form-group">
                                            <button id="yeniEkle" class="btn btn-info" type="button">Yeni Parça & Malzeme Ekle</button>
                                            <div id="urunOzellikAlani"></div>

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Değiştirilme Şekli</label>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio1" name="sekil" required value="Arıza">
                                                <label for="customRadio1" class="custom-control-label">Arıza Sırasında</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio2" name="sekil"  value="Bakım">
                                                <label for="customRadio2" class="custom-control-label">Bakım Sırasında</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio3" name="sekil" value="Diğer">
                                                <label for="customRadio3" class="custom-control-label">Diğer</label>
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

        var dateNow = new Date();
        $('#tarih').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            defaultDate:dateNow,
            locale: {
                format: 'YYYY-MM-DD',
                language: 'tr'
            }
        });


        $('body').on("click", "#removeitem", function () {
            $(this).closest(".items").remove();
        });



    </script>
@endpush
