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
                        Create
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-card card">
        <div class="card-body">
            <form class="form-horizontal" id="form" method="POST" action="{{ route('admin.user.store') }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="kd_kec_state" id="kd_kec_state" value="">
                <div class="box-body">
                    <?php if(!empty(session()->flash('message_error'))){?>
                    <div class="alert alert-danger">
                        <?php
                        print_r(session()->flash('message_error'));
                        ?>
                    </div>
                    <?php }?>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="name" class="form-control" id="name" placeholder="Nama" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">No HP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control number" maxlength="13" id="phone"
                                placeholder="No HP" name="phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="address"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 control-label">Jabatan</label>
                        <div class="col-sm-9">
                            <select id="role" name="role" class="form-control">
                                <option value="">Pilih Jabatan</option>
                                @foreach ($roles as $key => $role)
                                    <option value="<?php echo $role->name; ?>"><?php echo $role->name; ?></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 control-label">Ulangi Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <a href="<?php echo url('admin/user'); ?>" class="btn btn-default">Batal</a>
                    <button type="submit" class="btn btn-success" id="save-btn">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script data-main="<?php echo url('/'); ?>/assets/js/main/main-user" src="<?php echo url('/'); ?>/assets/js/require.js">
    </script>
@endsection
