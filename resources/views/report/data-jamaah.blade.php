@extends('report.layout-report')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Jamaah</h1>
</div>
<div class="content mt-3">
	<div class="row">
		<div class="col-md-3">
			<button class="btn btn-secondary btn-sm" type="button" data-toggle="collapse" data-target="#filter-form" aria-expanded="false" aria-controls="collapseExample">
		    Filter
		  	</button>
		  	@if(request()->all())
		  	<form class="d-inline-block" action="{{url('report/jamaah-perusahaan/print')}}" method="post">
		  		@csrf
		  		<input type="hidden" name="kode_perusahaan" value="{{request('kode_perusahaan')}}">
		  		<input type="hidden" name="nik" value="{{request('nik')}}">
		  		<input type="hidden" name="nip" value="{{request('nip')}}">
		  		<input type="hidden" name="nama" value="{{request('nama')}}">
		  		<input type="hidden" name="jk" value="{{request('jk')}}">
		  		<input type="hidden" name="telp" value="{{request('telp')}}">
		  		<input type="hidden" name="email" value="{{request('email')}}">
		  		<input type="hidden" name="kode_produk" value="{{request('kode_produk')}}">
		  		<input type="hidden" name="tgl_dari" value="{{request('tgl_dari')}}">
		  		<input type="hidden" name="tgl_sampai" value="{{request('tgl_sampai')}}">
		  		<input type="hidden" name="status" value="{{request('status')}}">
		  		<button class="btn btn-secondary btn-sm">Print</button>
		  	</form>
		  	@endif
		</div>
	</div>
	<div class="collapse mt-3" id="filter-form">
		<form action="{{url('report/jamaah-perusahaan')}}" method="post">
			@csrf
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Perusahaan</label>
				<div class="col-sm-10">
					<select name="kode_perusahaan">
						<option value="">Pilih Perusahaan</option>
						@foreach($perusahaan as $item)
						<option value="{{$item->kode_perusahaan}}">{{$item->nama}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIP</label>
				<div class="col-sm-10">
					<input type="text" name="nip" class="form-control-x" placeholder="NIP">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIK</label>
				<div class="col-sm-10">
					<input type="text" name="nik" class="form-control-x" placeholder="NIK">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-10">
					<input type="text" name="nama" class="form-control-x" placeholder="Nama">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">JK</label>
				<div class="col-sm-10">
					<select name="jk">
						<option value="">Pilih Jenis Kelamin</option>
						<option value="L">Laki - Laki</option>
						<option value="P">Perempuan</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Telp</label>
				<div class="col-sm-10">
					<input type="text" name="telp" class="form-control-x" placeholder="Telp">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
					<input type="text" name="email" class="form-control-x" placeholder="Email">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Produk</label>
				<div class="col-sm-10">
					<select name="kode_produk">
						<option value="">Pilih Produk</option>
						@foreach($produk as $item)
						<option value="{{$item->kode_produk}}">{{$item->nama_produk}} - {{$item->kota}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tanggal Keberangkatan</label>
				<div class="col-sm-2">
					<input type="date" name="tgl_dari" placeholder="dari">
					<span style="float: right;">s.d.</span>
				</div>
				<div class="col-sm-2">
					<input type="date" name="tgl_sampai">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Status</label>
				<div class="col-sm-10">
					<select name="status">
						<option value="approved">Approved</option>
						<option value="pending">Pending</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label"></label>
				<div class="col-sm-10">
					<button type="submit" class="btn btn-secondary btn-sm">Terapkan</button>
				</div>
			</div>
		</form>
	</div>
	<div class="table-responsive mt-3">
		<table class="table">
			<tr>
				<th>#</th>
				<th>Perusahaan</th>
				<th>NIP</th>
				<th>NIK</th>
				<th>Nama</th>
				<th>Jk</th>
				<th>Telp</th>
				<th>Email</th>
				<th>Tgl. Keberangkatan</th>
				<th>Embarkasi</th>
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
				<td>{{App\Helper\TimeFormat::timeId($item->tanggal_keberangkatan, 'date')}}</td>
				<td>{{$item->embarkasi}}</td>
				<td>{{$item->status}}</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
@endsection