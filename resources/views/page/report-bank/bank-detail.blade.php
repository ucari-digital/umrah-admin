@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Daftar peserta bank {{$bank->nama_bank}}</h5>
				</div>
				<div class="col-md-3">
					<select id="inputState" class="form-control form-control-sm">
						<option selected>Pilih Field</option>
						<option value="0">NIP</option>
						<option value="1">NIK</option>
						<option value="2">Nama</option>
						<option value="3">JK</option>
						<option value="4">Telepon</option>
						<option value="5">Email</option>
					</select>
				</div>
				<div class="col-md-3">
					<input class="form-control form-control-sm" id="inputSearch" type="text" placeholder="Cari" onkeyup="searchField()">	
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-md-12 float-right">
					<div class="button btn btn-primary btn-sm float-right" onclick="print()"><i class="fas fa-print"></i> PDF</div>
				</div>
			</div>
			<div class="row mt-2">
				<div class="table-responsive" id="tablePrint">
					<table class="table" id="tableSearch">
						<thead>
							<tr>
								<th scope="col">NIP</th>
								<th scope="col">NIK</th>
								<th scope="col">Nama</th>
								<th scope="col">JK</th>
								<th scope="col">Telp</th>
								<th scope="col">Email</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($peserta as $item)
							<tr>
								<td>{{$item->nip}}</td>
								<td>{{$item->nik}}</td>
								<td>{{$item->nama}}</td>
								<td>{{$item->jk}}</td>
								<td>{{$item->telephone}}</td>
								<td>{{$item->email}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script>
	function searchField() {
		var input, filter, table, tr, td, i;
		input = document.getElementById("inputSearch");
		filter = input.value.toUpperCase();
		table = document.getElementById("tableSearch");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[$('#inputState').val()];
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
		
	}
	function print() {
		$("#tablePrint").printMe({ "path": ["{{url('vendor/bootstrap-4.1/bootstrap.min.css')}}","{{url('css/theme.css')}}"]});
	}
</script>
@endsection