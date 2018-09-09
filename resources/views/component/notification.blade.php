<ul class="list-group" style="width: 250px;">
	
	@php
	$no = 0;
	@endphp
	@foreach($notif['data'] as $item)
	<?php $no = $no + 1; ?>
	@if($no > 1)
	<?php $class = 'border-top'; ?>
	@else
	<?php $class = 'border-top-0'; ?>
	@endif
	<li class="list-group-item {{$class}} border-right-0 border-left-0">
		<a href="{{url($item['url'])}}" class="row">
			<div class="col-12">
				<h6><span class="text-danger">{{$item['counter']}}</span> {{$item['text']}}</h6>
			</div>
			<div class="col-12">
				<span class="text-secondary">{{$item['keterangan']}} ...</span>
			</div>
		</a>
	</li>
	@endforeach
	{{-- <li class="list-group-item border-right-0 border-left-0 border-top">Dapibus ac facilisis in</li>
	<li class="list-group-item border-right-0 border-left-0 border-top">Morbi leo risus</li>
	<li class="list-group-item border-right-0 border-left-0 border-top">Porta ac consectetur ac</li>
	<li class="list-group-item border-right-0 border-left-0 border-top">Vestibulum at eros</li> --}}
</ul>
