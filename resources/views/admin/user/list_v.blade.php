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
                </div>
            </div>
            <div class="page-title-actions">
                @if ($is_can_create)
                    <a href="{{ route('admin.user.create') }}" class="btn-shadow btn btn-info">
                        Tambah
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="main-card card">
        <div class="card-body border-bottom">
            <label class="form-label">Filter</label>
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control" id="role_id" data-selectjs="true">
                        <option value="" selected>Pilih Jabatan</option>
                        <?php if (!empty($roles)) : ?>
                        <?php foreach ($roles as $value) : ?>
                        <option value="<?= $value->id ?>"><?= $value->name ?></option>
                        <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary mr-2" id="filter">Terapkan</button>
                    <button class="btn btn-outline-danger" id="reset">Atur Ulang</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-nowrap text-nowrap table-hover responsive w-100"
                    id="table">
                    <thead>
                        <tr>
                            <th style="max-width: 20px">No Urut</th>
                            <th>Jabatan</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <script data-main="<?php echo url('/'); ?>/assets/js/main/main-user" src="<?php echo url('/'); ?>/assets/js/require.js">
    </script>
@endsection
