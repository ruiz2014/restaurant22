@extends('layouts.app')

@section('template_title')
    {{ $provider->name ?? __('Show') . " " . __('Provider') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Provider</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('providers.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Name:</strong>
                                    {{ $provider->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Document:</strong>
                                    {{ $provider->document }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Contact:</strong>
                                    {{ $provider->contact }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Phone:</strong>
                                    {{ $provider->phone }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Address:</strong>
                                    {{ $provider->address }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ubigeo:</strong>
                                    {{ $provider->ubigeo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $provider->status }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
