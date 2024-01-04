@if(session('infor'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('infor') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if($products->isNotEmpty())
    <h4> Share your ideas </h4>
    <div class="row">
        <form action="{{ route('cart.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="d-flex gap-3 align-items-center flex-column">
                <div class="d-flex gap-3 flex-wrap">
                    @foreach($products as $product)
                        <div class="w-100">
                            Products
                            <div class="w-100 d-flex align-items-center justify-content-between">
                                <input type="checkbox" name="product_id[]" class="product-checkbox"
                                       value="{{ $product->id }}" data-price="{{ $product->price }}">
                                <div>
                                    Name Product: {{ $product->name }}
                                </div>
                                <div>
                                    <input type="number" name="quantity_products[]" class="quantity">
                                </div>
                                <div>
                                    Price: {{ $product->price }}
                                </div>
                            </div>
                            Terms
                            @foreach($product->terms as $term)
                                <div class="w-100 d-flex align-items-center justify-content-between">
                                    <input type="checkbox" name="terms_id[]" class="terms-checkbox"
                                           value="{{ $term->pivot->id }}" data-price="{{ $term->pivot->price }}">
                                    <div>
                                        Name Product: {{ $product->name }}
                                    </div>
                                    <div>
                                        <input type="number" name="quantity_terms[]" class="quantity">
                                    </div>
                                    <div>
                                        Price: {{ $term->pivot->price }}
                                    </div>
                                </div>
                            @endforeach
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
@endif
<script>
    const productCheckboxes = document.querySelectorAll('.product-checkbox');
    const termCheckboxes = document.querySelectorAll('.terms-checkbox');
    const totalInput = document.getElementById('total');
    const productQuantityInputs = document.querySelectorAll('input[name="quantity_products[]"]');
    const termQuantityInputs = document.querySelectorAll('input[name="quantity_terms[]"]');

    function calculateTotalPrice() {
        let totalPrice = 0;

        // Calculate total price for products
        productCheckboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                const price = parseFloat(checkbox.getAttribute('data-price'));
                const quantity = parseFloat(productQuantityInputs[index].value) || 0;
                totalPrice += price * quantity;
            }
        });

        // Calculate total price for terms
        termCheckboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                const price = parseFloat(checkbox.getAttribute('data-price'));
                const quantity = parseFloat(termQuantityInputs[index].value) || 0;
                totalPrice += price * quantity;
            }
        });

        totalInput.value = totalPrice.toFixed(2); // Display total with 2 decimal places
    }

    productCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculateTotalPrice);
    });

    termCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculateTotalPrice);
    });

    // Add event listener for product quantity changes
    productQuantityInputs.forEach(input => {
        input.addEventListener('input', calculateTotalPrice);
    });

    // Add event listener for term quantity changes
    termQuantityInputs.forEach(input => {
        input.addEventListener('input', calculateTotalPrice);
    });
</script>
<style>
    /* Style for the form container */
    .row {
        margin: 20px auto;
        max-width: 800px;
    }

    /* Style for each product/term container */
    .w-100 {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    }

    /* Style for input fields */
    input[type="checkbox"] {
        margin-right: 10px;
    }

    input[type="number"] {
        width: 60px;
        padding: 5px;
        margin-right: 10px;
    }

    /* Style for the total input field */
    #total {
        margin-top: 10px;
        padding: 5px;
        width: 100px;
    }

    /* Style for the button */
    .btn {
        padding: 8px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    /* Style for the headings */
    h4 {
        margin-bottom: 20px;
    }

</style>