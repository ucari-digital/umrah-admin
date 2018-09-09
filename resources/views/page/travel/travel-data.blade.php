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
					<h5>Data Travel</h5>
				</div>
			</div>
			<div class="row mt-5">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nama Travel</th>
								<th scope="col">Logo</th>
								<th scope="col">Website</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($travel as $item)
							<tr>
								<th scope="row">{{$no = $no + 1}}</th>
								<td>{{$item->nama_travel}}</td>
								<td><a href="{{asset('storage/'.$item->logo_travel)}}">Lihat</a></td>
								<td>{{$item->website_travel}}</td>
								<td><a href="{{url('travel-drop/'.$item->kode_travel)}}">Hapus</a></td>
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