@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('revizyon.store',$revizyon->id)}}" method="post" autocomplete="off">
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

                                    <label class="control-label">Yapılan İşlemler</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="revizyon" checked disabled value=1>
                                                    <label for="customCheckbox1" class="custom-control-label">Revizyon Raporu Tamamlandı</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label class="control-label">Ekstra Yapılanlar</label>
                                            <textarea rows="8" name="ekstra" class="form-control">{{$revizyon->ekstra}}</textarea>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Revizyon Zamanı</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker bugun_tarih" name="tarih">
                                            </div>
                                            <!-- /.input group -->
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
