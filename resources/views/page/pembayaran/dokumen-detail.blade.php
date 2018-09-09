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
					@if(!empty($dokumen->foto))
						@if($dokumen->foto_status == 'approved')
						<div class="card-footer text-white bg-success">
							<div class="row">
								<div class="col-md-10">
									Approved
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/foto_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/foto_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@elseif($dokumen->foto_status == 'rejected')
						<div class="card-footer text-white bg-danger">
							<div class="row">
								<div class="col-md-10">
									Rejected
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/foto_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/foto_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@else
						<div class="card-footer text-muted">
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('dokumen/foto_status/approved'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-primary btn-block btn-sm">Approve</a>
								</div>
								<div class="col-md-6">
									<a href="{{url('dokumen/foto_status/rejected'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-danger btn-block btn-sm">Reject</a>
								</div>
							</div>
						</div>
						@endif
					@endif
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
					@if(!empty($dokumen->passpor))
						@if($dokumen->passpor_status == 'approved')
						<div class="card-footer text-white bg-success">
							<div class="row">
								<div class="col-md-10">
									Approved
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/passpor_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/passpor_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@elseif($dokumen->passpor_status == 'rejected')
						<div class="card-footer text-white bg-danger">
							<div class="row">
								<div class="col-md-10">
									Rejected
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/passpor_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/passpor_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@else
						<div class="card-footer text-muted">
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('dokumen/passpor_status/approved'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-primary btn-block btn-sm">Approve</a>
								</div>
								<div class="col-md-6">
									<a href="{{url('dokumen/passpor_status/rejected'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-danger btn-block btn-sm">Reject</a>
								</div>
							</div>
						</div>
						@endif
					@endif
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
					@if(!empty($dokumen->kartu_keluarga))
						@if($dokumen->kartu_keluarga_status == 'approved')
						<div class="card-footer text-white bg-success">
							<div class="row">
								<div class="col-md-10">
									Approved
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/kartu_keluarga_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/kartu_keluarga_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@elseif($dokumen->kartu_keluarga_status == 'rejected')
						<div class="card-footer text-white bg-danger">
							<div class="row">
								<div class="col-md-10">
									Rejected
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/kartu_keluarga_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/kartu_keluarga_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@else
						<div class="card-footer text-muted">
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('dokumen/kartu_keluarga_status/approved'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-primary btn-block btn-sm">Approve</a>
								</div>
								<div class="col-md-6">
									<a href="{{url('dokumen/kartu_keluarga_status/rejected'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-danger btn-block btn-sm">Reject</a>
								</div>
							</div>
						</div>
						@endif
					@endif
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
					@if(!empty($dokumen->kartu_kuning))
						@if($dokumen->kartu_kuning_status == 'approved')
						<div class="card-footer text-white bg-success">
							<div class="row">
								<div class="col-md-10">
									Approved
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/kartu_kuning_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/kartu_kuning_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@elseif($dokumen->kartu_kuning_status == 'rejected')
						<div class="card-footer text-white bg-danger">
							<div class="row">
								<div class="col-md-10">
									Rejected
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/kartu_kuning_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/kartu_kuning_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@else
						<div class="card-footer text-muted">
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('dokumen/kartu_kuning_status/approved'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-primary btn-block btn-sm">Approve</a>
								</div>
								<div class="col-md-6">
									<a href="{{url('dokumen/kartu_kuning_status/rejected'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-danger btn-block btn-sm">Reject</a>
								</div>
							</div>
						</div>
						@endif
					@endif
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
					@if(!empty($dokumen->kartu_karyawan))
						@if($dokumen->kartu_karyawan_status == 'approved')
						<div class="card-footer text-white bg-success">
							<div class="row">
								<div class="col-md-10">
									Approved
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/kartu_karyawan_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/kartu_karyawan_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@elseif($dokumen->kartu_karyawan_status == 'rejected')
						<div class="card-footer text-white bg-danger">
							<div class="row">
								<div class="col-md-10">
									Rejected
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/kartu_karyawan_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/kartu_karyawan_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@else
						<div class="card-footer text-muted">
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('dokumen/kartu_karyawan_status/approved'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-primary btn-block btn-sm">Approve</a>
								</div>
								<div class="col-md-6">
									<a href="{{url('dokumen/kartu_karyawan_status/rejected'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-danger btn-block btn-sm">Reject</a>
								</div>
							</div>
						</div>
						@endif
					@endif
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
					@if(!empty($dokumen->ktp_status))
						@if($dokumen->ktp_status == 'approved')
						<div class="card-footer text-white bg-success">
							<div class="row">
								<div class="col-md-10">
									Approved
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/ktp_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/ktp_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@elseif($dokumen->ktp_status == 'rejected')
						<div class="card-footer text-white bg-danger">
							<div class="row">
								<div class="col-md-10">
									Rejected
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/ktp_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/ktp_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@else
						<div class="card-footer text-muted">
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('dokumen/ktp_status/approved'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-primary btn-block btn-sm">Approve</a>
								</div>
								<div class="col-md-6">
									<a href="{{url('dokumen/ktp_status/rejected'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-danger btn-block btn-sm">Reject</a>
								</div>
							</div>
						</div>
						@endif
					@endif
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
					@if(!empty($dokumen->buku_nikah))
						@if($dokumen->buku_nikah_status == 'approved')
						<div class="card-footer text-white bg-success">
							<div class="row">
								<div class="col-md-10">
									Approved
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/buku_nikah_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/buku_nikah_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@elseif($dokumen->buku_nikah_status == 'rejected')
						<div class="card-footer text-white bg-danger">
							<div class="row">
								<div class="col-md-10">
									Rejected
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/buku_nikah_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/buku_nikah_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@else
						<div class="card-footer text-muted">
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('dokumen/buku_nikah_status/approved'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-primary btn-block btn-sm">Approve</a>
								</div>
								<div class="col-md-6">
									<a href="{{url('dokumen/buku_nikah_status/rejected'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-danger btn-block btn-sm">Reject</a>
								</div>
							</div>
						</div>
						@endif
					@endif
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
					@if(!empty($dokumen->akta))
						@if($dokumen->akta_status == 'approved')
						<div class="card-footer text-white bg-success">
							<div class="row">
								<div class="col-md-10">
									Approved
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/akta_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/akta_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@elseif($dokumen->akta_status == 'rejected')
						<div class="card-footer text-white bg-danger">
							<div class="row">
								<div class="col-md-10">
									Rejected
								</div>
								<div class="col-md-2">
									<div class="dropdown">
										<span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="{{url('dokumen/akta_status/approved'.'/'.$dokumen->nomor_transaksi)}}">Approve</a>
											<a class="dropdown-item" href="{{url('dokumen/akta_status/rejected'.'/'.$dokumen->nomor_transaksi)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@else
						<div class="card-footer text-muted">
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('dokumen/akta_status/approved'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-primary btn-block btn-sm">Approve</a>
								</div>
								<div class="col-md-6">
									<a href="{{url('dokumen/akta_status/rejected'.'/'.$dokumen->nomor_transaksi)}}" class="btn btn-danger btn-block btn-sm">Reject</a>
								</div>
							</div>
						</div>
						@endif
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection