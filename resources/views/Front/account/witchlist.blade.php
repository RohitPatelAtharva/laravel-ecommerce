@extends('Front.app')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">My Wishlist</a></li>
                        <li class="breadcrumb-item">Wishlist</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class=" section-11 ">
            <div class="container  mt-5">

                <div class="row">
                    <div class="col-md-12">
                        @include('Front.account.common.message')
                    </div>
                    <div class="col-md-3">
                        @include('Front.account.common.sidebar')
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">My Wishlist</h2>
                            </div>
                            <div class="card-body p-4">
                                @if ($wishlists->isNotEmpty())
                                    @foreach ($wishlists as $wishlist)
                                        <div
                                            class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                                            <div class="d-block d-sm-flex align-items-start text-center text-sm-start"><a
                                                    class="d-block flex-shrink-0 mx-auto me-sm-4"
                                                    href="{{ route('front.product', $wishlist->product->slug) }}"
                                                    style="width: 10rem;"><img
                                                        src="{{ asset('admin-assets/products_img/' . $wishlist->product->image) }}"
                                                        alt="Product"></a>
                                                <div class="pt-2">
                                                    <h3 class="product-title fs-base mb-2"><a
                                                            href="{{ route('front.product', $wishlist->product->slug) }}">{{ Illuminate\Support\Str::limit($wishlist->product->title, 250) }}</a>
                                                    </h3>
                                                    <div class="fs-lg text-accent pt-2 text-info"> Rs.
                                                        {{ $wishlist->product->price }}<small class="text-danger"> Rs.
                                                            {{ $wishlist->product->compare_price }}</small></div>
                                                </div>
                                            </div>
                                            <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                                <button onclick="removeProduct({{ $wishlist->product_id }})"
                                                    class="btn btn-outline-danger btn-sm" type="button"><i
                                                        class="fas fa-trash-alt me-2"></i> </button>
                                            </div>
                                        </div>
                                    @endforeach
                             







                            </div>


                        </div>
                            @else
                            <div>
                                <h2 class="text-center text-primary p-2">Your Wishlist is Empty</h2>
                                 <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="748.0748" height="406.63957" viewBox="0 0 748.0748 406.63957" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M723.49034,356.92749l-17.83323-3.15843-18.21332,49.15449-31.101,46.33221a11.01794,11.01794,0,1,0,11.31606,10.4346l37.98505-43.79252Z" transform="translate(-225.9626 -246.68021)" fill="#ffb7b7"/><path d="M784.52559,295.68021c0,17.67312-16.34161,15-36.5,15s-36.5,2.67312-36.5-15,7.98246-49,36.5-49C777.52559,246.68021,784.52559,278.0071,784.52559,295.68021Z" transform="translate(-225.9626 -246.68021)" fill="#2f2e41"/><path d="M851.63156,449.44357l-32.2124-55.41694-15-50.22833-18,2,14,60,35.85791,47.18109a10.9955,10.9955,0,1,0,15.35449-3.53582Z" transform="translate(-225.9626 -246.68021)" fill="#ffb7b7"/><polygon points="593.709 291 630.709 392 645.929 392 619.819 287.378 593.709 291" fill="#ffb7b7"/><polygon points="512.709 296.5 475.709 397.5 460.488 397.5 486.598 292.878 512.709 296.5" fill="#ffb7b7"/><path d="M776.67126,323.68019s15-5,19,2,14,29,14,29l-20,3,18,45s25,19,31,62,12,78,12,78-104,17-144,10c0,0,3-21,11-22-6-6,1.90551-11,1.90551-11l18.09449-65,4-32s-6.96661-32.72257-16-39-6-24-6-24l-18,1s2-32,11-32h11Z" transform="translate(-225.9626 -246.68021)" fill="#2f2e41"/><path d="M873.767,651.77038l-39.53076-.00146v-.5a15.38731,15.38731,0,0,1,15.38648-15.38623h.001l24.14405.001Z" transform="translate(-225.9626 -246.68021)" fill="#2f2e41"/><path d="M705.767,651.77038l-39.53076-.00146v-.5a15.38731,15.38731,0,0,1,15.38648-15.38623h.001l24.14405.001Z" transform="translate(-225.9626 -246.68021)" fill="#2f2e41"/><circle cx="523.66929" cy="37.62202" r="24.56103" fill="#ffb7b7"/><path d="M719.52559,283.68019v0H729.24l4.28564-12,.85693,12h4.64307l2.5-7,.5,7h34.5v0a26,26,0,0,0-26-26h-5.00006A26,26,0,0,0,719.52559,283.68019Z" transform="translate(-225.9626 -246.68021)" fill="#2f2e41"/><path d="M973.0374,653.31979h-381a1,1,0,0,1,0-2h381a1,1,0,1,1,0,2Z" transform="translate(-225.9626 -246.68021)" fill="#cbcbcb"/><rect id="b176a470-c9a0-4b19-a249-9749cef70ca2" data-name="Rectangle 75" y="34.09137" width="430.25197" height="180.67121" fill="#cbcbcb"/><path d="M234.96261,452.44283h412.252V289.77145h-412.252Z" transform="translate(-225.9626 -246.68021)" fill="#fff"/><path d="M583.685,348.298v69.36769a3.45558,3.45558,0,0,1-3.4481,3.4481H505.59566a3.4557,3.4557,0,0,1-3.4481-3.4481V348.298a3.45047,3.45047,0,0,1,3.4481-3.4481h74.64126A3.45035,3.45035,0,0,1,583.685,348.298Z" transform="translate(-225.9626 -246.68021)" fill="#00b0ff"/><path d="M548.18937,421.46261H537.64223a3.40838,3.40838,0,0,1-3.4481-3.35907V346.14669a3.4084,3.4084,0,0,1,3.4481-3.35907h10.54714a3.4084,3.4084,0,0,1,3.4481,3.35907v71.95685A3.40839,3.40839,0,0,1,548.18937,421.46261Z" transform="translate(-225.9626 -246.68021)" fill="#3f3d56"/><path d="M540.74411,323.13694c5.42075,4.69188,3.70908,15.55,3.70908,15.55s-10.50045,3.25113-15.92119-1.44076-3.70908-15.55-3.70908-15.55S535.32336,318.44507,540.74411,323.13694Z" transform="translate(-225.9626 -246.68021)" fill="#3f3d56"/><path d="M558.74923,336.347c-4.67493,5.43538-15.53837,3.75762-15.53837,3.75762s-3.28387-10.49027,1.391-15.92563,15.53837-3.75762,15.53837-3.75762S563.42416,330.91165,558.74923,336.347Z" transform="translate(-225.9626 -246.68021)" fill="#3f3d56"/><path d="M583.685,348.298v11.67892l-81.53746-.34481V348.298a3.45047,3.45047,0,0,1,3.4481-3.4481h74.64126A3.45035,3.45035,0,0,1,583.685,348.298Z" transform="translate(-225.9626 -246.68021)" opacity="0.2"/><path d="M592.46485,355.39829a3.44357,3.44357,0,0,1-2.75528,1.35824l-90.86687-.38114a3.4481,3.4481,0,0,1-3.43367-3.46247h0l.04259-10.14151a3.44747,3.44747,0,0,1,3.46161-3.43327h.00106l90.86657.3809a3.44811,3.44811,0,0,1,3.43368,3.46248h0l-.04262,10.14149A3.42927,3.42927,0,0,1,592.46485,355.39829Z" transform="translate(-225.9626 -246.68021)" fill="#00b0ff"/><rect x="533.97008" y="339.11765" width="18.25465" height="17.44334" transform="translate(-32.87776 642.85846) rotate(-89.77043)" fill="#3f3d56"/><rect id="b0bfb71d-a32e-4f0c-b04f-06b3baf1791c" data-name="Rectangle 81" x="63.49065" y="97.16524" width="100.86719" height="8.053" fill="#e5e5e5"/><rect id="a096be4f-2cf6-461f-ae56-f8547c16e35b" data-name="Rectangle 82" x="63.49065" y="126.5392" width="155.76132" height="8.053" fill="#00b0ff"/><rect id="be15e58f-5799-4307-babb-7d5595f0559e" data-name="Rectangle 83" x="63.49065" y="154.21223" width="126.94161" height="8.053" fill="#e5e5e5"/><path id="bb7b29b1-743f-4814-99e1-7130c517fe83-115" data-name="Path 438" d="M352.19527,595.21017A24.21457,24.21457,0,0,0,375.578,591.0914c8.18977-6.87441,10.758-18.196,12.84671-28.68191l6.17973-31.01657-12.9377,8.90837c-9.30465,6.40641-18.81827,13.01866-25.26012,22.29785s-9.25222,21.94707-4.07792,31.988" transform="translate(-225.9626 -246.68021)" fill="#e6e6e6"/><path id="fed11345-5ecc-4699-9d2a-1ad58856fa3e-116" data-name="Path 439" d="M354.193,634.92073c-1.62839-11.86368-3.30382-23.88078-2.15885-35.87167,1.01467-10.64932,4.26374-21.0488,10.87832-29.57938a49.20624,49.20624,0,0,1,12.62465-11.44039c1.26216-.79647,2.4241,1.20355,1.16733,1.997A46.77947,46.77947,0,0,0,358.2,582.35187c-4.02858,10.24607-4.67546,21.41582-3.98154,32.3003.41944,6.58218,1.31074,13.1212,2.20588,19.65251a1.19817,1.19817,0,0,1-.808,1.42251,1.16349,1.16349,0,0,1-1.42254-.808Z" transform="translate(-225.9626 -246.68021)" fill="#f2f2f2"/><path id="a3dbae8e-6ba7-4728-9f88-d2b4a8de2cb7-117" data-name="Path 442" d="M365.914,615.88428a17.82514,17.82514,0,0,0,15.53142,8.01862c7.8644-.37318,14.41806-5.85973,20.31713-11.07027l17.452-15.4088-11.54987-.5528c-8.3062-.39784-16.82672-.771-24.73814,1.79338s-15.20757,8.72638-16.654,16.9154" transform="translate(-225.9626 -246.68021)" fill="#e6e6e6"/><path id="b12c7aab-829f-433e-99e1-9b0624b941d5-118" data-name="Path 443" d="M349.59,641.74042c7.83972-13.87142,16.93235-29.28794,33.1808-34.21551a37.02568,37.02568,0,0,1,13.95545-1.44105c1.4819.128,1.1118,2.41174-.367,2.28454a34.39826,34.39826,0,0,0-22.27164,5.89214c-6.27995,4.27454-11.16976,10.21756-15.30782,16.51907-2.5351,3.86051-4.80576,7.88445-7.07642,11.903C350.97782,643.96712,348.856,643.03959,349.59,641.74042Z" transform="translate(-225.9626 -246.68021)" fill="#f2f2f2"/><path d="M435.0374,644.31979h-136a1,1,0,1,1,0-2h136a1,1,0,0,1,0,2Z" transform="translate(-225.9626 -246.68021)" fill="#cbcbcb"/></svg>
                            </div>
                            @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('customjs')
    <script>
        function removeProduct(id) {
    $.ajax({
        url: '{{ route("account.removeProductfromWishlist") }}',
        type: 'post',
        data: {
            id: id,
        },
        dataType: 'json',
        success: function(response) {
            if (response.status == true) {
                window.location.href = "{{ route('account.wishlist') }}";
            } else {
                // Handle case when product removal fails
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', xhr.responseText);
            // You can handle errors here, such as displaying an error message to the user
        }
    });
}
    </script>
@endsection