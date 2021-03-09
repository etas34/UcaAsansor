@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('ariza.store',$asansor->id)}}" method="post" autocomplete="off">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title"><strong>Asansör Kimlik No:</strong> {{$asansor->kimlik}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Apartman Adı</label>
                                        <input type="text" id="GorevBasligi" name="baslik" value="{{$asansor->apartman}}" disabled class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Blok</label>
                                        <input type="text" id="GorevBasligi" name="baslik" value="{{$asansor->blok}}" disabled class="form-control">
                                    </div>
                                    </div>

                                    <label class="control-label">Arıza Türü</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="icindebiri" value=1>
                                                    <label for="customCheckbox1" class="custom-control-label">İçeride Birisi Kalmış</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="fotosel" value=1>
                                                    <label for="customCheckbox2" class="custom-control-label">Fotosel Arızası</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox3" name="lamba" value=1>
                                                    <label for="customCheckbox3" class="custom-control-label">Kabin İçi Lamba Sürekli Yanıyor</label>
                                                </div>


                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox4" name="calismiyor" value=1 >
                                                    <label for="customCheckbox4" class="custom-control-label">Asansör Çalışmıyor, Başka Bilgi Verilmedi</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox5" name="sesgeliyor" value=1 >
                                                    <label for="customCheckbox5" class="custom-control-label">Ses Geliyor</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox6" name="kapisurtme" value=1 >
                                                    <label for="customCheckbox6" class="custom-control-label">Kapı Sürtmesi</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="control-label">Bunların Dışında</label>
                                            <textarea rows="4" name="disinda" class="form-control"></textarea>
                                        </div>






                                        <div class="form-group">
                                            <label class="col-md-12">Arızacı Ata</label>
                                            <select name="atanan_id" class="form-control" >
                                                <option value="" selected>Atanacak Kişi Seçiniz</option>
                                            @foreach($user as $key=>$value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>
                                  <!--  <div class="custom-control custom-checkbox">
                                         <input class="custom-control-label" type="checkbox"  ">
                                        <label for="customCheckbox7" class="custom-control-label">Yöneticiye Mesaj Gönder:</label>


                                    </div>-->
                      
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
