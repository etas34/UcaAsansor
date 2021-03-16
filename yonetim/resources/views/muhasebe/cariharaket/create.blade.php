@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">


                            <form action="{{route('muhasebe.cariharaket.store',$cari->id)}}" method="post" autocomplete="off"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}


                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group col-md-12">
                                            <label class="control-label">Cari Adı </label>
                                            <input type="text" disabled value="{{$cari->cari_unvan }}" class="form-control">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Tür</label>
                                            <select name="tur" class="form-control" required="">
                                                <option  @if($cari->borc_bakiye > 0){{'selected=""'}} @endif value="1">
                                                    Tahsilat
                                                </option>
                                                <option value="2" @if($cari->alacak_bakiye > 0){{'selected=""'}} @endif>
                                                    Ödeme
                                                </option>

                                            </select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="control-label">Tutar</label>
                                            <input type="number" step="0.01" required name="tutar" class="form-control">
                                        </div>



                                        <div class="form-group col-md-12">
                                            <label>Ödeme Metotu</label>
                                            <select name="odeme_metot" class="form-control" required="">
                                                <option value="kredi_kart" selected="">
                                                    Kredi Kartı
                                                </option>
                                                <option value="nakit">
                                                   Nakit
                                                </option>
                                                <option value="eft">
                                                    EFT
                                                </option>
                                                <option value="multi">
                                                    Çoklu Ödeme (Kredi Kartı + Nakit)
                                                </option>

                                            </select>
                                        </div>

                                            <div class="form-group col-md-12">
                                                <label>Ödeme Tarihi</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                    </div>
                                                    <input type="text" value="{{\Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control pull-right datepicker" name="tarih" >
                                                </div>
                                            </div>

                                        <div class="form-group col-md-12">
                                            <label class="control-label">Açıklama</label>
                                            <input name="aciklama" class="form-control">
                                        </div>
                                    </div>
                                    <div class="card-footer pull-right">
                                        <input type="submit" class="btn btn-success px-5 float-right" value="Kaydet">
                                    </div>
                                </div>


                            </form>
                        </div>


                    </div>

                </div>
            </div>
        </section>

    </div>

@endsection
