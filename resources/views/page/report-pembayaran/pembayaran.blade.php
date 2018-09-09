@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Data Pembayaran</h5>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-md-12" id="tablePrint">
					<table class="table" style="width: 100%">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Kode Pembayaran</th>
								<th scope="col">Nama</th>
								{{-- <th scope="col">Tgl Pengiriman</th> --}}
								<th scope="col">Jumlah Pembayaran</th>
								<th scope="col">Jenis Pembayaran</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($pembayaran as $item)
							<tr>
								<td></td>
								<td>{{$item->nomor_pembayaran}}</td>
								<td>{{$item->nama}}</td>
								<td>{{App\Helper\Number::rupiah($item->jumlah_pembayaran)}}</td>
								{{-- <td>{{App\Helper\TimeFormat::timeId($item->tanggal_keberangkatan)}}</td> --}}
								@if($item->jenis_pembayaran == 'dp')
								<td>Uang Muka</td>
								@elseif($item->jenis_pembayaran == 'pelunasan')
								<td>Pelunasan</td>
								@endif
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
$title = 'Data Pembayaran';
$column = '[0, 1, 2, 3, 4]';
$column_width = "[ 20, '*', '*', '*', '*']";
$header_alignment = 'left';
@endphp
<script src="{{url('data-table/datatables.min.js')}}"></script>
@endsection