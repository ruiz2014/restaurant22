<div class="row padding-1 p-1">

    <div class="col-md-6">    
        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label-2">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control-2 @error('name') is-invalid @enderror" value="{{ old('name', $user?->name) }}" id="name" placeholder="Name">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2 mb20">
            <label for="email" class="form-label-2">DNI</label>
            <input type="text" name="dni" class="form-control-2 @error('DNI') is-invalid @enderror" value="{{ old('DNI', $data?->dni) }}" id="dni" placeholder="DNI">
            {!! $errors->first('dni', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-4">
            <label for="rol" class="form-label-2">{{ __('Rol') }}</label>
            <select name="rol" id="rol" class="form-control-2 line vld draw @error('rol') is-invalid @enderror">
            @foreach($roles as $role)    
                <option value="{{ $role->id }}" {{ $user?->rol == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
            @endforeach    
            </select>
            {!! $errors->first('rol', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2 mb20">
            <label for="address" class="form-label-2">{{ __('Address') }}</label>
            <input type="text" name="address" class="form-control-2 @error('address') is-invalid @enderror" value="{{ old('address', $data?->address) }}" id="address" placeholder="address">
            {!! $errors->first('address', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2 mb20">
            <label for="email" class="form-label-2">{{ __('Email') }}</label>
            <input type="text" name="email" class="form-control-2 @error('email') is-invalid @enderror" value="{{ old('email', $user?->email) }}" id="email" placeholder="Email">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-2 mb20">
            <label for="phone" class="form-label-2">{{ __('Phone') }}</label>
            <input type="text" name="phone" class="form-control-2 @error('phone') is-invalid @enderror" value="{{ old('phone', $data?->phone) }}" id="phone" placeholder="Phone">
            {!! $errors->first('phone', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>