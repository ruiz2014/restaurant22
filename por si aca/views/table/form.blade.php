<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="identifier" class="form-label">{{ __('Identifier') }}</label>
            <input type="text" name="identifier" class="form-control @error('identifier') is-invalid @enderror" value="{{ old('identifier', $table?->identifier) }}" id="identifier" placeholder="Identifier">
            {!! $errors->first('identifier', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="room_id" class="form-label">{{ __('Room Id') }}</label>
            <input type="text" name="room_id" class="form-control @error('room_id') is-invalid @enderror" value="{{ old('room_id', $table?->room_id) }}" id="room_id" placeholder="Room Id">
            {!! $errors->first('room_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="place_id" class="form-label">{{ __('Place Id') }}</label>
            <input type="text" name="place_id" class="form-control @error('place_id') is-invalid @enderror" value="{{ old('place_id', $table?->place_id) }}" id="place_id" placeholder="Place Id">
            {!! $errors->first('place_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="observation" class="form-label">{{ __('Observation') }}</label>
            <input type="text" name="observation" class="form-control @error('observation') is-invalid @enderror" value="{{ old('observation', $table?->observation) }}" id="observation" placeholder="Observation">
            {!! $errors->first('observation', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="status" class="form-label">{{ __('Status') }}</label>
            <input type="text" name="status" class="form-control @error('status') is-invalid @enderror" value="{{ old('status', $table?->status) }}" id="status" placeholder="Status">
            {!! $errors->first('status', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>