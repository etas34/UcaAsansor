@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('bakim.update',$bakim->id)}}" method="post" autocomplete="off">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title"><strong>Asansör Kimlik No:</strong> {{App\AsansorModel::find($bakim['asansor_id'])->kimlik}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Apartman Adı</label>
                                        <input type="text" id="GorevBasligi" name="baslik" value="{{App\AsansorModel::find($bakim['asansor_id'])->apartman}}" disabled class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Blok</label>
                                        <input type="text" id="GorevBasligi" name="baslik" value="{{App\AsansorModel::find($bakim['asansor_id'])->blok}}" disabled class="form-control">
                                    </div>
                                    </div>

{{--                                    <label class="control-label">Yapılan İşlemler</label>--}}
                                    <div class="row">
{{--                                        <div class="col-md-6">--}}
{{--                                            <!-- checkbox -->--}}
{{--                                            <div class="form-group">--}}
{{--                                                <div class="custom-control custom-checkbox">--}}
{{--                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="yag" value=1 @if($bakim->yag==1) checked @endif>--}}
{{--                                                    <label for="customCheckbox1" class="custom-control-label">Yağlama</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="custom-control custom-checkbox">--}}
{{--                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="makina" value=1  @if($bakim->makina==1) checked @endif>--}}
{{--                                                    <label for="customCheckbox2" class="custom-control-label">Makina Daire Temizlik - Kontrol</label>--}}
{{--                                                </div>--}}

{{--                                                <div class="custom-control custom-checkbox">--}}
{{--                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox3" name="kabin" value=1  @if($bakim->kabin==1) checked @endif>--}}
{{--                                                    <label for="customCheckbox3" class="custom-control-label">Kabin İçi Temizlik - Kontrol</label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


{{--                                        <div class="col-md-6">--}}
{{--                                            <!-- checkbox -->--}}
{{--                                            <div class="form-group">--}}
{{--                                                <div class="custom-control custom-checkbox">--}}
{{--                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox4" name="pano" value=1  @if($bakim->pano==1) checked @endif>--}}
{{--                                                    <label for="customCheckbox4" class="custom-control-label">Pano İçi Temizlik - Kontrol </label>--}}
{{--                                                </div>--}}
{{--                                                <div class="custom-control custom-checkbox">--}}
{{--                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox5" name="kuyu" value=1  @if($bakim->kuyu==1) checked @endif>--}}
{{--                                                    <label for="customCheckbox5" class="custom-control-label">Kuyu Dibi Temizlik - Kontrol</label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


                                        <div class="form-group col-md-12 custom-control custom-checkbox ml-2">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="yag" checked disabled value=1>
                                            <label for="customCheckbox1" class="custom-control-label">Bakım Yapıldı</label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label">Ekstra Yapılanlar</label>
                                            <textarea rows="4" name="ekstra" class="form-control">{{$bakim->ekstra}}</textarea>
                                        </div>
                                      <div class="form-group col-md-12">
                                            <label class="control-label">Fatura Numarası</label>
                                          <input type="text" name="fnumara" value="{{$bakim->fatura_no}}" class="form-control">

                                      </div>

                                    </div>
                                        @if($bakim->images!='')
                                        <label class="control-label">Fotoğraflar</label>
                                        <div class="row">

                                            @foreach(explode(';', $bakim->images) as $image)
                                                <div class="form-group col-md-4">
                                                    <img src="{{$image}}" />
                                                </div>
                                            @endforeach
                                        </div>

                                        @endif
                                        <div class="form-group">
                                            <label>Bakım Yapan</label>
                                            <select name="user_id" class="form-control" required>
                                                @foreach($user as $key=>$value)
                                                    <option value="{{$value->id}}"
                                                            @if($value->id==$bakim->user_id) selected @endif>
                                                        {{$value->name}}
                                                    </option>
                                                @endforeach

                                            </select>
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
