@if(session('infor'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('infor') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<h4> Share yours ideas </h4>
<div class="row">
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
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
                <textarea class="form-control" id="idea" name="description" rows="3"
                          placeholder="description"></textarea>
        </div>
        @error('description')
        <div style="color:red;">{{ $message }}</div>
        <br>
        @enderror
        <div class="mb-3" style="display: flex;gap: 50px;">
            <div>
                <div>
                    <label>Code :</label>
                    <input type="text" name="code">
                </div>
                @error('code')
                <div style="color:red;">{{ $message }}</div>
                <br>
                @enderror
            </div>
            <div>
                <div>
                    <label>Price :</label>
                    <input type="number" name="price">
                </div>
                @error('price')
                <div style="color:red;">{{ $message }}</div>
                <br>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label>Images :</label>
            <input type="file" name="path[]" multiple>
        </div>
        @error('path')
        <div style="color:red;">{{ $message }}</div>
        <br>
        @enderror
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <div class="mb-3" style="display: flex; gap: 25px; align-items: center">
            <label>Category</label>
            <select class="form-select" name="category_id" style="width: fit-content">
                <option selected value="">Choose category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        @error('category_id')
        <div style="color:red;">{{ $message }}</div>
        <br>
        @enderror
        <div class="mb-3 d-flex flex-column">
            <label>Attribute :</label>
            <div class="d-flex gap-3 align-items-center">
                @foreach($attributes as $attribute)
                    <input type="checkbox" name="attribute[]" id="attribute"
                           value="{{ $attribute->id }}">{{ $attribute->name }}
                @endforeach
            </div>

        </div>
        @error('category_id')
        <div style="color:red;">{{ $message }}</div>
        <br>
        @enderror
        <div class="">
            <button class="btn btn-dark" type="submit"> Share</button>
        </div>
    </form>
</div>
<script>

    // const checkbox = document.getElementById('attribute');
    // const dataToShow = document.getElementById('inputShow');
    //
    //
    // checkbox.addEventListener('change', function () {
    //     if (this.checked) {
    //         dataToShow.style.display = 'block'; // Show the data if checkbox is checked
    //     } else {
    //         dataToShow.style.display = 'none'; // Hide the data if checkbox is unchecked
    //     }
    // });
</script>