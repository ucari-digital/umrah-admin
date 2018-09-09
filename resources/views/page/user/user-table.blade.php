@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Data Tanggal Keberangkatan</h5>
				</div>
			</div>
			<div class="row mt-5">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nama</th>
								<th scope="col">Email</th>
								<th scope="col">Status</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($user as $item)
							<tr>
								<th scope="row">{{$no = $no + 1}}</th>
								<td>{{$item->nama_user}}</td>
								<td>{{$item->email}}</td>
								<td>{{$item->status}}</td>
								@if($item->status == 'active')
								<td><a href="{{url('users').'/inactive'.'/'.$item->kode_user}}" class="btn btn-danger btn-sm">Nonaktifkan</a></td>
								@else
								<td><a href="{{url('users').'/active'.'/'.$item->kode_user}}" class="btn btn-primary btn-sm">Aktifkan</a></td>
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
<script>
	$(document).ready(function () {
	$('.select2').select2();
	$('.rupiah').maskMoney({prefix: 'Rp. ', thousands: '.', decimal: ',', precision: 0});
	$('.number').maskMoney({thousands: '.', decimal: ',', precision: 0});
	});
</script>
@endsection