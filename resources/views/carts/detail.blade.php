@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row" style="justify-content: center">
            <div class="col-6">
                <hr>
                <div class="mt-3">
                    <div class="mb-3">
                        <div class="mb-5">
                            <div class="m-2">
                                @foreach($cart->listProducts as $product)
                                    <div class="card">
                                        <div class="px-3 pt-4 pb-2">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center w-100 justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <img style="width:50px"
                                                             class="me-2 avatar-sm rounded-circle"
                                                             src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario"
                                                             alt="Mario Avatar">
                                                        <h5 class="card-title mb-0"><a
                                                                    href="#"> {{ $product->user->name }}</a>
                                                        </h5>
                                                    </div>
                                                    @if(is_null($product->post))

                                                    @else()
                                                        <a href="{{ route('post.detail',['id' => $product->post->id ]) }}">Go
                                                            to
                                                            post</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h1 class="fs-6 fw-light text-muted" style="font-weight: bold">
                                                {{ $product->name }}
                                            </h1>
                                            <div class="images-container">
                                                @foreach($product->images as $image)
                                                    <img src="{{ asset('images/'.$image->path) }}" alt=""
                                                         width="100%"
                                                         height="auto">
                                                @endforeach
                                            </div>
                                            <p class="fs-6 fw-light text-muted">
                                                {{ $product->description }}
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <span> Price :</span>
                                                    <span class="fs-6 fw-light text-muted"> {{ $product->price }} USD </span>
                                                </div>
                                                <div>
                                                    <span> Category :</span>
                                                    <span class="fs-6 fw-light text-muted"> {{ $product->category->name }} </span>
                                                </div>
                                                <div>
                                                    @if($product->is_active == 0)
                                                        <span style="color: red"> InActive </span>
                                                    @else
                                                        <span style="color: green"> Active </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <span> Quantity :</span>
                                                    <span class="fs-6 fw-light text-muted"> {{ $product->pivot->quantity }} </span>
                                                </div>
                                            </div>
                                            @if($product->terms->isNotEmpty())
                                                <hr>
                                                @foreach($product->terms as $term)
                                                    Term
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <div>
                                                            <span> Name :</span>
                                                            <span class="fs-6 fw-light text-muted"> {{ $term->name }} </span>
                                                        </div>
                                                        <div>
                                                            <span> Price :</span>
                                                            <span class="fs-6 fw-light text-muted"> {{ $term->pivot->price }} </span>
                                                        </div>
                                                        <div>
                                                            <span> Type :</span>
                                                            <span class="fs-6 fw-light text-muted"> {{ $term->attribute->name }} </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                <hr>
                                <div class="d-flex align-items-center gap-3">
                                    Username:
                                    <h3 style="font-weight: bold">
                                        {{ $cart->user->name }}
                                    </h3>
                                </div>
                            </div>
                            <div class="card d-flex flex-row align-items-center justify-content-between px-3">
                                <div class="d-flex align-items-center gap-3">
                                    <h3 style="font-weight: bold">
                                        {{ $cart->total }} USD
                                    </h3>
                                </div>
                                <form action="{{ route('order.checkout') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="customer_name" value="{{ Auth::user()->name }}">
                                    <input type="hidden" name="customer_email" value="{{ Auth::user()->email }}">
                                    <input type="hidden" name="customer_id" value="{{ Auth::id() }}">
                                    @foreach($cart->listProducts as $product)

                                        <input type="hidden" value="{{ $product->user->name }}" name="merchant_name">
                                        <input type="hidden" value="{{ $product->user->email }}" name="merchant_email">
                                        <input type="hidden" value="{{ $product->user->id }}" name="merchant_id">
                                        <input type="hidden" value="{{ $product->code }}" name="products_code[]">
                                        <input type="hidden" value="{{ $product->name }}" name="products_name[]">
                                        @foreach($product->terms as $term)
                                            <input type="text" value="{{ $term->pivot->price }}" name="terms_price[]">
                                            <input type="text" value="{{ $term->name }}" name="terms_name[]">
                                        @endforeach
                                        <input type="hidden" value="{{ $product->price }}" name="products_price[]">
                                        <input type="hidden" value="{{ $product->pivot->quantity }}"
                                               name="products_quantity[]">
                                    @endforeach
                                    <input type="hidden" name="quantity" value="{{ $cart->quantity }}">
                                    <input type="hidden" name="total" value="{{ $cart->total }}">
                                    <input type="hidden" name="active" value="1">
                                    <input type="hidden" name="status_id" value="4">
                                    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                    <div class="d-flex align-items-center gap-3">
                                        <button type="submit" style="color: green;background: none;border: none">
                                            Payment
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
