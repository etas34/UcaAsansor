@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">

                        <div class="card card-primary">

                            <form action="{{route('ayarlar.update',Auth::user()->id)}}" method="post">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title">Kullanıcı Ayarları</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="control-label">Ad Soyad</label>
                                        <input type="text" id="GorevBasligi" name="name" required class="form-control"
                                               value="{{Auth::user()->name}}">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">E-Mail</label>
                                        <input type="email" id="GorevBasligi" name="email"
                                               value="{{Auth::user()->email}}" required class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Telefon</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="(532)777-8899" name="phone"
                                                   data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;"
                                                   data-mask="" im-insert="true" value="{{Auth::user()->phone}}">
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label class="control-label">Email ile Bildirim Al</label>
                                            <div class="bootstrap-switch-container"
                                                 style="width: 129px; margin-left: 0px;">
                                                <span class="bootstrap-switch-handle-on bootstrap-switch-success"
                                                      style="width: 43px;"></span>
                                                <span class="bootstrap-switch-handle-off bootstrap-switch-danger"
                                                      style="width: 43px;"></span>
                                                <input type="checkbox" name="mail_bild" value="1" @if(Auth::user()->mail_bild=="1") checked @endif
                                                       data-bootstrap-switch="" data-off-color="danger"
                                                       data-on-color="success"></div>

                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="control-label">SMS ile Bildirim Al</label>
                                            <div class="bootstrap-switch-container"
                                                 style="width: 129px; margin-left: 0px;">
                                                <span class="bootstrap-switch-handle-on bootstrap-switch-success"
                                                      style="width: 43px;"></span>
                                                <span class="bootstrap-switch-handle-off bootstrap-switch-danger"
                                                      style="width: 43px;"></span>
                                                <input type="checkbox" name="sms_bild" value="1"  @if(Auth::user()->sms_bild=="1") checked @endif
                                                       data-bootstrap-switch="" data-off-color="danger"
                                                       data-on-color="success"></div>

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
