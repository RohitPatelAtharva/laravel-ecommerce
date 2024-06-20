@extends('Front.app')

@section('content')

    </style>

    <main>
        <section class="section-1">
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="false">
                <div class="carousel-inner">
                    <a href="{{ route('front.kid') }}" style="color: white">
                        <div class="carousel-item active">
                            <!-- <img src="images/carousel-1.jpg" class="d-block w-100" alt=""> -->


                            <picture>
                                <source media="(max-width: 799px)"
                                    srcset="{{ asset('front-assets\images\carousel-1.jpg') }}" />
                                <source media="(min-width: 800px)"
                                    srcset="{{ asset('front-assets\images\carousel-1.jpg') }}" />
                                <img src="{{ asset('front-assets\images\carousel-1.jpg') }}" alt="" />
                            </picture>


                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3">
                                    <h1 class="display-4 text-white mb-3">Kids Fashion</h1>
                                    <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                        stet
                                        amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.kid') }}">Shop
                                        Now</a>
                                </div>

                            </div>
                        </div>
                    </a>
                    <a class="text-white" href="{{ route('front.women') }}">
                        <div class="carousel-item">
                            <picture>
                                <source media="(max-width: 799px)"
                                    srcset="{{ asset('front-assets\images\carousel-2.jpg') }}" />
                                <source media="(min-width: 800px)"
                                    srcset="{{ asset('front-assets\images\carousel-2.jpg') }}" />
                                <img src="{{ asset('front-assets\images\carousel-2.jpg') }}" alt="" />
                            </picture>

                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3">
                                    <h1 class="display-4 text-white mb-3">Women 's Fashion</h1>
                                    <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                        stet
                                        amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.women') }}">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <!-- <img src="images/carousel-3.jpg" class="d-block w-100" alt=""> -->


                            <picture>
                                <source media="(max-width: 799px)"
                                    srcset="{{ asset('front-assets\images\carousel-3.jpg') }}" />
                                <source media="(min-width: 800px)"
                                    srcset="{{ asset('front-assets\images\carousel-3.jpg') }}" />
                                <img src="{{ asset('front-assets\images\carousel-3.jpg') }}" alt="" />
                            </picture>

                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3">
                                    <h1 class="display-4 text-white mb-3">Shop Online at Flat 70% off on Branded Clothes
                                    </h1>
                                    <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                        stet
                                        amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div class="carousel-item">
                        <!-- <img src="images/carousel-3.jpg" class="d-block w-100" alt=""> -->


                        <a href="{{ route('front.toy') }}">
                            <picture>
                                <source media="(max-width: 799px)"
                                    srcset="{{ asset('front-assets\images\desktop_hp_merch_p10_toys_atiba_default_22ndapril1713616462326.webp') }}" />
                                <source media="(min-width: 800px)"
                                    srcset="{{ asset('front-assets\images\desktop_hp_merch_p10_toys_atiba_default_22ndapril1713616462326.webp') }}" />
                                <img src="{{ asset('front-assets\images\desktop_hp_merch_p10_toys_atiba_default_22ndapril1713616462326.webp') }}"
                                    alt="" />
                            </picture>
                        </a>

                        {{-- <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3">
                                    <h1 class="display-4 text-white mb-3">Shop Online at Flat 70% off on Branded Clothes
                                    </h1>
                                    <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                        stet
                                        amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Shop Now</a>
                                </div>
                            </div> --}}
                    </div>
                    </a>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <section class="section-1.5">

            <div class="container-fluid mt-3">
                <div class="card">
                    <picture>
                        <source media="(max-width: 799px)"
                            srcset="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_03.jpg') }}" />
                        <source media="(min-width: 800px)"
                            srcset="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_03.jpg') }}" />
                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_03.jpg') }}"
                            alt="" />
                    </picture>
                    <style>
                        .summer-season {
                            overflow: hidden;
                        }
                    </style>
                    <div class="container-fluid summer-season">
                        <div class="row justify-content-center align-items-center">

                            <div class="col-lg-2 col-md-4">
                                <a href="">
                                    <div class="card " style="width: 14rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_04.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4 ">
                                <a href="">
                                    <div class="card " style="width: 14rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_05.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a href="">
                                    <div class="card " style="width: 14rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_06.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a href="">
                                    <div class="card " style="width: 14rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_07.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a href="">
                                    <div class="card " style="width: 14rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_08.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a href="">
                                    <div class="card " style="width: 14rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_09.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>

                    <picture>
                        <source media="(max-width: 799px)"
                            srcset="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_10.jpg') }}" />
                        <source media="(min-width: 800px)"
                            srcset="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_10.jpg') }}" />
                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_10.jpg') }}"
                            alt="" />
                    </picture>


                    <div class="container-fluid">
                        <div class="row justify-content-center align-items-center ">
                            <div class="col-lg-2 col-md-4">
                                <a href="">
                                    <div class="card " style="width: 16rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_11.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a href="">
                                    <div class="card " style="width: 16rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_12.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a href="">
                                    <div class="card " style="width: 16rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_13.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a class="pl-5" href="">
                                    <div class="card " style="width: 16rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_14.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a href="">
                                    <div class="card " style="width: 16rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_15.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>

                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-2 col-md-4">
                                <a href="">
                                    <div class="card " style="width: 16rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_16.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2  ">
                                <a href="">
                                    <div class="card " style="width: 16rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_17.jpg ') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2">
                                <a href="">
                                    <div class="card " style="width: 16rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_19.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2">
                                <a href="">
                                    <div class="card " style="width: 16rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_20.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2">
                                <a href="">
                                    <div class="card " style="width: 16rem;border:unset">
                                        <img src="{{ asset('front-assets\kids image\desktop_landing_summer24_boy_2to4_1_18032024_18.jpg') }}"
                                            class="" alt="...">

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>







                </div>
            </div>
        </section>
        <section class="section-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 ">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                        </div>
                    </div>
                    <div class="col-lg-3 ">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-3">
            <div class="container">
                <div class="section-title">
                    <h2>Categories</h2>
                </div>
             
            </div>
            </div>

            </div>
            </div>
        </section>
        <section class="section-4 pt-5">
            <div class="container">
                <div class="section-title">
                    <h2>Letests Products</h2>
                </div>
                <div class="row pb-3">
                    @if ($featuredProducts->isNotEmpty())
                        @foreach ($featuredProducts as $feature)
                            <div class="col-md-3">
                                <div class="card product-card">
                                    <div class="product-image position-relative">
                                        <a href="{{ route('front.product', $feature->slug) }}" class="product-img"><img
                                                class="card-img-top"
                                                src="{{ asset('admin-assets/products_img/' . $feature->image) }}"
                                                alt=""></a>
                                        <a onclick="addToWishlist({{ $feature->id }})" id="wishlistButton"
                                            class="whishlist" href="javascript:void(0)"
                                            data-product-id="{{ $feature->id }}"><i class="far fa-heart"></i></a>

                                        <div class="product-action">
                                            <div class="product-action">
                                                @if ($feature->track_qty == 'Yes')
                                                    @if ($feature->qty > 0)
                                                        <a class="btn btn-dark" href="javascript:void(0);"
                                                            onclick="addToCart({{ $feature->id }})">
                                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                                        </a>
                                                        <input style="display: none" type="hidden"
                                                        id="quantity{{ $feature->id }}" value="1">
                                                    @else
                                                        <a class="btn btn-dark" href="javascript:void(0);">
                                                            <i class="fa fa-shopping-cart"></i> out Of Stock
                                                        </a>
                                                    @endif
                                                @else
                                                <a class="btn btn-dark" href="javascript:void(0);"
                                                            onclick="addToCart({{ $feature->id }})">
                                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                                        </a>
                                                        <input style="display: none" type="hidden"
                                                        id="quantity{{ $feature->id }}" value="1">
                                                @endif
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body text-center mt-3">
                                        <a class="h6 link product-name"
                                            href={{ route('front.product', $feature->slug) }}>{{ $feature->title }}</a>
                                        <div class="price mt-2">
                                            <span class="h5"><strong>Rs. {{ $feature->price }}</strong></span>
                                            @if ($feature->compare_price > 0)
                                                <span class="h6 text-underline text-danger"><del>MRP.
                                                        {{ $feature->compare_price }}</del></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>
            </div>
        </section>

        <section class="section-4 pt-5">
            <div class="container">
                <div class="section-title">
                    <h2>Featured Products</h2>
                </div>
                <div class="row pb-3">
                    @if ($featuredProducts->isNotEmpty())
                        @foreach ($featuredProducts as $feature)
                            <div class="col-md-3">
                                <div class="card product-card">
                                    <div class="product-image position-relative">
                                        <a href="{{ route('front.product', $feature->slug) }}" class="product-img"><img
                                                class="card-img-top"
                                                src="{{ asset('admin-assets/products_img/' . $feature->image) }}"
                                                alt=""></a>
                                        <a onclick="addToWishlist({{ $feature->id }})" id="wishlistButton"
                                            class="whishlist  " href="javascript:void(0)"><i
                                                class="far fa-heart"></i></a>

                                        <div class="product-action">
                                            @if ($feature->track_qty == 'Yes')
                                            @if ($feature->qty > 0)
                                                <a class="btn btn-dark" href="javascript:void(0);"
                                                    onclick="addToCart({{ $feature->id }})">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </a>
                                                <input style="display: none" type="hidden"
                                                id="quantity{{ $feature->id }}" value="1">
                                            @else
                                                <a class="btn btn-dark" href="javascript:void(0);">
                                                    <i class="fa fa-shopping-cart"></i> out Of Stock
                                                </a>
                                            @endif
                                        @else
                                        <a class="btn btn-dark" href="javascript:void(0);"
                                                    onclick="addToCart({{ $feature->id }})">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </a>
                                                <input style="display: none" type="hidden"
                                                id="quantity{{ $feature->id }}" value="1">
                                        @endif
                                        </div>
                                    </div>
                                    <div class="card-body text-center mt-3">
                                        <a class="h6 link product-name"
                                            href={{ route('front.product', $feature->slug) }}>{{ $feature->title }}</a>
                                        <div class="price mt-2">
                                            <span class="h5"><strong>Rs. {{ $feature->price }}</strong></span>
                                            @if ($feature->compare_price > 0)
                                                <span class="h6 text-underline text-danger"><del>MRP.
                                                        {{ $feature->compare_price }}</del></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>
            </div>
        </section>



    </main>

@endsection
@section('customjs')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var wishlistButton = document.getElementById("wishlistButton");
            wishlistButton.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent the default action of the anchor tag

                // Send an AJAX request to your server to add the item to the wishlist
                var itemId = getItemId(); // Implement a function to get the ID of the item
                addToWishlist(itemId); // Implement a function to send the AJAX request
            });
        });

        $(document).ready(function() {
            $('#wishlistButton').click(function(event) {
                event.preventDefault(); // Prevent the default action of the anchor tag

                // Send an AJAX request to your server to add the item to the wishlist
                var itemId = getItemId(); // Implement a function to get the ID of the item
                addToWishlist(itemId); // Implement a function to send the AJAX request
            });
        });
    </script>
@endsection
