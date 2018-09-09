@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Daftar peserta umroh perusahaan</h5>
				</div>
				<div class="col-md-3">
					<select id="inputState" class="form-control form-control-sm">
						<option selected>Pilih Field</option>
						<option value="0">Nama Perusahaan</option>
						<option value="1">Semua Jamaah</option>
						<option value="2">Jamaah diverifikasi</option>
						<option value="3">Jamaah belum diferifikasi</option>
					</select>
				</div>
				<div class="col-md-3">
					<input class="form-control form-control-sm" id="inputSearch" type="text" placeholder="Cari" onkeyup="searchField()">	
				</div>
			</div>
			<div class="row mt-2">
				<div class="table-responsive" id="tablePrint">
					<table class="table" id="tableSearch">
						<thead>
							<tr>
								<th scope="col">Nama Perusahaan</th>
								<th scope="col">Semua Jamaah</th>
								<th scope="col">Jamaah diverifikasi</th>
								<th scope="col">Jamaah belum diverifikasi</th>
								<th scope="col" class="px-print">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($perusahaan as $item)
							<tr>
								<td>{{$item->nama}}</td>
								<td>{{App\Http\Controllers\PerusahaanPendaftarController::jamaahPerusahaan($item->kode_perusahaan)}} Orang</td>
								<td>{{App\Http\Controllers\PerusahaanPendaftarController::jamaahVerifikasi($item->kode_perusahaan)}} Orang</td>
								<td>{{App\Http\Controllers\PerusahaanPendaftarController::jamaahUnverifikasi($item->kode_perusahaan)}} Orang</td>
								<td class="px-print">
									<a href="{{url('perusahaan-pendaftar').'/'.$item->kode_perusahaan}}">Lihat</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="col-md-12 place-pagination">
					<div class="place-pg"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
@endsection