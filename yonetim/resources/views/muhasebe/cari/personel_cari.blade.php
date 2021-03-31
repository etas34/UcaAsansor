@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">

                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">id</th>
                                        <th>Kullanıcı Ad</th>
                                        <th>Bu Ayki Toplam Tahsilat Tutarı</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user as $key=>$value)
                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td>{{$value->name}}</td>
                                            <td>{{\App\Cariharaket::where('user_id',$value->id)
                                                    ->where('tur',1)
                                                    ->whereBetween('created_at',[$baslangic_tarih,$bitis_tarih])
                                                    ->sum('tutar')}}₺</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>


                    </div>

                </div>
            </div>
        </section>

    </div>

@endsection
