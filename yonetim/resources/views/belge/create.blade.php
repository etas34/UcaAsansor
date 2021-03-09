@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                         <form action="{{route('belge.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Belge Adı</label>
                                            <input type="text" name="ad" class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Belge Geçerlilik Tarihi</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" name="tarih" >
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-md-6">Hatırlatma Zamanı Seçiniz</label>
                                            <select name="hatirlatma" class="form-control" >
                                                    <option value="15">15 Gün</option>
                                                    <option value="1">1 Ay</option>
                                                    <option value="2">2 Ay</option>
                                                    <option value="3">3 Ay</option>


                                            </select>
                                        </div>
                                    </div>





                                    <div class="form-group">
                                            <label class="control-label">Belge Yükle</label>
                                            <input type="file" name="images"
                                                   class="form-control" id="image-input"
                                                   accept=".zip, .rar, .tiff, .pjp, .pjpeg, .jfif, .webp, .tif, .bmp, .png, .jpeg, .svgz, .jpg, .gif, .svg, .ico, .xbm, .dib">
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
