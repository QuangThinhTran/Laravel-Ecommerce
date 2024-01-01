{{--<select class="form-select" name="category_id" style="width: fit-content">--}}
{{--    <option selected value="">Choose Attribute child</option>--}}
{{--    @foreach($attributes_child[0] as $attribute_child)--}}
{{--        <option value="{{ $attribute_child->id }}" selected>--}}
{{--            {{ $attribute_child->name }}--}}
{{--        </option>--}}
{{--    @endforeach--}}
{{--</select>--}}
<div class="d-flex gap-3 align-items-center">
    @foreach($attributes_child[0] as $attribute_child)
        <input type="checkbox" name="attribute_child[]" class="attribute-checkbox"
               value="{{ $attribute_child->id }}">{{ $attribute_child->name }}
    @endforeach
</div>