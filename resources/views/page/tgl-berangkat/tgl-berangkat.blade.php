@extends('index')
@section('content')
<div class="ml-5 mr-5">
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
					<h5>Input Tanggal Keberangkatan</h5>
				</div>
			</div>
			<form action="{{url('tanggal-berangkat-post')}}" method="post">
				@csrf
				<div class="row mt-5">
					<div class="col-md-6">
						<div class="form-group">
							<label>Embarkasi</label>
							<select name="kode_embarkasi" class="form-control" required="">
								<option value="">Pilih</option>
								@foreach($embarkasi as $item)
								<option value="{{$item->kode_embarkasi}}">{{$item->kota}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Tanggal Keberangkatan</label>
							<input type="text" class="form-control datepicker" name="tanggal_keberangkatan">
						</div>
						<div class="form-group">
							<label>Jumlah Jamaah</label>
							<input type="text" class="form-control" name="seat">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Harga</label>
							<input type="text" class="form-control rupiah" name="harga" value="Rp. 25.000.000">
						</div>
						<div class="form-group">
							<label>Status</label>
							<select name="status" class="form-control">
								<option value="Y">Publish</option>
								<option value="N">Draft</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary btn-block">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script>
	$(document).ready(function () {
		$('.datepicker').datepicker({
			format: 'dd/mm/yyyy',
		    startDate: '{{Carbon\Carbon::now('Asia/Jakarta')->addDays(11)->format('d/m/Y')}}'
		});

	    $('.rupiah').maskMoney({prefix: 'Rp. ', thousands: '.', decimal: ',', precision: 0});
	    $('.number').maskMoney({thousands: '.', decimal: ',', precision: 0});
	});
</script>
@endsection