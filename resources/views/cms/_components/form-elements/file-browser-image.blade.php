@props([
    'name' => 'main_image_url',
    'defaultFile' => NULL,
    'margin' => 3,
    'height' => NULL,
    'required' => TRUE,
    'label' => 'Default',
])

<div class="col-lg-12 mb-{{$margin}}">
    <label for="{{$name}}" class="form-label">{{$label}} <small><code>{{$required == true ? '[Required]' : ''}}</code></small></label>
    <div
        class="dropify-wrapper single"
        id="lfm"
        data-path="path"
        data-preview-wrapper="preview"
        data-preview="holder"
        style="@if($height) height: {{$height}}px; @endif @error('image_url') border: 2px solid #febfbe @enderror"
    >
        <div class="dropify-message {{$defaultFile ? 'has-preview' : ''}}">
            <span class="file-icon"><p>Click to open Image Browser</p></span>
            <p class="dropify-error">Ooops, something wrong happended.</p>
        </div>
        <div class="dropify-preview {{$defaultFile ? 'd-block' : ''}}" id="preview">
            <span class="dropify-render" id="holder">
                @if($defaultFile)
                    <img src="{{$defaultFile}}" alt="">
                @endif
            </span>
            <div class="dropify-infos">
                <div class="dropify-infos-inner">
                    <p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner" id="path">{{$defaultFile ?? ''}}</span></p>
                    <p class="dropify-infos-message">Click and Open Image Browser to replace</p>
                </div>
            </div>
        </div>
        <input type="hidden" value="" id="image_url" name="{{$name}}" {{$required ? 'required' : ''}}>
    </div>
    @error('image_url')<p style="color: #fd625e; font-size: 80%; margin-top: 4px">Image Field is required</p>@enderror
</div>
