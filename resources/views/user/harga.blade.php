@extends('user.layouts.page')
@section('content')
    <div class="container body">
        <div class="main_container">
            <!-- page content -->
            <div class="" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Daftar Harga Barang </h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box table-responsive ">
                                                <table id="datatable" class="table table-striped table-bordered"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>id</th>
                                                            <th>Nama Barang</th>
                                                            <th>Satuan</th>
                                                            <th>Harga Normal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        @foreach ($harga as $value)
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $value->nama_barang }}</td>
                                                                <td>{{ $value->satuan }}</td>
                                                                <td>{{ number_format($value->harga, 0, ',', '.') }}</td>
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
