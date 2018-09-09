@extends('index')
@section('content')
<div class="ml-2 mr-2">
	<div class="card">
		<div class="card-body row">
			<div class="col-md-12 mb-5">
				<h4>Dimas Adi Satria</h4>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-10">
								Foto
							</div>
							<div class="col-md-2">
								<i class="fas fa-exclamation" data-toggle="tooltip" data-placement="top" title="Dokumen wajib diisi"></i>
							</div>
						</div>
					</div>
					<div class="card-body m-0 p-0">
						<img src="{{$dokumen->foto}}" alt="" class="">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-10">
								Paspor
							</div>
							<div class="col-md-2">
								<i class="fas fa-exclamation" data-toggle="tooltip" data-placement="top" title="Dokumen wajib diisi"></i>
							</div>
						</div>
					</div>
					<div class="card-body m-0 p-0">
						<img src="{{$dokumen->passpor}}" alt="" class="">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-10">
								Kartu Keluarga
							</div>
							<div class="col-md-2">
								<i class="fas fa-exclamation" data-toggle="tooltip" data-placement="top" title="Dokumen wajib diisi"></i>
							</div>
						</div>
					</div>
					<div class="card-body m-0 p-0">
						<img src="{{$dokumen->kartu_keluarga}}" alt="" class="">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-10">
								Kartu Kuning
							</div>
							<div class="col-md-2">
								<i class="fas fa-exclamation" data-toggle="tooltip" data-placement="top" title="Dokumen wajib diisi"></i>
							</div>
						</div>
					</div>
					<div class="card-body m-0 p-0">
						<img src="{{$dokumen->kartu_kuning}}" alt="" class="">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-10">
								Kartu Karyawan
							</div>
							<div class="col-md-2">
								<i class="fas fa-exclamation" data-toggle="tooltip" data-placement="top" title="Dokumen wajib diisi"></i>
							</div>
						</div>
					</div>
					<div class="card-body m-0 p-0">
						<img src="{{$dokumen->kartu_karyawan}}" alt="" class="">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-header">
						KTP
					</div>
					<div class="card-body m-0 p-0">
						<img src="{{$dokumen->ktp}}" alt="" class="">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-header">
						Buku Nikah
					</div>
					<div class="card-body m-0 p-0">
						<img src="{{$dokumen->buku_nikah}}" alt="" class="">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-header">
						Akta
					</div>
					<div class="card-body m-0 p-0">
						<img src="{{$dokumen->akta}}" alt="" class="">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection