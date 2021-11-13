@extends('layouts.home')

@section('content')
<!-- Carousel -->
    <section class="section-content-carousel">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-12">
            <div
              id="carouselExampleSlidesOnly"
              class="carousel slide"
              data-bs-ride="carousel"
            >
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="row">
                    <div class="col-lg-6">
                      <h1 class="title">
                        Discount 50 % off <br />
                        All Members
                      </h1>
                      <p class="subtitle">
                        Jelajahi barang kebutuhan anda & dapatkan <br />
                        diskon setiap bulannya
                      </p>
                      <a href="#" class="btn btn-get-now">Get it Now</a>
                    </div>
                    <div class="col-lg-4 offset-2">
                      <figure class="figure text-center">
                        <img
                          src="{{ url('frontend/images/brand_image.jpg') }}"
                          class="img-figure img-fluid"
                          alt=""
                        />
                      </figure>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="row">
                    <div class="col-lg-6">
                      <h1 class="title">
                        Discount 50 % off <br />
                        All Members
                      </h1>
                      <p class="subtitle">
                        Jelajahi barang kebutuhan anda & dapatkan <br />
                        diskon setiap bulannya
                      </p>
                      <a href="#" class="btn btn-get-now">Get it Now</a>
                    </div>
                    <div class="col-lg-4 offset-2">
                      <figure class="figure text-center">
                        <img
                          src="{{ url('frontend/images/brand_image.jpg') }}"
                          class="img-figure img-fluid"
                          alt=""
                        />
                      </figure>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Carousel -->

    <!-- Category -->
    <section class="section-category">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-12">
            <h3>Category Product</h3>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-4 col-lg-2 text-center mb-2">
            <div class="bg-category" data-aos="zoom-in" data-aos-delay="100">
              <a href="#">
                <figure class="figure pt-3">
                  <img src="{{ url('frontend/images/ic_gadgets.svg') }}" class="img-fluid" alt="" />
                  <p class="mt-2 d-none d-md-block d-lg-block">Gadgets</p>
                </figure>
              </a>
            </div>
          </div>
          <div class="col-4 col-lg-2 text-center mb-2">
            <div class="bg-category" data-aos="zoom-in" data-aos-delay="200">
              <a href="#">
                <figure class="figure pt-3">
                  <img src="{{ url('frontend/images/ic_food.svg') }}" class="img-fluid" alt="" />
                  <p class="mt-2 d-none d-md-block d-lg-block">Makanan</p>
                </figure>
              </a>
            </div>
          </div>
          <div class="col-4 col-lg-2 text-center mb-2">
            <div class="bg-category" data-aos="zoom-in" data-aos-delay="300">
              <a href="#">
                <figure class="figure pt-3">
                  <img src="{{ url('frontend/images/ic_cosmetic.svg') }}" class="img-fluid" alt="" />
                  <p class="mt-2 d-none d-md-block d-lg-block">Kosmetik</p>
                </figure>
              </a>
            </div>
          </div>
          <div class="col-4 col-lg-2 text-center mb-2">
            <div class="bg-category" data-aos="zoom-in" data-aos-delay="400">
              <a href="#">
                <figure class="figure pt-3">
                  <img src="{{ url('frontend/images/ic_baby.svg') }}" class="img-fluid" alt="" />
                  <p class="mt-2 d-none d-md-block d-lg-block">Bayi</p>
                </figure>
              </a>
            </div>
          </div>
          <div class="col-4 col-lg-2 text-center mb-2">
            <div class="bg-category" data-aos="zoom-in" data-aos-delay="500">
              <a href="#">
                <figure class="figure pt-3">
                  <img src="{{ url('frontend/images/ic_fashion.svg') }}" class="img-fluid" alt="" />
                  <p class="mt-2 d-none d-md-block d-lg-block">Fashion</p>
                </figure>
              </a>
            </div>
          </div>
          <div class="col-4 col-lg-2 text-center mb-2">
            <div class="bg-category" data-aos="zoom-in" data-aos-delay="600">
              <a href="#">
                <figure class="figure pt-3">
                  <img src="{{ url('frontend/images/ic_perkakas.svg') }}" class="img-fluid" alt="" />
                  <p class="mt-2 d-none d-md-block d-lg-block">Perkakas</p>
                </figure>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Category -->

    <!-- New Product -->
    <section class="section-product">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-12">
            <h3>Produk Baru</h3>
          </div>
        </div>
        <div class="row mt-2">
          <div
            class="col-6 col-lg-3 mb-3"
            data-aos="zoom-in"
            data-aos-delay="100"
          >
            <figure class="figure">
              <div class="product-img">
                <img
                  src="{{ url('frontend/images/product_1.jpg') }}"
                  class="figure-img img-fluid w-100"
                  alt=""
                />
                <a href="/details.html" class="d-flex justify-content-center">
                  <img
                    src="/images/eye.png"
                    class="img-fluid align-self-center"
                    alt=""
                  />
                </a>
              </div>
            </figure>
            <h4 class="name-product">Pizza Hut</h4>
            <div class="price">$890</div>
          </div>
          <div
            class="col-6 col-lg-3 mb-3"
            data-aos="zoom-in"
            data-aos-delay="200"
          >
            <figure class="figure">
              <div class="product-img">
                <img
                  src="{{ url('frontend/images/product_2.jpg') }}"
                  class="figure-img img-fluid w-100"
                  alt=""
                />
                <a href="/details.html" class="d-flex justify-content-center">
                  <img
                    src="/images/eye.png"
                    class="img-fluid align-self-center"
                    alt=""
                  />
                </a>
              </div>
            </figure>
            <h4 class="name-product">Pizza Hut</h4>
            <div class="price">$890</div>
          </div>
          <div
            class="col-6 col-lg-3 mb-3"
            data-aos="zoom-in"
            data-aos-delay="300"
          >
            <figure class="figure">
              <div class="product-img">
                <img
                  src="{{ url('frontend/images/product_2.jpg') }}"
                  class="figure-img img-fluid w-100"
                  alt=""
                />
                <a href="/details.html" class="d-flex justify-content-center">
                  <img
                    src="/images/eye.png"
                    class="img-fluid align-self-center"
                    alt=""
                  />
                </a>
              </div>
            </figure>
            <h4 class="name-product">Pizza Hut</h4>
            <div class="price">$890</div>
          </div>
          <div
            class="col-6 col-lg-3 mb-3"
            data-aos="zoom-in"
            data-aos-delay="400"
          >
            <figure class="figure">
              <div class="product-img">
                <img
                  src="{{ url('frontend/images/product_2.jpg') }}"
                  class="figure-img img-fluid w-100"
                  alt=""
                />
                <a href="/details.html" class="d-flex justify-content-center">
                  <img
                    src="/images/eye.png"
                    class="img-fluid align-self-center"
                    alt=""
                  />
                </a>
              </div>
            </figure>
            <h4 class="name-product">Pizza Hut</h4>
            <div class="price">$890</div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Product -->

    <!-- Popular Product -->
    <section class="section-popular">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-12">
            <h3>Produk Populer</h3>
          </div>
        </div>
        <div class="row mt-2">
          <div
            class="col-6 col-lg-3 mb-3"
            data-aos="zoom-in"
            data-aos-delay="100"
          >
            <figure class="figure">
              <div class="product-img">
                <img
                  src="{{ url('frontend/images/product_1.jpg') }}"
                  class="figure-img img-fluid w-100"
                  alt=""
                />
                <a href="/details.html" class="d-flex justify-content-center">
                  <img
                    src="/images/eye.png"
                    class="img-fluid align-self-center"
                    alt=""
                  />
                </a>
              </div>
            </figure>
            <h4 class="name-product">Pizza Hut</h4>
            <div class="price">$890</div>
          </div>
          <div
            class="col-6 col-lg-3 mb-3"
            data-aos="zoom-in"
            data-aos-delay="200"
          >
            <figure class="figure">
              <div class="product-img">
                <img
                  src="{{ url('frontend/images/product_2.jpg') }}"
                  class="figure-img img-fluid w-100"
                  alt=""
                />
                <a href="/details.html" class="d-flex justify-content-center">
                  <img
                    src="/images/eye.png"
                    class="img-fluid align-self-center"
                    alt=""
                  />
                </a>
              </div>
            </figure>
            <h4 class="name-product">Pizza Hut</h4>
            <div class="price">$890</div>
          </div>
          <div
            class="col-6 col-lg-3 mb-3"
            data-aos="zoom-in"
            data-aos-delay="300"
          >
            <figure class="figure">
              <div class="product-img">
                <img
                  src="{{ url('frontend/images/product_2.jpg') }}"
                  class="figure-img img-fluid w-100"
                  alt=""
                />
                <a href="/details.html" class="d-flex justify-content-center">
                  <img
                    src="/images/eye.png"
                    class="img-fluid align-self-center"
                    alt=""
                  />
                </a>
              </div>
            </figure>
            <h4 class="name-product">Pizza Hut</h4>
            <div class="price">$890</div>
          </div>
          <div
            class="col-6 col-lg-3 mb-3"
            data-aos="zoom-in"
            data-aos-delay="400"
          >
            <figure class="figure">
              <div class="product-img">
                <img
                  src="{{ url('frontend/images/product_2.jpg') }}"
                  class="figure-img img-fluid w-100"
                  alt=""
                />
                <a href="/details.html" class="d-flex justify-content-center">
                  <img
                    src="/images/eye.png"
                    class="img-fluid align-self-center"
                    alt=""
                  />
                </a>
              </div>
            </figure>
            <h4 class="name-product">Pizza Hut</h4>
            <div class="price">$890</div>
          </div>
        </div>
      </div>
    </section>
    <!-- Popular Product -->
@endsection
