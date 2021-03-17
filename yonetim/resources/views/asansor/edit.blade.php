@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('asansor.update',$asansor->id)}}" method="post" autocomplete="off"  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title">Asansör Düzenle</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-between">
                                        <div class="col-md-6">
                                            <h5 style="font-weight: bold">Gerekli Bilgiler</h5>
                                            <div class="form-group">
                                                <label class="control-label">Asansör Kimlik Numarası</label>
                                                <input type="text" name="kimlik" placeholder="123456789/01"  id="kimlik_no" required class="form-control" value="{{$asansor->kimlik}}">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Apartman Adı</label>
                                                <input type="text" name="apartman" required class="form-control"  value="{{$asansor->apartman}}">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Blok ve Asansör Numarası</label>
                                                <input type="text" name="blok" class="form-control"  value="{{$asansor->blok}}">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Yönetici</label>
                                                <input type="text" name="yonetici" class="form-control"  value="{{$asansor->yonetici}}">
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
                                                           data-mask="" im-insert="true"  value="{{$asansor->yonetici_tel}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Adres</label>
                                                <textarea rows="3" name="adres" class="form-control"> {{$asansor->adres}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Bölge</label>
                                                <select name="bolge_id" class="form-control" >
                                                    <option value=""  selected>Bölge Seçiniz</option>

                                                    @foreach($bolge as $key=>$value)
                                                        <option value="{{$value->id}}" @if($value->id==$asansor->bolge_id) selected @endif>{{$value->ad}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            {{--
                                           <div class="form-group">
                                                <label>Son Aylık Bakım Zamanı</label>

                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                    </div>
                                                    <input type="text" class="form-control pull-right datepicker"
                                                           name="aylik_bakim"
                                                           value="{{$asansor->aylik_bakim}}">
                                                </div>
                                                &lt;!&ndash; /.input group &ndash;&gt;
                                            </div>
--}}


                                            <div class="form-group">
                                                <label>Bir Sonraki Kontrol/Revizyon Tarihi</label>

                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                    </div>
                                                    <input type="text" class="form-control pull-right datepicker"
                                                           name="etiket_tarihi"
                                                           value="{{$asansor->etiket_tarihi}}">
                                                </div>
                                                <!-- /.input group -->
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Bakım Ücreti</label>
                                                <input type="number" name="bakim_ucreti" value="{{$asansor->bakim_ucreti}}"  class="form-control">
                                            </div>


                                        </div>
                                        <div class="col-md-5">

                                            <h5 style="font-weight: bold">Ek Bilgiler</h5>

                                            <div class="form-group">
                                                <label class="control-label">Üretici</label>
                                                <input type="text" name="uretici"  class="form-control" value="{{$ekbilgiler['uretici']}}">
                                            </div>

                                            <div class="form-group">
                                                <label>Üretim Tarihi</label>

                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                    </div>
                                                    <input type="text" class="form-control pull-right datepicker"
                                                           name="uretim_tarihi"
                                                           value="{{$ekbilgiler['uretim_tarihi']}}">
                                                </div>
                                                <!-- /.input group -->
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Motor Marka</label>
                                                <input type="text" name="motor_marka"  class="form-control" value="{{$ekbilgiler['motor_marka']}}">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Kapı Marka</label>
                                                <input type="text" name="kapi_marka"  class="form-control" value="{{$ekbilgiler['kapi_marka']}}">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Pano Marka</label>
                                                <input type="text" name="pano_marka"  class="form-control" value="{{$ekbilgiler['pano_marka']}}">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Kaç Kişilik</label>
                                                <input type="number" name="kisilik"  class="form-control" value="{{$ekbilgiler['kisilik']}}">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio1" name="hidrolik" value="0" @if($ekbilgiler['hidrolik']==0) checked @endif>
                                                    <label for="customRadio1" class="custom-control-label">Elektrikli Asansör</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio2" name="hidrolik" value="1" @if($ekbilgiler['hidrolik']==1) checked @endif>
                                                    <label for="customRadio2" class="custom-control-label">Hidrolik Asansör</label>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label>Bakımcı</label>
                                                <select name="bakimci_id" class="form-control" >
                                                    <option value=""  selected>Bakımcı Seçiniz</option>
                                                    @foreach($user as $key=>$value)
                                                        <option value="{{$value->id}}" @if($value->id==$asansor->bakimci_id) selected @endif
                                                        >{{$value->name}}</option>
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
                                    <div class="row justify-content-between">
                                        <div class="col-md-12">

                                            @if($ekbilgiler->images!='')
                                                <label class="control-label">Fotoğraflar</label>
                                                <div class="row">

                                                    @foreach(explode(';', $ekbilgiler->images) as $key=>$image)
                                                        <div class="form-group col-md-4">
                                                            <a target="_blank" href="{{asset($image)}}"><img height="400px" width="400px" src="{{asset($image)}}"/></a>

                                                            <a href="javascript:void(0)" data-id="{{$key}}" class="btn btn-block btn-danger mt-1 sil_btn" >Sil</a>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            @endif
                                            <input type="hidden" name="sil_ids" id="sil_ids">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer pull-right">
                                    <input type="submit" class="btn btn-success px-5 float-right" value="Düzenle">
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
        var sil_ids=[];
    $('.sil_btn').click(function(){

        sil_ids.push($(this).attr("data-id"));
        $('#sil_ids').val(sil_ids);
        $(this).closest('.form-group').remove();


    });
    </script>




    @endpush

