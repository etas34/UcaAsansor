@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                         <form action="{{route('belge.update',$belge->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Belge Adı</label>
                                            <input type="text"name="ad"  value="{{$belge->ad }} "  class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Belge Geçerlilik Tarihi</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                </div>
                                                <input type="text"  value="{{$belge->gecerlilik }} "  class="form-control pull-right datepicker" name="tarih" >
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-md-6">Hatırlatma Ayı Seçiniz</label>
                                            <select name="hatirlatma" class="form-control" >
                                                    <option @if($belge->hatirlatma == 15 ) selected @endif value="15">15 Gün</option>
                                                    <option @if($belge->hatirlatma == 1 ) selected @endif value="1">1 Ay</option>
                                                    <option @if($belge->hatirlatma == 2 ) selected @endif  value="2">2 Ay</option>
                                                    <option  @if($belge->hatirlatma == 3 ) selected @endif  value="3">3 Ay</option>


                                            </select>
                                        </div>
                                    </div>





                                    <div class="form-group">
                                            <label class="control-label">Belge Yükle</label>
                                            <input type="file" name="images" class="form-control" id="image-input"
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
