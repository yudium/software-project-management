@extends('template.master')
@section('title', 'Tambah Proyek: Form Utama')

@section('content')
<div class="container">
	<div class="page-header">
		<h1 class="page-title">
			Dashboard
		</h1>
	</div>

	<div class="row row-cards">
		<div class="col-lg-3">
			<div class="card p-3 px-4">
				<div>
					Proyek
				</div>
				<div class="py-4 m-0 text-center h1 text-green">35</div>
				<div class="d-flex">
					<small class="text-muted">Total</small>
				</div>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="card p-3 px-4">
				<div>
					Client
				</div>
				<div class="py-4 m-0 text-center h1 text-blue">32</div>
				<div class="d-flex">
					<small class="text-muted">Total</small>
				</div>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="card p-3 px-4">
				<div>
					Prospect
				</div>
				<div class="py-4 m-0 text-center h1 text-warning">5</div>
				<div class="d-flex">
					<small class="text-muted">Total</small>
				</div>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="card p-3 px-4">
				<div>
					Penghasilan
				</div>
				<div class="py-4 m-0 text-center h1 text-red">Rp.14.000.000</div>
				<div class="d-flex">
					<small class="text-muted">Seluruh proyek</small>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-lg-6">
			<div class="card">
				<div class="card-header">
					<h2 class="card-title">Proyek Berjalan</h2>
				</div>
				<table class="table card-table">
				<tbody>
					@for ($i = 0; $i < 5; $i++)
					<tr>
						<td>
							Pembangunan Aplikasi Sistem Informasi
							<div class="text-muted">
								deadline 250 hari lagi
							</div>
						</td>
						<td class="text-right">
							<span class="text-muted">
								2/3 task selesai
							</span>
							<div>
								<span class="badge badge-secondary">30%</span>
							</div>
						</td>
					</tr>
					@endfor
				</tbody>
				</table>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Termin</h4>
				</div>
				<table class="table card-table">
					<tbody>
						@for ($i = 0; $i < 3; $i++)
						<tr>
							<td>
								<span class="bg-warning mr-3" style="border-radius:100%;font-size:20px;padding:4px 8px;">25</span>
								<a href="#">hari lagi penagihan</a>
							</td>
							<td></td>
						</tr>
						@endfor
					</tbody>
				</table>
			</div>
		</div>

		<div class="col-3">
			<div class="row">
				<div class="col-lg-12">
					<div class="card p-3">
						<div class="d-flex align-items-center">
							<span class="stamp stamp-md bg-blue mr-3">
								<i class="fe fe-briefcase"></i>
							</span>
							<div>
								<h4 class="m-0"><a href="javascript:void(0)">132 <small>Proyek Berjalan</small></a></h4>
								<small class="text-muted">dari 10 total proyek</small>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
						<div class="card p-3">
						<div class="d-flex align-items-center">
							<span class="stamp stamp-md bg-warning mr-3">
								<i class="fe fe-book"></i>
							</span>
							<div>
								<h4 class="m-0"><a href="javascript:void(0)">132 <small>Proyek Draft</small></a></h4>
								<small class="text-muted">menunggu untuk dikonfirmasi</small>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
						<div class="card p-3">
						<div class="d-flex align-items-center">
							<span class="stamp stamp-md bg-red mr-3">
								<i class="fe fe-bookmark"></i>
							</span>
							<div>
								<h4 class="m-0"><a href="javascript:void(0)">132 <small>Proyek Potensial</small></a></h4>
								<small class="text-muted">menunggu untuk di-follow up</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection