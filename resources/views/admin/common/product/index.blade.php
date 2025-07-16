@extends('layouts.app')

@section('template_title')
    Products
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
        @if($deleted)    
            <div class="col-md-12">
                <a href="{{ route('products.deleted') }}" class="btn btn-outline-secondary mb-4">Ver Productos Eliminados</a>
            </div>
        @endif    
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Products') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="row">
                            <form class="d-flex" role="search" action="{{ route('products.index') }}" method="get">
                                <input class="form-control me-2" name="search" type="search" value="{{ $search }}" placeholder="Buscar" aria-label="Buscar">
                                <button class="btn btn-outline-success" type="submit"><ion-icon name="search"></ion-icon></button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th> 
                                        <th >Name</th>
                                        <th >Description</th>
                                        <th >Price</th>
                                        <th >Categoria
                                        <th >Stock</th>
                                        <th >Minimo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ ++$i }}</td>    
                                        <td >{{ $product->name }}</td>
                                        <td >{{ $product->description }}</td>
                                        <td >{{ $product->price }}</td>
                                        <td >{{ $product->category }}</td>
                                        <td >{{ $product->stock }}</td>
                                        <td >{{ $product->minimo }}</td>
                                        <td>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('products.show', $product->id) }}"><ion-icon name="eye"></ion-icon></a>
                                                <a class="btn btn-sm btn-success" href="{{ route('products.edit', $product->id) }}"><ion-icon name="pencil"></ion-icon></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><ion-icon name="trash"></ion-icon></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $products->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
