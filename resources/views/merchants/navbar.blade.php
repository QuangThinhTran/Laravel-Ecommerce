<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('product.create') }}">Product</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page"
           href="{{ route('attribute.create') }}">Attribute</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('term.create') }}">Term</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('cart.create') }}">Cart</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('order.list') }}">Order</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('merchant.employees') }}">Employees</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('auth.logout') }}" class="nav-link active" aria-current="page">Logout</a>
    </li>
</ul>