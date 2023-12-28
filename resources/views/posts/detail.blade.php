@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row" style="justify-content: center">
            <div class="col-6">
                <div class="d-flex gap-3">
                    Name product :
                    <p class="text-muted">{{ $post->user->name }} </p>
                </div>
                <div class="d-flex gap-3">
                    Description
                    <p class="text-muted">{{ $post->content }}</p>
                </div>
                <hr>
                <div class="mt-3">
                    @foreach($post->products as $product)
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection