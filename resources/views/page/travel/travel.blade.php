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
					<h5>Input Travel</h5>
				</div>
			</div>
			<form action="{{url('travel-post')}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="row mt-5">
					<div class="col-md-6">
						<div class="form-group">
							<label>Nama Travel</label>
							<input type="text" class="form-control" name="nama" required="">
						</div>
						<div class="form-group">
							<label>Logo</label>
							<input type="file" class="form-control" name="logo" required="">
						</div>
						<div class="form-group">
							<label>Website</label>
							<input type="text" class="form-control" name="website" required="">
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
	    $('.select2').select2();
	    $('.rupiah').maskMoney({prefix: 'Rp. ', thousands: '.', decimal: ',', precision: 0});
	    $('.number').maskMoney({thousands: '.', decimal: ',', precision: 0});
	});
</script>
@endsection