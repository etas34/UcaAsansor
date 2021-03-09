@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('parca.update',$parca->id)}}" method="post" autocomplete="off">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title"><strong>Asansör Kimlik No:</strong> {{App\AsansorModel::find($parca['asansor_id'])->kimlik}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Apartman Adı</label>
                                            <input type="text" name="baslik" value="{{App\AsansorModel::find($parca['asansor_id'])->apartman}}" disabled
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Blok</label>
                                            <input type="text" name="baslik" value="{{App\AsansorModel::find($parca['asansor_id'])->blok}}" disabled
                                                   class="form-control">
                                        </div>
                                    </div>



                                        <div class="form-group">
                                            <label>Değiştirme Tarihi</label>
                                            <input type="text" name="tarih" class="form-control" id="tarih" value="{{$parca->tarih}}" />
                                        </div>

                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>Parça & Malzeme Ad - Marka - Model</label>
                                                <input type="text" name="parca" class="form-control"  value="{{$parca->parca}}" />
                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <label>Miktar</label>
                                                <input type="text" name="miktar" class="form-control"  value="{{$parca->miktar}}" />
                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <label>Birim</label>
                                                <input type="text" name="birim" class="form-control"  value="{{$parca->birim}}" />
                                            </div>

                                        </div>
                                    </div>



                                        <div class="form-group">
                                            <label class="control-label">Değiştirilme Şekli</label>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio1" name="sekil" required value="Arıza" @if($parca->sekil=='Arıza') checked @endif>
                                                <label for="customRadio1" class="custom-control-label">Arıza Sırasında</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio2" name="sekil"  value="Bakım" @if($parca->sekil=='Bakım') checked @endif>
                                                <label for="customRadio2" class="custom-control-label">Bakım Sırasında</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio3" name="sekil" value="Diğer" @if($parca->sekil=='Diğer') checked @endif>
                                                <label for="customRadio3" class="custom-control-label">Diğer</label>
                                            </div>
                                        </div>

                                    <div class="form-group">
                                        <label>Parça & Malzeme Değiştiren</label>
                                        <select name="user_id" class="form-control" required>
                                            @foreach($user as $key=>$value)
                                                <option value="{{$value->id}}"
                                                        @if($value->id==$parca->user_id) selected @endif>
                                                    {{$value->name}}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Fatura Numarası</label>
                                        <input type="text" name="fatura_no" class="form-control"  value="{{$parca->fatura_no}}" />
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
@push('scripts')
    <script>


        $('#tarih').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD',
                language: 'tr'
            }
        });



    </script>
@endpush
