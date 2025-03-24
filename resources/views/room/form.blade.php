<div class="row padding-1 p-1">

    <div class="col-md-6">
        <div class="form-group mb-4 mb20">
            <label for="name" class="form-label-2">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control-2 @error('name') is-invalid @enderror" value="{{ old('name', $room?->name) }}" id="name" placeholder="Name">
            {!! $errors->first('name', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-4 mb20">
            <label for="number_tables" class="form-label-2">{{ __('Number of tables') }}</label>
            <input type="number" name="number_tables" class="form-control-2 @error('number_tables') is-invalid @enderror" value="{{ old('number_tables', $room?->number_tables) }}" id="number_tables" placeholder="Numero">
            {!! $errors->first('number_tables', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>