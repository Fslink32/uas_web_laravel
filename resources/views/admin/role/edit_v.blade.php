@extends('admin.layouts.page')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div>Ubah <?php echo $page_description; ?></div>
        </div>
    </div>
</div>
<div class="d-block">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form class="card mb-3" id="form-edit" method="POST" action="{{ route('admin.role.update', [$datas->id]) }}"
                enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">Formulir Update Jabatan
                    </div>
                    <div class="btn-actions-pane-right actions-icon-btn">
                        <div class="btn-group dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                class="btn-icon btn-icon-only btn btn-link"><i
                                    class="pe-7s-menu btn-icon-wrapper"></i></button>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                                <button type="button" tabindex="0" class="dropdown-item"><i
                                        class="dropdown-icon lnr-inbox"> </i><span>Menus</span></button>
                                <button type="button" tabindex="0" class="dropdown-item"><i
                                        class="dropdown-icon lnr-file-empty"> </i><span>Settings</span></button>
                                <button type="button" tabindex="0" class="dropdown-item"><i
                                        class="dropdown-icon lnr-book"> </i><span>Actions</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="form-label col-3">Nama Jabatan</label>
                        <div class="col-9">
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Masukkan nama jabatan" value="<?= $datas->name ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-3">Deskripsi</label>
                        <div class="col-9">
                            <textarea class="form-control" name="description" id="description" placeholder="Masukkan deskripsi"><?= $datas->description ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex w-100 justify-content-end">
                        <a href="{{ route('admin.role.index') }}" class="btn btn-outline-danger mr-2">Batal</a>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script data-main="<?php echo url('/'); ?>/assets/js/main/main-role" src="<?php echo url('/'); ?>/assets/js/require.js">
</script>
@endsection
