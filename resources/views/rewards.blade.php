@extends('layouts.home')

@section('title')
    Penghargaan
@endsection

@section('content')
    <section class="section-notfound">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <figure class="figure">
              <img
                src="{{ url('/images/rewards.svg') }}"
                class="figure-img w-50 h-50"
                alt=""
              />
              <figcaption class="figure-caption mt-4">
                <h3>Belum Ada Hadiah!</h3>
                <p>
                  Anda belum memiliki hadiah apapun. <br>
                  Silahkan belanja sebanyak mungkin untuk mendapatkan <br> hadiah spesial dari kami.
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