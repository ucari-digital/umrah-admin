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
					<h5>Book Hotel</h5>
				</div>
			</div>
			<form action="{{url('book/hotel-post')}}" method="post">
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
								@if($produk->kode_produk == request('tgl_berangkat'))
								<option value="{{$produk->kode_produk}}" selected="">{{$produk->nama_produk}}</option>
								@else
								<option value="{{$produk->kode_produk}}">{{$produk->nama_produk}}</option>
								@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Lokasi</label>
							<select name="lokasi" class="form-control" id="lokasi" required="">
								<option value="">Pilih</option>
								@if(request('embk'))
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
								@endif
							</select>
						</div>
					</div>
					<div class="col-md-6">
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
						<div class="form-group">
							<label>Ruangan</label>
							<select name="room" class="form-control" id="room" required="">
								<option value="">Pilih</option>
								@foreach($room as $item)
									@if($item['status'] == true)
										<option value="{{$item['kode_kamar']}}">{{$item['lantai'].$item['nomor_kamar']}}</option>
									@endif
								@endforeach
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
		$('#embarkasi').change(function(){
			var q_url = '{{url()->full()}}';
			var url = q_url.replace(/\?embk=([^&]*)/, '');
			window.location.replace(url+'?embk='+this.value);
		});
		$('#tgl_berangkat').change(function(){
			var q_url = '{{url()->full()}}';
			var clean_amp = q_url.replace(/\&amp;/g, '&');
			var clean_url = clean_amp.replace(/\&amp;tgl_berangkat=([^&]*)/g, '');
			var url = clean_url.replace(/\&tgl_berangkat=([^&]*)/, '');
			window.location.href = url+'&tgl_berangkat='+this.value;
		});
		$('#lokasi').change(function(){
			var q_url = '{{url()->full()}}';
			var clean_amp = q_url.replace(/\&amp;/g, '&');
			var clean_url = clean_amp.replace(/\&amp;lokasi=([^&]*)/g, '');
			var url = clean_url.replace(/\&lokasi=([^&]*)/, '');
			window.location.href = url+'&lokasi='+this.value;
		});
		$('#lantai').change(function(){
			var q_url = '{{url()->full()}}';
			var clean_amp = q_url.replace(/\&amp;/g, '&');
			var clean_url = clean_amp.replace(/\&amp;lantai=([^&]*)/g, '');
			var url = clean_url.replace(/\&lantai=([^&]*)/, '');
			window.location.href = url+'&lantai='+this.value;
		});
		$('#hotel').change(function(){
			var q_url = '{{url()->full()}}';
			var clean_amp = q_url.replace(/\&amp;/g, '&');
			var clean_url = clean_amp.replace(/\&amp;hotel=([^&]*)/, '');
			var url = clean_url.replace(/\&hotel=([^&]*)/, '');
			window.location.href = url+'&hotel='+this.value;
		});
	});
</script>
@endsection
@section('navbar')
<a href="{{url('book/hotel/peserta')}}" class="btn btn-primary">+ Peserta Book Hotel</a>
@endsection