@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('muhasebe.cariharaket.update',$cariharaket->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="control-label">Cari Ünvanı</label>
                                            <input type="text" value="{{$cari->cari_unvan}}"  disabled name="cari_unvan" class="form-control">
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label>Tür</label>

                                            <select disabled name="tur" class="form-control" required="">
                                                <option value="1"  @if($cariharaket->tur == 1) selected @endif>
                                                    Tahsilat
                                                </option>
                                                <option value="2" @if($cariharaket->tur == 2) selected @endif>
                                                    Ödeme
                                                </option>

                                            </select>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label class="control-label">Tutar</label>
                                            <input value="{{$cariharaket->tutar}}" type="number" step="0.01" name="tutar" class="form-control">
                                        </div>



                                        <div class="form-group col-md-12">
                                            <label>Ödeme Metotu</label>
                                            <select name="odeme_metot" class="form-control" required="">
                                                <option value="kredi_kart" @if($cariharaket->metot=='kredi_kart') selected @endif>
                                                    Kredi Kartı
                                                </option>
                                                <option value="nakit"  @if($cariharaket->metot=='nakit') selected @endif>
                                                    Nakit
                                                </option>
                                                <option value="eft" @if($cariharaket->metot=='eft') selected @endif>
                                                    EFT
                                                </option>
                                                <option value="multi" @if($cariharaket->metot=='multi') selected @endif>
                                                    Çoklu Ödeme (Kredi Kartı + Nakit)
                                                </option>

                                            </select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Ödeme Tarihi</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                </div>
                                                <input type="text" value="{{$cariharaket->islem_tarih}}" class="form-control pull-right datepicker" name="tarih" >
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="control-label">Açıklama</label>
                                            <input name="aciklama" value="{{$cariharaket->aciklama}}" class="form-control">
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

@endpush
