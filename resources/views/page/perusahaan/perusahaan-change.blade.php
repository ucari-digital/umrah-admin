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
					<h5>Input Perusahaan</h5>
				</div>
			</div>
			<form action="{{url('perusahaan-update/'.$item->kode_perusahaan)}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="row mt-5">
					<div class="col-md-6">
						<div class="form-group">
							<label>Nama Perusahaan</label>
							<input type="text" class="form-control" name="nama_perusahaan" placeholder="Perusahaan" value="{{$item->nama}}">
						</div>
						<div class="form-group">
							<label>Domain</label>
							<input type="text" class="form-control" name="domain" placeholder="Domain" value="{{$item->domain}}">
						</div>
						<div class="form-group">
							<label>Telepon</label>
							<input type="text" class="form-control" name="telepon" placeholder="No. telepon" value="{{$item->telephone}}">
						</div>
						<div class="form-group">
							<label>Website</label>
							<input type="text" class="form-control" name="website" placeholder="Website" value="{{$item->website}}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" placeholder="Email" value="{{$item->email}}">
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea type="text" class="form-control" name="alamat" placeholder="Alamat">{{$item->alamat}}</textarea>
						</div>
						<div class="form-group">
							<label>logo</label>
							<input type="file" class="form-control" name="logo" placeholder="">
						</div>
						<div class="form-group">
							<label>Tagline</label>
							<input type="file" class="form-control" name="tagline" placeholder="">
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