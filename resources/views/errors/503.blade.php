@extends('layouts.blank')

@section('title')
    Buana Store - Pembaruan Sistem
@endsection

@section('content')
    <section class="section-maintenance-content mt-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-12 col-md-12">
                    <figure class="figure">
                        <img src="{{ url('images/maintenance.svg') }}" class="figure-img img-fluid w-100 h-100" alt="Maintenance">
                    </figure>
                </div>
                <div class="col-10 col-md-12">
                    <div class="maintenance-content">
                        <h1>Pembaruan Sistem!</h1>
                        <p>
                            Kami sedang melakukan pembaruan sistem, <br />
                            Silahkan coba beberapa saat lagi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection