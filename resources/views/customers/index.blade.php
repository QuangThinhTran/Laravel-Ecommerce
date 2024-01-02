@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                <div class="card overflow-hidden">
                    <div class="card-body pt-3">
                        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="#">
                                    <span>Home</span></a>
                            </li>
                        </ul>
                    </div>
                    @if(Auth::check())
                        <div class="card-footer text-center py-2">
                            <a class="btn btn-link btn-sm" href="{{ route('user.detail',['id' => Auth::id()]) }}">View
                                Profile </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-6">
                @if(Auth::check())
                    @include('posts.create')
                @endif
                <hr>
                <div class="mt-3">
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
                                    <div>
                                    <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                                        {{ $post->created_at }} </span>
                                    </div>
                                </div>
                                <div>
                                    @if(Auth::check())
                                        <form action="{{ route('comment.add') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <textarea class="fs-6 form-control" rows="1" name="title"></textarea>
                                            </div>
                                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            @error('title')
                                            <div style="color:red;">{{ $message }}</div>
                                            <br>
                                            @enderror
                                            <div>
                                                <button type="submit" class="btn btn-primary btn-sm"> Post Comment
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                    <hr>
                                    @foreach($post->comments as $comment)
                                        <div class="d-flex align-items-start">
                                            <img style="width:35px" class="me-2 avatar-sm rounded-circle"
                                                 src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Luigi"
                                                 alt="Luigi Avatar">
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="">{{ $comment->user->name }}
                                                    </h6>
                                                    <small class="fs-6 fw-light text-muted">{{ $comment->created_at }}</small>
                                                </div>
                                                <p class="fs-6 mt-3 fw-light">
                                                    {{ $comment->title }}
                                                </p>
                                                <div style="margin: 20px 0">
                                                    <form action="{{ route('comment.add.child') }}" method="post">
                                                        @csrf
                                                        <input name="content">
                                                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                                        <input type="hidden" name="comment_id"
                                                               value="{{ $comment->id }}">
                                                        <button type="submit">Share</button>
                                                    </form>
                                                </div>
                                                @foreach($comment->childComments as $childComment)
                                                    <div class="d-flex align-items-start">
                                                        <img style="width:35px" class="me-2 avatar-sm rounded-circle"
                                                             src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Luigi"
                                                             alt="Luigi Avatar">
                                                        <div class="w-100">
                                                            <div class="d-flex justify-content-between">
                                                                <h6 class="">{{ $childComment->user->name }}
                                                                </h6>
                                                                <small class="fs-6 fw-light text-muted">{{ $childComment->created_at }}</small>
                                                            </div>
                                                            <p class="fs-6 mt-3 fw-light">
                                                                {{ $childComment->content }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($posts->isNotEmpty())
                    {{ $posts->links('vendor.pagination.bootstrap-4')}}
                @endif
            </div>
        </div>
    </div>
@endsection