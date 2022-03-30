@props([
    'type' => 'submit',
    'name' => 'save',
    'title' => 'Submit',
    'btnType' => 'primary',
    'col' => null,
])

<div class="{{$col ? 'col-' . $col : 'col'}}">
    <input type="{{$type}}" {{$attributes->merge(['class' => "btn btn-{$btnType} mt-3"])}} value="{{$title}}" name="{{$name}}" />
</div>
