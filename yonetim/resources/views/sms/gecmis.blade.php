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
                                <h3 class="card-title">SMS Geçmişi</h3>
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
                                                    <th>Tarih</th>
                                                    <th>Telefon No</th>
                                                    <th>Mesaj</th>
                                                    <th>Dosya</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($sms as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td>{{$value->created_at}}</td>
                                                        <td>{{$value->phone}}</td>
                                                        <td>{{$value->mesaj}}</td>
                                                        <td>@if($value->pdf!=null) <a href="https://ciftcilerasansor.com.tr/yonetim/storage/app/{{$value->pdf}}" target="_blank"> <span class="badge bg-gradient-light p-2" ><img src="{{asset('public/images/pdf.png')}}">Ekli Dosya</span></a>@endif</td>
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
