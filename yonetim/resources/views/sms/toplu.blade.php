@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('sms.toplusms_gonder')}}" method="post"  autocomplete="off">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title">Toplu SMS Gönderme</h3>
                                </div>
                                <div class="card-body">


                                    <div class="form-group">
                                        <label class="control-label">Mesaj</label>
                                        <textarea rows="4" name="mesaj" placeholder="Mesaj Giriniz"

                                                  class="form-control"></textarea>
                                    </div>



                                </div>
                                <div class="card-footer pull-right">
                                    <input type="submit" class="btn btn-success px-5 float-right" onclick="return confirm('Bütün Yöneticilere SMS Gidecek, Emin misiniz?')" value="Gönder">
                                </div>

                            </form>
                        </div>



                    </div>

                </div>
            </div>
        </section>

    </div>



@endsection
