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
					<h5>Data Departemen</h5>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">Departemen</th>
									<th scope="col" class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $item)
									<tr>
										<td>{{$item->departemen}}</td>
										<td class="text-center">
											<a href="#" onclick="confirm_delete(this)" data-id="{{$item->id}}"><i class="far fa-trash-alt"></i></a>
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
</div>
@endsection
@section('footer')
	<script type="text/javascript">
		function confirm_delete(yeay) {
			var cfrm = confirm('Yakin untuk menghapus departemen ini ?');
			if (cfrm == true) {
				var id = yeay.getAttribute("data-id");
				console.log(id);
				window.location.href = "{{url('departemen-drop')}}/"+id
			}
		}
	</script>
@endsection