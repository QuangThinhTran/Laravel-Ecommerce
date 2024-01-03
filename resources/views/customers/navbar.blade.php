<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('customer.products') }}">Product</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('term.create') }}">Term</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('customer.carts') }}">Cart</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('order.list') }}">Order</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('auth.logout') }}" class="nav-link active" aria-current="page">Logout</a>
    </li>
</ul>