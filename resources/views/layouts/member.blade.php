<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>@yield('title')</title>

	@stack('before-style')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	@include('includes.member.style')
	<style>
	body
	{
		font-family: "Poppins";
		font-weight: 400;
	}
	.navbar .nav-link.nav-link-user 
	{
		font-weight: 500;
	}

	.main-sidebar .sidebar-menu li a 
	{
		font-weight: 400;
	}
	.card.card-statistic-2 .card-header h4 
	{
		font-weight: 500;
		font-size: 13px;
		letter-spacing: .5px;
	}
	.btn{
		font-weight: 400;
	}
	</style>
	@stack('after-style')
</head>

<body>
  	<div id="app">
		<div class="main-wrapper">
			<div class="navbar-bg"></div>
				@include('includes.member.navbar')
				@include('includes.member.sidebar')
				@yield('content')
				@include('includes.member.footer')
		</div>
    	<!-- Logout Modal-->
		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">Apakah anda yakin ingin keluar ?</div>
					<div class="modal-footer">
					<form action="{{ url('logout') }}" method="POST">
						@csrf
						<button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
						<button class="btn btn-primary" type="submit">Keluar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
    	<!-- Logout Modal-->
		<div class="modal fade" id="logoutModalCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">Apakah anda yakin ingin keluar ?</div>
					<div class="modal-footer">
					<form action="{{ url('logout') }}" method="POST">
						@csrf
						<button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
						<button class="btn btn-primary" type="submit">Keluar</button>
						</form>
					</div>
				</div>
			</div>
		</div>

    	<!-- Notifikasi Has Open Store -->
		<div class="modal fade" id="openStore" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Hi, {{ Auth::user()->name }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Mohon maaf kepada Customer {{ Auth::user()->name }} data yang anda kirimkan untuk pembukaan toko
					sedang dalam antrian, team kami sedang melakukan pengecekan data-data anda,
					mohon untuk menunggu beberapa hari kedepan.
					Terima kasih...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
				</div>
			</div>
		</div>
	</div>
	@include('sweetalert::alert')
	@stack('before-script')
	@include('includes.member.script')
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	@stack('after-script')
</body>
</html>
