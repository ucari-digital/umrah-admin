@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Data Manifest Pesawat - {{App\Helper\TimeFormat::timeId($produk->tanggal_keberangkatan)}}</h5>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-md-12">
					<table class="table" style="width: 100%">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nama</th>
								<th scope="col">Seat</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($manifest as $item)
							<tr>
								<td></td>
								<td>{{$item->nama}}</td>
								<td>{{$item->kursi}}</td>
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
$title = 'Data Manifest Pesawat - '.App\Helper\TimeFormat::timeId($produk->tanggal_keberangkatan);
$column = '[0, 1, 2]';
$column_width = "[ 20, '*', '*']";
$header_alignment = 'left';
@endphp
<script src="{{url('data-table/datatables.min.js')}}"></script>
@endsection