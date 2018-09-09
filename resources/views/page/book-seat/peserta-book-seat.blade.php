@extends('index')
@section('header')
<style>
	.plane-map{
		position: fixed;
		top: 150px;
		float: right;
		right: 0;
		padding: 10px;
    	background-color: #0069d9;
    	color: #FFF;
    	cursor: pointer;
	}
	.plane-map > i {
		font-size: 24px;
	}
	.map-seat{
		height: 100%;
	    position: absolute;
	    top: 0;
	    z-index: 9;
	    right: 0;
	    overflow-x: auto;
	}
	.map-seat > img {
		position: initial;
	}
	.hide{
		position: absolute;
	    top: 0;
	    right: 392px;
	    color: #fff;
	    z-index: 10;
	    font-size: 34px;
	    background-color: #2C343A;
	    padding: 0 20px;
	    cursor: pointer
	}
</style>
@endsection
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
					<h5>Book Seat Peserta</h5>
				</div>
			</div>
			<form action="{{url('book/seat/peserta-post')}}" method="post">
				@csrf
				<input type="hidden" name="no_peserta" value="">
				<input type="hidden" name="kode_embarkasi" value="">
				<input type="hidden" name="tanggal_keberangkatan" value="">
				<input type="hidden" name="nomor_transaksi" value="">
				<div class="row mt-5">
					<div class="col-md-6">
						<div class="form-group">
							<label>Peserta</label>
							<div class="input-group mb-3">
								<input name="" type="text" class="form-control" placeholder="No. Peserta" id="peserta" value="{{request('nomor_peserta')}}">
								<div class="input-group-append">
									<span class="input-group-text" id="peserta-addon">-</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Embarkasi</label>
							<input type="text" class="form-control" name="" id="embarkasi" readonly="">
						</div>
						<div class="form-group">
							<label>Tanggal Keberangkatan</label>
							<input type="text" class="form-control" name="" id="kode_produk" readonly="">
						</div>
						<div class="form-group">
							<label>Seat Pesawat</label>
							<select name="seat" class="form-control" id="seat_pesawat" required="">
								<option value="">Pilih</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary btn-block">Simpan </button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="float-right plane-map">
	Map Seat <i class="fas fa-plane"></i>
</div>
<div class="seat" style="display: none;">
	<div class="hide">></div>
	<div class="map-seat">
		<img src="{{url('image/seat.png')}}" alt="">
	</div>
</div>
@endsection
@section('footer')
<script>
	$('.plane-map').click(function(){
		$('.seat').show();
	});
	$('.hide').click(function(){
		$('.seat').hide();
	});

	$(document).ready(function(){
		query_load($('#peserta').val());
		$('#peserta').keyup(function(){
			query_load(this.value);
		});
		$('#embarkasi').change(function(){
			var q_url = '{{url()->full()}}';
			var url = q_url.replace(/\?embk=([^&]*)/, '');
			window.location.replace(url+'?embk='+this.value);
		});
		$('.select2').select2();
	});
	function query_load(value) {
		$.post( "{{url('peserta-cek')}}", {
            '_token': '{{csrf_token()}}',
            'nomor_peserta' : 'UMHPS'+value
        })
        .done(function(data){
        	console.log(data);
        	$("input[name='no_peserta']").val(data['data']['nomor_peserta']);
        	$("input[name='kode_embarkasi']").val(data['data']['kode_embarkasi']);
        	$("input[name='tanggal_keberangkatan']").val(data['data']['kode_produk']);
        	$("input[name='nomor_transaksi']").val(data['data']['nomor_transaksi']);

        	$('#peserta-addon').html(data['data']['nama']);
        	$('#peserta').val(data['data']['nomor_peserta']);
        	$('#embarkasi').val(data['data']['embarkasi']);
        	$('#kode_produk').val(data['data']['nama_produk']);

        	$.post( "{{url('book/seat/availabel/fiktif')}}", {
            '_token': '{{csrf_token()}}',
            'kode_produk' : data['data']['kode_produk']
	        })
	        .done(function(data){
	        	console.log(data);
	        	$('#seat_pesawatat').html('');
	            $.each(data, function(key, value) {   
				     $('#seat_pesawat')
				         .append($("<option></option>")
				                    .attr("value",'{{$pesawat->kode_pesawat}}'+value)
				                    .text(value)); 
				});
	        });
        });
	}
</script>
@endsection