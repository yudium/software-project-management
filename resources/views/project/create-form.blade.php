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

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}

.multiple-field-js {
    background: #f8f8f8;
    border: none;
}
.multiple-field-copy-target .fe {
    color: #a19090
}
</style>

<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-secondary btn-circle">1</a>
            <p>Step 1</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-secondary btn-circle disabled">2</a>
            <p>Step 2</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-primary btn-circle disabled">3</a>
            <p>Step 3</p>
        </div>
    </div>
</div>

<div class="container">

    <div class="page-header">
    <h1 class="page-title">
        

        Form Tambah Proyek
    </h1>

    

    

    
</div>

    <div class="row row-cards">
        <div class="col-4">
            <div class="row row-cards">
            <div class="col-12">
                <div class="card card-client">
                    <div class="card-header">
                        <h3 class="card-title">Data Client</h3>
                        <div class="card-options">
                            <a href="#" class="btn btn-primary btn-sm">Ganti</a>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center pt-2 mt-auto">
                            <div class="avatar avatar-md mr-3" style="background-image: url(./demo/faces/female/18.jpg)"></div>
                            <div>
                                <a href="./profile.html" class="text-default">{{ $client->name }}</a>
                                <div class="d-block text-muted">
                                    <span class="badge badge-success">Individu</span>
                                    <span class="badge badge-info">Prospect</span>
                                </div>
                            </div>
                            <div class="ml-auto">
                                <a href="#" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-eye mr-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <!--
                        <div class="card-footer">
                            This is standard card footer
                        </div>
                    -->
                </div>
            </div>
            <div class="col-12">
                <div class="card card-client">
                    <div class="card-header">
                        <h3 class="card-title">Data Keuangan</h3>
                    </div>
                    <div class="card-body">
                    <fieldset class="form-fieldset">
                        <div class="form-group">
                            <label class="form-label" for="name">Pembayaran <span class="form-required">*</span></label>
                            <div class="custom-controls-stacked">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" name="payment" value="cash" checked="" type="radio">
                                    <span class="custom-control-label">Cash</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" name="payment" value="transfer" type="radio">
                                    <span class="custom-control-label">Transfer</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tujuan Transfer</label>
                            <select disabled="" class="form-control custom-select">
                                <option value="">BNI</option>
                                <option value="">Mandiri</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal bayar DP</label>
                            <div class="row gutters-xs">
                                <div class="col-5">
                                    <select name="tgl_bayar_dp[month]" class="form-control custom-select">
                                        <option value="">Month</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option selected="selected" value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select name="tgl_bayar_dp[day]" class="form-control custom-select">
                                        <option value="">Day</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option selected="selected" value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select name="tgl_bayar_dp[year]" class="form-control custom-select">
                                        <option value="">Year</option>
                                        <option value="2014">2014</option>
                                        <option value="2013">2013</option>
                                        <option value="2012">2012</option>
                                        <option value="2011">2011</option>
                                        <option value="2010">2010</option>
                                        <option value="2009">2009</option>
                                        <option value="2008">2008</option>
                                        <option value="2007">2007</option>
                                        <option value="2006">2006</option>
                                        <option value="2005">2005</option>
                                        <option value="2004">2004</option>
                                        <option value="2003">2003</option>
                                        <option value="2002">2002</option>
                                        <option value="2001">2001</option>
                                        <option value="2000">2000</option>
                                        <option value="1999">1999</option>
                                        <option value="1998">1998</option>
                                        <option value="1997">1997</option>
                                        <option value="1996">1996</option>
                                        <option value="1995">1995</option>
                                        <option value="1994">1994</option>
                                        <option value="1993">1993</option>
                                        <option value="1992">1992</option>
                                        <option value="1991">1991</option>
                                        <option value="1990">1990</option>
                                        <option selected="selected" value="1989">1989</option>
                                        <option value="1988">1988</option>
                                        <option value="1987">1987</option>
                                        <option value="1986">1986</option>
                                        <option value="1985">1985</option>
                                        <option value="1984">1984</option>
                                        <option value="1983">1983</option>
                                        <option value="1982">1982</option>
                                        <option value="1981">1981</option>
                                        <option value="1980">1980</option>
                                        <option value="1979">1979</option>
                                        <option value="1978">1978</option>
                                        <option value="1977">1977</option>
                                        <option value="1976">1976</option>
                                        <option value="1975">1975</option>
                                        <option value="1974">1974</option>
                                        <option value="1973">1973</option>
                                        <option value="1972">1972</option>
                                        <option value="1971">1971</option>
                                        <option value="1970">1970</option>
                                        <option value="1969">1969</option>
                                        <option value="1968">1968</option>
                                        <option value="1967">1967</option>
                                        <option value="1966">1966</option>
                                        <option value="1965">1965</option>
                                        <option value="1964">1964</option>
                                        <option value="1963">1963</option>
                                        <option value="1962">1962</option>
                                        <option value="1961">1961</option>
                                        <option value="1960">1960</option>
                                        <option value="1959">1959</option>
                                        <option value="1958">1958</option>
                                        <option value="1957">1957</option>
                                        <option value="1956">1956</option>
                                        <option value="1955">1955</option>
                                        <option value="1954">1954</option>
                                        <option value="1953">1953</option>
                                        <option value="1952">1952</option>
                                        <option value="1951">1951</option>
                                        <option value="1950">1950</option>
                                        <option value="1949">1949</option>
                                        <option value="1948">1948</option>
                                        <option value="1947">1947</option>
                                        <option value="1946">1946</option>
                                        <option value="1945">1945</option>
                                        <option value="1944">1944</option>
                                        <option value="1943">1943</option>
                                        <option value="1942">1942</option>
                                        <option value="1941">1941</option>
                                        <option value="1940">1940</option>
                                        <option value="1939">1939</option>
                                        <option value="1938">1938</option>
                                        <option value="1937">1937</option>
                                        <option value="1936">1936</option>
                                        <option value="1935">1935</option>
                                        <option value="1934">1934</option>
                                        <option value="1933">1933</option>
                                        <option value="1932">1932</option>
                                        <option value="1931">1931</option>
                                        <option value="1930">1930</option>
                                        <option value="1929">1929</option>
                                        <option value="1928">1928</option>
                                        <option value="1927">1927</option>
                                        <option value="1926">1926</option>
                                        <option value="1925">1925</option>
                                        <option value="1924">1924</option>
                                        <option value="1923">1923</option>
                                        <option value="1922">1922</option>
                                        <option value="1921">1921</option>
                                        <option value="1920">1920</option>
                                        <option value="1919">1919</option>
                                        <option value="1918">1918</option>
                                        <option value="1917">1917</option>
                                        <option value="1916">1916</option>
                                        <option value="1915">1915</option>
                                        <option value="1914">1914</option>
                                        <option value="1913">1913</option>
                                        <option value="1912">1912</option>
                                        <option value="1911">1911</option>
                                        <option value="1910">1910</option>
                                        <option value="1909">1909</option>
                                        <option value="1908">1908</option>
                                        <option value="1907">1907</option>
                                        <option value="1906">1906</option>
                                        <option value="1905">1905</option>
                                        <option value="1904">1904</option>
                                        <option value="1903">1903</option>
                                        <option value="1902">1902</option>
                                        <option value="1901">1901</option>
                                        <option value="1900">1900</option>
                                        <option value="1899">1899</option>
                                        <option value="1898">1898</option>
                                        <option value="1897">1897</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    </div>
                    <!--
                        <div class="card-footer">
                            This is standard card footer
                        </div>
                    -->
                </div>
            </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-client">
                <div class="card-header">
                    <h3 class="card-title">Data Proyek</h3>
                </div>
                <div class="card-body">
                <fieldset class="form-fieldset">
                    <div class="form-group">
                        <label class="form-label" for="name">Nama lengkap <span class="form-required">*</span></label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="price">Nilai <span class="form-required">*</span></label>
                        <div class="input-group">
                            <span id="basic-addon1" class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </span>
                            <input class="form-control" type="text" name="price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">ID Board Trello</label>
                        <div class="row gutters-xs">
                            <div class="col">
                                <input class="form-control" type="text">
                            </div>
                            <span class="col-auto">
                                <a href="https://trello.com" target="_blank" class="btn btn-secondary" type="button">Buka Trello</a>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="backup_link">Link backup source code</label>
                        <input class="form-control" type="text" name="backup_link">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="project_link">Link proyek</label>
                        <input class="form-control" type="text" name="project_link">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="note">Catatan</label>
                        <textarea class="form-control" name="note"></textarea>
                    </div>
                </fieldset>
                </div>
                <!--
                    <div class="card-footer">
                        This is standard card footer
                    </div>
                -->
            </div>
        </div>  
        <div class="col-4">
            <div class="row row-cards">
                <div class="col-12 mb-5">
                    <a href="new-project_termin-pembayaran.html" class="btn btn-primary btn-block">Berikutnya</a>
                </div>
                <div class="col-12">
                    <div class="card card-client">
                        <div class="card-header">
                            <h3 class="card-title">Person In Charge</h3>
                        </div>
                        <div class="card-body">
                        <fieldset class="form-fieldset">
                            <div class="form-group">
                                <div class="input-group mb-2 multiple-field-copy-target">
                                    <input class="form-control" type="text">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
                                    </span>
                                </div>
                                <input class="form-control multiple-field-js" name="example-text-input" type="text" placeholder="Add item..">
                            </div>
                        </fieldset>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-client">
                        <div class="card-header">
                            <h3 class="card-title">Waktu Proyek</h3>
                        </div>
                        <div class="card-body">
                        <fieldset class="form-fieldset">
                            <div class="form-group">
                                <label class="form-label">Waktu Mulai Proyek</label>
                                <div class="row gutters-xs">
                                    <div class="col-5">
                                        <select name="tgl_bayar_dp[month]" class="form-control custom-select">
                                            <option value="">Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option selected="selected" value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select name="tgl_bayar_dp[day]" class="form-control custom-select">
                                            <option value="">Day</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option selected="selected" value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select name="tgl_bayar_dp[year]" class="form-control custom-select">
                                            <option value="">Year</option>
                                            <option value="2014">2014</option>
                                            <option value="2013">2013</option>
                                            <option value="2012">2012</option>
                                            <option value="2011">2011</option>
                                            <option value="2010">2010</option>
                                            <option value="2009">2009</option>
                                            <option value="2008">2008</option>
                                            <option value="2007">2007</option>
                                            <option value="2006">2006</option>
                                            <option value="2005">2005</option>
                                            <option value="2004">2004</option>
                                            <option value="2003">2003</option>
                                            <option value="2002">2002</option>
                                            <option value="2001">2001</option>
                                            <option value="2000">2000</option>
                                            <option value="1999">1999</option>
                                            <option value="1998">1998</option>
                                            <option value="1997">1997</option>
                                            <option value="1996">1996</option>
                                            <option value="1995">1995</option>
                                            <option value="1994">1994</option>
                                            <option value="1993">1993</option>
                                            <option value="1992">1992</option>
                                            <option value="1991">1991</option>
                                            <option value="1990">1990</option>
                                            <option selected="selected" value="1989">1989</option>
                                            <option value="1988">1988</option>
                                            <option value="1987">1987</option>
                                            <option value="1986">1986</option>
                                            <option value="1985">1985</option>
                                            <option value="1984">1984</option>
                                            <option value="1983">1983</option>
                                            <option value="1982">1982</option>
                                            <option value="1981">1981</option>
                                            <option value="1980">1980</option>
                                            <option value="1979">1979</option>
                                            <option value="1978">1978</option>
                                            <option value="1977">1977</option>
                                            <option value="1976">1976</option>
                                            <option value="1975">1975</option>
                                            <option value="1974">1974</option>
                                            <option value="1973">1973</option>
                                            <option value="1972">1972</option>
                                            <option value="1971">1971</option>
                                            <option value="1970">1970</option>
                                            <option value="1969">1969</option>
                                            <option value="1968">1968</option>
                                            <option value="1967">1967</option>
                                            <option value="1966">1966</option>
                                            <option value="1965">1965</option>
                                            <option value="1964">1964</option>
                                            <option value="1963">1963</option>
                                            <option value="1962">1962</option>
                                            <option value="1961">1961</option>
                                            <option value="1960">1960</option>
                                            <option value="1959">1959</option>
                                            <option value="1958">1958</option>
                                            <option value="1957">1957</option>
                                            <option value="1956">1956</option>
                                            <option value="1955">1955</option>
                                            <option value="1954">1954</option>
                                            <option value="1953">1953</option>
                                            <option value="1952">1952</option>
                                            <option value="1951">1951</option>
                                            <option value="1950">1950</option>
                                            <option value="1949">1949</option>
                                            <option value="1948">1948</option>
                                            <option value="1947">1947</option>
                                            <option value="1946">1946</option>
                                            <option value="1945">1945</option>
                                            <option value="1944">1944</option>
                                            <option value="1943">1943</option>
                                            <option value="1942">1942</option>
                                            <option value="1941">1941</option>
                                            <option value="1940">1940</option>
                                            <option value="1939">1939</option>
                                            <option value="1938">1938</option>
                                            <option value="1937">1937</option>
                                            <option value="1936">1936</option>
                                            <option value="1935">1935</option>
                                            <option value="1934">1934</option>
                                            <option value="1933">1933</option>
                                            <option value="1932">1932</option>
                                            <option value="1931">1931</option>
                                            <option value="1930">1930</option>
                                            <option value="1929">1929</option>
                                            <option value="1928">1928</option>
                                            <option value="1927">1927</option>
                                            <option value="1926">1926</option>
                                            <option value="1925">1925</option>
                                            <option value="1924">1924</option>
                                            <option value="1923">1923</option>
                                            <option value="1922">1922</option>
                                            <option value="1921">1921</option>
                                            <option value="1920">1920</option>
                                            <option value="1919">1919</option>
                                            <option value="1918">1918</option>
                                            <option value="1917">1917</option>
                                            <option value="1916">1916</option>
                                            <option value="1915">1915</option>
                                            <option value="1914">1914</option>
                                            <option value="1913">1913</option>
                                            <option value="1912">1912</option>
                                            <option value="1911">1911</option>
                                            <option value="1910">1910</option>
                                            <option value="1909">1909</option>
                                            <option value="1908">1908</option>
                                            <option value="1907">1907</option>
                                            <option value="1906">1906</option>
                                            <option value="1905">1905</option>
                                            <option value="1904">1904</option>
                                            <option value="1903">1903</option>
                                            <option value="1902">1902</option>
                                            <option value="1901">1901</option>
                                            <option value="1900">1900</option>
                                            <option value="1899">1899</option>
                                            <option value="1898">1898</option>
                                            <option value="1897">1897</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Waktu Akhir Proyek</label>
                                <div class="row gutters-xs">
                                    <div class="col-5">
                                        <select name="tgl_bayar_dp[month]" class="form-control custom-select">
                                            <option value="">Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option selected="selected" value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select name="tgl_bayar_dp[day]" class="form-control custom-select">
                                            <option value="">Day</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option selected="selected" value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select name="tgl_bayar_dp[year]" class="form-control custom-select">
                                            <option value="">Year</option>
                                            <option value="2014">2014</option>
                                            <option value="2013">2013</option>
                                            <option value="2012">2012</option>
                                            <option value="2011">2011</option>
                                            <option value="2010">2010</option>
                                            <option value="2009">2009</option>
                                            <option value="2008">2008</option>
                                            <option value="2007">2007</option>
                                            <option value="2006">2006</option>
                                            <option value="2005">2005</option>
                                            <option value="2004">2004</option>
                                            <option value="2003">2003</option>
                                            <option value="2002">2002</option>
                                            <option value="2001">2001</option>
                                            <option value="2000">2000</option>
                                            <option value="1999">1999</option>
                                            <option value="1998">1998</option>
                                            <option value="1997">1997</option>
                                            <option value="1996">1996</option>
                                            <option value="1995">1995</option>
                                            <option value="1994">1994</option>
                                            <option value="1993">1993</option>
                                            <option value="1992">1992</option>
                                            <option value="1991">1991</option>
                                            <option value="1990">1990</option>
                                            <option selected="selected" value="1989">1989</option>
                                            <option value="1988">1988</option>
                                            <option value="1987">1987</option>
                                            <option value="1986">1986</option>
                                            <option value="1985">1985</option>
                                            <option value="1984">1984</option>
                                            <option value="1983">1983</option>
                                            <option value="1982">1982</option>
                                            <option value="1981">1981</option>
                                            <option value="1980">1980</option>
                                            <option value="1979">1979</option>
                                            <option value="1978">1978</option>
                                            <option value="1977">1977</option>
                                            <option value="1976">1976</option>
                                            <option value="1975">1975</option>
                                            <option value="1974">1974</option>
                                            <option value="1973">1973</option>
                                            <option value="1972">1972</option>
                                            <option value="1971">1971</option>
                                            <option value="1970">1970</option>
                                            <option value="1969">1969</option>
                                            <option value="1968">1968</option>
                                            <option value="1967">1967</option>
                                            <option value="1966">1966</option>
                                            <option value="1965">1965</option>
                                            <option value="1964">1964</option>
                                            <option value="1963">1963</option>
                                            <option value="1962">1962</option>
                                            <option value="1961">1961</option>
                                            <option value="1960">1960</option>
                                            <option value="1959">1959</option>
                                            <option value="1958">1958</option>
                                            <option value="1957">1957</option>
                                            <option value="1956">1956</option>
                                            <option value="1955">1955</option>
                                            <option value="1954">1954</option>
                                            <option value="1953">1953</option>
                                            <option value="1952">1952</option>
                                            <option value="1951">1951</option>
                                            <option value="1950">1950</option>
                                            <option value="1949">1949</option>
                                            <option value="1948">1948</option>
                                            <option value="1947">1947</option>
                                            <option value="1946">1946</option>
                                            <option value="1945">1945</option>
                                            <option value="1944">1944</option>
                                            <option value="1943">1943</option>
                                            <option value="1942">1942</option>
                                            <option value="1941">1941</option>
                                            <option value="1940">1940</option>
                                            <option value="1939">1939</option>
                                            <option value="1938">1938</option>
                                            <option value="1937">1937</option>
                                            <option value="1936">1936</option>
                                            <option value="1935">1935</option>
                                            <option value="1934">1934</option>
                                            <option value="1933">1933</option>
                                            <option value="1932">1932</option>
                                            <option value="1931">1931</option>
                                            <option value="1930">1930</option>
                                            <option value="1929">1929</option>
                                            <option value="1928">1928</option>
                                            <option value="1927">1927</option>
                                            <option value="1926">1926</option>
                                            <option value="1925">1925</option>
                                            <option value="1924">1924</option>
                                            <option value="1923">1923</option>
                                            <option value="1922">1922</option>
                                            <option value="1921">1921</option>
                                            <option value="1920">1920</option>
                                            <option value="1919">1919</option>
                                            <option value="1918">1918</option>
                                            <option value="1917">1917</option>
                                            <option value="1916">1916</option>
                                            <option value="1915">1915</option>
                                            <option value="1914">1914</option>
                                            <option value="1913">1913</option>
                                            <option value="1912">1912</option>
                                            <option value="1911">1911</option>
                                            <option value="1910">1910</option>
                                            <option value="1909">1909</option>
                                            <option value="1908">1908</option>
                                            <option value="1907">1907</option>
                                            <option value="1906">1906</option>
                                            <option value="1905">1905</option>
                                            <option value="1904">1904</option>
                                            <option value="1903">1903</option>
                                            <option value="1902">1902</option>
                                            <option value="1901">1901</option>
                                            <option value="1900">1900</option>
                                            <option value="1899">1899</option>
                                            <option value="1898">1898</option>
                                            <option value="1897">1897</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        </div>
                        <!--
                            <div class="card-footer">
                                This is standard card footer
                            </div>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.scroll(0, 65.133 + 55.5 + 1);

    $(document).ready(function(){
        $(".form-group").on("click", ".multiple-field-js", function(){
            let el = $(this);
            let clonedTarget = el.parent().children(".multiple-field-copy-target").first().clone();
            let insertedEl = clonedTarget.insertBefore(el);
            insertedEl.children("input")
                .val("")
                .focus();
        });
    });
