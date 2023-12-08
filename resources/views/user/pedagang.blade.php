@extends('user.layouts.page')
@section('content')
    <div class="container body">
        <div class="main_container">
            <!-- page content -->
            <div class="" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Daftar Pedagang </h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box table-responsive">
                                                <table id="datatable" class="table table-striped table-bordered"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>id</th>
                                                            <th>Nama Pemilik</th>
                                                            <th>Nama Toko</th>
                                                            <th>Komoditas</th>
                                                            <th>Lantai</th>
                                                            <th>Blok</th>
                                                            <th>Nomor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        @foreach ($pedagang as $value)
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $value->nama_pemilik }}</td>
                                                                <td>{{ $value->nama_toko }}</td>
                                                                <td>{{ $value->komoditas }}</td>
                                                                <td>{{ $value->lantai }}</td>
                                                                <td>{{ $value->block }}</td>
                                                                <td>{{ $value->nomor }}</td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /page content -->
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
