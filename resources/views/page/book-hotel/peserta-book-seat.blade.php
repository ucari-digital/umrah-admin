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
	    top: 75px;
	    z-index: 9;
	    right: 0;
	    overflow-x: auto;
	}
	.map-seat > img {
		position: initial;
	}
	.hide{
		position: absolute;
	    top: 75px;
	    right: 797px;
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
					<h5>Book Hotel Peserta</h5>
				</div>
			</div>
			<form action="{{url('book/hotel/peserta-post')}}" method="post">
				@csrf
				<input type="hidden" name="no_peserta" value="">
				<input type="hidden" name="kode_embarkasi" value="">
				<input type="hidden" name="tanggal_keberangkatan" value="">
				<input type="hidden" name="nomor_transaksi" value="">
				<div class="row mt-5">
					<div class="col-md-6">
						<div class="form-group">
							<label>Lokasi</label>
							<select name="lokasi" class="form-control" id="lokasi" required="">
								<option value="">Pilih</option>
								@if('madinah' == request('lokasi'))
								<option value="madinah" selected="">Madinah</option>
								<option value="mekkah">Mekkah</option>
								@elseif('mekkah' == request('lokasi'))
								<option value="mekkah" selected="">Mekkah</option>
								<option value="madinah">Madinah</option>
								@else
								<option value="mekkah">Mekkah</option>
								<option value="madinah">Madinah</option>
								@endif
							</select>
						</div>
						<div class="form-group">
							<label>Hotel</label>
							<select name="hotel" class="form-control" id="hotel" required="">
								<option value="">Pilih</option>
								@foreach($hotel as $item)
								@if($item->kode_hotel == request('hotel'))
								<option value="{{$item->kode_hotel}}" selected="">{{$item->nama_hotel}}</option>
								@else
								<option value="{{$item->kode_hotel}}">{{$item->nama_hotel}}</option>
								@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Lantai</label>
							<select name="lantai" class="form-control" id="lantai" required="">
								<option value="">Pilih</option>
								@for($i=1; $i <= 30; $i++)
									@if($i == request('lantai'))
									<option value="{{$i}}" selected="">{{$i}}</option>
									@else
									<option value="{{$i}}">{{$i}}</option>
									@endif
								@endfor
							</select>
						</div>	
					</div>
					@if(request('lantai'))
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
							<label>Ruangan</label>
							<select name="room" class="form-control" id="room" required="">
								<option value="">Pilih</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary btn-block">Simpan </button>
					</div>
					@endif
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
		<img src="{{url('image/hotel-seat.png')}}" alt="">
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
		$('#lokasi').change(function(){
			var q_url = window.location.href.split('?')[0];
			var url = q_url.replace(/\?lokasi=([^&]*)/, '');
			window.location.replace(url+'?lokasi='+this.value);
		});
		$('#hotel').change(function(){
			var url = window.location.href.split('?')[0];
			window.location.href = url+'?lokasi={{request('lokasi')}}&hotel='+this.value;
		});
		$('#lantai').change(function(){
			var url = window.location.href.split('?')[0];
			window.location.href = url+'?lokasi={{request('lokasi')}}&hotel={{request('hotel')}}&lantai='+this.value;
		});
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

        	$.post( "{{url('book/hotel/availabel')}}", {
	            '_token': '{{csrf_token()}}',
	            'kode_produk' : data['data']['kode_produk'],
	            'lokasi' : $('#lokasi').val(),
	            'hotel' : $('#hotel').val(),
	            'lantai' : $('#lantai').val()
	        })
	        .done(function(data){
	        	console.log(data);
	        	$('#room').html('');
	        	$.each(data, function(key, value) {   
				    $('#room')
				    .append($("<option></option>")
				    .attr("value", value['nomor_transaksi'])
				    .text(value['lantai']+value['nomor_kamar']+' - '+value['jumlah_orang']+' Orang')); 
				});
	        });
	    });
	}
</script>
@endsection