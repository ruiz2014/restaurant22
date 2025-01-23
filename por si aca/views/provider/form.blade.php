<div class="row padding-1 p-1">
    <div class="col-md-6">
        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label-2">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control-2 @error('name') is-invalid @enderror" value="{{ old('name', $provider?->name) }}" id="name" placeholder="Name">
            {!! $errors->first('name', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2 mb20">
            <label for="document" class="form-label-2">{{ __('Document') }}</label>
            <input type="text" name="document" class="form-control-2 @error('document') is-invalid @enderror" value="{{ old('document', $provider?->document) }}" id="document" placeholder="Document">
            {!! $errors->first('document', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2 mb20">
            <label for="contact" class="form-label-2">{{ __('Contact') }}</label>
            <input type="text" name="contact" class="form-control-2 @error('contact') is-invalid @enderror" value="{{ old('contact', $provider?->contact) }}" id="contact" placeholder="Contact">
            {!! $errors->first('contact', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2 mb20">
            <label for="phone" class="form-label-2">{{ __('Phone') }}</label>
            <input type="text" name="phone" class="form-control-2 @error('phone') is-invalid @enderror" value="{{ old('phone', $provider?->phone) }}" id="phone" placeholder="Phone">
            {!! $errors->first('phone', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2 mb20">
            <label for="address" class="form-label-2">{{ __('Address') }}</label>
            <input type="text" name="address" class="form-control-2 @error('address') is-invalid @enderror" value="{{ old('address', $provider?->address) }}" id="address" placeholder="Address">
            {!! $errors->first('address', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2 mb20">
            <label for="ubigeo" class="form-label-2">{{ __('Ubigeo') }}</label>
            <input type="text" name="ubigeo" class="form-control-2 @error('ubigeo') is-invalid @enderror" value="{{ old('ubigeo', $provider?->ubigeo) }}" id="ubigeo" placeholder="Ubigeo">
            {!! $errors->first('ubigeo', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2 mb20">
            <label for="status" class="form-label-2">{{ __('Status') }}</label>
            <input type="text" name="status" class="form-control-2 @error('status') is-invalid @enderror" value="{{ old('status', $provider?->status) }}" id="status" placeholder="Status">
            {!! $errors->first('status', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>