@extends('layouts.blank')

@section('title')
    Transaksi Berhasil
@endsection

@section('content')
    <section class="section-notfound">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <figure class="figure">
              <img
                src="{{ url('/images/transaction-success.svg') }}"
                class="figure-img w-75 h-75"
                alt=""
              />
              <figcaption class="figure-caption mt-3">
                <h3>Transaksi Berhasil!</h3>
                <p>
                  Transaksi yang anda lakukan telah berhasil, <br />
                  barang akan segera kami proses, selamat menunggu!
                </p>
              </figcaption>
              <a href="{{ route('home') }}" class="btn-lg btn btn-back"
                >Kembali Keberanda</a
              >
            </figure>
          </div>
        </div>
      </div>
    </section>
@endsection