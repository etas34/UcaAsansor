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
                                <h3 class="card-title"> Cari Haraketler</h3>
                                <div style="float: right !important;">
                                    <a href="{{route('muhasebe.cariharaket.create',$id)}}" class="btn btn-success">Tahsilat / Ödeme Yap</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="export_table" class="table table-bordered table-striped dataTable"
                                                   role="grid" aria-describedby="example1_info">
                                                <thead>
                                                <tr role="row">

                                                    <th>No</th>
                                                    <th>Cari Ünvanı</th>
                                                    <th>İlgili Kişi</th>
                                                    <th>Açıklama</th>
                                                    <th>Tutar</th>
                                                    <th>Tür</th>
                                                    <th>İşlem Tarihi</th>
                                                    <th>Ödeme Metotu</th>
                                                    <th>İşlem Yapan</th>
                                                    <th style="width: 15px;">Düzenle</th>
                                                    <th style="width: 10px;">Kaldır</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($cariharaket as $key=>$value)
                                                    <tr role="row" class="odd">

                                                        <td></td>
                                                        <td>{{\App\Cari::find($value->cari_id)->cari_unvan}}</td>
                                                        <td>{{\App\Cari::find($value->cari_id)->ilgili_kisi ?? ''}}</td>
                                                        <td>{{$value->aciklama }}{{\App\Fatura::find($value->fatura_id)['aciklama'] ?? ''}}</td>

                                                        <td>{{$value->tutar }}</td>
                                                        <td>@if($value->tur == 1){{"Tahsilat"}} @elseif($value->tur == 2){{"Ödeme"}}   @elseif(explode(",",$value->tur)[0] == 3){{"Fatura Kesimi"}} @endif </td>
                                                        <td>{{$value->islem_tarih }}</td>
                                                        <td>@if($value->metot=='kredi_kart') Kredi Kartı @elseif($value->metot=='nakit') Nakit
                                                            @elseif($value->metot=='eft') EFT
                                                            @elseif($value->metot=='multi')Çoklu Ödeme (Kredi Kartı + Nakit)@endif</td>
                                                        <td>@if($value->user_id){{\App\User::findOrFail($value->user_id)->name }}@endif</td>

                                                        <td><a href="{{route('muhasebe.cariharaket.edit',$value->id)}}"><span
                                                                    class="badge bg-orange p-2">Düzenle</span></a></td>
                                                        <td>
                                                            <form action="{{route('muhasebe.cariharaket.delete',$value->id)}}"
                                                                  method="POST">
                                                                @csrf

                                                                <button type="submit"  onclick="return confirm('Cari Hesap silinecek. Emin Misiniz?')" class="badge bg-red p-2">Sil
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


@push('scripts')
    <script>
        $(function () {
            var table=$("#export_table").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                "buttons": ['copy', 'excel'],
                "columnDefs": [
                    {
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    },
                ],

            });

            table.on('order.dt search.dt', function () {
                table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

            table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        })
    </script>
@endpush
