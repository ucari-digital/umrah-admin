@extends('index')
@section('content')
<div class="ml-5 mr-5">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5>Panel SMS</h5>
					<div class="row justify-content-md-center mt-5 mb-5">
						<div class="col-md-6">
							<h1 class="text-center text-primary display-4">{{App\Helper\Number::rupiah($saldo['data']['saldo'])}}</h1>
						</div>
					</div>
					<table class="table" style="width: 100%">
						<thead>
							<tr>
								<th></th>
								<th>Sending ID</th>
								<th>Nomor Hp</th>
								<th>Pesan</th>
								<th>Waktu</th>
								<th>Report</th>
							</tr>
						</thead>
						<tbody>
							@foreach($history['data'] as $item)
							<tr>
								<td></td>
								<td>{{$item['sending_id']}}</td>
								<td>{{$item['number']}}</td>
								<td>{{str_limit($item['text'], 100)}}</td>
								<td class="time">{{$item['created_at']}}</td>
								<td>{{$item['status']}}</td>
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
@section('header')
<style type="text/css">
	table{
		font-size: 13px;
	}
	.time{
		width: 155px;
	}
</style>
@endsection
@section('footer')
<script src="{{url('data-table/datatables.min.js')}}"></script>
@endsection