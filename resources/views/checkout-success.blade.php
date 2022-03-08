@extends('layouts.blank')

@section('title')
    Checkout Berhasil
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
                <h3>Checkout Berhasil!</h3>
                <p>
                  Segera lakukan pembayaran<br />
                  Agar barang dapat segera kami proses                </p>
              </figcaption>
              <a href="{{ route('transaction') }}" class="btn-lg btn btn-back"
                >Lihat Transaksi Saya</a
              >
            </figure>
          </div>
        </div>
      </div>
    </section>
@endsection
    