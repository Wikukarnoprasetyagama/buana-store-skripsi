<html>
<head>
	<title>Laporan Transaksi {{ Auth::user()->name }}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
		body{
			font-family: "Roboto", sans-serif;
		}
		.badge-success{
			color: #28A745;
			border: none;
		}
		.badge-warning{
			color: #FFC107;
			border: none;
		}
		.badge-danger{
			color: #cf4040;
			border: none;
		}
		.badge-info{
			color: #17a2b8;
			border: none;
		}
	</style>
	{{-- <center>
		<h3>Buana Store</h3>
		<h5>Laporan Transaksi Pembelian</h4>
		<h6><a target="_blank" href="https://buanastore.wikukarno.id">www.buanastore.id</a></h5>
	</center> --}}
	<section class="section-pdf-header text-center mt-1">
		<div class="media">
			<img src="{{ $pic }}" class="img-fluid" style="max-height: 50px" alt="Logo">
		</div>
		<div class="title-transaction">
			<h3>BUANASTORE</h3>
			<h5>DATA LAPORAN TRANSAKSI</h5>
			<p>An. {{ Auth::user()->name }}</p>
		</div>
	</section>
	<section class="section-pdf-content pt-3">
		<table class='table table-bordered'>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Kode Produk</th>
				<th>Nama Produk</th>
				<th>Telepon</th>
				<th>Jumlah</th>
				<th>Tanggal</th>
				<th>Status Pembayaran</th>
				<th>Harga</th>
			</tr>
			
			@foreach($transactions as $transaction)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{$transaction->name}}</td>
					<td>{{$transaction->code_product}}</td>
					<td>{{$transaction->product->name_product}}</td>
					<td>{{$transaction->phone}}</td>
					<td>{{$transaction->quantity}}</td>
                    <td>{{ $transaction->created_at->isoFormat('D MMMM Y') }}</td>
					@if ($transaction->payment_status == 'FAILED')
					<td><strong class="text-white badge badge-danger">{{ $transaction->payment_status }}</strong></td>
					@elseif ($transaction->payment_status == 'PENDING')
					<td><strong class="text-white badge badge-warning">{{ $transaction->payment_status }}</strong></td>
					@elseif ($transaction->payment_status == 'DIBAYAR')
					<td><strong class="text-white badge badge-success">{{ $transaction->payment_status }}</strong></td>
					@else
					<td><strong class="text-white badge badge-info">{{ $transaction->payment_status }}</strong></td>
					@endif
					<td>Rp.{{ number_format($transaction->total_price) }}</td>
				</tr>
				@endforeach
				<tfoot>
					
					<tr>
						<th colspan="8" class="text-center">Total</th>
						<th>Rp.{{ number_format($revenue) }}</th>
					</tr>
				</tfoot>
		</table>
	</section>
	<section class="section-footer-content text-right">
		<div class="signature">
			<p>{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
			<br>
			<br>
			<p>{{ Auth::user()->name }}</p>	
		</div>
	</section>
</body>
</html>