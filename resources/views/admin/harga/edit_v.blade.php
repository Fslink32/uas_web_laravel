@extends('admin.layouts.page')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div>
                    <?php echo $parent_page_name; ?>
                    <div class="page-title-subheading">
                        <?php echo $page_description; ?>
                    </div>
                    <div class="page-title-subheading">
                        Edit
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-card card">
        <div class="card-body">
            <form class="form-horizontal" id="form" method="POST"
                action="{{ route('admin.harga.update', [$datas->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="box-body">
                    <div class="form-group row">
                        <label for="nama_barang" class="col-sm-3 control-label">Nama Barang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang"
                                name="nama_barang" value="{{ $datas->nama_barang }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="satuan" class="col-sm-3 control-label">Satuan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="satuan" placeholder="Satuan" name="satuan"
                                value="{{ $datas->satuan }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga" class="col-sm-3 control-label">Harga</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="harga" placeholder="Harga" name="harga"
                                value="{{ $datas->harga }}">
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <a href="{{ route('admin.harga.index') }}" class="btn btn-default">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script data-main="<?php echo url('/'); ?>/assets/js/main/main-harga" src="<?php echo url('/'); ?>/assets/js/require.js">
    </script>
@endsection
