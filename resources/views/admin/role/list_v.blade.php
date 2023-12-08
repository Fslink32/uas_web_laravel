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
                    <a href="{{ route('admin.role.create') }}" class="btn-shadow btn btn-info">
                        Tambah
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="main-card card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-nowrap text-nowrap table-hover responsive w-100"
                    id="table">
                    <thead>
                        <tr>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <script data-main="<?php echo url('/'); ?>/assets/js/main/main-role" src="<?php echo url('/'); ?>/assets/js/require.js">
    </script>
@endsection
