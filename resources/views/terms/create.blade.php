@if(session('infor'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('infor') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<h4> Share yours ideas </h4>
<div class="row">
    <form action="{{ route('term.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Name :</label>
            <input type="text" name="name">
        </div>
        @error('name')
        <div style="color:red;">{{ $message }}</div>
        <br>
        @enderror
        <div class="mb-3 d-flex flex-column">
            <label>Description :</label>
            <textarea cols="10" rows="3" name="description"></textarea>
        </div>
        @error('description')
        <div style="color:red;">{{ $message }}</div>
        <br>
        @enderror
        <div class="mb-3" style="display: flex; gap: 25px; align-items: center">
            <label>Attribute</label>
            <select class="form-select" name="attribute_id" style="width: fit-content">
                <option selected value="">Choose attribute</option>
                @foreach($attributes as $attribute)
                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                @endforeach
            </select>
        </div>
        @error('attribute_id')
        <div style="color:red;">{{ $message }}</div>
        <br>
        @enderror
        <div class="mb-3" style="display: flex; gap: 25px; align-items: center">
            <label>Status</label>
            <select class="form-select" name="is_active" style="width: fit-content">
                <option selected value="">Choose status</option>
                <option value="1">Active</option>
                <option value="0">InActive</option>
            </select>
        </div>
        @error('is_active')
        <div style="color:red;">{{ $message }}</div>
        <br>
        @enderror
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <div class="">
            <button class="btn btn-dark" type="submit"> Share</button>
        </div>
    </form>
</div>