@props([
'col' => '12',
'name' => 'Default',
'label' => 'Default',
'placeholder' => 'Default', 
'id' =>'exampleFormControlTextarea1',
'required' => false,
'value' => null,
'editor' => true,
'cols' => 30,
'rows' => 10,
])


<div class="col-lg-{{$col}}">
    <div class="mb-3">
        <label for="{{$name}}">{{$label}} <small><code>{{$required == true ? '[Required]' : ''}}</code></small></label>
        <textarea id="summernote-editor" name="{{$name}}" cols="{{$cols}}" rows="{{$rows}}"
            class="form-control {{$editor ? 'summernote' : ''}} @error($name) is-invalid @enderror">{!! old($name, $value) !!}</textarea>
        @error($name)<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
</div>