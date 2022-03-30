@props([
    'type' => 'text',
    'label' => 'Default',
    'name' => 'Default',
    'placeholder' => 'Default',
    'col' => '12',
    'required' => false,
    'value' => null,
    'step' => 0,
    'autofocus' => false,
    'id' => null,
    'dataRole' => null,
    'min' => null,
    'max' => null,
    'readonly' => null,
])

<div {{ $attributes->merge(['class' => "col-md-{$col}"]) }}>
    <div class="mb-3">
        <label for="{{ $name }}" class="form-label">{{ $label }}
            <small><code>{{ $required == true ? '[Required]' : '' }}</code></small></label>
        <input class="form-control @error($name) is-invalid @enderror bg-white"
               type="{{ $type }}"
               placeholder="{{ $placeholder }}"
               @if ($id) id="{{ $id }}" @else id="{{ $name }}" @endif
               name="{{ $name }}"
               @if ($step != 0 && $type == 'number') step="{{ $step }}" @endif
               @if (old($name, $value)) value="{{ old($name, $value) }}" @endif
               {{ $required == true ? 'required' : '' }}
               {{ $autofocus == true ? 'autofocus' : '' }}
               {{ $attributes->get('inputAttribute') }}
            @if ($dataRole) data-role="{{ $dataRole }}" @endif @if ($type == 'number')
        min="{{ $min }}"
        max="{{ $max }}"
        value="{{ $value }}"
        @endif
        @if ($readonly)
            readonly="{{ $readonly }}"
        @endif
        >
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
