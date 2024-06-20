<?php

use App\Http\Controllers\admin\AdminAgentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\BillingController;
use App\Http\Controllers\admin\BrandsController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\Categorycontroller;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\DataController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\admin\OrderController as AdminOrderController;
use App\Http\Controllers\admin\OrderReturmController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\SectionController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\TempController;

use App\Http\Controllers\FrontController;
use App\Http\Controllers\admin\StockController;
use App\Http\Controllers\KidController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\admin\TagController;
use App\Http\Controllers\admin\TopSectionController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ToyController;
use App\Http\Controllers\WomenController;
use App\Http\Controllers\WitchlistController;
use App\Http\Middleware\Authenticate;
use App\Models\BillingAddress;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return redirect('/home');
});



Route::get('/home', [FrontController::class, 'index'])->name('home');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}', [ShopController::class, 'index'])->name('Front.shop');
Route::get('/product/{slug}', [ShopController::class, 'product'])->name('front.product');

Route::get('/kids/shop', [KidController::class, 'index'])->name('front.kid');
Route::get('/women/shop', [WomenController::class, 'index'])->name('front.women');
Route::get('/kids/toys/shop', [ToyController::class, 'index'])->name('front.toy');
Route::post('/add-to-cart', [CartController::class, 'addtoCart'])->name('front.addToCart');
Route::get('/cart-count', [FrontController::class, 'countCart'])->name('front.countCart');
Route::get('/cart', [CartController::class, 'cart'])->name('front.cart');
Route::delete('/cart/delete/{productId}', [CartController::class, 'deleteCartItem'])->name('cart.delete');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('front.updateCart');
Route::get('/cart/summary', [CartController::class, 'cartSummary'])->name('front.cartSummary');

########checkout############
Route::get('/checkout', [CartController::class, 'checkout'])->name('front.checkout');

########order##############
Route::post('/process-Checkout', [CartController::class, 'processCheckout'])->name('front.processCheckout');
Route::get('/thanks/{orderId}', [CartController::class, 'thankyou'])->name('front.thankyou');
######################witchlist#########################
Route::post('/add-to-wishlist', [FrontController::class, 'addToWishlist'])->name('front.addToWishlist');


#############review######
Route::post('/save-rating/{productId}', [ShopController::class, 'saveRating'])->name('front.saveRating');

Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('front.forgetPassword');
Route::post('/process-forget-password', [AuthController::class, 'processForgetPassword'])->name('front.processForgetPassword');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('front.resetPassword');
Route::post('/process-reset-password', [AuthController::class, 'processresetPassword'])->name('front.processresetPassword');
##############Subcribe##############################
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::post('/send-message', [MessageController::class, 'store'])->name('sendMessage');



####for login and register######
#####################about us############################

Route::get('/contact-us', [FrontController::class, 'contact'])->name('front.contact-us');

Route::get('/about-us', [FrontController::class, 'about'])->name('front.about');

Route::group(['prefix' => 'account'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [AuthController::class, 'login'])->name('account.login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('account.authenticate');
        Route::get('/register', [AuthController::class, 'register'])->name('account.register');
        Route::post('/process-register', [AuthController::class, 'processRegister'])->name('account.processRegister');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('account.profile');
        Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('account.updateProfile');
        Route::post('/update-address', [AuthController::class, 'updateAddress'])->name('account.updateAddress');
        Route::get('/my-order', [AuthController::class, 'orders'])->name('account.orders');
        Route::get('/order-detail/{orderId}', [AuthController::class, 'orderDetail'])->name('account.orderDetail');
        ##########################################cancel order#########################
        // Route::get('order-cancel', [AuthController::class, 'cancel'])->name('order.cancel');
        Route::get('/cancel/{orderId}', [AuthController::class, 'showCancelForm'])->name('orders.showCancelForm');
        Route::post('/orders/cancel/{orderId}', [AuthController::class, 'cancelOrder'])->name('orders.cancel');
        // Route::post('/order/cancel/{id}', [AuthController::class, 'cancelOrder'])->name('order.cancel');
        // Route::post('/order/item/cancel/{id}', [AuthController::class, 'cancelOrderItem'])->name('order.item.cancel');
        Route::get('/cancel-comfirm/{orderId}', [AuthController::class, 'Cancelconfirm'])->name('cancel.confirm');


        ###############################################################################
        Route::get('/change-password', [AuthController::class, 'showchangePaswordForm'])->name('account.showchangePaswordForm');
        Route::post('/process-change-password', [AuthController::class, 'changePasword'])->name('account.changePasword');

        Route::get('logout', [AuthController::class, 'logout'])->name('account.logout');
        Route::get('/my-wishlist', [AuthController::class, 'wishlist'])->name('account.wishlist');
        Route::post('/remove-product-from-wishlist', [AuthController::class, 'removeProductfromWishlist'])->name('account.removeProductfromWishlist');

        Route::get('/track-order/{track}', [AuthController::class, 'trackOrder'])->name('trackOredr');



        ##############cart#####################################


    });
});

