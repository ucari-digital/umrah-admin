@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Informasi Peserta</h5>
				</div>
				<div class="col-md-3">
					<select id="inputState" class="form-control form-control-sm">
						<option selected>Pilih Field</option>
						<option value="0">Nama</option>
						<option value="1">Perusahaan</option>
						<option value="2">Tgl. Keberangkatan</option>
					</select>
				</div>
				<div class="col-md-3">
					<input class="form-control form-control-sm" id="inputSearch" type="text" placeholder="Cari" onkeyup="searchField()">	
				</div>
			</div>
			<div class="row mt-2">
				<div class="table-responsive">
					<table class="table table-pg" id="tableSearch">
						<thead>
							<tr>
								<th scope="col">Nama</th>
								<th scope="col">Perusahaan</th>
								<th scope="col">Tgl. Keberangkatan</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($peserta as $item)
							<tr>
								<td>{{$item->nama}}</td>
								<td>{{$item->nama_perusahaan}}</td>
								<td>{{App\Helper\TimeFormat::timeId($item->tanggal_keberangkatan)}}</td>
								<td><a href="{{url('informasi-peserta-detail').'/'.$item->nomor_transaksi}}">Detail</a></td>
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
