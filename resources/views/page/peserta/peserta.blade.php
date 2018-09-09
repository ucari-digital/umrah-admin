@extends('index')
@section('content')
<div class="ml-2 mr-2">
	@if (session('status') == 'success')
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
	@endif

	@if (session('status') == 'failed')
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
	@endif
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Daftar peserta umroh perusahaan</h5>
				</div>
				<div class="col-md-3">
					<select id="inputState" class="form-control form-control-sm">
						<option selected>Pilih Field</option>
						<option value="0">NIP</option>
						<option value="1">NIK</option>
						<option value="2">No. Peserta</option>
						<option value="3">Nama</option>
						<option value="4">JK</option>
						<option value="5">Telp</option>
						<option value="6">Email</option>
					</select>
				</div>
				<div class="col-md-3">
					<input class="form-control form-control-sm" id="inputSearch" type="text" placeholder="Cari" onkeyup="searchField()">	
				</div>
			</div>
			<div class="row mt-2">
				<div class="table-responsive">
					<table class="table table-pg" id="tableSearch" style="min-width: 1300px;">
						<thead>
							<tr>
								<th scope="col">NIP</th>
								<th scope="col">NIK</th>
								<th scope="col">No. Peserta</th>
								<th scope="col">Nama</th>
								<th scope="col">JK</th>
								<th scope="col">Telp</th>
								<th scope="col">Email</th>
								<th scope="col">Status</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($peserta as $item)
							<tr>
								<td>{{$item->nip}}</td>
								<td>{{$item->nik}}</td>
								<td>{{str_replace('UMHPS', '', $item->nomor_peserta)}}</td>
								<td>{{$item->nama}}</td>
								<td>{{$item->jk}}</td>
								<td>{{$item->telephone}}</td>
								<td>{{$item->email}}</td>
								@if($item->status == 'approved')
								<td>
									<button class="btn btn-primary btn-sm">Approv</button>
									<div class="btn-group">
										<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Book
										</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="{{url('book/seat/peserta').'/'.str_replace('UMHPS', '', $item->nomor_peserta)}}">Seat</a>
    										<a class="dropdown-item" href="{{url('book/hotel/peserta').'/'.str_replace('UMHPS', '', $item->nomor_peserta)}}">Hotel</a>
										</div>
									</div>
									<a href="{{url('peserta/pin/'.$item->nomor_peserta)}}" class="btn btn-primary btn-sm">Pin</a>
								</td>
								@else
								<td>
									<a href="#" class="btn btn-primary btn-sm popover-btn" data-toggle="popover" title="Masukan uang muka" data-nps="{{$item->nomor_peserta}}">Approv</a>
									<a href="{{url('peserta/rejected').'/'.$item->nomor_peserta}}" class="btn btn-danger btn-sm">Reject</a>
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
<div class="d-none popover-content">
	<form class="form-post" method="post">
		@csrf
		<div class='row'>
			<div class='col-md-12'>
				<input type='text' name="uang_muka" class='form-control rupiah'>
			</div>
		</div>
		<div class='row mt-2'>
			<div class='col-md-8'>
				<button type="submit" class='btn-primary btn-block btn-sm'>
				Terapkan
				</button>
			</div>
			<div class='col-md-4'>
				<button type="button" class='btn-danger btn-sm popover-close'>
				Batal
				</button>
			</div>
		</div>
	</form>
</div>
@endsection
@section('footer')
<script>
	$(document).on("click", '.popover-btn', function(){
		$('.rupiah').maskMoney({prefix: 'Rp. ', thousands: '.', decimal: ',', precision: 0});
	});
	$('.popover-btn').popover({
    	html: true,
    	// trigger: 'focus',
    	content: $('.popover-content').html()
	});

	$('body').on('click', function (e) {
	    $('[data-toggle="popover"]').each(function () {
	        //the 'is' for buttons that trigger popups
	        //the 'has' for icons within a button that triggers a popup
	        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
	            $(this).popover('hide');
	        }
	    });
	});

	$('.popover-btn').on('inserted.bs.popover', function () {
		$('.form-post').attr('action', '{{url('peserta/approved').'/'}}'+$(this).data('nps'));
	});
</script>
@endsection
