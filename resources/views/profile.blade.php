@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                {{--                <div class="card overflow-hidden">--}}
                {{--                    <div class="card-body pt-3">--}}
                {{--                        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">--}}
                {{--                            <li class="nav-item">--}}
                {{--                                <a class="nav-link text-dark" href="#">--}}
                {{--                                    <span>Home</span></a>--}}
                {{--                            </li>--}}
                {{--                            <li class="nav-item">--}}
                {{--                                <a class="nav-link" href="#">--}}
                {{--                                    <span>Explore</span></a>--}}
                {{--                            </li>--}}
                {{--                            <li class="nav-item">--}}
                {{--                                <a class="nav-link" href="#">--}}
                {{--                                    <span>Feed</span></a>--}}
                {{--                            </li>--}}
                {{--                            <li class="nav-item">--}}
                {{--                                <a class="nav-link" href="#">--}}
                {{--                                    <span>Terms</span></a>--}}
                {{--                            </li>--}}
                {{--                            <li class="nav-item">--}}
                {{--                                <a class="nav-link" href="#">--}}
                {{--                                    <span>Support</span></a>--}}
                {{--                            </li>--}}
                {{--                            <li class="nav-item">--}}
                {{--                                <a class="nav-link" href="#">--}}
                {{--                                    <span>Settings</span></a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
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
                            {{--                            <div class="d-flex justify-content-start">--}}
                            {{--                                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">--}}
                            {{--                                    </span> 120 Followers </a>--}}
                            {{--                                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">--}}
                            {{--                                    </span> 2 </a>--}}
                            {{--                                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">--}}
                            {{--                                    </span> 2 </a>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="mt-3">--}}
                            {{--                                <button class="btn btn-primary btn-sm"> Follow</button>--}}
                            {{--                            </div>--}}
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
                                        <form action="" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <textarea class="fs-6 form-control" rows="1"></textarea>
                                            </div>
                                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                            <div>
                                                <button type="submit" class="btn btn-primary btn-sm"> Post Comment
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                    <hr>
                                    <div class="d-flex align-items-start">
                                        <img style="width:35px" class="me-2 avatar-sm rounded-circle"
                                             src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Luigi"
                                             alt="Luigi Avatar">
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="">Luigi
                                                </h6>
                                                <small class="fs-6 fw-light text-muted"> 3 hour
                                                    ago</small>
                                            </div>
                                            <p class="fs-6 mt-3 fw-light">
                                                and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and
                                                Evil)
                                                by
                                                Cicero, written in 45 BC. This book is a treatise on the theory of
                                                ethics,
                                                very
                                                popular during the Renaissan
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($paginatedPosts->isNotEmpty())
                    {{ $paginatedPosts->links('vendor.pagination.bootstrap-4')}}
                @endif
            </div>
            @include('list-user')
        </div>
    </div>
@endsection