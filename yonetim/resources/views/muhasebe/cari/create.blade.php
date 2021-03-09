@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                         <form action="{{route('muhasebe.cari.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="control-label">Cari Ünvanı</label>
                                            <input type="text" required name="cari_unvan" class="form-control">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Adres</label>
                                           <textarea rows="2" name="adres" class="form-control" lt-auto-check="true" spellcheck="false"> </textarea>
                                        </div>



                                        <div class="form-group col-md-6">
                                            <label class="control-label">İlgili Kişi</label>
                                            <input type="text" name="ilgili_kisi" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label>İlgili Telefon</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="(532)777-8899"
                                                           name="tel"
                                                           data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;"
                                                           data-mask="" im-insert="true">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group col-md-6">
                                            <label class="control-label">Borç Bakiyesi</label>
                                            <input type="number"  step="0.01" name="borc_bakiye" class="form-control">
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label class="control-label">Alacak Bakiyesi</label>
                                            <input type="number"  step="0.01" name="alacak_bakiye" class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="control-label">Vergi Dairesi</label>
                                            <input type="text"  name="vergi_dairesi" class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="control-label">Vergi Numarası</label>
                                            <input type="number" name="vergi_numarasi" class="form-control">





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
