@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row" style="justify-content: center">
            <div class="col-6">
                @include('products.create')
                <hr>
                <h1>Products list</h1>
                <div class="mt-3">
                    @foreach($products as $product)
                        <div class="card">
                            <div class="px-3 pt-4 pb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center w-100 justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                                                 src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario"
                                                 alt="Mario Avatar">
                                            <h5 class="card-title mb-0"><a href="#"> {{ $product->user->name }}</a></h5>
                                        </div>
                                        @if(is_null($product->post))

                                        @else()
                                            <a href="{{ route('post.detail',['id' => $product->post->id ]) }}">Go to
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
                                        <img src="{{ asset('images/'.$image->path) }}" alt="" width="100%"
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
                                @if(!is_null($product->attributes))
                                    <hr>
                                    Attribute
                                    @foreach($product->attributes as $attribute)
                                        <div class="d-flex justify-content-between mt-3">
                                            <div>
                                                <span> Name :</span>
                                                <span class="fs-6 fw-light text-muted"> {{ $attribute->name }} </span>
                                            </div>
                                            <div>
                                                <span> Price :</span>
                                                <span class="fs-6 fw-light text-muted"> {{ $attribute->price }} </span>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <span> Description :</span>
                                            <span class="fs-6 fw-light text-muted"> {{ $attribute->description }} </span>
                                        </div>
{{--                                        <div class="mt-2">--}}
{{--                                            <span> Detail attribute :</span>--}}
{{--                                            <a href="">{{ $attribute->id }}</a>--}}
{{--                                        </div>--}}
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($products->isNotEmpty())
                    {{ $products->links('vendor.pagination.bootstrap-4')}}
                @endif
            </div>
        </div>
    </div>
@endsection