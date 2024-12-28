<!--== Header Area Start ==-->
<header id="header-area">
    <div class="handeva-container">
        <div class="row">
            <div class="flexed-contain">
                <!-- Logo Area Start -->
                <div class="col-3 col-lg-1 col-xl-2 m-auto">
                    <a href="{{ route('user.home') }}" class="logo-area">
                        <img src="{{ asset('assets') }}/img/HandevaLogo.png" alt="Logo" class="img-fluid" />
                    </a>
                </div>
                <!-- Logo Area End -->

                <!-- Navigation Area Start -->
                <div class="col-3 col-lg-9 col-xl-8 m-auto">
                    <div class="main-menu-wrap">
                        <nav id="mainmenu">
                            <ul>
                                <li class="@yield('home-active')">
                                    <a href="{{ route('user.home') }}">Home</a>
                                </li>
                                <li class="@yield('collections-active')">
                                    <a href="{{ route('collections') }}">Collections</a>
                                </li>
                                <li class="@yield('contact-active')">
                                    <a href="{{ route('theme.contact') }}">Contact Us</a>
                                </li>
                                <li class="@yield('about-active')">
                                    <a href="{{ route('theme.about') }}">About Us</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Navigation Area End -->

                <!--== Header Right Meta Start ==-->
                <div class="header-right-meta text-right">
                    <ul class="custom-options">
                        @guest
                        <!-- Login Button for Guests -->
                        <li class="custom-login">
                            <a href="{{ route('theme.login_register') }}"
                                class="custom-btn custom-btn-primary">Login</a>
                        </li>
                        @else
                        <!-- Profile and Dropdown for Authenticated Users -->
                        <li class="custom-dropdown">
                            <a href="#" class="custom-dropdown-toggle">
                                <i class="fa fa-user-circle"></i>
                            </a>
                            <ul class="custom-dropdown-menu">
                                @if(Auth::guard('web')->check())
                                <li><a href="{{ route('theme.my_account') }}">Your Profile</a></li>
                                @elseif(Auth::guard('vendor')->check())
                                <li><a href="{{ route('vendor.dashboard') }}">Your Dashboard</a></li>
                                @endif
                                <li>
                                    <form action="{{ route('userLogout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="custom-btn custom-btn-link">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest

                        <ul class="icons">
                            <!-- Wishlist -->
                            <li class="custom-icon" title="Wishlist">
                                <a href="{{ route('wishlist.show') }}">
                                    <i class="fa fa-heart"></i>
                                </a>
                                <span class="count wishlist-count">{{ $wishlistCount }}</span>
                            </li>

                            <!-- Compare -->
                            <li class="custom-icon" title="Compare">
                                <a href="#">
                                    <i class="fa fa-exchange-alt"></i>
                                </a>
                            </li>

                            <!-- Search -->
                            <li class="custom-icon" title="Search">
                                <a href="#" class="modal-active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>

                            <!-- Shopping Cart -->
                            <li class="shop-cart custom-icon" title="Cart">
                                <a href="{{ route('theme.cart') }}">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span class="count">{{ $cartCount }}</span>
                                </a>
                                <div class="mini-cart">
                                    <div class="mini-cart-body">
                                        <div class="single-cart-item">
                                            <figure class="product-thumb">
                                                <a href="#">
                                                    <img src="{{ asset('assets') }}/img/product-1.jpg" alt="Products">
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h2 class="product-name">
                                                    <a href="#">Sprite Yoga Companion</a>
                                                </h2>
                                                <div class="cal">
                                                    <span class="quantity">3</span>
                                                    <span class="multiplication">X</span>
                                                    <span class="price">$77.00</span>
                                                </div>
                                            </div>
                                            <a href="#" class="remove-icon">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mini-cart-footer">
                                        <a href="checkout.html" class="btn-add-to-cart">Checkout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </ul>
                </div>
                <!--== Header Right Meta End ==-->
            </div>
        </div>
    </div>
</header>
<!--== Header Area End ==-->

<!--== Search Box Area Start ==-->
<div class="body-popup-modal-area">
    <span class="modal-close"><img src="{{ asset('assets') }}/img/cancel.png" alt="Close" class="img-fluid" /></span>
    <div class="modal-container d-flex">
        <div class="search-box-area">
            <div class="search-box-form">
                <form action="#" method="post">
                    <input type="search" placeholder="type keyword and hit enter" />
                    <button class="btn" type="button"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--== Search Box Area End ==-->