@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Data Kelengkapan Dokumen</h5>
				</div>
			</div>>
			<div class="row mt-2">
				<div class="col-md-12">
					<table class="table" style="width: 100%">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nama</th>
								<th scope="col">Perusahaan</th>
								<th scope="col">Tanggal Keberangkatan</th>
								<th scope="col">status</th>
								<th scope="col" class="px-print">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($dokumen as $item)
							<tr>
								<td></td>
								<td>{{$item->nama}}</td>
								<td>{{$item->nama_perusahaan}}</td>
								<td>{{App\Helper\TimeFormat::timeId($item->tanggal_keberangkatan)}}</td>
								<td>{{App\Http\Controllers\KelengkapanDokumenController::statusDokumen($item->nomor_transaksi)}}</td>
								<td class="px-print">
									<a href="{{url('kelengkapan-dokumen').'/'.$item->nomor_transaksi}}">Lihat</a>
								</td>
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
$title = 'Data Kelengkapan Dokumen';
$column = '[0, 1, 2, 3, 4]';
$column_width = "[ 'auto', 'auto', 'auto', 'auto', 'auto']";
@endphp
<script src="{{url('data-table/datatables.min.js')}}"></script>
@endsection