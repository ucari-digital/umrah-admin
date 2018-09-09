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
					<h5>Data Tanggal Keberangkatan</h5>
				</div>
			</div>
			<div class="row mt-5">
				<div class="table-responsive">
					<table class="table" style="width: 1000px">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Kode Produk</th>
								<th scope="col">Nama Produk</th>
								<th scope="col">Quota</th>
								{{-- <th scope="col">Tgl Keberangkatan</th> --}}
								<th scope="col">Harga</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 0;
							@endphp
							@foreach($produk as $item)
								@if($item->status != 'DROP')
									<tr>
										<th scope="row">{{$no = $no + 1}}</th>
										<td>{{$item->kode_produk}}</td>
										<td>{{$item->nama_produk}}</td>
										<td>{{$item->seat}}</td>
										{{-- <td>{{$item->tanggal_keberangkatan}}</td> --}}
										<td>{{App\Helper\Number::rupiah($item->harga)}}</td>
										@if($item->status == 'Y')
										<td>
											<a href="{{url('publish-or-no/draft/'.$item->kode_produk)}}" class="btn btn-primary btn-sm">Publish</a>
										</td>
										@elseif($item->status == 'N')
										<td>
											<a href="{{url('publish-or-no/publish/'.$item->kode_produk)}}" class="btn btn-warning btn-sm">Draft</a>
										</td>
										@endif
										<td class="text-center">
											<a href="#" onclick="confirm_delete(this)" data-id="{{$item->kode_produk}}"><i class="far fa-trash-alt"></i></a>
										</td>
									</tr>
								@endif
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
@section('footer')
<script>
	$(document).ready(function () {
		$('.select2').select2();
		$('.rupiah').maskMoney({prefix: 'Rp. ', thousands: '.', decimal: ',', precision: 0});
		$('.number').maskMoney({thousands: '.', decimal: ',', precision: 0});
	});

	function confirm_delete(yeay) {
		var cfrm = confirm('Yakin untuk menghapus paket ini ?');
		if (cfrm == true) {
			var id = yeay.getAttribute("data-id");
			console.log(id);
			window.location.href = "{{url('tanggal-berangkat-drop')}}/"+id
		}
	}
</script>
@endsection