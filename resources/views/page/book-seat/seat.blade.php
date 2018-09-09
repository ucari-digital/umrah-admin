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
					<h5>Book Seat</h5>
				</div>
			</div>
			<form action="{{url('book/seat-post')}}" method="post">
				@csrf
				<div class="row mt-5">
					<div class="col-md-6">
						<div class="form-group">
							<label>Embarkasi</label>
							<select name="embarkasi" class="form-control" id="embarkasi" required="">
								<option value="">Pilih</option>
								@foreach($embarkasi as $item)
								@if($item->kode_embarkasi == request('embk'))
								<option value="{{$item->kode_embarkasi}}" selected="">{{$item->kota}}</option>
								@else
								<option value="{{$item->kode_embarkasi}}">{{$item->kota}}</option>
								@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Tanggal Keberangkatan</label>
							<select name="kode_produk" class="form-control" id="tgl_berangkat" required="">
								<option value="">Pilih</option>
								@foreach($produk as $produk)
								<option value="{{$produk->kode_produk}}">{{$produk->nama_produk}}</option>
								@endforeach
							</select>
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
		$('#tgl_berangkat').change(function(){
			$.post( "{{url('book/seat/availabel')}}", {
            '_token': '{{csrf_token()}}',
            'kode_produk' : $(this).val()
	        })
	        .done(function(data){
	        	console.log(data);
	            $.each(data, function(key, value) {   
				     $('#seat_pesawat')
				         .append($("<option></option>")
				                    .attr("value",'{{$pesawat->kode_pesawat}}'+value)
				                    .text(value)); 
				});
	        });
		});
		$('#embarkasi').change(function(){
			var q_url = '{{url()->full()}}';
			var url = q_url.replace(/\?embk=([^&]*)/, '');
			window.location.replace(url+'?embk='+this.value);
		});
	});
</script>
@endsection
@section('navbar')
<a href="{{url('book/seat/peserta/')}}" class="btn btn-primary">+ Peserta Book Seat</a>
@endsection