@extends('layouts.index')
@section('title')
    Home
@endsection
@section('content')
    {{-- Start Carousel --}}
    <div class="jumbotron">
        <div class="card w-100 position-relative d-flex justify-content-center align-items-center">
            <div class="gradient"></div>
            <div class="tagline position-absolute text-white text-center">
                <div class="text">
                    <h1>Elevate <span class="text-warning"> Your Style Game</span> <br> with Our Diverse Jersey Collection!</h1>
                </div>
                @auth
                    <div class="button mt-5">
                        <a href="{{ auth()->user()->role == 'admin' ? '/my/dashboard/product' : '/my/product' }}"
                            class="btn btn-outline-dark py-2 px-5">Shop Now <i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                @endauth
                @guest
                    <div class="button mt-5">
                        <a href="/product" class="btn btn-outline-secondary py-2 px-5">Shop Now <i
                                class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                @endguest

            </div>
        </div>
    </div>
    {{-- End Carousel --}}




    {{-- Start Content --}}
    <div class="container">
        <section id="category" class="my-5">
            <header class="mb-5">
                <h2 class="text-dark">Category</h2>
            </header>
            <section>
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card text-center">
                            <div class="img-category rounded-pill mt-2 mx-auto" style="width: 100px; height: 100px;">
                                <img src="/assets/img/product-1.png" class="w-100" alt="...">
                            </div>
                            <div class="card-body">
                                <p class="card-text">Jersey NBA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card text-center">
                            <div class="img-category rounded-pill mt-2 mx-auto" style="width: 100px; height: 100px;">
                                <img src="/assets/img/product-2.png" class="w-100" alt="...">
                            </div>
                            <div class="card-body">
                                <p class="card-text">Jersey IBL</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card text-center">
                            <div class="img-category rounded-pill mt-2 mx-auto" style="width: 100px; height: 100px;">
                                <img src="/assets/img/product-3.png" class="w-100" alt="...">
                            </div>
                            <div class="card-body">
                                <p class="card-text">Jersey FIBA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card text-center">
                            <div class="img-category rounded-pill mt-2 mx-auto" style="width: 100px; height: 100px;">
                                <img src="/assets/img/product-4.png" class="w-100" alt="...">
                            </div>
                            <div class="card-body">
                                <p class="card-text">Jersey Custom</p>
                            </div>
                        </div>
                    </div>                    
                </div>
            </section>
        </section>


        <section id="new-product" class="my-5">
            <header class="mb-5">
                <h2 class="text-warning">New Product</h2>
            </header>
            <section>
                <div class="row" id="data_product">
                    {{-- Data new product -> home_read_new_product --}}
                </div>
            </section>
        </section>
    </div>
    {{-- End Content --}}


    @include('user.component.loading')


    <script>
        $(document).ready(function() {
            $('#loading').removeClass('d-none')
            setTimeout(() => {
                read_data_product_home();
                $('#loading').addClass('d-none')
            }, 2000);
        })

        function read_data_product_home() {
            $.get("{{ url('my/new-product/read') }}", {}, function(data, status) {
                $('#data_product').html(data)
            })
        }

        function detail_product(id) {
            $.get("{{ url('my/product/detail') }}/" + id, {}, function(data, status) {
                $('#data_modal_product').html(data)
                $('#modal_product_label').html('Detail Product')
                $('#button_modal_detail').removeClass('d-none')
                $('#modal_product').modal('show')
            })
        }

        function modal_cart(id) {
            $.get("{{ url('my/home/product/modal-cart/') }}/" + id, {}, function(data, status) {
                $('#data_modal_product').html(data)
                $('#modal_product_label').html('Save to Cart')
                $('#button_modal_detail').addClass('d-none')
                $('#modal_product').modal('show')
            })
        }
    </script>
@endsection
