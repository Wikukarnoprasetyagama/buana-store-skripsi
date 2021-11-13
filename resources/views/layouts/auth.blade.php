<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('includes.style')
    <title>Buana Store - Web Toko Online Kec: Tapung Hilir Kab: Kampar</title>
  </head>
  <body>
    <section class="section-login">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-4 text-center">
            <div class="figure">
              <img src="/images/logo.svg" class="figure-img img-fluid" alt="" />
              <h1>Selamat Datang</h1>
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-4 text-center">
            <p>
              Silahkan masuk untuk belanja kebutuhan favorit anda dan keluarga
            </p>
          </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
          <div class="col-12 col-lg-4">
            <form action="#">
              <label for="email" class="form-label">Email Address</label>
              <input
                type="email"
                class="form-control"
                aria-describedby="emailhelp"
                autofocus
              />
            </form>
          </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
          <div class="col-12 col-lg-4">
            <form action="#">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" />
            </form>
          </div>
        </div>
        <div class="row mt-4 d-flex justify-content-center">
          <div class="col-12 col-lg-4 mb-3">
            <div class="d-grid">
              <a href="#" class="btn text-white btn-daftar">Login Now</a>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-12 col-lg-12">
            <a href="#" class="forgot-password">Forgot Password?</a>
          </div>
        </div>

        <div class="row d-flex justify-content-center mt-4">
          <div class="col-12 col-lg-1 mb-3">
            <div class="d-grid text-center">
              <a href="#" class="img-fluid"
                ><img src="/images/ic_google.svg" alt=""
              /></a>
            </div>
          </div>
          <div class="col-12 col-lg-1 mb-3">
            <div class="d-grid text-center">
              <a href="#" class="img-fluid"
                ><img src="/images/ic_facebook_1.svg" alt=""
              /></a>
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-center mb-sm-3">
          <div class="col-12 col-lg-4 text-center already-account">
            <hr />
            <span
              >Don't have an account? <a href="/register.html">Sign Up</a></span
            >
          </div>
        </div>
      </div>
    </section>

   @include('includes.script')
  </body>
</html>
