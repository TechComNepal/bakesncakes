@props([
    'type' => 'file',
    'col' => '12',
    'name' => 'Default',
    'label' => 'Default',
    'required' => false,
    'allowedExt' => 'jpg png jpeg',
    'defaultFile' => '',
    'multiple' => false,
])

<div {{ $attributes->merge(['class' => 'col-md-'.$col]) }}>
    <div class="mb-3">
        <label for="{{$name}}">{{$label}} <small><code>{{$required == true ? '[Required]' : ''}} {{$multiple ? '[Multiple]' : ''}}</code></small></label>
        <input
            type="{{$type}}"
            class="dropify @error($name) is-invalid @enderror"
            name="{{$name}}"
            id="{{$name}}"
            data-allowed-file-extensions="{{$allowedExt}}"
            @if($defaultFile !== '') data-default-file="{{$defaultFile}}" @endif
            {{$multiple ? 'multiple' : ''}}
            {{$required ? 'required' : ''}}
        />
        @error($name)<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
</div>
