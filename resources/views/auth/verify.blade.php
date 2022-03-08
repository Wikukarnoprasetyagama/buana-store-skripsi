@extends('layouts.blank')

@section('content')

<section class="section-email-verification">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="email-ilustration">
                    <figure class="figure">
                        <img src="{{ url('/images/email_verification.svg') }}" class="figure-img img-fluid h-50 w-50" alt="email verification">
                    </figure>
                </div>
                <div class="title mt-3">
                    <h3>Yuk, Verifikasi Email!</h3>
                </div>
                <div class="description">
                    <p>
                        Sebelum melanjutkan, yuk verifikasi email kamu terlebih dahulu!
                        <br />
                        Jika belum menerima email, klik kirim email dibawah ini.
                    </p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-4 col-md-4 col-lg-3">
                        <div class="btn-send-email">
                            <form method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-lg btn-send-email p-1 m-1 text-white">Kirim Email Verifikasi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@push('after-script')
    <style>
        .section-email-verification {
        margin-top: 8%;
        }
        h3 {
            font-family: "Merriweather";
            font-size: 32px;
            font-weight: 600;
            color: #1e124c;
        }
        p{
            font-family: "Poppins";
            font-size: 16px;
            color: #5b5575;
        }
        .btn-send-email {
            margin-top: 30px;
            background-color: #a43ce3;
            color: #fff;
            border-radius: 50px;
            font-size: 16px;
            font-family: "Poppins";
        }
    </style>
@endpush
