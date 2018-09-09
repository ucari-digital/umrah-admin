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
								<th scope="col">Lokasi</th>
								<th scope="col">No. Kamar</th>
								<th scope="col">Tgl. Masuk</th>
								<th scope="col">Tgl. Keluar</th>
								<th scope="col">Tamu</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($hotel as $item)
							<tr>
								<td>{{$item->nama_hotel_madinah}}</td>
								<td>{{$item->lokasi_madinah}}</td>
								<td>{{$item->lantai_madinah.$item->nomor_kamar_madinah}}</td>
								<td>{{App\Helper\TimeFormat::timeId($item->durasi_hotel_madinah, 'date')}}</td>
								{{-- Menampilkan tgl keluar menggunakan carbon --}}
								<td>{{App\Helper\TimeFormat::carbonAddDaysId($item->durasi_hotel_madinah, 1)}}</td>
								<td rowspan="2" style="vertical-align: middle;text-align: center;">{{App\Http\Controllers\DataJamaahHotelController::jamaahHotel($item->kode_produk, $item->kode_kamar_madinah)}} Orang</td>
								<td rowspan="2" style="vertical-align: middle;text-align: center;">
									<a href="{{url('data-jamaah-hotel-detail').'/'.$item->kode_produk.'/'.$item->kode_kamar_madinah.'/'.$item->kode_kamar_mekkah}}">Lihat</a>
								</td>
							</tr>
							<tr>
								<td class="border-top-0">{{$item->nama_hotel_mekkah}}</td>
								<td class="border-top-0">{{$item->lokasi_mekkah}}</td>
								<td class="border-top-0">{{$item->lantai_mekkah.$item->nomor_kamar_mekkah}}</td>
								<td class="border-top-0">{{App\Helper\TimeFormat::timeId($item->durasi_hotel_mekkah, 'date')}}</td>
								<td class="border-top-0">{{App\Helper\TimeFormat::carbonAddDaysId($item->durasi_hotel_mekkah, 4)}}</td>
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