############FOR REVIEW###################

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {

        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {

        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboard-data', [HomeController::class, 'getDashboardData'])->name('dashboard-data');

        Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');
        ##category

        Route::get('/categories', [Categorycontroller::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [Categorycontroller::class, 'create'])->name('categories.create');

        Route::post('/categories', [Categorycontroller::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [Categorycontroller::class, 'edit'])->name('categories.edit');
        Route::get('/products/{id}', [ShopController::class, 'show'])->name('front.product
        ');
        Route::delete('/categories/{page}', [Categorycontroller::class, 'destroy'])->name('categories.delete');




        ###subcategory Routes
        Route::get('/sub-categories', [SubCategorycontroller::class, 'index'])->name('sub-categories.index');

        Route::get('/sub-categories/create', [SubCategoryController::class, 'create'])->name('sub-category.create');
        Route::post('/sub-categories', [SubCategoryController::class, 'store'])->name('sub-categories.store');
        Route::get('/sub-categories/{subCategory}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit');
        Route::put('sub-categories/{id}/update', [SubCategoryController::class, 'update'])->name('sub-categories.update');
        Route::delete('/subcategories/{page}', [SubCategorycontroller::class, 'destroy'])->name('subcategories.delete');


        ###brands
        Route::get('/brands', [BrandsController::class, 'index'])->name('brands.index');
        Route::get('/brands/create', [BrandsController::class, 'create'])->name('brands.create');
        Route::post('/brands/store', [BrandsController::class, 'store'])->name('brands.store');
        Route::get('/brands/{brand}/edit', [BrandsController::class, 'edit'])->name('brands.edit');
        Route::put('/brands/{brand}', [BrandsController::class, 'update'])->name('brands.update');
        Route::delete('/brands/{page}', [BrandsController::class, 'destroy'])->name('brands.delete');
        ###product
        Route::get('/products', [ProductController::class, 'index'])->name('product.index');

        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::get('/product-subcategories', [ProductSubCategoryController::class, 'index'])->name('product-subcategories.index');
        Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::get('/get-products', [ProductController::class, 'getProducts'])->name('product.getProducts'); ##for related product###
        Route::get('/product/tags', [ProductController::class, 'getTags'])->name('product.getTags'); ##for related product###

        Route::delete('/products/{page}', [ProductController::class, 'destroy'])->name('products.delete');

        #########for show rating admin pannel and update
        Route::get('/rating', [ProductController::class, 'productRating'])->name('product.productRating');
        Route::get('/change-rating-status', [ProductController::class, 'changeRatingStatus'])->name('product.changeRatingStatus');


        #########shipping############################
        Route::get('/shipping/create', [ShippingController::class, 'create'])->name('shipping.create');
        Route::post('/shipping/store', [ShippingController::class, 'store'])->name('shipping.store');
        Route::get('/shipping/{id}', [ShippingController::class, 'edit'])->name('shipping.edit');
        Route::put('/shipping/{id}', [ShippingController::class, 'update'])->name('shipping.update');
        Route::delete('/shipping/{id}', [ShippingController::class, 'destroy'])->name('shipping.delete');

        ####################User#########################
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users-create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users-store', [UserController::class, 'store'])->name('users.store');
        Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/user/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');

        #############agent #######################################
        Route::resource('agents', AdminAgentController::class)->names([
            'index' => 'admin.agents.index',
            'create' => 'admin.agents.create',
            'store' => 'admin.agents.store',
            'show' => 'admin.agents.show',
            'edit' => 'admin.agents.edit',
            'update' => 'admin.agents.update',
            'destroy' => 'admin.agents.destroy',
        ]);
        Route::put('agents/{id}/approve', [AdminAgentController::class, 'approve'])->name('admin.agents.approve');
        Route::put('agents/{id}/block', [AdminAgentController::class, 'block'])->name('admin.agents.block');
        ################product###########################
        Route::post('/upload-temp-image', [TempController::class, 'create'])->name('temp-images.create');
        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
        Route::post('/color/store', [ColorController::class, 'store'])->name('color.store');

        #######stock
        Route::get('/stock/create', [StockController::class, 'create'])->name('stock.create');
        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
        Route::post('/stock/store', [StockController::class, 'store'])->name('stock.store');


        ############for Tag  #####
        Route::post('/tags/add', [TagController::class, 'addTag'])->name('tags.add');


        ##########order

        Route::get('/order', [AdminOrderController::class, 'index'])->name('order.index');
        Route::get('/order/{id}', [AdminOrderController::class, 'detail'])->name('order.detail');
        Route::post('/order/change-status/{id}', [AdminOrderController::class, 'changeOrderStatus'])->name('order.changeOrderStatus');
        Route::post('/order/send-email/{id}', [AdminOrderController::class, 'sendInvoiceEmail'])->name('order.sendInvoiceEmail');



        ####################section add##################
        Route::get('/index/pages;', [SectionController::class, 'index'])->name('sections.index');
        Route::get('/create', [SectionController::class, 'create'])->name('sections.create');
        Route::post('/store', [SectionController::class, 'store'])->name('sections.store');
        Route::get('/edit/{id}', [SectionController::class, 'edit'])->name('sections.edit');
        Route::put('/section/{id}', [SectionController::class, 'update'])->name('sections.update');
        Route::delete('/sections/{page}', [SectionController::class, 'destroy'])->name('sections.destroy');
        #####################top section###########################
        Route::get('/index', [TopSectionController::class, 'index'])->name('Topsections.index');

        Route::get('/create/topsection', [TopSectionController::class, 'create'])->name('topsection.create');
        Route::post('/store/topsection', [TopSectionController::class, 'store'])->name('topsection.store');
        Route::delete('/topsections/{id}', [TopSectionController::class, 'destroy'])->name('topsections.destroy');
        Route::get('/getCategory', [TopSectionController::class, 'getCategories'])->name('top.getCetegory');
        Route::get('/getProducts', [TopSectionController::class, 'getProducts'])->name('top.getProducts');
        Route::get('/getTags', [TopSectionController::class, 'getTags'])->name('top.getTags');


        #############pages###################
        Route::get('/pages/index', [PageController::class, 'index'])->name('pages.index');
        Route::get('/pages/craete', [PageController::class, 'create'])->name('pages.create');
        Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
        Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.delete');

        ############################invoice ###################

        Route::get('/invoice-create', [InvoiceController::class, 'create'])->name('invoice.create');
        Route::post('/billing-addresses', [BillingController::class, 'store'])->name('billing.address');
        Route::get('/search-billing-addresses', [BillingController::class, 'search'])->name('get.searchBillingAddresses');
        Route::get('/get-products/data', [InvoiceController::class, 'getProductsdata'])->name('get.productsdata');


        Route::post('submit-invoice', [InvoiceController::class, 'store'])->name('store.invoice');

        Route::get('/invoice-bill', [InvoiceController::class, 'getBill'])->name('getBill');
        Route::post('/view-pdf', [InvoiceController::class, 'viewPDF'])->name('viewPDF');
        Route::post('/download/pdf', [InvoiceController::class, 'downloadPDF'])->name('download-PDF');

        #########################ReturnInvoice###################
        Route::get('/return-product', [BillingController::class, 'return'])->name('return.product');
        Route::get('/return-order/{id}', [OrderReturmController::class, 'returnOrder'])->name('return.order');
        Route::post('/return-order/store', [OrderReturmController::class, 'storeReturnOrder'])->name('return.order.store');

        Route::get('/search-order', [BillingController::class, 'getsearch'])->name('get.searchorder');
        Route::get('/return-invoice-bill/{order_id}', [OrderReturmController::class, 'return_invoice'])->name('return.invoice.bill');





        // testing

        Route::get("/pdf-invoice", [BillingController::class, 'bill']);

        Route::get('/getSlug', function (Request $request) {
            $slug = '';
            if (!empty($request->title)) {
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        })->name('getSlug');
    });
});
