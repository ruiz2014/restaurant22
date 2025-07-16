@extends('layouts.app')

@section('template_title')
    Customers
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Customers') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            <form class="d-flex" role="search" action="{{route('customers.index')}}" method="get">
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
                                        <th >Tipo Doc</th>
                                        <th >Document</th>
                                        <th >Phone</th>
                                        <th >Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td >{{ $customer->name }}</td>
                                            <td >{{ $customer->name_doc }}</td>
                                            <td >{{ $customer->document }}</td>
                                            <td >{{ $customer->phone }}</td>
                                            <td >{{ $customer->address }}</td>
                                            <td>
                                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('customers.show', $customer->id) }}"><ion-icon name="eye"></ion-icon></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('customers.edit', $customer->id) }}"><ion-icon name="pencil"></ion-icon></a>
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
                {!! $customers->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
