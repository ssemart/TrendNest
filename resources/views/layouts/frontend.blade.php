<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Title  -->
    <title>@yield('title', 'TrendNest - Fashion E-commerce')</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('frontend/img/core-img/favicon.icon') }}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    @livewireStyles
    @stack('styles')
</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="{{ route('home') }}"><img src="{{ asset('frontend/img/core-img/trendnest-logo.png') }}" alt="TrendNest"></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="{{ route('shop') }}">Shop</a>
                                <div class="megamenu">
                                    @php
                                        $categories = App\Models\Category::take(3)->get();
                                    @endphp
                                    
                                    @foreach($categories as $category)
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">{{ $category->category_name }}</li>
                                        @php
                                            $subcategories = App\Models\Subcategory::where('category_id', $category->id)->get();
                                        @endphp
                                        
                                        @foreach($subcategories as $subcategory)
                                        <li><a href="{{ route('shop.subcategory', $subcategory->id) }}">{{ $subcategory->subcategory_name }}</a></li>
                                        @endforeach
                                    </ul>
                                    @endforeach
                                    
                                    <div class="single-mega cn-col-4">
                                        <img src="{{ asset('frontend/img/bg-img/bg-6.jpg') }}" alt="">
                                    </div>
                                </div>
                            </li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('shop') }}">Shop</a></li>
                                    <li><a href="{{ route('blog') }}">Blog</a></li>
                                    <li><a href="{{ route('contact') }}">Contact</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('blog') }}">Blog</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->
                <div class="search-area">
                    <form action="{{ route('search') }}" method="get">
                        <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
                <!-- Favourite Area -->
                <div class="favourite-area">
                    <a href="{{ route('wishlist') }}"><img src="{{ asset('frontend/img/core-img/heart.svg') }}" alt=""></a>
                </div>
                <!-- User Login Info -->
                <div class="user-login-info">
                    @auth
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('frontend/img/core-img/user.svg') }}" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                @if(Auth::user()->role == 2)
                                    <h6 class="dropdown-header">My Account</h6>
                                    <a class="dropdown-item" href="{{ route('customer.dashboard') }}">
                                        <i class="fa fa-user me-2"></i> Dashboard
                                    </a>
                                    <a class="dropdown-item" href="{{ route('customer.order.history') }}">
                                        <i class="fa fa-history me-2"></i> Order History
                                    </a>
                                    <a class="dropdown-item" href="{{ route('customer.setting.payment') }}">
                                        <i class="fa fa-credit-card me-2"></i> Payment Methods
                                    </a>
                                    <a class="dropdown-item" href="{{ route('customer.affiliate') }}">
                                        <i class="fa fa-users me-2"></i> Affiliate Program
                                    </a>
                                    <div class="dropdown-divider"></div>
                                @endif
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fa fa-sign-out me-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"><img src="{{ asset('frontend/img/core-img/user.svg') }}" alt=""></a>
                    @endauth
                </div>
                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="#" id="essenceCartBtn"><img src="{{ asset('frontend/img/core-img/bag.svg') }}" alt=""> <span id="cartCount">0</span></a>
                </div>
            </div>

        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="{{ asset('frontend/img/core-img/bag.svg') }}" alt=""> <span id="sideCartCount">0</span></a>
        </div>

        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list" id="cart-items">
                <!-- Cart items will be loaded dynamically -->
            </div>

            <!-- Cart Summary -->
            <div class="cart-amount-summary">

                <h2>Summary</h2>
                <ul class="summary-table">
                    <li><span>subtotal:</span> <span id="cart-subtotal">UGX 0</span></li>
                    <li><span>delivery:</span> <span>Free</span></li>
                    <li><span>discount:</span> <span id="cart-discount">0%</span></li>
                    <li><span>total:</span> <span id="cart-total">UGX 0</span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="{{ route('checkout') }}" class="btn essence-btn">check out</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Right Side Cart End ##### -->

    @yield('content')

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="{{ route('home') }}"><img src="{{ asset('frontend/img/core-img/trendnest-logo.png') }}" alt="TrendNest"></a>
                        </div>
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <ul>
                                <li><a href="{{ route('shop') }}">Shop</a></li>
                                <li><a href="{{ route('blog') }}">Blog</a></li>
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area mb-30">
                        <ul class="footer_widget_menu">
                            <li><a href="{{ route('order.status') }}">Order Status</a></li>
                            <li><a href="{{ route('payment.options') }}">Payment Options</a></li>
                            <li><a href="{{ route('shipping') }}">Shipping and Delivery</a></li>
                            <li><a href="{{ route('guides') }}">Guides</a></li>
                            <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms') }}">Terms of Use</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-end">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_heading mb-30">
                            <h6>Subscribe</h6>
                        </div>
                        <div class="subscribtion_form">
                            <form action="{{ route('newsletter') }}" method="post">
                                @csrf
                                <input type="email" name="email" class="mail" placeholder="Your email here">
                                <button type="submit" class="submit"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_social_area">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <p>
                        Copyright &copy;{{ date('Y') }} All rights reserved | TrendNest
                    </p>
                </div>
            </div>

        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{ asset('frontend/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('frontend/js/plugins.js') }}"></script>
    <!-- Classy Nav js -->
    <script src="{{ asset('frontend/js/classy-nav.min.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('frontend/js/active.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize dropdowns
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const dropdown = this.closest('.dropdown');
                    const menu = dropdown.querySelector('.dropdown-menu');
                    
                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(otherMenu => {
                        if (otherMenu !== menu && otherMenu.classList.contains('show')) {
                            otherMenu.classList.remove('show');
                        }
                    });
                    
                    // Toggle current dropdown
                    menu.classList.toggle('show');
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });

            // Close dropdowns on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });
        });
    </script>
    @livewireScripts
    @stack('scripts')
    @push('scripts')
    <script>
    $(document).ready(function() {
        // Function to load cart items
        function loadCartItems() {
            $.ajax({
                url: "{{ route('cart') }}",
                method: 'GET',
                success: function(response) {
                    $('#cart-items').html(response);
                    updateCartCounts();
                }
            });
        }

        // Function to update cart counts
        function updateCartCounts() {
            $.ajax({
                url: "{{ route('cart.count') }}",
                method: 'GET',
                success: function(response) {
                    $('#cartCount').text(response.count);
                    $('#sideCartCount').text(response.count);
                }
            });
        }

        // Load cart items on page load
        loadCartItems();

        // Event delegation for add to cart buttons
        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            const quantity = $('input[name="quantity"]').val() || 1;
            
            $.ajax({
                url: "{{ route('cart.add') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    quantity: quantity
                },
                success: function(response) {
                    loadCartItems();
                    alert(response.message);
                },
                error: function(error) {
                    alert('Error adding product to cart');
                }
            });
        });

        // Event delegation for remove from cart buttons (handles both sidebar and main cart)
        $(document).on('click', '.product-remove, .remove-from-cart', function(e) {
            e.preventDefault();
            const cartId = $(this).data('cart-id');
            const cartItem = $(this).closest('.single-cart-item, tr[data-cart-id]');
            const isMainCart = cartItem.is('tr');
            
            if (confirm('Are you sure you want to remove this item?')) {
                $.ajax({
                    url: "{{ route('cart.remove') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        cart_id: cartId
                    },
                    success: function(response) {
                        cartItem.fadeOut(function() {
                            $(this).remove();
                            
                            // Update cart counts
                            $('#cartCount').text(response.cart_count);
                            $('#sideCartCount').text(response.cart_count);
                            
                            // Update cart totals
                            $('#cart-subtotal').text('UGX ' + response.cart_total);
                            $('#cart-total').text('UGX ' + response.cart_total);
                            
                            // If on main cart page
                            if (isMainCart) {
                                if (response.cart_count === 0) {
                                    location.reload();
                                }
                            } else {
                                // If in sidebar
                                loadCartItems();
                            }
                            
                            // If on checkout page or cart is empty, reload
                            if (response.cart_count === 0 || window.location.href.indexOf('checkout') > -1) {
                                location.reload();
                            }
                        });
                    },
                    error: function(error) {
                        alert('Error removing item from cart');
                    }
                });
            }
        });
    });
    </script>
    @endpush
</body>

</html>