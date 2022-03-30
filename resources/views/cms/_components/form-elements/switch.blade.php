@props([
    'type' => 'checkbox',
    'label' => 'switch3',
    'name' => 'Default',
    'col' => '12',
    'checked' => false,
    'required' => false,
    'value' => null,
    'id' => 'switch3',
])

<div {{$attributes->merge(['class' => "col-md-{$col}"])}}>
    <div class="mb-3">
        <label for="{{$name}}" class="form-label">{{$label}} <small><code>{{$required == true ? '[Required]' : ''}}</code></small></label>
        <br />
        <input
            class="form-check form-switch @error($name) is-invalid @enderror"
            type="{{$type}}"
            id="{{$id}}"
            name="{{$name}}"
            switch="bool"
            {{old($name, $checked) == true ? 'checked' : ''}}
        >
        <label for="{{$id}}" data-on-label="Yes" data-off-label="No" class="form-label"></label>
    </div>
</div>
