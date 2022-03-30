@props([
    'type' => 'text',
    'col' => '12',
    'name' => 'Default',
    'label' => 'Default',
    'placeholder' => 'Select Parent Category',
    'required' => false,
    'values' => [],
    'selected' => null,
    'multiple' => false,
])

<div class="col-lg-{{$col}}">
    <div class="mb-3">
        <label for="{{$name}}">{{$label}} <small><code>{{$required == true ? '[Required]' : ''}}</code></small></label>
        <select
            class="form-control js-choice @error($name) is-invalid @enderror"
            data-trigger
            name="{{$name}}"
            id="{{$name}}"
            data-placeholder="{{$placeholder}}"
            {{$required ? 'required' : ''}}
            {{$multiple ? 'multiple' : ''}}
        >
            <option value data-choices-placeholder>{{$placeholder}}</option>
            {{$slot}}
            @foreach($values as $value)
                <option
                    value="{{$value->id}}"
                    @if($selected)
                        @if(old($name, $selected) == $value->id) selected @endif
                    @else
                        @if(old($name) == $value->id) selected @endif
                    @endif
                >{{$value->name}}</option>
            @endforeach
        </select>
        @error($name)
        <div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
</div>
