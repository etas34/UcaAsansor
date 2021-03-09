@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6 col-sm-12 col-xs-12">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Görev Düzenle</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="{{route('gorev.durum_update',$gorev->id)}}">
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="control-label">Görev Başlığı</label>
                                        <input type="text" id="GorevBasligi" name="baslik" value="{{$gorev->baslik}}"
                                               placeholder="Lütfen Başlık Belirtiniz.." disabled class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Görev Detayları</label>
                                        <textarea rows="4" name="icerik" placeholder="Lütfen Açıklama Yapınız.." disabled

                                                  class="form-control">{{$gorev->icerik}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Atanacak Kişi</label>
                                        <select name="atanan_id" class="form-control" disabled>
                                            @foreach($user as $key=>$value)
                                                <option value="{{$value->id}}"
                                                        @if($value->id==$gorev->atanan_id) selected @endif>
                                                    {{$value->name}}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Önem</label>

                                        <select name="onem_id" class="form-control" disabled>
                                            @foreach($onem as $key=>$value)
                                                <option value="{{$value->id}}"
                                                        @if($value->id==$gorev->onem_id) selected @endif>
                                                    {{$value->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label>Başlangıç Zamanı</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker"
                                                   name="bas_zaman" disabled
                                                   value="{{$gorev->bas_zaman}}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <div class="form-group">
                                        <label>Bitiş Zamanı</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" disabled
                                                   name="bitis_zaman" value="{{$gorev->bitis_zaman}}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                </div>


                                <div class="card-footer">
                                    <div class="form-group">
                                        <label>Durum</label>

                                        <select name="durum"  data-durumid="{{$gorev->durum}}"
                                                data-sahipid="{{$gorev->sahip_id}}"
                                                data-userid="{{Auth::user()->id}}" class="form-control durumSelect"
                                                style="background: #c0f16e" required>
                                            @foreach($durum->where('id','!=',5)  as $key=>$value)
                                                <option @if($value->id==$gorev->durum) selected
                                                        @endif value="{{$value->id}}">{{$value->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Düzenle</button>
                                </div>
                            </form>
                        </div>


                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="card">

                            <div class="card-header">
                                <h2>Yorum Yap</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">

                                <!-- start form for validation -->
                                <form action="{{route('gorev.yorum_create',$gorev->id)}}" method="POST">
                                    {{csrf_field()}}
                                    <label for="message">Yorum :</label>
                                    <textarea id="yorum" required="required" class="form-control"
                                              name="yorum"></textarea>

                                    <br>
                                    <button type="submit" class="btn btn-primary">Yorumu Gönder</button>

                                </form>
                            </div>
                            <!-- end form for validations -->

                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2>Yorumlar</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <ul class="list-group border-2">
                                    @foreach($yorum as $key=>$value)
                                        <li class="list-group-item">
                                            <div>
                                                <blockquote
                                                    style="border-left: 5px solid #857f84;">{{$value->yorum}}</blockquote>
                                                <h4 class="heading">{{$value->user_name}}</h4>
                                                <p class="url">
                                                    <i class="fa fa-clock-o"></i>{{$value->created_at}}
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                                <!-- end of user messages -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
