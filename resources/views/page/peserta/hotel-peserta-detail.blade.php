@extends('index')
@section('content')
<div class="ml-2 mr-2">
	@if (session('status') == 'success')
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
	@endif

	@if (session('status') == 'failed')
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
	@endif
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Data Peserta Hotel</h5>
				</div>
				<div class="col-md-3">
					<select id="inputState" class="form-control form-control-sm">
						<option selected>Pilih Field</option>
						<option value="1">NIP</option>
						<option value="2">NIK</option>
						<option value="3">Nama</option>
						<option value="4">JK</option>
						<option value="5">Telp</option>
						<option value="6">Hubungan Kerabat</option>
					</select>
				</div>
				<div class="col-md-3">
					<input class="form-control form-control-sm" id="inputSearch" type="text" placeholder="Cari" onkeyup="searchField()">	
				</div>
			</div>
			<div class="row mt-2">
				<div class="table-responsive" id="tablePrint">
					<table class="table table-pg" id="tableSearch">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">NIP</th>
								<th scope="col">NIK</th>
								<th scope="col">Nama</th>
								<th scope="col">JK</th>
								<th scope="col">Telp</th>
								<th scope="col">Hubungan Kerabat</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($jamaah_hotel as $item)
							<tr>
								<td>{{$no = $no + 1}}</td>
								<td>{{$item->nip}}</td>
								<td>{{$item->nik}}</td>
								<td>{{$item->nama}}</td>
								<td>{{$item->jk}}</td>
								<td>{{$item->telephone}}</td>
								@if($item->hubungan_keluarga == null)
								<td>Diri Sendiri</td>
								@else
								<td>{{$item->hubungan_keluarga}}</td>
								@endif
								<td><a href="{{url('hotel-peserta-delete').'/'.$item->lokasi.'/'.$item->nomor_transaksi}}">Keluarkan</a></td>
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
@section('navbar')
	@if($item->check_status == 'true')
		<a href="#" class="btn btn-success">Approved</a>
	@else
		<a href="{{url('hotel-peserta-check/'.$item->kode_produk.'/'.$item->lokasi.'/'.$item->kode_kamar_madinah.'/'.$item->kode_kamar_mekkah)}}" class="btn btn-primary">Approve</a>
	@endif
@endsection