<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 ml-auto">
      
            </div>
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link active"><i class="fe fe-home"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link @if(request()->segment(1) == 'project') active @endif" data-toggle="dropdown"><i class="fe fe-box"></i>
                            Proyek</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{ route('create-project-step1') }}" class="dropdown-item  ">Tambah</a>
                            <a href="../" class="dropdown-item  dropdown-item-title">Daftar Proyek</a>
                            <a href="{{ route('onprogress-project-list') }}" class="dropdown-item  ">Proyek Berjalan</a>
                            <a href="" class="dropdown-item  ">Draft **</a>
                            <a href="" class="dropdown-item  ">Arsip Berhasil **</a>
                            <a href="" class="dropdown-item  ">Arsip Gagal **</a>
                            <a href="../" class="dropdown-item  dropdown-item-title">Proyek Potensial</a>
                            <a href="{{ route('create-potential-project-step1') }}" class="dropdown-item  ">Tambah</a>
                            <a href="{{ route('potential-project-list') }}" class="dropdown-item  ">Daftar</a>
                            <a href="{{ route('potential-project-list-archive') }}" class="dropdown-item  ">Arsip</a>
                            <a href="../" class="dropdown-item  dropdown-item-title">Antrian Proyek dari Agen</a>
                            <a href="../agen_project-pending.html" class="dropdown-item  ">Antrian ** <span class="status-icon bg-danger"></span></a>
                            <a href="../agen_project-pending_arsip.html" class="dropdown-item  ">Arsip Antrian **<span
                                    class="status-icon bg-danger"></span></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link @if(request()->segment(1) == 'client') active @endif" data-toggle="dropdown"><i class="fa fa-user-o"></i>
                            Client</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{ route('clientList') }}" class="dropdown-item  ">Daftar Client</a>
                            <a href="{{ route('newClientTypes') }}" class="dropdown-item  ">Tambah</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link @if(request()->segment(1) == 'prospect') active @endif" data-toggle="dropdown"><i class="fa fa-user-o"></i>
                            Prospect</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{ route('prospectList') }}" class="dropdown-item  ">Daftar Prospect</a>
                            <a href="{{ route('newProspectTypes') }}" class="dropdown-item  ">Tambah</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="../gallery.html" class="nav-link" data-toggle="dropdown"><i class="fe fe-image"></i>
                            Agen</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="../komisi-agen_daftar.html" class="dropdown-item  ">Komisi Agen</a>
                            <a href="../agen-list.html" class="dropdown-item  ">Daftar Agen</a>
                            <a href="../new-agen_form.html" class="dropdown-item  ">Tambah Agen</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-activity"></i>
                            Statistics</a>
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
