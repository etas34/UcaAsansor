@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
{{--                                <h3 class="card-title"><b>{{\App\Cari::find($fatura->first()->cari_id)->ilgili_kisi ?? ''}} </b> Fatura Haraketleri</h3>--}}
                                <div style="float: right !important;">
                                    <a href="{{route('muhasebe.fatura.create',$id)}}" class="btn btn-success">Fatura Kes</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="example1" class="table table-bordered table-striped dataTable"
                                                   role="grid" aria-describedby="example1_info">
                                                <thead>
                                                <tr role="row">

                                                    <th>No</th>
                                                    <th>Cari Ünvanı</th>
                                                    <th>İlgili Kişi</th>
                                                    <th>Fatura Numarası</th>
                                                    <th>Tarih</th>
                                                    <th>Açıklama</th>

                                                    <th>Genel Toplam</th>
                                                    <th style="width: 15px;">Yazdır</th>
                                                    <th style="width: 15px;">Düzenle</th>
                                                    <th style="width: 10px;">Kaldır</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($fatura as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td>{{\App\Cari::find($value->cari_id)->cari_unvan}}</td>
                                                        <td>{{\App\Cari::find($value->cari_id)->ilgili_kisi}}</td>
                                                        <td>{{$value->fatura_no}}</td>
                                                        <td>{{$value->tarih}}</td>
                                                        <td>{{$value->aciklama}}</td>
                                                        <td>{{$value->gentoplam}}</td>

                                                        <td><a   target="_blank" href="{{route('muhasebe.fatura.faturaPrint',$value->id)}}"><span
                                                                    class="badge bg-blue p-2">Yazdır</span></a></td>
                                                        <td><a href="{{route('muhasebe.fatura.edit',$value->id)}}"><span
                                                                    class="badge bg-orange p-2">Düzenle</span></a></td>
                                                        <td>
                                                            <form action="{{route('muhasebe.fatura.delete',$value->id)}}"
                                                                  method="POST">
                                                                @csrf

                                                                <button type="submit"  onclick="return confirm('Fatura silinecek, Cari Bakiye Güncellenecek. Emin Misiniz?')" class="badge bg-red p-2">Sil
                                                                </button>
                                                            </form>



                                                        </td>


                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>


                    </div>

                </div>
            </div>
        </section>

    </div>

@endsection
