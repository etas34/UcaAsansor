@extends('layouts.main')
@section('content')
    <form action="{{route('muhasebe.cari.cariasansor')}}" method="post" autocomplete="off" enctype="multipart/form-data">

        @csrf
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
                                    <button type="button" data-toggle="modal" data-target="#modal1" class="btn btn-md pd-x-15 btn-success btn-uppercase mg-l-5"><i data-feather="database" class="wd-10 mg-r-5"></i>Cari Hesap Ata</button>
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
                                                    <th ><input type="checkbox"  id="select-all" ></th>
                                                    <th>Asansör Kimlik No</th>
                                                    <th>Apartman Adı</th>
                                                    <th>Blok</th>
{{--                                                    <th>Yönetici</th>--}}
{{--                                                    <th>Yönetici Tel</th>--}}
                                                    <th>Adres</th>
                                                    <th>Cari Hesap</th>
{{--                                                    <th>Etiket</th>--}}
{{--                                                    <th>Son Aylık Bakım</th>--}}
{{--                                                    <th>Etiket Tarihi</th>--}}
{{--                                                    <th style="width: 15px;">Düzenle</th>--}}
{{--                                                    <th style="width: 15px;">Pasif</th>--}}
{{--                                                    <th style="width: 10px;">Kaldır</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($asansor as $key=>$value)
                                                    <tr role="row" class="odd">
                                                        <td></td>
                                                        <td><input type="checkbox" value="{{$value->id }}" name="checkbox[{{$key}}]" ></td>
                                                        <td>{{$value->kimlik}}</td>
                                                        <td>{{$value->apartman}}</td>
                                                        <td>{{$value->blok}}</td>
{{--                                                        <td>{{$value->yonetici}}</td>--}}
{{--                                                        <td><a href="tel:0{{str_replace(str_split('()- '), '', $value->yonetici_tel )}}" class="">{{$value->yonetici_tel }}</a></td>--}}
                                                        <td>{{$value->adres ?? ''}}</td>
                                                        <td> {{$cari->find($value->cari_id)["cari_unvan"] ?? ''}}</td>
{{--                                                        <td><span class="badge p-2 @if($value->etiket=="Yeşil") bg-success @elseif($value->etiket=="Kırmızı") bg-danger @elseif($value->etiket=="Sarı") bg-warning @elseif($value->etiket=="Mavi") bg-primary @endif ">{{$value->etiket}}</span></td>--}}
{{--                                                        <td>{{$value->aylik_bakim}}</td>--}}
{{--                                                        <td>{{$value->etiket_tarihi}}</td>--}}
{{--                                                        <td><a href="{{route('asansor.edit',$value->id)}}"><span class="badge bg-primary p-2">Düzenle</span></a></td>--}}
{{--                                                        <td><form  method="post" onSubmit="return confirm('Emin misiniz?')" action="{{route('asansor.pasifeAl',$value->id)}}">{{csrf_field()}}<button class="badge bg-orange p-2">Pasife Al</button></form></td>--}}
{{--                                                        <td><form  method="post" onSubmit="return confirm('Emin misiniz?')" action="{{route('asansor.delete',$value->id)}}">{{csrf_field()}}{{method_field('delete')}}<button class="badge bg-danger p-2">Sil</button></form></td>--}}
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
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">

                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Cari Hesap Ata</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <h3 class="mg-b-0">Cari Hesap Seçiniz </h3>
                        <div class="row">


                                <div class="form-group col-md-12">
                                    <select class="form-control select2" name="cari" style="width: 100%;">
                                        <option value="" >Cari Hesap Yok</option>
                                        @foreach($cari as $value)
                                                    <option value="{{$value->id}}">{{$value->cari_unvan}}</option>
                                                @endforeach
                                    </select>
                                </div>

{{--
                                </select>
                                @foreach($cari as $value)--}}
                                {{--                                        <option value="{{$value->id}}">{{$value->cari_unvan}}</option>--}}
                                {{--                                    @endforeach--}}


                            <div class="col-md-6">


                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit"  class="btn btn-success tx-13"  name="action"  value="durum" >Tamam</button>
                    </div>
                </div>
            </div>
        </div>


    </form>
@endsection

@push('scripts')

    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){

            $('.select2').select2()

            // $.fn.dataTable.ext.search.push(
            //     function( settings, data, dataIndex ) {
            //         var durum = $('#kargodurum_select').val();
            //         var kolon =  data[2]; // use data for the age column
            //
            //         if (  kolon == durum || durum=='1' )
            //         {
            //             return true;
            //         }
            //         return false;
            //     }
            // );
            //
            // var table = $('#example22').DataTable({
            //
            //     columnDefs: [ {
            //         orderable: false,
            //         targets:   0
            //     } ],
            //
            //     language: {
            //         url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Turkish.json'
            //     },
            //
            //     "scrollX": true
            //
            // } );
            $('#modal12').on('show.bs.modal', function(e) {
                if( e.target.id === 'modal12') {
                    //get data-id attribute of the clicked element
                    var Id = $(e.relatedTarget).data('id');

                    $('#input12').val(Id);

                }

            });
            $('#select-all').click(function(event) {
                if(this.checked) {
                    // Iterate each checkbox
                    $(':checkbox').each(function() {
                        this.checked = true;
                    });
                } else {
                    $(':checkbox').each(function() {
                        this.checked = false;
                    });
                }
            });


            //
            //
            // // Event listener to the two range filtering inputs to redraw on input
            // $('#kargodurum_select').on('change', function() {
            //     table.draw();
            // } );
            //



        });
    </script>

@endpush


