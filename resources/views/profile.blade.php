@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="px-3 pt-4 pb-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                                     src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario" alt="Mario Avatar">
                                <div>
                                    <h3 class="card-title mb-0"><a href="#"> {{ $user->name }}
                                        </a></h3>
                                    <span class="fs-6 text-muted">{{ '@'. $user->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 mt-4">
                            <h5 class="fs-5"> About : </h5>
                            <p class="fs-6 fw-light">
                                This book is a treatise on the theory of ethics, very popular during the
                                Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes
                                from a line in section 1.10.32.
                            </p>
                            @auth()
                                @if(Auth::id() !== $user->id)
                                    @if(Auth::user()->follows($user))
                                        <a href="{{ route('unfollow', ['user' => $user]) }}"
                                           class="btn btn-danger btn-sm">Unfollow </a>
                                    @else
                                        <a href="{{ route('follow', ['user' => $user]) }}"
                                           class="btn btn-success btn-sm">Follow </a>
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mt-3">
                    @foreach($user->posts as $post)
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
                                                <textarea class="fs-6 form-control" name="content" rows="1"></textarea>
                                            </div>
                                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
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
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($paginatedPosts->isNotEmpty())
                    {{ $paginatedPosts->links('vendor.pagination.bootstrap-4')}}
                @endif
            </div>
        </div>
    </div>
@endsection