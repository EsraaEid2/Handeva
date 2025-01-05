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
                                <li class="nav-item {{ Request::routeIs('user.home') ? 'active' : '' }}">
                                    <a href="{{ route('user.home') }}">Home</a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('collections') ? 'active' : '' }}">
                                    <a href="{{ route('collections') }}">Shop</a>
                                </li>
                                @if(Auth::guard('vendor')->check())
                                <li class="nav-item {{ Request::routeIs('vendor.dashboard') ? 'active' : '' }}">
                                    <a href="{{ route('vendor.dashboard') }}">Dashboard</a>
                                </li>
                                @endif
                                <li class="nav-item {{ Request::routeIs('theme.about') ? 'active' : '' }}">
                                    <a href="{{ route('theme.about') }}">About Us</a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('theme.contact') ? 'active' : '' }}">
                                    <a href="{{ route('theme.contact') }}">Contact Us</a>
                                </li>

                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- Navigation Area End -->

                <!--== Header Right Meta Start ==-->
                <div class="header-right-meta text-right">
                    <ul class="custom-options">
                        @if(Auth::guard('web')->check())
                        <!-- Wishlist Icon -->
                        <li class="custom-icon" title="Wishlist">
                            <a href="{{ route('wishlist.show') }}">
                                <i class="fa fa-heart"></i>
                                @if($wishlistCount > 0)
                                <span class="count wishlist-count">{{ $wishlistCount }}</span>
                                @endif
                            </a>
                        </li>

                        <!-- Cart Icon -->
                        <li class="shop-cart custom-icon" title="Cart">
                            <a href="{{ route('cart.show') }}">
                                <i class="fa fa-shopping-bag"></i>
                                @if($cartCount > 0)
                                <span class="count cart-count">{{ $cartCount }}</span>
                                @endif
                            </a>
                        </li>

                        <!-- User Profile Dropdown -->
                        <li class="custom-dropdown">
                            <a href="#" class="custom-dropdown-toggle">
                                <i class="fa fa-user-circle"></i>
                            </a>
                            <ul class="custom-dropdown-menu">
                                <li><a href="{{ route('theme.my_account') }}">Your Profile</a></li>
                                <li>
                                    <form action="{{ route('userLogout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="custom-btn custom-btn-link">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @elseif(Auth::guard('vendor')->check())
                        <!-- Wishlist Icon -->
                        <li class="custom-icon" title="Wishlist">
                            <a href="{{ route('wishlist.show') }}">
                                <i class="fa fa-heart"></i>
                                @if($wishlistCount > 0)
                                <span class="count wishlist-count">{{ $wishlistCount }}</span>
                                @endif
                            </a>
                        </li>
                        <!-- User Dashboard Dropdown -->
                        <li class="custom-dropdown">
                            <a href="#" class="custom-dropdown-toggle">
                                <i class="fa fa-user-circle"></i>
                            </a>
                            <ul class="custom-dropdown-menu">
                                <li><a href=" {{ route('vendor.profile') }}" style="color: var(--dark-color)">Your
                                        profile</a></li>
                                <li>
                                    <form action="{{ route('userLogout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="custom-btn custom-btn-link">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @else
                        <!-- Guest -->
                        <li class="custom-login">
                            <a href="{{ route('login_register') }}" class="custom-btn">Login</a>
                        </li>

                        <!-- Wishlist Icon -->
                        <li class="custom-icon" title="Wishlist">
                            <a href="{{ route('wishlist.show') }}">
                                <i class="fa fa-heart"></i>
                                @if($wishlistCount > 0)
                                <span class="count wishlist-count">{{ $wishlistCount }}</span>
                                @endif
                            </a>
                        </li>
                        <!-- Cart Icon -->
                        <li class="shop-cart custom-icon" title="Cart">
                            <a href="{{ route('cart.show') }}">
                                <i class="fa fa-shopping-bag"></i>
                                @if($cartCount > 0)
                                <span class="count cart-count">{{ $cartCount }}</span>
                                @endif
                            </a>
                        </li>
                        @endif
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