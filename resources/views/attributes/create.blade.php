@if(session('infor'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('infor') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<h4> Share yours ideas </h4>
<div class="row">
    <form action="{{ route('attribute.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Name :</label>
            <input type="text" name="name">
        </div>
        @error('name')
        <div style="color:red;">{{ $message }}</div>
        <br>
        @enderror
        <div class="mb-3">
            <textarea class="form-control" id="idea" name="description" rows="3" placeholder="description"></textarea>
        </div>
        @error('description')
        <div style="color:red;">{{ $message }}</div>
        <br>
        @enderror
        <div class="mb-3">
            <input type="number" name="price">
        </div>
        @error('price')
        <div style="color:red;">{{ $message }}</div>
        <br>
        @enderror
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <div class="">
            <button class="btn btn-dark" type="submit"> Share</button>
        </div>
    </form>
</div>