</script>

<!--
THANKS TO:
(Progress bar wizard) https://codepen.io/brettmichaelorr/pen/RaRZLe
-->

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

<script>
require(['datatables', 'jquery'], function(datatable, $) {
    $('.datatable-client').DataTable({
        serverSide: true,
        ajax: '{{ url('project/new/select-client/ajax/client') }}',
        // because I want to remove sort icon for col 0
        order: [],
        columnDefs: [
            {
                render: function(data, type, row) {
                    // TODO: ubah path asset pake row['client.photo']
                    // reference: https://www.datatables.net/examples/advanced_init/column_render.html
                    return `
                        <div class="avatar d-block" style="background-image: url({{ asset('demo/faces/female/26.jpg') }})">
                        <span class="avatar-status bg-green"></span>
                        </div>
                    `;
                },
                orderable: false,
                targets: 0,
            },
            {
                render: function(data, type, row) {
                    return `
                        <div>${data}</div>
                        <div class="small text-muted">
                            <span class="badge badge-secondary">${row['type']['name']}</span>
                        </div>
                    `;
                },
                targets: 1,
            },
            {
                render: function(data, type, row) {
                    return `
                        <a href="{{ url('project/new/select-type.html') }}?client_id=${row['id']}&client_status=client]}" class="btn btn-outline-info btn-sm">Pilih</a>
                    `;
                },
                orderable: false,
                targets: 3,
            },
        ],
        columns: [
            { data: 'photo' },
            { data: 'name' },
            { data: 'business_relationship_status' },
            { data: null },
        ]
    });

    $('.datatable-prospect').DataTable({
        serverSide: true,
        ajax: '{{ url('project/new/select-client/ajax/prospect') }}',
        // because I want to remove sort icon for col 0
        order: [],
        columnDefs: [
            {
                render: function(data, type, row) {
                    // TODO: ubah path asset pake row['client.photo']
                    // reference: https://www.datatables.net/examples/advanced_init/column_render.html
                    return `
                        <div class="avatar d-block" style="background-image: url({{ asset('demo/faces/female/26.jpg') }})">
                        <span class="avatar-status bg-green"></span>
                        </div>
                    `;
                },
                orderable: false,
                targets: 0,
            },
            {
                render: function(data, type, row) {
                    return `
                        <div>${data}</div>
                        <div class="small text-muted">
                            <span class="badge badge-secondary">${row['type']['name']}</span>
                        </div>
                    `;
                },
                targets: 1,
            },
            {
                render: function(data, type, row) {
                    return `
                        <a href="{{ url('project/new/select-type.html') }}?client_id=${row['id']}&client_status=prospect]}" class="btn btn-outline-info btn-sm">Pilih</a>
                    `;
                },
                orderable: false,
                targets: 3,
            },
        ],
        columns: [
            { data: 'photo' },
            { data: 'name' },
            { data: 'business_relationship_status' },
            { data: null },
        ],
    });
});
</script>

</body>
</html>
