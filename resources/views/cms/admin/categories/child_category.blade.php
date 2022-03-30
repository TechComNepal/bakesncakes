@php
$value = NULL;

for ($i=0; $i < $child_category->level; $i++){
    $value.= '--';
}
@endphp

<option value="{{ $child_category->id }}">{{ $value ." ". $child_category->name }}</option>

@if($child_category->categories)
    @foreach($child_category->categories as $childCategory)
        @include('cms.admin.categories.child_category', ['child_category' => $childCategory])
    @endforeach
@endif

{{--@php--}}
{{--$value=NULL;--}}
{{--for ($i=0; $i < $child_category->level; $i++ ){--}}
{{--    $value .= '--';--}}
{{--}--}}
{{--@endphp--}}

{{--<option value="{{$child_category->id}}" >{{ $value ." ". $child_category->name }}</option>--}}

{{--@if($child_category->parent)--}}
{{--    @foreach($child_category->parent as $childCategory)--}}
{{--        @include('cms.admin.categories.child_category',['child_category' => $childCategory])--}}
{{--    @endforeach--}}
{{--@endif--}}
