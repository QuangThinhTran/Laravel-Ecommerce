{{--<select class="form-select" name="category_id" style="width: fit-content">--}}
{{--    <option selected value="">Choose Attribute child</option>--}}
{{--    @foreach($attributes_child[0] as $terms)--}}
{{--        <option value="{{ $terms->id }}" selected>--}}
{{--            {{ $terms->name }}--}}
{{--        </option>--}}
{{--    @endforeach--}}
{{--</select>--}}
@foreach($terms as $term)
    <div>
        <div class="term-group d-flex gap-3 align-items-center">
            @foreach($term as $item)
                <div class="item-container d-flex align-items-center">
                    <input type="checkbox" name="terms[]" value="{{ $item->id }}" class="attribute-checkbox">
                    <label class="attribute-name">{{ $item->name }}</label>
                    <input type="number" class="attribute-text" name="price_items[]" placeholder="Enter text">
                </div>
            @endforeach
        </div>
    </div>
@endforeach
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.attribute-checkbox').change(function () {
            var isChecked = $(this).is(":checked");
            var $textInput = $(this).siblings('.attribute-text');

            if (isChecked) {
                $textInput.show();
            } else {
                $textInput.hide();
            }
        });
    });
</script>
<style>
    .term-group {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .item-container {
        display: flex;
        align-items: center;
    }

    .attribute-checkbox {
        appearance: none;
        margin-right: 10px;
    }

    .attribute-name {
        margin-left: 10px;
        margin-right: 10px;
    }

    .attribute-text {
        display: none;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

</style>


