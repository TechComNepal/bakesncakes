@props([
    'label' => 'Default',
    'name' => 'Default',
    'placeholder' => 'Choose...',
    'col' => '12',
    'required' => FALSE,
    'values' => NULL,
    'selected' => NULL,
    'multiple' => TRUE,
    'autofocus' => FALSE,
])


<div class="col-lg-{{$col}}">
    <div class="mb-3">
        <label for="{{$name}}">{{$label}} <small><code>{{$required == true ? '[Required]' : ''}}</code></small> </label> <br />
        <select
            class="select2 form-control {{$multiple ? 'select2-multiple' : ''}}"
            name="{{$name}}{{$multiple ? '[]' : ''}}"
            id="{{$name}}"
            {{$multiple ? 'multiple' : ''}}
            data-placeholder="{{$placeholder}}"
            {{$required ? 'required' : ''}}
        >
            {{ $slot }}
        </select>
    </div>
</div>
