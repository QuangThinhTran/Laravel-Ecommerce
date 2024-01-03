@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row" style="justify-content: center">
            <div class="col-6">
                @if(Auth::user()->role_id != 4)
                    @include('terms.create')
                @endif
                <hr>
                <h1>Terms</h1>
                <div class="mt-3">
                    @foreach($terms as $term)
                        @if($term->attribute->user_id == auth()->id())
                            <div class="card">
                                <div class="d-flex align-items-center gap-3 px-3 ">
                                    Name:
                                    <h3 style="font-weight: bold">
                                        {{ $term->name }}
                                    </h3>
                                    {{ $term->attribute->name }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                {{--                @if($terms->isNotEmpty())--}}
                {{--                    {{ $terms->links('vendor.pagination.bootstrap-4')}}--}}
                {{--                @endif--}}
            </div>
        </div>
    </div>
@endsection