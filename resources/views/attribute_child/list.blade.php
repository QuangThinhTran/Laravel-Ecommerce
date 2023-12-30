@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row" style="justify-content: center">
            <div class="col-6">
                @include('attributes.create')
                <hr>
                <h1>Attribute list</h1>
                <div class="mt-3">
                    @foreach($attributes as $attribute)
                        <div class="card">
                            <div class="d-flex align-items-center gap-3 px-3 ">
                                Name:
                                <h3 style="font-weight: bold">
                                    {{ $attribute->name }}
                                </h3>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($attributes->isNotEmpty())
                    {{ $attributes->links('vendor.pagination.bootstrap-4')}}
                @endif
            </div>
        </div>
    </div>
@endsection