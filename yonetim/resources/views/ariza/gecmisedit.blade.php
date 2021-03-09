@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('ariza.gecmisUpdate',$ariza->id)}}" method="post" autocomplete="off">
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
                                                           @if($ariza->calismiyor==1) checked @endif >
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
                                                           id="customCheckbox6" name="baskaariza" value=1 disabled
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


                                        <div class="form-group col-md-12 py-2">
                                            <label class="control-label">Not Ekle</label>
                                            <input class="form-control" name="ariza_not" type="text"
                                                   value="{{$ariza->ariza_not}}">
                                        </div>
                                        <div class="form-group col-md-2 mb-3">
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

                                        @if(!$parca->isEmpty())
                                            <div class="card col-md-12 py-3">
                                                <div class="card-header">
                                                    <h4>Parçalar</h4>
                                                </div>
                                                <div class="card-body">
                                                    @foreach($parca as $key => $value)
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Parça Adı- Markası - Modeli</label>
                                                                <input value="{{$value->parca}}" disabled type="text"
                                                                       class="form-control"
                                                                       required=""></div>
                                                            <div class="form-group col-md-2">
                                                                <label>Miktar</label>
                                                                <input value="{{$value->miktar}}" disabled type="number"
                                                                       class="form-control"
                                                                       step="0.01" required="">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Birim (Adet-Lt-Paket vs.)</label>
                                                                <input value="{{$value->birim}}" disabled type="text"
                                                                       class="form-control" required="">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

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
