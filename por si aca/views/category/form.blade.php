<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-4 mb20">
            <label for="name" class="form-label-2">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control-2 @error('name') is-invalid @enderror" value="{{ old('name', $category?->name) }}" id="name" placeholder="Name">
            {!! $errors->first('name', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-4 mb20">
            <label for="status" class="form-label-2">{{ __('Status') }}</label>
            <input type="text" name="status" class="form-control-2 @error('status') is-invalid @enderror" value="{{ old('status', $category?->status) }}" id="status" placeholder="Status">
            {!! $errors->first('status', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>