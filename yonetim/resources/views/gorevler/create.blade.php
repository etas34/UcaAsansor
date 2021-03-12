@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('gorev.store')}}" method="post" autocomplete="off">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title">Yeni Görev Tanımlama</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="control-label">Görev Başlığı</label>
                                        <input type="text" id="GorevBasligi" name="baslik"
                                               placeholder="Lütfen Başlık Belirtiniz.." required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Görev Detayları</label>
                                        <textarea rows="4" name="icerik" placeholder="Lütfen Açıklama Yapınız.."

                                                  class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Atanacak Kişi</label>
                                        <select name="atanan_id" class="form-control" required>
                                            <option value="" disabled selected>Atanacak Kişi Seçiniz</option>
                                            @foreach($user as $key=>$value)
                                                <option value="{{$value->id}}">{{$value->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Önem</label>
                                        <select name="onem_id" class="form-control" required>
                                            @foreach($onem as $key=>$value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label>Başlangıç Zamanı</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" required name="bas_zaman"
                                                   id="datepicker_bas" value="">
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <div class="form-group">
                                        <label>Bitiş Zamanı</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" name="bitis_zaman">
                                        </div>
                                        <!-- /.input group -->
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
