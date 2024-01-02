@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row" style="justify-content: center">
            <div class="col-6">
                @include('carts.create')
                <hr>
                <h1>Carts list</h1>
                <div class="mt-3">
                    <div class="mb-3">
                        @foreach($carts as $cart)
                            <div class="mb-5">
                                <div class="card d-flex flex-row align-items-center justify-content-between px-3">
                                    <div class="d-flex align-items-center gap-3">
                                        Price:
                                        <h3 style="font-weight: bold">
                                            {{ $cart->total }} USD
                                        </h3>
                                    </div>
                                    <a href="{{ route('cart.detail',['id' => $cart->id]) }}" style="color: blue">Checkout</a>
                                </div>
                                <div class="m-2">
                                    @if(!empty($cart->listProducts))
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
                                                    @if(!is_null($product->attributesChild))
                                                        <hr>
                                                        Attribute Child
                                                        @foreach($product->attributesChild as $attribute_child)
                                                            <div class="d-flex justify-content-between mt-3">
                                                                <div>
                                                                    <span> Name :</span>
                                                                    <span class="fs-6 fw-light text-muted"> {{ $attribute_child->name }} </span>
                                                                </div>
                                                                <div>
                                                                    <span> Price :</span>
                                                                    <span class="fs-6 fw-light text-muted"> {{ $attribute_child->price }} </span>
                                                                </div>
                                                                <div>
                                                                    <span> Type :</span>
                                                                    <span class="fs-6 fw-light text-muted"> {{ $attribute_child->attribute->name }} </span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
