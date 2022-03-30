@props([
    'type' => 'radio',
    'name' => 'Default',
    'label' => 'Default',
    'col' => '12',
    'required' => false,
    'values' => [],
    'id' => null,
    'checked' => null,
])

<div {{ $attributes->merge(['class' => "col-{$col}"]) }}>
    <div class="mb-3">

        <div class="form-check-inline mb-3">
            <label class="form-check-label"
                for="{{ $name }}">{{ $label }}<small><code>{{ $required == true ? '[Required]' : '' }}
                    </code> </small> </label>
        </div>
        <div>
            @foreach ($values as $value)
                <div class="form-check-inline">
                    <label class="form-check-label"> <input type="radio" class="form-check-input"
                            name="{{ $name }}" value="{{ $value }}"
                            {{ $checked == $value ? 'checked' : '' }}>{{ $value == 1 ? 'Yes' : 'No' }}</label>
                </div>
            @endforeach
        </div>

        @error($name)
        <div class="invalid-feedback">{{ $message }}</div>@enderror

    </div>
</div>
