@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Daftar Bank</h5>
				</div>
				<div class="col-md-3">
					<select id="inputState" class="form-control form-control-sm">
						<option selected>Pilih Field</option>
						<option value="0">Nama Bank</option>
						<option value="1">Total Jamaah</option>
					</select>
				</div>
				<div class="col-md-3">
					<input class="form-control form-control-sm" id="inputSearch" type="text" placeholder="Cari" onkeyup="searchField()">	
				</div>
			</div>
			<div class="row mt-2">
				<div class="table-responsive" id="tablePrint">
					<table class="table" id="tableSearch">
						<thead>
							<tr>
								<th scope="col">Nama Bank</th>
								<th scope="col">Total Jamaah</th>
								<th scope="col" class="px-print">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($bank as $item)
							<tr>
								<td>{{$item->nama_bank}}</td>
								<td>{{App\Http\Controllers\BankController::countOrang($item->kode_bank)}} Orang</td>
								<td class="px-print">
									<a href="{{url('data-bank').'/'.$item->kode_bank}}">Lihat</a>
								</td>
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
	$(document).ready(function(){
		$('table tbody').paginathing({
			perPage: 5,
			prevNext: true,
			firstLast: true,
			prevText: '&laquo;',
			nextText: '&raquo;',
			firstText: 'First',
			lastText: 'Last',
			containerClass: 'pagination-container mt-2 float-right',
			ulClass: 'pagination',
			liClass: 'page-item',
			activeClass: 'active',
			disabledClass: 'disabled',
			insertAfter: '.place-pg'
		});
	});
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