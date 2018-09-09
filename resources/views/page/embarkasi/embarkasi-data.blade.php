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
					<h5>Data Embarkasi</h5>
				</div>
			</div>
			<div class="row mt-5">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Kota Embarkasi</th>
								<th scope="col" class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($embarkasi as $item)
								@if($item->status == 'Y')
									<tr>
										<td scope="row">{{$no = $no + 1}}</td>
										<td>{{$item->kota}}</td>
										<td class="text-center">
											<a href="#" onclick="confirm_delete(this)" data-id="{{$item->kode_embarkasi}}"><i class="far fa-trash-alt"></i></a>
										</td>
									</tr>
								@endif
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
	<script type="text/javascript">
		function confirm_delete(yeay) {
			var cfrm = confirm('Yakin untuk menghapus embarkasi ini ?');
			if (cfrm == true) {
				var id = yeay.getAttribute("data-id");
				console.log(id);
				window.location.href = "{{url('embarkasi-drop')}}/"+id
			}
		}
	</script>
@endsection