@extends('layouts.main')
@section('content')
    <style>
        .custom-control-label:before{
            background-color:red;
        }
        .custom-checkbox .custom-control-input:checked~.custom-control-label::before{
            background-color:black;
        }
        .custom-checkbox .custom-control-input:checked~.custom-control-label::after{
            background-image:url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='red' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E");
        }
        .custom-control-input:active~.custom-control-label::before{
            background-color:green;
        }

        /** focus shadow pinkish **/
        .custom-checkbox .custom-control-input:focus~.custom-control-label::before{
            box-shadow: 0 0 0 1px #fff, 0 0 0 0.2rem rgba(255, 0, 247, 0.25);
        }

    </style>
    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('revizyon.update',$revizyon->id)}}" method="post" autocomplete="off">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title"><strong>Asansör Kimlik
                                            No:</strong> {{App\AsansorModel::find($revizyon['asansor_id'])->kimlik}}
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Apartman Adı</label>
                                            <input type="text" id="GorevBasligi" name="baslik"
                                                   value="{{App\AsansorModel::find($revizyon['asansor_id'])->apartman}}"
                                                   disabled class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Blok</label>
                                            <input type="text" id="GorevBasligi" name="baslik"
                                                   value="{{App\AsansorModel::find($revizyon['asansor_id'])->blok}}"
                                                   disabled class="form-control">
                                        </div>
                                    </div>

                                    <label class="control-label">Yapılan İşlemler</label>
                                    <div class="row">


                                        <div class="form-group col-md-12">
                                            <label class="control-label">Ekstra Yapılanlar</label>
                                            <textarea rows="4" name="ekstra"
                                                      class="form-control">{{$revizyon->ekstra}}</textarea>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label>Revizyon Zamanı</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" name="tarih" value="{{$revizyon->tarih}}">
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <!-- checkbox -->
                                        <div class="form-group col-md-12">
                                            <div class="custom-control custom-checkbox ">
                                                <input class="custom-control-input" type="checkbox" id="customCheckbox1"
                                                       name="tamamlanamadi" value=1 >
                                                <label for="customCheckbox1" class="custom-control-label">Revizyon Tamamlanamadı </label>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>Revizyon Yapan</label>
                                            <select name="user_id" class="form-control" required>
                                                @foreach($user as $key=>$value)
                                                    <option value="{{$value->id}}"
                                                            @if($value->id==$revizyon->user_id) selected @endif>
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
