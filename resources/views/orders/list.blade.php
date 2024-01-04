@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row" style="justify-content: center">
            <div class="col-6">
                <h3>Orders List</h3>
                <hr>

                <div class="mt-3">
                    <div class="mb-3">
                        <div class="mb-5">
                            @if($orders->isNotEmpty())
                                Products
                            @endif
                            @foreach($orders as $order)
                                <div class="m-2">
                                    @foreach($order->orderDetailProducts as $detailProduct)
                                        <div class="card d-flex flex-row align-items-center justify-content-between px-3">
                                            <div class="d-flex align-items-center gap-3">
                                                Code
                                                <h3 style="font-weight: bold">
                                                    {{ $detailProduct->product_code }}
                                                </h3>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                Name
                                                <h3 style="font-weight: bold">
                                                    {{ $detailProduct->product_name }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card d-flex flex-row align-items-center justify-content-between px-3">
                                            <div class="d-flex align-items-center gap-3">
                                                Price
                                                <h3 style="font-weight: bold">
                                                    {{ $detailProduct->product_price }}
                                                </h3>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                Quantity
                                                <h3 style="font-weight: bold">
                                                    {{ $detailProduct->quantity }}
                                                </h3>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if($order->orderDetailTerms->isNotEmpty())
                                        <hr>
                                        Terms
                                    @endif
                                    @foreach($order->orderDetailTerms as $detailTerm)
                                        <div class="card d-flex flex-row align-items-center justify-content-between px-3">
                                            <div class="d-flex align-items-center gap-3">
                                                Name
                                                <h3 style="font-weight: bold">
                                                    {{ $detailTerm->term_name }}
                                                </h3>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                Price
                                                <h3 style="font-weight: bold">
                                                    {{ $detailTerm->term_price }}
                                                </h3>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                Customer
                                <div class="card d-flex px-3">
                                    <div class="d-flex align-items-center gap-3">
                                        Name
                                        <h3 style="font-weight: bold">
                                            {{ $order->customer_name }}
                                        </h3>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        Email
                                        <h3 style="font-weight: bold">
                                            {{ $order->customer_email }}
                                        </h3>
                                    </div>
                                </div>
                                <hr>
                                Merchant
                                <div class="card d-flex flex-row align-items-center justify-content-between px-3">
                                    <div class="d-flex align-items-center gap-3">
                                        Name
                                        <h3 style="font-weight: bold">
                                            {{ $order->merchant_name }}
                                        </h3>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        Email
                                        <h3 style="font-weight: bold">
                                            {{ $order->merchant_email }}
                                        </h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="card d-flex flex-row align-items-center justify-content-between px-3">
                                    <div class="d-flex align-items-center gap-3">
                                        Quantity
                                        <h3 style="font-weight: bold">
                                            {{ $order->quantity }}
                                        </h3>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        Total
                                        <h3 style="font-weight: bold">
                                            {{ $order->total }} USD
                                        </h3>
                                    </div>
                                </div>
                                <div>
                                    <h3 style="color: green">{{ $order->status->name }}</h3>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
