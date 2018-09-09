@extends('index')
@section('content')
<div class="ml-2 mr-2">
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
					<h5>Daftar peserta umroh perusahaan</h5>
				</div>
				<div class="col-md-3">
					<select id="inputState" class="form-control form-control-sm">
						<option selected>Pilih Field</option>
						<option value="0">Nama Perusahaan</option>
						<option value="1">Domain</option>
						<option value="2">Email</option>
						<option value="3">Telepon</option>
					</select>
				</div>
				<div class="col-md-3">
					<input class="form-control form-control-sm" id="inputSearch" type="text" placeholder="Cari" onkeyup="searchField()">	
				</div>
			</div>
			<div class="row mt-2">
				<div class="table-responsive">
					<table class="table" id="tableSearch" style="min-width: 1300px;">
						<thead>
							<tr>
								<th scope="col">Nama Perusahaan</th>
								<th scope="col">Domain</th>
								<th scope="col">Email</th>
								<th scope="col">Telepon</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($perusahaan as $item)
							<tr>
								<td>{{$item->nama}}</td>
								<td>{{$item->domain}}</td>
								<td>{{$item->email}}</td>
								<td>{{$item->telephone}}</td>
								<td><a href="{{url('perusahaan-change/'.$item->kode_perusahaan)}}">Edit</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="col-md-12 place-pagination">
					<div class="place-pg"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
