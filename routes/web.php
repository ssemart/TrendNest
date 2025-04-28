<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Customer\CustomerMainController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\MasterSubCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\SellerMainController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerStoreController;
use App\Livewire\HomepageComponet;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\WishlistController;
use App\Http\Controllers\Shop\CheckoutController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/category/{id}', [ShopController::class, 'categoryProducts'])->name('shop.category');
Route::get('/shop/subcategory/{id}', [ShopController::class, 'subcategoryProducts'])->name('shop.subcategory');
Route::get('/product/{id}', [ShopController::class, 'productDetails'])->name('product.details');
Route::get('/search', [ShopController::class, 'search'])->name('search');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Cart Routes
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

// Wishlist Routes
Route::post('/wishlist/toggle', [WishlistController::class, 'toggleWishlist'])->name('wishlist.toggle');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist')->middleware('auth');

// Static Pages
Route::get('/order-status', [HomeController::class, 'orderStatus'])->name('order.status');
Route::get('/payment-options', [HomeController::class, 'paymentOptions'])->name('payment.options');
Route::get('/shipping', [HomeController::class, 'shipping'])->name('shipping');
Route::get('/guides', [HomeController::class, 'guides'])->name('guides');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::post('/newsletter', [HomeController::class, 'newsletter'])->name('newsletter');

// Admin Routes
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminMainController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [AdminMainController::class, 'profile'])->name('admin.profile');
    Route::put('/profile/update', [AdminMainController::class, 'updateProfile'])->name('admin.profile.update');
    Route::get('/settings', [AdminMainController::class, 'setting'])->name('admin.settings');
    Route::get('/manage/users', [AdminMainController::class, 'manage_user'])->name('admin.manage.user');
    Route::get('/users/{id}/view', [AdminMainController::class, 'view_user'])->name('admin.users.view');
    Route::get('/users/{id}/edit', [AdminMainController::class, 'edit_user'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminMainController::class, 'update_user'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminMainController::class, 'delete_user'])->name('admin.users.delete');
    Route::get('/cart/history', [AdminMainController::class, 'cart_history'])->name('admin.cart.history');
    Route::get('/order/history', [AdminMainController::class, 'order_history'])->name('admin.order.history');

    // Store Management
    Route::controller(StoreController::class)->group(function () {
        Route::get('/stores', 'index')->name('admin.stores.index');
        Route::get('/stores/create', 'create')->name('admin.stores.create');
        Route::post('/stores', 'store')->name('admin.stores.store');
        Route::get('/stores/{store}/edit', 'edit')->name('admin.stores.edit');
        Route::put('/stores/{store}', 'update')->name('admin.stores.update');
        Route::delete('/stores/{store}', 'destroy')->name('admin.stores.delete');
    });

    // Product Management
    Route::delete('/product-images/{id}', [ProductController::class, 'deleteImage'])->name('admin.products.delete-image');
    
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('admin.products');
        Route::get('/products/create', 'create')->name('admin.products.create');
        Route::post('/products', 'store')->name('admin.products.store');
        Route::get('/products/{id}/edit', 'edit')->name('admin.products.edit');
        Route::put('/products/{id}', 'update')->name('admin.products.update');
        Route::delete('/products/{id}', 'destroy')->name('admin.products.delete');
        Route::get('/products/reviews', 'review_manage')->name('admin.products.reviews');
    });

    // Category Management
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('admin.categories');
        Route::get('/categories/create', 'create')->name('admin.categories.create');
        Route::post('/categories/store', 'store')->name('admin.categories.store');
        Route::get('/categories/edit/{id}', 'edit')->name('admin.categories.edit');
        Route::put('/categories/update/{id}', 'update')->name('admin.categories.update');
        Route::delete('/categories/delete/{id}', 'destroy')->name('admin.categories.delete');
    });

    // Subcategory Management
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/subcategories', 'manage')->name('admin.subcategories');
        Route::get('/subcategories/create', 'index')->name('admin.subcategories.create');
        Route::post('/subcategories', 'store')->name('admin.subcategories.store');
        Route::get('/subcategories/{id}/edit', 'edit')->name('admin.subcategories.edit');
        Route::put('/subcategories/{id}', 'update')->name('admin.subcategories.update');
        Route::delete('/subcategories/{id}', 'destroy')->name('admin.subcategories.delete');
    });

    // Other admin routes...
});

// Vendor Routes
Route::middleware(['auth', 'verified', 'rolemanager:vendor'])->prefix('vendor')->group(function () {
    Route::get('/', [SellerMainController::class, 'index'])->name('vendor.dashboard');
    Route::get('/profile', [SellerMainController::class, 'profile'])->name('vendor.profile');
    Route::put('/profile/update', [SellerMainController::class, 'updateProfile'])->name('vendor.profile.update');
    Route::get('/order/history', [SellerMainController::class, 'orderhistory'])->name('vendor.order.history');
    
    Route::controller(SellerProductController::class)->group(function () {
        Route::get('/product/create', 'index')->name('vendor.product.create');
        Route::post('/product/store', 'storeproduct')->name('vendor.product.store');
        Route::get('/product/manage', 'manage')->name('vendor.product.manage');
    });

    Route::controller(SellerStoreController::class)->group(function () {
        Route::get('/store/create', 'index')->name('vendor.store.create');
        Route::get('/store/manage', 'manage')->name('vendor.store.manage');
        Route::post('/store/publish', 'store')->name('vendor.create.store');
        Route::get('/store/{id}', 'showsstore')->name('vendor.show.substore');
        Route::put('/store/Update/{id}', 'updatestore')->name('vendor.update.store');
        Route::delete('/store/delete/{id}', 'deletestore')->name('vendor.delete.store');
    });
});

// Customer Routes
Route::middleware(['auth', 'verified', 'rolemanager:customer'])->prefix('user')->group(function () {
    Route::controller(CustomerMainController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('customer.dashboard');
        Route::put('/profile/update', 'updateProfile')->name('customer.profile.update');
        Route::get('/order/history', 'history')->name('customer.order.history');
        Route::get('/setting/payment', 'payment')->name('customer.setting.payment');
        Route::post('/setting/payment', 'storePaymentMethod')->name('customer.payment.store');
        Route::delete('/setting/payment/{id}', 'deletePaymentMethod')->name('customer.payment.delete');
        Route::get('/affiliate', 'affiliate')->name('customer.affiliate');
    });
});

Route::middleware(['auth', 'role:2'])->prefix('customer')->name('customer.')->group(function () {
    Route::put('/order/{id}/cancel', [CustomerMainController::class, 'cancelOrder'])->name('order.cancel');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
