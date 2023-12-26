<div class="col-3">
    <div class="card">
        <div class="card-header pb-0 border-0">
            <h5 class="">Search</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('search.user') }}" method="get">
                <input placeholder="...
                        " class="form-control w-100" type="text"
                       id="search" name="key">
                <button class="btn btn-dark mt-2"> Search</button>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header pb-0 border-0">
            <h5 class="">Who to follow</h5>
        </div>
        <div class="card-body">
            @foreach($users as $user)
                <div class="hstack gap-2 mb-3">
                    <div class="avatar">
                        <a href="#!"><img class="avatar-img rounded-circle"
                                          src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario"
                                          alt=""></a>
                    </div>
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="{{ route('user.detail',['id' => $user->id]) }}">{{ $user->name }}</a>
                        <p class="mb-0 small text-truncate">{{ $user->email }}</p>
                    </div>
                    <?php $data = $user->followers()->where('user_id', Auth::id())->get() ?>
                    @if(Auth::check() && !$data->isEmpty()))
                        <a href="{{ route('unfollow',['user' => $user]) }}"
                           class="btn btn-primary-soft rounded-circle icon-md ms-auto"><i
                                    class="fa-solid fa-check"> </i></a>
                    @elseif($data->isEmpty()))
                        <a href="{{ route('follow',['user' => $user]) }}"
                           class="btn btn-primary-soft rounded-circle icon-md ms-auto"><i
                                    class="fa-solid fa-plus"> </i></a>
                    @else

                    @endif
                </div>
            @endforeach
            {{--                        <div class="d-grid mt-3">--}}
            {{--                            <a class="btn btn-sm btn-primary-soft" href="#!">Show More</a>--}}
            {{--                        </div>--}}
        </div>
    </div>
</div>