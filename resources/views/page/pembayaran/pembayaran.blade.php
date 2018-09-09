@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Data Pembayaran</h5>
				</div>
				<div class="col-md-3">
					<select id="inputState" class="form-control form-control-sm">
						<option selected>Pilih Field</option>
						<option value="0">No. Pembayaran</option>
						<option value="1">Bank</option>
						<option value="2">Nama</option>
						<option value="3">Perusahaan</option>
						<option value="4">Tgl Pembayaran</option>
						<option value="5">Jumlah Pembayaran</option>
						<option value="6">Bukti Pembayaran</option>
						<option value="7">Jenis Pembayaran</option>
					</select>
				</div>
				<div class="col-md-3">
					<input class="form-control form-control-sm" id="inputSearch" type="text" placeholder="Cari" onkeyup="searchField()">	
				</div>
			</div>
			<div class="row mt-5">
				<div class="table-responsive">
					<table class="table" style="width: 1500px" id="tableSearch">
						<thead>
							<tr>
								<th scope="col">No. Pembayaran</th>
								<th scope="col">Bank</th>
								<th scope="col">Nama</th>
								<th scope="col">Perusahaan</th>
								<th scope="col">Tgl Pembayaran</th>
								<th scope="col">Jumlah Pembayaran</th>
								<th scope="col">Bukti Pembayaran</th>
								<th scope="col">Jenis Pembayaran</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($pembayaran as $item)
							<tr>
								<td>{{$item->nomor_pembayaran}}</td>
								<td>{{$item->nama_bank}}</td>
								<td>{{$item->nama}}</td>
								<td>{{$item->nama_perusahaan}}</td>
								<td>{{App\Helper\TimeFormat::timeId($item->tgl_pembayaran)}}</td>
								<td>{{App\Helper\Number::rupiah($item->jumlah_pembayaran)}}</td>
								<td class="text-center">
									<a href="{{$item->bukti}}">
										Lihat
									</a>
								</td>
								@if($item->jenis_pembayaran == 'dp')
								<td>Uang Muka</td>
								@elseif($item->jenis_pembayaran == 'pelunasan')
								<td>Pelunasan</td>
								@endif
								@if($item->status == 'approved')
								<td>
									Approv
								</td>
								@else
								<td>
									<a href="{{url('pembayaran/approved').'/'.$item->nomor_pembayaran}}" class="btn btn-primary btn-sm">Approv</a>
									<a href="{{url('pembayaran/rejected').'/'.$item->nomor_pembayaran}}" class="btn btn-danger btn-sm">Reject</a>
								</td>
								@endif
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