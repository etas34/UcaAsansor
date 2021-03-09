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
                                <h3 class="card-title">Cariler</h3>
                                <div style="float: right !important;">
                                    <a href="{{route('muhasebe.cari.create')}}" class="btn btn-success">Yeni Cari Hesap Ekle</a>
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
                                                    <th>Adres</th>
                                                    <th>İlgili Kişi</th>
                                                    <th>İlgili Telefon</th>
                                                    <th>Borç Bakiyesi</th>
                                                    <th>Alacak Bakiyesi</th>
                                                    <th>Vergi Dairesi</th>
                                                    <th>Vergi Numarası</th>
                                                    <th>Tahsilat & Ödeme</th>

                                                    <th>Haraketler</th>
                                                    <th style="width: 15px;">Düzenle</th>
                                                    <th style="width: 10px;">Kaldır</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($cari as $key=>$value)
                                                    <tr role="row" class="odd">

                                                        <td></td>
                                                        <td>{{$value->cari_unvan }}</td>
                                                        <td>{{$value->adres ?? '' }}</td>
                                                        <td>{{$value->ilgili_kisi }}</td>
                                                        <td>{{$value->telefon }}</td>
                                                        <td>{{$value->borc_bakiye }}</td>
                                                        <td>{{$value->alacak_bakiye }}</td>
                                                        <td>{{$value->vergi_dairesi}} </td>
                                                        <td>{{$value->vergi_numarasi}} </td>
                                                        <td><a href="{{route('muhasebe.cariharaket.create',$value->id)}}"><span
                                                                    class="badge bg-info p-2">Tahsilat / Ödeme Yap</span></a>
                                                        </td>
                                                        <td>
                                                            <a href="{{route('muhasebe.cariharaket.gecmis',$value->id)}}"><span
                                                                    class="badge bg-success p-2">Haraketler</span></a>
                                                        </td>

                                                        <td><a href="{{route('muhasebe.cari.edit',$value->id)}}"><span
                                                                    class="badge bg-orange p-2">Düzenle</span></a></td>
                                                        <td>
                                                            <form action="{{route('muhasebe.cari.delete',$value->id)}}"
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
