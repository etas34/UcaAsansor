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
                                <h3 class="card-title">Asansör Listesi</h3>
                                <div style="float: right !important;">
                                    <a href="{{route('ariza.mesaiExport')}}" class="btn btn-info">Excel Olarak İndir</a>
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
                                                    <th style="width: 10px;">id</th>
                                                    <th>Asansör Kimlik No</th>
                                                    <th>Apartman Adı</th>
                                                    <th>Blok</th>
                                                    <th>Arıza Tarihi</th>
                                                    <th>Arıza Giderilme Tarihi</th>
                                                    <th>Arıza Günü</th>
                                                    <th>Arıza Gideren</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $weekMap = [
                                                                0 => 'PAZAR',
                                                                1 => 'PAZARTESİ',
                                                                2 => 'SALI',
                                                                3 => 'ÇARŞAMBA',
                                                                4 => 'PERŞEMBE',
                                                                5 => 'CUMA',
                                                                6 => 'CUMARTESİ',
                                                            ];
                                                @endphp
                                                @foreach($arizalar as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->kimlik}}</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->apartman}}</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->blok}}</td>
                                                        <td>{{$value->created_at}}</td>
                                                        <td>{{$value->updated_at}}</td>
                                                        <td>{{$weekMap[\Carbon\Carbon::parse($value->created_at)->dayOfWeek]}}</td>
                                                        <td>{{App\User::find($value['user_id'])->name}}</td>
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
