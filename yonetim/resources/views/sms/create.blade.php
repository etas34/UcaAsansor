@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('sms.store')}}" method="post"  enctype="multipart/form-data" autocomplete="off">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title">Yeni SMS Gönderme</h3>
                                </div>
                                <div class="card-body">

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

                                    <div class="form-group">
                                        <label class="control-label">Mesaj</label>
                                        <textarea rows="4" name="mesaj" placeholder="Mesaj Giriniz"

                                                  class="form-control"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label for="customFile">Custom File</label> -->
                                        <label>PDF veya Resim Ekle</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="pdf"  accept="application/pdf,image/*">
                                            <label class="custom-file-label" for="customFile">Lütfen Sadece PDF veya Resim Yükleyiniz</label>
                                        </div>
                                    </div>


                                </div>
                                <div class="card-footer pull-right">
                                    <input type="submit" class="btn btn-success px-5 float-right" value="Gönder">
                                </div>

                            </form>
                        </div>



                    </div>

                </div>
            </div>
        </section>

    </div>



@endsection
