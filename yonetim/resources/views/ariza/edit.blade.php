@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('ariza.update',$ariza->id)}}" method="post" autocomplete="off">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title"><strong>Asansör Kimlik No:</strong> {{App\AsansorModel::find($ariza['asansor_id'])->kimlik}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Apartman Adı</label>
                                        <input type="text" name="baslik" disabled value="{{App\AsansorModel::find($ariza['asansor_id'])->apartman}}"  class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Blok</label>
                                        <input type="text" name="baslik" disabled value="{{App\AsansorModel::find($ariza['asansor_id'])->blok}}"  class="form-control">
                                    </div>
                                    </div>

                                    <label class="control-label">Arıza Türü</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="icindebiri" value=1  @if($ariza->icindebiri==1) checked @endif>
                                                    <label for="customCheckbox1" class="custom-control-label">İçeride Birisi Kalmış</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="fotosel" value=1  @if($ariza->fotosel==1) checked @endif>
                                                    <label for="customCheckbox2" class="custom-control-label">Fotosel Arızası</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox3" name="fotosel" value=1  @if($ariza->lamba==1) checked @endif>
                                                    <label for="customCheckbox3" class="custom-control-label">Kabin İçi Lamba Sürekli Yanıyor</label>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox4" name="calismiyor" value=1 @if($ariza->calismiyor==1) checked @endif >
                                                    <label for="customCheckbox4" class="custom-control-label">Asansör Çalışmıyor, Başka Bilgi Verilmedi</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox5" name="sesgeliyor" value=1  @if($ariza->sesgeliyor==1) checked @endif>
                                                    <label for="customCheckbox5" class="custom-control-label">Ses Geliyor</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox6" name="kapisurtme" value=1  @if($ariza->kapisurtme==1) checked @endif>
                                                    <label for="customCheckbox6" class="custom-control-label">Kapı Sürtmesi</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="control-label">Bunların Dışında</label>
                                            <textarea rows="4" name="disinda" class="form-control" >{{$ariza->disinda}}</textarea>
                                        </div>

                                        <div class="form-group clearfix">
                                            <div class="icheck-danger d-inline">
                                                <input type="checkbox" id="checkboxDanger1" name="buyuk_ariza" @if($ariza->buyuk_ariza!='') checked @endif  value="1">
                                                <label for="checkboxDanger1">
                                                    Arıza Giderilemedi
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="control-label">Not Ekle</label>
                                            <input class="form-control" name="ariza_not" id="ariza_not" type="text" value="{{$ariza->ariza_not}}" >
                                        </div>


                                        <div class="form-group">
                                            <label>Arıza Gideren</label>
                                            <select name="atanan_id" class="form-control" required>
                                                @foreach($user as $key=>$value)
                                                    <option value="{{$value->id}}"
                                                            @if($value->id==$ariza->user_id) selected @endif>
                                                        {{$value->name}}
                                                    </option>
                                                @endforeach

                                            </select>
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
