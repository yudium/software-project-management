<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />

    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">

    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <link rel="icon" href="../favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />

    <title>Tambah Proyek: Atur Tracking Progress - tabler.github.io - a responsive, flat and full featured admin template</title>

    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="{{ asset('assets/js/require.min.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: '{{ url('/') }}'
        });
    </script>

    <!-- Dashboard Core -->
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    <!-- c3.js Charts Plugin -->
    <link href="{{ asset('assets/plugins/charts-c3/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/plugins/charts-c3/plugin.js') }}"></script>

    <!-- Google Maps Plugin -->
    <link href="{{ asset('assets/plugins/maps-google/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/plugins/maps-google/plugin.js') }}"></script>

    <!-- Input Mask Plugin -->

    <script src="{{ asset('assets/plugins/input-mask/plugin.js') }}"></script>

    <!-- Datatables Plugin -->

    <script src="{{ asset('assets/plugins/datatables/plugin.js') }}"></script>

    <!-- Maintenance page only-->
    <script src="{{ asset('assets/js/vendors/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/jquery.nestable.js') }}"></script>

    <style>
.dropdown-item {
    padding-left: 35px;
}
.dropdown-item-title {
    padding-left: 24px;
    font-weight: bold;
    background: rgba(216, 216, 216, 0.2);
}
    </style>
</head>
<body class="">

<div class="page">

<div class="page-main">
<div class="header py-4">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="../index.html">
                <img src="demo/brand/tabler.svg" class="header-brand-img" alt="tabler logo">
            </a>

            <div class="d-flex order-lg-2 ml-auto">
                <div class="nav-item d-none d-md-flex">
                    <a href="https://github.com/tabler/tabler" class="btn btn-sm btn-outline-primary" target="_blank">Source code</a>
                </div>
                <div class="dropdown d-none d-md-flex">
                    <a class="nav-link icon" data-toggle="dropdown">
                        <i class="fe fe-bell"></i>
                        <span class="nav-unread"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a href="#" class="dropdown-item d-flex">
                            <span class="avatar mr-3 align-self-center" style="background-image: url({{ asset('demo/faces/male/41.jpg') }})"></span>
                            <div>
                                <strong>Nathan</strong> pushed new commit: Fix page load performance issue.
                                <div class="small text-muted">10 minutes ago</div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item d-flex">
                            <span class="avatar mr-3 align-self-center" style="background-image: url({{ asset('demo/faces/female/1.jpg') }})"></span>
                            <div>
                                <strong>Alice</strong> started new task: Tabler UI design.
                                <div class="small text-muted">1 hour ago</div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item d-flex">
                            <span class="avatar mr-3 align-self-center" style="background-image: url({{ asset('demo/faces/female/18.jpg') }})"></span>
                            <div>
                                <strong>Rose</strong> deployed new version of NodeJS REST Api V3
                                <div class="small text-muted">2 hours ago</div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-center">Mark all as read</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                        <span class="avatar" style="background-image: url({{ asset('demo/faces/female/25.jpg') }})"></span>
                        <span class="ml-2 d-none d-lg-block">
                            <span class="text-default">Jane Pearson</span>
                            <small class="text-muted d-block mt-1">Administrator</small>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon fe fe-user"></i> Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon fe fe-settings"></i> Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <span class="float-right"><span class="badge badge-primary">6</span></span>
                            <i class="dropdown-icon fe fe-mail"></i> Inbox
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon fe fe-send"></i> Message
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon fe fe-log-out"></i> Sign out
                        </a>
                    </div>
                </div>
            </div>

            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
            </a>
        </div>
    </div>
</div>

