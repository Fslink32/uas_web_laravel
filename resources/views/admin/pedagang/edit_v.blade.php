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
                action="{{ route('admin.pedagang.update', [$datas->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="box-body">
                    <div class="form-group row">
                        <label for="nama_pedagang" class="col-sm-3 control-label">Nama Pedagang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_pemilik" placeholder="Nama Pedagang"
                                name="nama_pemilik" value="{{ $datas->nama_pemilik }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_toko" class="col-sm-3 control-label">Nama Toko</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_toko" placeholder="Nama Toko"
                                name="nama_toko" value="{{ $datas->nama_toko }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="komoditas" class="col-sm-3 control-label">Komoditas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="komoditas" placeholder="Komoditas"
                                name="komoditas" value="{{ $datas->komoditas }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lantai" class="col-sm-3 control-label">Lantai</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="lantai" placeholder="Lantai" name="lantai"
                                value="{{ $datas->lantai }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="block" class="col-sm-3 control-label">Block</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="block" placeholder="Block" name="block"
                                value="{{ $datas->block }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nomor" class="col-sm-3 control-label">Nomor</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="nomor" placeholder="Nomor" name="nomor"
                                value="{{ $datas->nomor }}">
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <a href="{{ route('admin.pedagang.index') }}" class="btn btn-default">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script data-main="<?php echo url('/'); ?>/assets/js/main/main-pedagang" src="<?php echo url('/'); ?>/assets/js/require.js">
    </script>
@endsection
