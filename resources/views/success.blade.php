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
                src="{{ url('/frontend/images/transaction-success.svg') }}"
                class="figure-img w-75 h-75"
                alt=""
              />
              <figcaption class="figure-caption mt-3">
                <h3>Mohon Maaf!</h3>
                <p>
                  Halaman yang anda kunjungi sedang dalam pengembangan, <br>
                  Dengan rentang waktu yang tidak bisa di tentukan
                </p>
              </figcaption>
              <a href="{{ route('home') }}" class="btn-lg btn btn-back"
                >Kembali keberanda</a
              >
            </figure>
          </div>
        </div>
      </div>
    </section>
@endsection