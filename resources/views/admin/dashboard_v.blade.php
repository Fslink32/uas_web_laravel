@extends('admin.layouts.page')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div>Dasboard</div>
            </div>
            <div class="page-title-actions">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="dropdown-toggle btn btn-secondary">Pilih</button>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                            <button type="button" tabindex="-1" class="dropdown-item">Assets</button>
                            <button type="button" tabindex="0" class="dropdown-item">Components</button>
                        </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Pencarian">
                </div>
            </div>
        </div>
    </div>
    <div class="d-block">
        <div class="row">
            <div class="col-sm-12 col-lg-3">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            Status Sampel
                        </div>
                        <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                            <div class="btn-group dropdown">
                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="btn-icon btn-icon-only btn btn-link">
                                    <i class="pe-7s-menu btn-icon-wrapper"></i>
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="canvas-container">
                            <canvas id="chart-area"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="card-hover-shadow-2x mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            Sampel Dalam Proses
                        </div>
                        <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                            <div class="btn-group dropdown">
                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="btn-icon btn-icon-only btn btn-link">
                                    <i class="pe-7s-menu btn-icon-wrapper"></i>
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="canvas-container">
                            <canvas id="canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-3">
                <div class="card-hover-shadow-2x mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            Level Peringatan
                        </div>
                        <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                            <div class="btn-group dropdown">
                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="btn-icon btn-icon-only btn btn-link">
                                    <i class="pe-7s-menu btn-icon-wrapper"></i>
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="canvas-container">
                            <canvas id="doughnut-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="card mb-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            Sampel Diserahkan Terkini
                        </div>
                        <div class="btn-actions-pane-right actions-icon-btn">
                            <div class="btn-group dropdown">
                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="btn-icon btn-icon-only btn btn-link">
                                    <i class="pe-7s-menu btn-icon-wrapper"></i>
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%" id="example" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Lab No</th>
                                    <th>Lab Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>ACES-46162-0103</td>
                                    <td>10/08/2016</td>
                                    <td>In Progress</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="card mb-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            Sampel Asset Terkini
                        </div>
                        <div class="btn-actions-pane-right actions-icon-btn">
                            <div class="btn-group dropdown">
                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="btn-icon btn-icon-only btn btn-link">
                                    <i class="pe-7s-menu btn-icon-wrapper"></i>
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%" id="example" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Asset ID</th>
                                    <th>Health</th>
                                    <th>Health History</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>RH0001</td>
                                    <td>
                                        <span class="text-success"><i class="fa fa-check-circle"></i> Good</span>
                                    </td>
                                    <td>
                                        <span class="text-success"><i class="fa fa-check-circle"></i></span>
                                        <span class="text-success"><i class="fa fa-check-circle"></i></span>
                                        <span class="text-success"><i class="fa fa-check-circle"></i></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>RH0001</td>
                                    <td>
                                        <span class="text-warning"><i class="fa fa-exclamation-circle"></i>
                                            Warning</span>
                                    </td>
                                    <td>
                                        <span class="text-warning"><i class="fa fa-exclamation-circle"></i></span>
                                        <span class="text-success"><i class="fa fa-check-circle"></i></span>
                                        <span class="text-success"><i class="fa fa-check-circle"></i></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>RH0001</td>
                                    <td>
                                        <span class="text-danger"><i class="fa fa-times-circle"></i> Danger</span>
                                    </td>
                                    <td>
                                        <span class="text-success"><i class="fa fa-check-circle"></i></span>
                                        <span class="text-success"><i class="fa fa-check-circle"></i></span>
                                        <span class="text-success"><i class="fa fa-check-circle"></i></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>RH0001</td>
                                    <td>
                                        <span class="text-success"><i class="fa fa-check-circle"></i> Good</span>
                                    </td>
                                    <td>
                                        <span class="text-success"><i class="fa fa-check-circle"></i></span>
                                        <span class="text-success"><i class="fa fa-check-circle"></i></span>
                                        <span class="text-success"><i class="fa fa-check-circle"></i></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/metismenu"></script> --}}

    <script data-main="<?php echo url('/'); ?>/assets/js/main/main-dashboard" src="<?php echo url('/'); ?>/assets/js/require.js">
    </script>
@endsection
