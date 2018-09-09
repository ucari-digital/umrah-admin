<!DOCTYPE html>
<html>
<head>
	<title>Jamaah Perusahaan</title>
	<link href="{{url('vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
	<style>
		@page { margin: 20px 0px; }
		* {
			font-size: 12px;
		}
		.table {
		    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		    border-collapse: collapse;
		    width: 100%;
		    border: 1px solid #efefef;
		}

		.table td, .table th {
		    /*border: 1px solid #ddd;*/
		    padding: 8px;
		}

		.table tr:nth-child(odd){background-color: #f2f2f2;}

		.table tr:hover {background-color: #ddd;}

		.table .t-header {
		    padding-top: 12px;
		    padding-bottom: 12px;
		    text-align: left;
		    background-color: transparent !important;
		    color: #212121;
		    border: 1px solid #efefef;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row mt-2 mb-4">
			<div class="col-md-12">
				<h3 class="text-center mt-3">Laporan jamaah perusahaan PT. Mandiri Tbk.</h3>
			</div>
		</div>
		@if($produk)
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<tr>
						<th>Keberangkatan</th>
						<th>Embarkasi</th>
					</tr>
					<tr>
						<td>
							<h4>
								{{App\Helper\TimeFormat::timeId($produk->tanggal_keberangkatan, 'full')}}
							</h4>
						</td>
						<td>
							<h4>{{$produk->embarkasi}}</h4>
						</td>
					</tr>
				</table>
			</div>
		</div>
		@endif
		<div class="row">
			<div class="col-md-12">
				<table class="table mt-4">
					<tr class="t-header">
						<th>#</th>
						<th>Perusahaan</th>
						<th>NIP</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>JK</th>
						<th>Telp</th>
						<th>Email</th>
						@if(!$produk)
						<th>Keberangkatan</th>
						<th>Embarkasi</th>
						@endif
						<th>Status</th>
					</tr>
					@php
					$no = 0;
					@endphp
					@foreach($data as $item)
					<tr>
						<td>{{$no += 1}}</td>
						<td>{{$item->nama_perusahaan}}</td>
						<td>{{$item->nip}}</td>
						<td>{{$item->nik}}</td>
						<td>{{$item->nama}}</td>
						<td>{{$item->jk}}</td>
						<td>{{$item->telephone}}</td>
						<td>{{$item->email}}</td>
						@if(!$produk)
						<td>{{App\Helper\TimeFormat::timeId($item->tanggal_keberangkatan, 'date')}}</td>
						<td>{{$item->embarkasi}}</td>
						@endif
						<td>{{$item->status}}</td>
					</tr>
					@endforeach
{{-- 					<tr>
						<td>1</td>
						<td>PT. Mandiri TBK</td>
						<td>1234567890</td>
						<td>1234567890123456</td>
						<td>Dimas Adi Stria</td>
						<td>L</td>
						<td>08159510969</td>
						<td>dimas@gmail.com</td>
						<td>Umrah - 17 Juli 2018 - Jakarta</td>
						<td>Approved</td>
					</tr>
					<tr>
						<td>1</td>
						<td>PT. Mandiri TBK</td>
						<td>1234567890</td>
						<td>1234567890123456</td>
						<td>Dimas Adi Stria</td>
						<td>L</td>
						<td>08159510969</td>
						<td>dimas@gmail.com</td>
						<td>Umrah - 17 Juli 2018 - Jakarta</td>
						<td>Approved</td>
					</tr> --}}
				</table>
			</div>
		</div>
	</div>
	<script type="text/php">

	    if ( isset($pdf) ) {
	        $x = 810;
	        $y = 570;
	        $text = "{PAGE_NUM} / {PAGE_COUNT}";
	        $font = $fontMetrics->get_font("Arial", "bold");
	        $size = 8;
	        $color = array(0,0,0);
	        $word_space = 0.0;  //  default
	        $char_space = 0.0;  //  default
	        $angle = 0.0;   //  default
	        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
	    }

	</script>
</body>
</html>