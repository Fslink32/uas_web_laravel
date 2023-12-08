@include('admin.layouts.header')

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
    <div class="body-block-example-1 d-none">
        <div class="loader bg-transparent no-shadow p-0">
            <div class="ball-grid-pulse">
                <div class="bg-white"></div>
                <div class="bg-white"></div>
                <div class="bg-white"></div>
                <div class="bg-white"></div>
                <div class="bg-white"></div>
                <div class="bg-white"></div>
                <div class="bg-white"></div>
                <div class="bg-white"></div>
                <div class="bg-white"></div>
            </div>
        </div>
    </div>
    <input type="hidden" id="base_url" value="<?php echo url('/'); ?>/">
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        @include('admin.layouts.topbar')
        <div class="app-main w-100">

            @include('admin.layouts.sidemenu')
            <div class="app-main__outer w-100">

                <div class="app-main__inner">
                    @include('errors.html.alert_error')
                    @yield('content')
                </div>

                {{-- @include('admin.layouts.footer') --}}
            </div>
        </div>
    </div>
    <div id="alert_modal" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered shadow-none" role="document">
            <div class="modal-content">
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <i class="fa fa-exclamation-triangle text-danger" style="font-size: 48px"></i>
                    <h3 class="modal-title alert-title"></h3>
                    <div class="text-muted alert-msg"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger alert-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success ms-auto alert-ok">OK</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
