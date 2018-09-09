@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Data Keberangkatan Peserta - {{App\Helper\TimeFormat::timeId($produk->tanggal_keberangkatan)}}</h5>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-md-12">
					<table class="table" style="width:100%">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">NIP</th>
								<th scope="col">NIK</th>
								<th scope="col">Nama</th>
								<th scope="col">JK</th>
								<th scope="col">Telp</th>
								<th scope="col">Email</th>
								<th scope="col" class="px-print">Status</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($peserta as $item)
							<tr>
								<td></td>
								<td>{{$item->nip}}</td>
								<td>{{$item->nik}}</td>
								<td>{{$item->nama}}</td>
								<td>{{$item->jk}}</td>
								<td>{{$item->telephone}}</td>
								<td>{{$item->email}}</td>
								<td class="px-print">{{$item->status}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
@php
$title = "Data Keberangkatan Peserta - ".App\Helper\TimeFormat::timeId($produk->tanggal_keberangkatan);
$column = '[0, 1, 2, 3, 4, 5, 6]';
$column_width = "[ 'auto', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto']";
@endphp
<script src="{{url('data-table/datatables.min.js')}}"></script>
@endsection