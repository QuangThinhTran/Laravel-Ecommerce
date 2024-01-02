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
        <div class="mb-3 d-flex flex gap-3 align-items-center">
            <label>Attribute :</label>
            {{--            <select class="form-select" name="category_id" id="attributeSelect" style="width: fit-content">--}}
            {{--                <option selected value="">Choose Attribute</option>--}}
            {{--                @foreach($attributes as $attribute)--}}
            {{--                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>--}}
            {{--                @endforeach--}}
            {{--            </select>--}}
            <div class="d-flex gap-3 align-items-center">
                @foreach($attributes as $attribute)
                    <input type="checkbox" name="attribute[]" class="attribute-checkbox"
                           value="{{ $attribute->id }}">{{ $attribute->name }}
                @endforeach
            </div>
        </div>

        <div class="mb-3" style="display: flex; gap: 25px; align-items: center" id="attributeChildView">
            <label>Attribute Child</label>
        </div>

        <div class="">
            <button class="btn btn-dark" type="submit"> Share</button>
        </div>
    </form>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    //Checked multiple
    $(document).ready(function () {
        $('.attribute-checkbox').change(function () {
            var selectedAttributes = [];

            $('.attribute-checkbox:checked').each(function () {
                selectedAttributes.push($(this).val());
            });
            if (selectedAttributes.length > 0) {
                // Load child view based on selected attributes
                $.ajax({
                    url: '/attribute-child/detail', // Replace with your route or endpoint to load the child view for multiple attributes
                    method: 'GET',
                    data: {attributes: selectedAttributes},
                    success: function (data) {
                        $('#attributeChildView').append('<div>' + data + '</div>');
                        $('#attributeChildView').show();
                    },
                    error: function () {
                        console.error('Error loading child view');
                    }
                });
            } else {
                $('#attributeChildView').empty();
                $('#attributeChildView').hide();
            }
        });
    });

    //Checked One
    // $(document).ready(function () {
    //     $('#attribute-checkbox').change(function () {
    //         if ($(this).is(':checked')) {
    //             var selectedAttributeId = $(this).val();
    //             console.log(selectedAttributeId)
    //             // Load child view based on selected attribute ID
    //             $.ajax({
    //                 url: '/attribute-child/detail', // Replace with your route or endpoint to load the child view
    //                 method: 'GET',
    //                 data: { attribute_id: selectedAttributeId },
    //                 success: function (data) {
    //                     $('#attributeChildView').html(data);
    //                     $('#attributeChildView').show();
    //                 },
    //                 error: function () {
    //                     console.error('Error loading child view');
    //                 }
    //             });
    //         } else {
    //             $('#attributeChildView').empty();
    //             $('#attributeChildView').hide();
    //         }
    //     });
    // });

    //Select
    // $(document).ready(function () {
    //     $('#attributeSelect').change(function () {
    //         var selectedAttributeId = $(this).val();
    //
    //         if (selectedAttributeId !== '') {
    //             // Load child view based on the selected attribute ID
    //             $.ajax({
    //                 url: '/attribute-child/detail', // Replace with your route or endpoint to load the child view
    //                 method: 'GET',
    //                 data: { attribute_id: selectedAttributeId },
    //                 success: function (data) {
    //                     $('#attributeChildView').html(data);
    //                 },
    //                 error: function () {
    //                     console.error('Error loading child view');
    //                 }
    //             });
    //         } else {
    //             $('#attributeChildView').empty();
    //         }
    //     });
    // });
</script>