@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Data Jamaah Hotel</h5>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-md-12" id="tablePrint">
					<table class="table" style="width: 100%">
						<thead>
							<tr>
								<th scope="col"></th>
								<th scope="col">NIP</th>
								<th scope="col">NIK</th>
								<th scope="col">Nama</th>
								<th scope="col">JK</th>
								<th scope="col">Telp</th>
								<th scope="col">Hubungan Kerabat</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($jamaah_hotel as $item)
							<tr>
								<td></td>
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
$title = 'Data jamaah hotel ';
$column = '[0, 1, 2, 3, 4, 5, 6]';
$column_width = "[ 'auto', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto'];";
$header_alignment = 'center';
@endphp
<script src="{{url('data-table/datatables.min.js')}}"></script>
@endsection