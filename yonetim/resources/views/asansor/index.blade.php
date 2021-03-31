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
                                    <a href="{{route('asansor.create')}}" class="btn btn-success">Yeni Asansör Ekle</a>
                                    <a href="{{route('asansor.export',$etiket)}}" class="btn btn-info">Excel Olarak
                                        İndir</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="d-block">Bölge Filtre</label>
                                        <select class="form-control " id="asansor_select" required>
                                            <option value="1" selected>Tüm Bölgeler</option>
                                            @foreach(\App\BolgeModel::where('durum','=',1)->orderBy('ad','asc')->get() as $bolge)
                                                <option value="{{$bolge->ad}}">{{$bolge->ad}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- col -->

                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="export_table"
                                                   class="table table-bordered table-striped dataTable"
                                                   role="grid" aria-describedby="example1_info">
                                                <thead>
                                                <tr role="row">
                                                    <th>No</th>
                                                    <th>Asansör Kimlik No</th>
                                                    <th>Apartman Adı</th>
                                                    <th>Blok</th>
                                                    <th>Yönetici</th>
                                                    <th>Bölge</th>
                                                    <th>Yönetici Tel</th>
                                                    <th>Adres</th>
                                                    <th>Etiket</th>
                                                    <th>Son Aylık Bakım</th>
                                                    <th>Etiket Tarihi</th>
                                                    <th>Bakım Ücreti</th>
                                                    <th style="width: 15px;">Düzenle</th>
                                                    <th style="width: 15px;">Pasif</th>
                                                    <th style="width: 10px;">Kaldır</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($asansor as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td>{{$value->kimlik}}</td>
                                                        <td>{{$value->apartman}}</td>
                                                        <td>{{$value->blok}}</td>
                                                        <td>{{$value->yonetici}}</td>
                                                        <td>{{\App\BolgeModel::find($value->bolge_id)['ad'] ?? ''}}</td>
                                                        <td>
                                                            <a href="tel:0{{str_replace(str_split('()- '), '', $value->yonetici_tel )}}"
                                                               class="">{{$value->yonetici_tel }}</a></td>
                                                        <td>{{$value->adres}}</td>
                                                        <td><span
                                                                class="badge p-2 @if($value->etiket=="Yeşil") bg-success @elseif($value->etiket=="Kırmızı") bg-danger @elseif($value->etiket=="Sarı") bg-warning @elseif($value->etiket=="Mavi") bg-primary @endif ">{{$value->etiket}}</span>
                                                        </td>
                                                        <td>{{$value->aylik_bakim}}</td>
                                                        <td>{{$value->etiket_tarihi}}</td>
                                                        <td>{{$value->bakim_ucreti}}</td>
                                                        <td><a href="{{route('asansor.edit',$value->id)}}"><span
                                                                    class="badge bg-primary p-2">Düzenle</span></a></td>
                                                        <td>
                                                            <form method="post"
                                                                  onSubmit="return confirm('Emin misiniz?')"
                                                                  action="{{route('asansor.pasifeAl',$value->id)}}">
                                                                {{csrf_field()}}
                                                                <button class="badge bg-orange p-2">Pasife Al</button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form method="post"
                                                                  onSubmit="return confirm('Emin misiniz?')"
                                                                  action="{{route('asansor.delete',$value->id)}}">
                                                                {{csrf_field()}}
                                                                {{method_field('delete')}}
                                                                <button class="badge bg-danger p-2">Sil</button>
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

    @push('scripts')
        <script>
            $(function () {

                          var table = $("#export_table").DataTable({
                    "responsive": true, "lengthChange": true, "autoWidth": false,
                    "buttons": [
                        'copy',
                        $.extend(true, {}, {
                            extend: 'excel',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 10, 11]
                            },
                        }),
                    ],

                });


                table.on('order.dt search.dt', function () {
                    table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }).draw();

                table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


                if ($('#asansor_select').length) {
                    $.fn.dataTable.ext.search.push(
                        function (settings, data, dataIndex) {
                            let durum = $('#asansor_select').val();
                            let kolon = data[5]; // use data for the age column
                            // alert(kolon)
                            // alert(table)
                            return (kolon == durum || durum == '1')
                        }
                    );

                    // Event listener to the two range filtering inputs to redraw on input
                    $('#asansor_select').on('change', function () {
                        table.draw();
                    });
                }
            })
        </script>
    @endpush
@endsection
