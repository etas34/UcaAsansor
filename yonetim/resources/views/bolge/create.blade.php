@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1203.6px;">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form action="{{route('bolge.store')}}" method="post" autocomplete="off">
                                {{csrf_field()}}
                                <div class="card-header">
                                    <h3 class="card-title">Yeni Bölge Ekle</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Bölge Adı</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="card-footer pull-right">
                                        <input type="submit" class="btn btn-success px-5 float-right" value="Kaydet">
                                    </div>
                                </div>

                            </form>
                        </div>


                    </div>

                </div>
            </div>
        </section>

    </div>

@endsection
