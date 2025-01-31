<div class="row padding-1 p-1">
    <div class="col-md-6">    
        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label-2">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control-2 @error('name') is-invalid @enderror" value="{{ old('name', $voucher?->name) }}" id="name" placeholder="Name">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-6">    
        <div class="form-group mb-2 mb20">
            <label for="sunat_code" class="form-label-2">{{ __('Sunat Code') }}</label>
            <input type="text" name="sunat_code" class="form-control-2 @error('sunat_code') is-invalid @enderror" value="{{ old('sunat_code', $voucher?->sunat_code) }}" id="sunat_code" placeholder="Sunat Code">
            {!! $errors->first('sunat_code', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>