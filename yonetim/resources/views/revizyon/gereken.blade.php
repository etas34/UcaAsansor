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
                                                    <th>Asansör Kimlik No</th>
                                                    <th>Apartman Adı</th>
                                                    <th>Blok</th>
                                                    <th>Atanan</th>
                                                    <th>Sonraki Kontrol Tarihi</th>
                                                    <th>Etiket</th>
                                                    <th class="bg-danger">Kaç Gün Kaldı</th>
                                                    <th>Revizyon Raporu</th>
                                                    <th>Durum</th>
                                                    <th>İşlem</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($revizyon as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td>{{$value->apt_kimlik}}</td>
                                                        <td>{{$value->apt_apartman}}</td>
                                                        <td>{{$value->apt_blok}}</td>
                                                        <td>@if($value['user_id']!=''){{App\User::find($value['user_id'])->name}}@endif</td>
                                                        <td>{{App\AsansorModel::find($value['asansor_id'])->etiket_tarihi}}</td>
                                                        <td><span
                                                                class="badge p-2 @if(App\AsansorModel::find($value['asansor_id'])->etiket=="Yeşil") bg-success @elseif(App\AsansorModel::find($value['asansor_id'])->etiket=="Kırmızı") bg-danger @elseif(App\AsansorModel::find($value['asansor_id'])->etiket=="Sarı") bg-warning @elseif(App\AsansorModel::find($value['asansor_id'])->etiket=="Mavi") bg-primary @endif ">{{App\AsansorModel::find($value['asansor_id'])->etiket}}</span>
                                                        </td>
                                                        <td class="text-danger">{{Carbon\Carbon::now()->startOfDay()->diffInDays(Carbon\Carbon::parse(App\AsansorModel::find($value['asansor_id'])->etiket_tarihi),false)}}</td>
                                                        <td>@if($value->pdf!=null) <a href="{{route('revizyon.pdfGetir',$value->id)}}" target="_blank"> <span class="badge bg-gradient-light p-2" ><img src="{{asset('public/images/pdf.png')}}">Revizyon Raporu</span></a>@endif</td>
                                                        <td>@if($value->durum==3)<span class="badge p-2 bg-danger">Revizyon Tekrarı</span>@endif</td>
                                                        <td><a href="{{route('revizyon.create',$value->id)}}"><span class="badge bg-primary p-2">Revizyon Yap</span></a></td>
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
