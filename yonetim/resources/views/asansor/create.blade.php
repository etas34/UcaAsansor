@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('asansor.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title">Yeni Asansör Ekle</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-between">
                                        <div class="col-md-6">
                                            <h5 style="font-weight: bold">Gerekli Bilgiler</h5>
                                            <div class="form-group">
                                                <label class="control-label">Asansör Kimlik Numarası</label>
                                                <input type="text" placeholder="123456789/01"  id="kimlik_no" name="kimlik" required class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Apartman Adı</label>
                                                <input type="text" name="apartman" required class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Blok ve Asansör Numarası</label>
                                                <input type="text" name="blok" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Yönetici</label>
                                                <input type="text" name="yonetici" class="form-control">
                                            </div>


                                            <div class="form-group">
                                                <label>Yönetici Telefon</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="(532)777-8899"
                                                           name="yonetici_tel"
                                                           data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;"
                                                           data-mask="" im-insert="true">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Adres</label>
                                                <textarea rows="3" name="adres" class="form-control"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Bölge</label>
                                                <select name="bolge_id" class="form-control" >
                                                    <option value=""  selected>Bölge Seçiniz</option>

                                                    @foreach($bolge as $key=>$value)
                                                        <option value="{{$value->id}}">{{$value->ad}}</option>
                                                    @endforeach

                                                </select>
                                            </div>


{{--                                            <div class="form-group">--}}
{{--                                                <label>Son Aylık Bakım Zamanı</label>--}}

{{--                                                <div class="input-group date">--}}
{{--                                                    <div class="input-group-addon">--}}
{{--                                                    </div>--}}
{{--                                                    <input type="text" class="form-control pull-right datepicker"--}}
{{--                                                           name="aylik_bakim"--}}
{{--                                                           value="2020-01-01">--}}
{{--                                                </div>--}}
{{--                                                <!-- /.input group -->--}}
{{--                                            </div>--}}


                                            <div class="form-group">
                                                <label>Bir Sonraki Kontrol/Revizyon Tarihi</label>

                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                    </div>
                                                    <input type="text" class="form-control pull-right datepicker"
                                                           name="etiket_tarihi"
                                                           value="">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Bakım Ücreti</label>
                                                <input type="number" name="bakim_ucreti"  class="form-control">
                                            </div>


                                        </div>
                                        <div class="col-md-5">

                                            <h5 style="font-weight: bold">Ek Bilgiler</h5>

                                            <div class="form-group">
                                                <label class="control-label">Üretici</label>
                                                <input type="text" name="uretici"  class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Üretim Tarihi</label>

                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                    </div>
                                                    <input type="text" class="form-control pull-right datepicker"
                                                           name="uretim_tarihi"
                                                           value="">
                                                </div>
                                                <!-- /.input group -->
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Motor Marka</label>
                                                <input type="text" name="motor_marka"  class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Kapı Marka</label>
                                                <input type="text" name="kapi_marka"  class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Pano Marka</label>
                                                <input type="text" name="pano_marka"  class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Kaç Kişilik</label>
                                                <input type="number" name="kisilik"  class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" checked id="customRadio1" name="hidrolik" value="0">
                                                    <label for="customRadio1"  class="custom-control-label">Elektrikli Asansör</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio2" name="hidrolik" value="1">
                                                    <label for="customRadio2" class="custom-control-label">Hidrolik Asansör</label>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label>Bakımcı</label>
                                                <select name="bakimci_id" class="form-control" >
                                                    <option value=""  selected>Bakımcı Seçiniz</option>
                                                    @foreach($user as $key=>$value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Fotoğraf Yükle</label>
                                                <input type="file" name="images[]" multiple class="form-control" id="image-input"
                                                       accept="image/*">
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
