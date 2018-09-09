@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Daftar peserta umroh perusahaan</h5>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">NIP</th>
								<th scope="col">NIK</th>
								<th scope="col">Nama</th>
								<th scope="col">JK</th>
								<th scope="col">Telp</th>
								<th scope="col">Email</th>
								<th scope="col" class="px-print">Kode Produk</th>
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
								<td class="px-print">{{$item->kode_produk}}</td>
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
$title = 'Daftar peserta umroh '.$title_label->nama;
$column = '[0, 1, 2, 3, 4, 5, 6]';
$column_width = "[ 'auto', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto']";
@endphp
<script src="{{url('data-table/datatables.min.js')}}"></script>
@endsection