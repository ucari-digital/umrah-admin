@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Data Jamaah</h5>
				</div>
				<div class="col-md-3">
					<select id="inputState" class="form-control form-control-sm">
						<option selected>Pilih Field</option>
						<option value="0">Perusahaan</option>
						<option value="1">Peserta</option>
					</select>
				</div>
				<div class="col-md-3">
					<input class="form-control form-control-sm" id="inputSearch" type="text" placeholder="Cari" onkeyup="searchField()">	
				</div>
			</div>
			<div class="row mt-2">
				<div class="table-responsive">
					<table class="table" id="tableSearch">
						<thead>
							<tr>
								<th scope="col">Perusahaan</th>
								<th scope="col">Peserta</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($perusahaan as $item)
							<tr>
								<td>{{$item->nama}}</td>
								<td>{{App\Http\Controllers\DataJamaahController::pesertaPerusahaan($item->kode_perusahaan, $item->kode_produk)}} Orang</td>
								<td>
									<a href="{{url('data-jamaah-perusahaan-detail').'/'.$item->kode_produk.'/'.$item->kode_perusahaan}}">Lihat</a>
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