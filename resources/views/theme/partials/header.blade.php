    <!--== Header Area Start ==-->
    <header id="header-area">
        <div class="ruby-container">
            <div class="row">
                <!-- Logo Area Start -->
                <div class="col-3 col-lg-1 col-xl-2 m-auto">
                    <a href="{{route('theme.home')}}" class="logo-area">
                        <img src="{{ asset('assets') }}/img/HandevaLogo.png" alt="Logo" class="img-fluid" />
                    </a>
                </div>
                <!-- Logo Area End -->

                <!-- Navigation Area Start -->
                <div class="col-3 col-lg-9 col-xl-8 m-auto">
                    <div class="main-menu-wrap">
                        <nav id="mainmenu">
                            <ul>
                                <li class="dropdown-show @yield('home-active')"><a
                                        href="{{ route('theme.home')}}">Home</a>
                                    <!-- <ul class="dropdown-nav sub-dropdown">
                                        <li><a href="index.html">Home Layout 1</a></li>
                                        <li><a href="index2.html">Home Layout 2</a></li>
                                        <li><a href="index3.html">Home Layout 3</a></li>
                                        <li><a href="index4.html">Home Layout 4</a></li>
                                        <li><a href="index5.html">Home Layout 5</a></li>
                                        <li><a href="index6.html">Home Layout 6</a></li>
                                    </ul> -->
                                </li>
                                <li class="dropdown-show @yield('shop-active')"><a
                                        href="{{ route('shop.index')}}">Shop</a>
                                    <ul class="mega-menu-wrap dropdown-nav">
                                        <li class="mega-menu-item"><a href="shop.html"
                                                class="mega-item-title">Necklaces</a>
                                        </li>

                                        <li class="mega-menu-item"><a href="single-product.html"
                                                class="mega-item-title">Earrings</a>
                                        </li>
                                        <li class="mega-menu-item"><a href="single-product.html"
                                                class="mega-item-title">Bracelets</a>
                                        </li>
                                        <li class="mega-menu-item"><a href="single-product.html"
                                                class="mega-item-title">Rings</a>
                                        </li>

                                    </ul>
                                </li>
                                <!-- <li class="dropdown-show"><a href="#">Pages</a>
                                    <ul class="dropdown-nav">
                                        <li><a href="cart.html">Shopping Cart</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="compare.html">Compare</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="login-register.html">Login & Register</a></li>
                                        <li><a href="my-account.html">My Account</a></li>
                                        <li><a href="404.html">404 Error</a></li>
                                    </ul>
                                </li> -->

                                <li class="dropdown-show"><a href="#">Blog</a>
                                    <ul class="dropdown-nav">
                                        <li><a href="blog.html">Blog Right Sidebar</a></li>
                                        <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                        <li><a href="blog-grid.html">Blog Grid Layout</a></li>
                                        <li><a href="single-blog.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li class="@yield('contact-active')">
                                    <a href="{{ route('theme.contact') }}">Contact Us</a>
                                </li>
                                <li class="@yield('contact-active')">
                                    <a href="{{ route('theme.about') }}">About Us</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Navigation Area End -->

                <!--== Header Right Meta Start ==-->
                <div class="header-right-meta text-right">
                    <ul class="additional-options">
                        <!--== Custom User Menu Start ==-->
                        <li class="custom-user-menu text-right">
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
                                        <!-- Customer Dropdown -->
                                        <li><a href="{{ route('theme.my_account') }}">Your Profile</a></li>
                                        @elseif(Auth::guard('vendor')->check())
                                        <!-- Vendor Dropdown -->
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
                            </ul>
                        </li>
                        <!--== Custom User Menu End ==-->

                        <!-- Search Icon -->
                        <li>
                            <a href="#" class="modal-active">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>

                        <!-- Settings Dropdown -->
                        <li class="settings">
                            <a href="#"><i class="fa fa-cog"></i></a>
                            <div class="site-settings">
                                <dl class="currency">
                                    <dt>Currency</dt>
                                    <dd class="current"><a href="#">USD</a></dd>
                                    <dd><a href="#">AUD</a></dd>
                                    <dd><a href="#">CAD</a></dd>
                                    <dd><a href="#">BDT</a></dd>
                                </dl>

                                <dl class="my-account">
                                    <dt>My Account</dt>
                                    <dd><a href="#">Dashboard</a></dd>
                                    <dd><a href="#">Profile</a></dd>
                                </dl>

                                <dl class="language">
                                    <dt>Language</dt>
                                    <dd class="current"><a href="#">English (US)</a></dd>
                                    <dd><a href="#">English (UK)</a></dd>
                                    <dd><a href="#">Chinese</a></dd>
                                </dl>
                            </div>
                        </li>

                        <!-- Shopping Cart -->
                        <li class="shop-cart">
                            <a href="#">
                                <i class="fa fa-shopping-bag"></i>
                                <span class="count">3</span>
                            </a>
                            <div class="mini-cart">
                                <div class="mini-cart-body">
                                    <!-- Single Cart Item -->
                                    <div class="single-cart-item">
                                        <figure class="product-thumb">
                                            <a href="#">
                                                <img src="{{ asset('assets') }}/img/product-1.jpg" alt="Products">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h2><a href="#">Sprite Yoga Companion</a></h2>
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
                                <!-- Mini Cart Footer -->
                                <div class="mini-cart-footer">
                                    <a href="checkout.html" class="btn-add-to-cart">Checkout</a>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
                <!--== Header Right Meta End ==-->


            </div>
        </div>
    </header>
    <!--== Header Area End ==-->

    <!--== Search Box Area Start ==-->
    <div class="body-popup-modal-area">
        <span class="modal-close"><img src="{{ asset('assets') }}/img/cancel.png" alt="Close"
                class="img-fluid" /></span>
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