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
                                <h3 class="card-title">Tahsilat</h3>

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
                                                    <th>İlgili Telefon</th>
                                                    <th>Borç Bakiyesi</th>
                                                    <th>Alacak Bakiyesi</th>
                                                    <th style="width: 200px;">İşlemler</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($cari as $key=>$value)
                                                    <tr role="row" class="odd">

                                                        <td></td>
                                                        <td>{{$value->cari_unvan}}</td>

                                                        <td>{{$value->ilgili_kisi }}</td>
                                                        <td>{{$value->telefon }}</td>
                                                        <td>{{$value->borc_bakiye }}</td>
                                                        <td>{{$value->alacak_bakiye }}</td>
                                                        <td><a href="{{route('muhasebe.fatura.create',$value->id)}}"><span
                                                                    class="badge bg-info p-2">Fatura Kes </span></a>

                                                       <a href="{{route('muhasebe.fatura.gecmis',$value->id)}}"><span
                                                                    class="badge bg-success p-2">Geçmiş Faturalar</span></a>
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