<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                    <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                    <div class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </div>
                </form>
            </div>
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="../index.html" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Proyek</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="../new-project_select-client.html" class="dropdown-item  ">Tambah</a>
                            <a href="../" class="dropdown-item  dropdown-item-title">Daftar Proyek</a>
                            <a href="../project-list_aktif.html" class="dropdown-item  ">Sedang Berjalan</a>
                            <a href="../project-list_maintenance.html" class="dropdown-item  ">Sedang Maintenance</a>
                            <a href="../project-list_pending.html" class="dropdown-item  ">Draft</a>
                            <a href="../project-list_arsip-berhasil.html" class="dropdown-item  ">Arsip Berhasil</a>
                            <a href="../project-list_arsip-gagal.html" class="dropdown-item  ">Arsip Gagal</a>
                            <a href="../" class="dropdown-item  dropdown-item-title">Daftar Follow Up</a>
                            <a href="../project-list_followup.html" class="dropdown-item  ">Follow Up</a>
                            <a href="../project-list_followup-arsip.html" class="dropdown-item  ">Arsip</a>
                            <a href="../" class="dropdown-item  dropdown-item-title">Antrian Proyek dari Agen</a>
                            <a href="../agen_project-pending.html" class="dropdown-item  ">Antrian <span class="status-icon bg-danger"></span></a>
                            <a href="../agen_project-pending_arsip.html" class="dropdown-item  ">Arsip Antrian <span class="status-icon bg-danger"></span></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fa fa-user-o"></i> Client</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="../client-list.html" class="dropdown-item  ">Daftar Client</a>
                            <a href="../new-client_select-jenis.html" class="dropdown-item  ">Tambah</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fa fa-user-o"></i> Prospect</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="../prospect-list.html" class="dropdown-item  ">Daftar Prospect</a>
                            <a href="../new-prospect_select-jenis.html" class="dropdown-item  ">Tambah</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="../gallery.html" class="nav-link" data-toggle="dropdown"><i class="fe fe-image"></i> Agen</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="../komisi-agen_daftar.html" class="dropdown-item  ">Komisi Agen</a>
                            <a href="../agen-list.html" class="dropdown-item  ">Daftar Agen</a>
                            <a href="../new-agen_form.html" class="dropdown-item  ">Tambah Agen</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-activity"></i> Statistics</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="../project_statistics.html" class="dropdown-item  ">Proyek</a>
                            <a href="../charts.html" class="dropdown-item  ">Client</a>
                            <a href="../pricing-cards.html" class="dropdown-item  ">Prospect</a>
                            <a href="../pricing-cards.html" class="dropdown-item  ">Agen</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


    <div class="my-3 my-md-5">
        <style>
.btn-as-text {
    color: #495057;
    border: none;
    box-shadow: none;
    background: transparent;
    cursor: pointer;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;
    margin-top: 40px;
}
.stepwizard p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.stepwizard-step .btn.disabled {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}

.button-step .btn {
    width: 140px;
    display: inline-block;
}
.button-step .btn-as-text {
    width: 60px;
}

.page-title { margin: auto }

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}
        </style>

        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-secondary btn-circle">1</a>
                    <p>Step 1</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-primary btn-circle disabled">2</a>
                    <p>Step 2</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-secondary btn-circle disabled">3</a>
                    <p>Step 3</p>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="page-header">
            <h1 class="page-title">
                

                Pilih Jenis Proyek
            </h1>

            

            

            
        </div>

            <div class="row row-cards">
                <div class="col col-3 mx-auto">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                                <tbody>
                                    <tr>
                                        <td width="10%" class="text-center"><i class="fa fa-television text-muted"></i></td>
                                        <td width="80%">Desktop</td>
                                        <td width="10%" class="text-center">
                                            <a href="javascript:void(0)" class="btn btn-outline-info btn-sm">Pilih</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fa fa-globe text-muted"></i></td>
                                        <td>Web</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="btn btn-outline-info btn-sm">Pilih</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fa fa-android text-muted"></i></td>
                                        <td>Android</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="btn btn-outline-info btn-sm">Pilih</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fe fe-smartphone text-muted"></i></td>
                                        <td>Mobile</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="btn btn-outline-info btn-sm">Pilih</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="3">
                                            <a href="#" class="btn btn-outline-success"><i class="fe fe-plus mr-2"></i>Buat Baru</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cards">
                <div class="col col-3 mx-auto">
                    <a href="new-project_form.html?{{ app('request')->getQueryString() }}" class="btn btn-primary">Berikutnya</a>
                </div>
            </div>
        </div>

        <script>
            window.scroll(0, 65.133 + 55.5 + 1);
        </script>

        <!--
        THANKS TO:
        (Progress bar wizard) https://codepen.io/brettmichaelorr/pen/RaRZLe
        -->
    </div>
</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-6 col-md-3">
                        <ul class="list-unstyled mb-0">
                            <li><a href="#">First link</a></li>
                            <li><a href="#">Second link</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <ul class="list-unstyled mb-0">
                            <li><a href="#">Third link</a></li>
                            <li><a href="#">Fourth link</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <ul class="list-unstyled mb-0">
                            <li><a href="#">Fifth link</a></li>
                            <li><a href="#">Sixth link</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <ul class="list-unstyled mb-0">
                            <li><a href="#">Other link</a></li>
                            <li><a href="#">Last link</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
                Premium and Open Source dashboard template with responsive and high quality UI. For Free!
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item"><a href="../docs/index.html">Documentation</a></li>
                            <li class="list-inline-item"><a href="../faq.html">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="https://github.com/tabler/tabler" class="btn btn-outline-primary btn-sm">Source code</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                Copyright © 2018 <a href="..">Tabler</a>. Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a> All rights reserved.
            </div>
        </div>
    </div>
</footer>
</div>

</body>
</html>
