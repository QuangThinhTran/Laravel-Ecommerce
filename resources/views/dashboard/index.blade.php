@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row" style="justify-content: center">
            <div class="col-6">
                <hr>
                <div class="mt-3">
                    @if(session('infor'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('infor') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif
                    @foreach($posts as $post)
                        <div class="card">
                            <div class="px-3 pt-4 pb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                                             src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario"
                                             alt="Mario Avatar">
                                        <div>
                                            <h5 class="card-title mb-0"><a href="#"> {{ $post->user->name }}
                                                </a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="fs-6 fw-light text-muted">
                                    {{ $post->content }}
                                </p>
                                <div class="d-flex justify-content-between">
                                    <div class="card-footer">
                                        <a href="{{ route('post.delete', ['id' => $post->id]) }}" class="btn btn-danger"
                                           type="submit">Delete</a>
                                        {{--                                        <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>--}}
                                        {{--                                            {{ $post->created_at }} </span>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($posts->isNotEmpty())
                    {{ $posts->links('vendor.pagination.bootstrap-4')}}
                @endif
            </div>
            {{--            @include('list-user')--}}
        </div>
    </div>
    <style>
        .card {
            margin-bottom: 40px;
        }

        .card-footer {
            padding: 0;
        }
    </style>
@endsection