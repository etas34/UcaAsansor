@extends('layouts.main')
@section('content')

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
                                    <h3 class="card-title"><strong>Asansör Kimlik No:</strong> {{App\AsansorModel::find($revizyon['asansor_id'])->kimlik}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Apartman Adı</label>
                                        <input type="text" id="GorevBasligi" name="baslik" value="{{App\AsansorModel::find($revizyon['asansor_id'])->apartman}}" disabled class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Blok</label>
                                        <input type="text" id="GorevBasligi" name="baslik" value="{{App\AsansorModel::find($revizyon['asansor_id'])->blok}}" disabled class="form-control">
                                    </div>
                                    </div>

                                    <label class="control-label">Yapılan İşlemler</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="revizyon" disabled value=1 @if($revizyon->revizyon==1) checked @endif>
                                                    <label for="customCheckbox1" class="custom-control-label">Revizyon Raporu Tamamlandı</label>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label class="control-label">Ekstra Yapılanlar</label>
                                            <textarea rows="4" name="ekstra" class="form-control" disabled>{{$revizyon->ekstra}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Revizyon Yapan</label>
                                            <select name="user_id" class="form-control" disabled>
                                                @foreach($user as $key=>$value)
                                                    <option value="{{$value->id}}"
                                                            @if($value->id==$revizyon->user_id) selected @endif>
                                                        {{$value->name}}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>

                                    <label>Etiket</label>
                                    <div><span class="badge p-2  @if($revizyon->etiket=="Yeşil") bg-success @elseif($revizyon->etiket=="Kırmızı") bg-danger @elseif($revizyon->etiket=="Sarı") bg-warning @elseif($revizyon->etiket=="Mavi") bg-primary @endif ">{{$revizyon->etiket}} Etiket</span></div>

                                    <br>

                                    <label class="control-label">Sebep</label>
                                    <textarea rows="4" name="ekstra" class="form-control" disabled>{{$revizyon->sebep}}</textarea>

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
