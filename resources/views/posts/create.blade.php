@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<h4> Share yours ideas </h4>
<div class="row">
    <form action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <textarea class="form-control" id="idea" name="content" rows="3"></textarea>
        </div>
        <input type="file" name="path[]" multiple>
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        @error('content')
        <div style="color:red;">{{ $message }}</div>
        <br>
        @enderror
        <div class="">
            <button class="btn btn-dark" type="submit"> Share</button>
        </div>
    </form>
</div>