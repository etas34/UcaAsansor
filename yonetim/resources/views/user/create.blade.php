@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('user.store')}}" method="post" autocomplete="off">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title">Yeni Kullanıcı Ekle</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Kullanıcı Adı</label>
                                        <input type="text"  name="name" class="form-control" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="control-label">E-Mail</label>
                                        <input type="email"  name="email" class="form-control" required>
                                    </div>


                                    <div class="form-group col-md-12">
                                        <label class="control-label">Şifre</label>
                                        <input type="text"  name="password" required class="form-control" placeholder="En Az 6 Karakter">
                                    </div>

                                    <label class="control-label col-md-12">İzinler</label>
                                            <!-- checkbox -->
                                            <div class="form-group col-md-12">

                                                @foreach($yetki as $key=>$value)
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="customCheckbox{{$key}}" name="yetki[]" value="{{$value->id}}">
                                                        <label for="customCheckbox{{$key}}" class="custom-control-label">{{$value->name}}</label>
                                                    </div>

                                                    @endforeach

                                            </div>
                                    <div class="form-group row">

                                        <label class="control-label col-md-12">Renk Seçiniz</label>

                                        @foreach(config('constants.colours') as $renk=>$color)
                                            <div class="form-check col-md-3 ">
                                                <input class="form-check-input" type="radio" name="renk" value="{{$color}}" id="{{$color}}">
                                                <label class="form-check-label" for="{{$color}}">
                                                    <h3 class="text-{{$color}}">  <i  class="fas fa-square"></i></h3>
                                                </label>
                                            </div>
                                        @endforeach


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
