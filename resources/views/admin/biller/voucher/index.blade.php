@extends('layouts.app')

@section('template_title')
    Products
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ $title }}
                            </span>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="row">
                            <form class="d-flex" role="search" action="{{route('attentions.index', ['type'=>'00'])}}" method="get">
                                <input class="form-control me-2" name="search" type="search" value="{{ $search }}" placeholder="Buscar" aria-label="Buscar">
                                <button class="btn btn-outline-success" type="submit"><ion-icon name="search"></ion-icon></button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th >Identificador</th>
                                        <th >Cliente</th>
                                        <th >Total</th>
                                        <th >Fecha</th>
                                        <th >Cdr</th>
                                        <th >Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($types as $type)
                                    <tr>   
                                        <td >{{ $type->identifier }}</td>
                                        <td >{{ $type->name }}</td>
                                        <td >{{ $type->total }}</td>
                                        <td >{{ $type->created_at}}</td>
                                        <td >{{ $type->cdr }}</td>
                                        <td >{{ $type->success }}</td>
                                        <td>
                                            <a class="btn btn-primary " href="{{ route('pay.generated', $type->id) }}"><ion-icon name="eye"></ion-icon></a>
                                        </td>
                                        <!-- <ion-icon name="pencil"></ion-icon>
                                        <ion-icon name="trash"></ion-icon> -->
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
             {!! $types->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection