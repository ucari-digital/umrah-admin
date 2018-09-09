@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Data Jamaah Hotel</h5>
				</div>
				<div class="col-md-3">
					<select id="inputState" class="form-control form-control-sm">
						<option selected>Pilih Field</option>
						<option value="0">Hotel</option>
						<option value="1">No. Kamar</option>
						<option value="2">Tgl. Masuk</option>
						<option value="3">Tgl. Keluar</option>
						<option value="4">Tamu</option>
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
								<th scope="col">Hotel</th>
								<th scope="col">No. Kamar</th>
								<th scope="col">Tgl. Masuk</th>
								<th scope="col">Tgl. Keluar</th>
								<th scope="col">Tamu</th>
								<th scope="col">Status</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($hotel as $item)
							<tr>
								<td>{{$item->nama_hotel}}</td>
								<td>{{$item->lantai.$item->nomor_kamar}}</td>
								@if($item->lokasi == 'madinah')
								<td>{{App\Helper\TimeFormat::timeId($item->durasi_hotel_madinah, 'date')}}</td>
								@elseif($item->lokasi == 'mekkah')
								<td>{{App\Helper\TimeFormat::timeId($item->durasi_hotel_mekkah, 'date')}}</td>
								@endif
								{{-- Menampilkan tgl keluar menggunakan carbon --}}
								@if($item->lokasi == 'madinah')
								<td>{{App\Helper\TimeFormat::carbonAddDaysId($item->durasi_hotel_madinah, 2)}}</td>
								@elseif($item->lokasi == 'mekkah')
								<td>{{App\Helper\TimeFormat::carbonAddDaysId($item->durasi_hotel_mekkah, 5)}}</td>
								@endif
								<td>{{App\Http\Controllers\DataJamaahHotelController::jamaahHotel($item->kode_produk, $item->kode_kamar)}} Orang</td>
								@if($item->check_status == 'true')
								<td>Check</td>
								@else
								<td></td>
								@endif
								<td>
									<a href="{{url('hotel-peserta-detail').'/'.$item->kode_produk.'/'.$item->kode_kamar_madinah.'/'.$item->kode_kamar_mekkah}}">Lihat</a>
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
