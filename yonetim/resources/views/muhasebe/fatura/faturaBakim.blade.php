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
                                <h3 class="card-title">Faturası Kesilmemiş Bakim Haraketleri</h3>

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
                                                    <th>Apartman Adı</th>
                                                    <th>Blok</th>
                                                    <th>Bakım Tarih</th>
                                                    <th>Fatura Kes</th>

{{--                                                    <th>Genel Toplam</th>--}}
{{--                                                    <th style="width: 15px;">Yazdır</th>--}}
{{--                                                    <th style="width: 15px;">Düzenle</th>--}}
{{--                                                    <th style="width: 10px;">Kaldır</th>--}}

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($bakimlar as $key=>$value)
                                                    @if(!$value->fatura_no)
                                                        <tr role="row" class="odd">
                                                        <td></td>
{{--                                                        @dd($value->cari_id)--}}
                                                        <td>{{\App\Cari::find($value->cari_id)->cari_unvan}}</td>
                                                        <td>{{$value->apartman}}</td>
                                                        <td>{{$value->blok}}</td>
                                                        <td>{{$value->created_at }}</td>

{{--                                                            @dd()--}}
                                                            <td><a href="{{route('muhasebe.fatura.create',$value->cari_id)}}"><span
                                                                        class="badge bg-info p-2">Fatura Kes </span></a>

                                                            @endif
                                                        </tr>
                                                        {{--                                                        <td>{{$value->gentoplam }}</td>--}}

                                                        {{--                                                        <td><a href="{{route('muhasebe.fatura.edit',$value->id)}}"><span--}}
                                                        {{--                                                                    class="badge bg-blue p-2">Yazdır</span></a></td>--}}
                                                        {{--                                                        <td><a href="{{route('muhasebe.fatura.edit',$value->id)}}"><span--}}
                                                        {{--                                                                    class="badge bg-orange p-2">Düzenle</span></a></td>--}}
                                                        {{--                                                        <td>--}}
                                                        {{--                                                            <form action="{{route('muhasebe.fatura.delete',$value->id)}}"--}}
                                                        {{--                                                                  method="POST">--}}
                                                        {{--                                                                @csrf--}}

                                                        {{--                                                                <button type="submit"  onclick="return confirm('Cari Hesap silinecek. Emin Misiniz?')" class="badge bg-red p-2">Sil--}}
                                                        {{--                                                                </button>--}}
                                                        {{--                                                            </form>--}}



                                                        {{--                                                        </td>--}}


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
