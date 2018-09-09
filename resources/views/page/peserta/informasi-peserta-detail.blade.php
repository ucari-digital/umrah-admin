@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-12 mb-4">
					<h4>Informasi Peserta</h4>
				</div>
				<div class="col-md-2 foto pr-0">
					<div class="img">
						<img src="{{optional($dokumen)->foto}}" alt="">
					</div>
				</div>
				<div class="col-md-4 pl-0">
					<table>
						<tr>
							<td class="px-2 pb-2" colspan="2"><h4>{{$peserta->nama}}</h4></td>
						</tr>
						<tr>
							<td class="px-2"><strong>Jenis Kelamin</strong></td>
							@if($peserta->jk == 'L')
							<td class="px-2"><span>Laki - laki</span></td>
							@else
							<td class="px-2"><span>Perempuan</span></td>
							@endif
						</tr>
						<tr>
							<td class="px-2"><strong>Perusahaan</strong></td>
							<td class="px-2"><span>{{optional($peserta)->nama_perusahaan}}</span></td>
						</tr>
						<tr>
							<td class="px-2"><strong>Nip</strong></td>
							<td class="px-2"><span>{{optional($peserta)->nip}}</span></td>
						</tr>
						<tr>
							<td class="px-2"><strong>Nik</strong></td>
							<td class="px-2"><span>{{optional($peserta)->nik}}</span></td>
						</tr>
						<tr>
							<td class="px-2"><strong>No. Telp</strong></td>
							<td class="px-2"><span>{{optional($peserta)->telephone}}</span></td>
						</tr>
						<tr>
							<td class="px-2"><strong>Email</strong></td>
							<td class="px-2"><span>{{optional($peserta)->email}}</span></td>
						</tr>
					</table>
				</div>
				<div class="col-md-6">
					<table>
						<tr>
							<td class="px-2 pb-2" colspan="2"><h4>Paket & Tgl. Keberangkatan</h4></td>
						</tr>
						<tr>
							<td class="px-2"><strong>Nama Paket</strong></td>
							<td class="px-2"><span>{{optional($produk)->nama_produk}}</span></td>
						</tr>
						<tr>
							<td class="px-2"><strong>Tgl. Keberangkatan</strong></td>
							<td class="px-2"><span>{{App\Helper\TimeFormat::timeId(optional($produk)->tanggal_keberangkatan)}}</span></td>
						</tr>
						<tr>
							<td class="px-2"><strong>Tgl. Kepulangan</strong></td>
							<td class="px-2"><span>{{App\Helper\TimeFormat::timeId(optional($produk)->tanggal_kepulangan)}}</span></td>
						</tr>
						<tr>
							<td class="px-2"><strong>Harga Paket</strong></td>
							<td class="px-2"><span>{{App\Helper\Number::rupiah(optional($produk)->harga)}}</span></td>
						</tr>
					</table>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12 mb-3">
					<h4>Informasi Hotel & Pesawat</h4>
				</div>
				<div class="col-md-5">
					<table>
						<tr>
							<td colspan="2" style="width: 300px"><h5>Hotel Madinah</h5></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td ><strong>Hotel</strong></td>
							<td class="px-2"><span>{{optional($hotel_madinah)->nama_hotel}}</span></td>
						</tr>
						<tr>
							<td class=""><strong>Lantai</strong></td>
							<td class="px-2"><span>{{optional($hotel_madinah)->lantai}}</span></td>
						</tr>
						<tr>
							<td class=""><strong>No. Kamar</strong></td>
							<td class="px-2"><span>{{optional($hotel_madinah)->lantai.optional($hotel_madinah)->nomor_kamar}}</span></td>
						</tr>
					</table>
				</div>
				<div class="col-md-5">
					<table>
						<tr>
							<td colspan="2" style="width: 300px"><h5>Hotel Mekkah</h5></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td ><strong>Hotel</strong></td>
							<td class="px-2"><span>{{optional($hotel_mekkah)->nama_hotel}}</span></td>
						</tr>
						<tr>
							<td class=""><strong>Lantai</strong></td>
							<td class="px-2"><span>{{optional($hotel_mekkah)->lantai}}</span></td>
						</tr>
						<tr>
							<td class=""><strong>No. Kamar</strong></td>
							<td class="px-2"><span>{{optional($hotel_mekkah)->lantai.optional($hotel_mekkah)->nomor_kamar}}</span></td>
						</tr>
					</table>
				</div>
				<div class="col-md-2">
					<table>
						<tr>
							<td colspan="2"><h5>Seat Pesawat</h5></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td>
								<h4 class="text-center">{{optional($pesawat)->kursi}}</h4>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<h4>Dokumen</h4>
				</div>
				<div class="col-md-12">
					<table>
						<tr>
							<td class="table-image px-1">
								<div class="box">
									<img src="{{optional($dokumen)->foto}}" alt="" class="img-modal">
									<div class="placeholder">
										<h6 class="text-white">Foto</h6>
									</div>
								</div>
							</td>
							<td class="table-image px-1">
								<div class="box">
									<img src="{{optional($dokumen)->passpor}}" alt="" class="img-modal">
									<div class="placeholder">
										<h6 class="text-white">Paspor</h6>
									</div>
								</div>
							</td>
							<td class="table-image px-1">
								<div class="box">
									<img src="{{optional($dokumen)->kartu_keluarga}}" alt="" class="img-modal">
									<div class="placeholder">
										<h6 class="text-white">Kartu Keluarga</h6>
									</div>
								</div>
							</td>
							<td class="table-image px-1">
								<div class="box">
									<img src="{{optional($dokumen)->kartu_kuning}}" alt="" class="img-modal">
									<div class="placeholder">
										<h6 class="text-white">Kartu Kuning</h6>
									</div>
								</div>
							</td>
							<td class="table-image px-1">
								<div class="box">
									<img src="{{optional($dokumen)->kartu_karyawan}}" alt="" class="img-modal">
									<div class="placeholder">
										<h6 class="text-white">Kartu Karyawan</h6>
									</div>
								</div>
							</td>
							<td class="table-image px-1">
								<div class="box">
									<img src="{{optional($dokumen)->ktp}}" alt="" class="img-modal">
									<div class="placeholder">
										<h6 class="text-white">KTP</h6>
									</div>
								</div>
							</td>
							<td class="table-image px-1">
								<div class="box">
									<img src="{{optional($dokumen)->buku_nikah}}" alt="" class="img-modal">
									<div class="placeholder">
										<h6 class="text-white">Buku Nikah</h6>
									</div>
								</div>
							</td>
							<td class="table-image px-1">
								<div class="box">
									<img src="{{optional($dokumen)->akta}}" alt="" class="img-modal">
									<div class="placeholder">
										<h6 class="text-white">Akta</h6>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12 mb-3">
					<h4>Pembayaran</h4>
				</div>
				@foreach($pembayaran as $item)
				<div class="col-md-12">
					<div class="pembayaran">
						<div class="timeline-point"></div>
						<div class="timeline-line"></div>
						<div class="timeline-content">
							<div class="col-md-4">
								<div class="card">
									<div class="card-body">
										<strong class="d-block">{{App\Helper\TimeFormat::formatId($item->tgl_pembayaran)}}</strong>
										@if($item->jenis_pembayaran == 'dp')
										<span class="d-block">Pembayaran Uang muka</span>
										@else 
										<span class="d-block">Pembayaran {{$item->jenis_pembayaran}}</span>
										@endif
										@if($item->status == 'approved')
										<h4 class="mt-1">{{App\Helper\Number::rupiah($item->jumlah_pembayaran)}} &nbsp;<i class="fa fa-check text-success"></i></h4>
										@else
										<h4 class="mt-1">{{App\Helper\Number::rupiah($item->jumlah_pembayaran)}} &nbsp;<i class="fa fa-check text-success"></i></h4>
										@endif
										<a href="{{$item->bukti}}" class="btn btn-primary btn-block btn-sm mt-2">Bukti Pembayaran</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection
@section('header')
<style>
	.pembayaran{
		position: inherit;
	}
	.timeline-point{
		background-color: #EEEEEE;
	    width: 15px;
	    height: 15px;
	    position: absolute;
	    top: 30%;
	    border-radius: 50%;
	}
	.timeline-line{
		width: 2px;
	    height: 190px;
	    background-color: #EEEEEE;
	    position: absolute;
	    left: 6.4px;
	}
	.timeline-content{
		margin-left: 18px;
	}

	.foto > .img{
		width: 125px;
		margin: 0 auto;
	}
	.foto > img {
		width: 125px;
	}
	table{
		font-size: 14px;
	}
	.table-image{
		
	}
	.box{
		border: 1px solid rgba(0,0,0,.1);
		height: 130px;
		width: 100px;	
	}
	.placeholder{
		width: 100px;
	    height: 60px;
	    position: absolute;
	    top: 69px;
	    background-color: rgba(0,105,217,.8);
	    text-align: center;
	    padding: 10px 5px;
	    color: #FFF;
	}
	.table-image .card, .pembayaran img{
		width: 100px;
	}
	.table-image  img {
		width: 100px;
		max-height: 128px;
	}
</style>
@endsection