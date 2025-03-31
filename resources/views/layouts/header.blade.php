<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/userhomepage">
            <img src="{{ asset('images/food_app_logo.png') }}" alt="CareBites Logo" height="75">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('userhomepage') ? 'active' : '' }}" href="/userhomepage">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('features') ? 'active' : '' }}" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('pricing') ? 'active' : '' }}" href="#">Pricing</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                @php
                $cartCount = auth()->check() && auth()->user()->role === 'user'
                ? \App\Models\Cart::where('user_id', auth()->id())->sum('quantity')
                : 0;
                @endphp

                @if(auth()->check() && auth()->user()->role === 'user')
                <a href="{{ route('cart.view') }}" class="nav-link position-relative me-3">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                    @if($cartCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $cartCount }}
                    </span>
                    @endif
                </a>
                @endif
                @auth
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a href="{{ route('orders.user') }}" class="dropdown-item">My Orders</a></li>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <a class="nav-link" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>