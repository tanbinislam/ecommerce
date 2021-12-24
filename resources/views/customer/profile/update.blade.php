<div class="row mb-3">
    <label class="col-2 col-form-label">Photo:</label>
    <div class="col-2 profile-pic">
        <img src="{{asset('images/placeholders/150.png')}}" class="img-thumbnail rounded" id="preview-up-image" alt="Preview Photo" title="Preview Photo"/>
    </div>
    <div class="col-6">
        <input type="file" id="img-upload-preview" name="avatar" class="form-control{{ $errors->has('avatar') ? ' is-invalid' : '' }}">
        @if ($errors->has('avatar'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('avatar') }}</strong>
            </span>
        @endif
    </div>
</div>