@if(session('infor'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('infor') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<h4> Share your ideas </h4>
<div class="row">
    <form action="{{ route('cart.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="d-flex gap-3 align-items-center flex-column">
            Products
            <div class="d-flex gap-3 flex-wrap">
                @foreach($products as $product)
                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <input type="checkbox" name="product_id[]" class="product-checkbox"
                               value="{{ $product->id }}" data-price="{{ $product->price }}">
                        <div>
                            Name Product: {{ $product->name }}
                        </div>
                        <div>
                            Price: {{ $product->price }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <input type="text" name="total" id="total" placeholder="Total Price" readonly>
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <div class="">
            <button class="btn btn-dark" type="submit">Add to Cart</button>
        </div>
    </form>
</div>

<script>
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const totalInput = document.getElementById('total');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            let totalPrice = 0;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    totalPrice += parseFloat(checkbox.getAttribute('data-price'));
                }
            });
            totalInput.value = totalPrice.toFixed(2); // Display total with 2 decimal places
        });
    });
</script>
