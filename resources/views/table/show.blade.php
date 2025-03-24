@extends('layouts.app')

@section('template_title')
    {{ $table->name ?? __('Show') . " " . __('Table') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Table</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('tables.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Identifier:</strong>
                                    {{ $table->identifier }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Room Id:</strong>
                                    {{ $table->room_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Place Id:</strong>
                                    {{ $table->place_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Observation:</strong>
                                    {{ $table->observation }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $table->status }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
