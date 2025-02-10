@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? __('Show') . " " . __('User') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} User</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Name:</strong>
                                    {{ $user->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Email:</strong>
                                    {{ $user->email }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rol:</strong>
                                        @switch($user->rol)
                                            @case(1)
                                                Admin
                                                @break
                                            @case(2)
                                                Vendedor
                                                @break
                                            @default
                                                Otros
                                        @endswitch
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>DNI:</strong>
                                    {{ $user->DNI }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Dias Laborales:</strong>
                                    {{ $user->DiasLab }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Salario:</strong>
                                    {{ $user->Salario }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $user->Estado == 1 ? 'Activo' : 'Desactivo' }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
