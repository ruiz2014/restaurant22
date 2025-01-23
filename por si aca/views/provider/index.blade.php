@extends('layouts.app')

@section('template_title')
    Providers
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Providers') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('providers.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Name</th>
									<th >Document</th>
									<th >Contact</th>
									<th >Phone</th>
									<th >Address</th>
									<th >Ubigeo</th>
									<th >Status</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($providers as $provider)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $provider->name }}</td>
										<td >{{ $provider->document }}</td>
										<td >{{ $provider->contact }}</td>
										<td >{{ $provider->phone }}</td>
										<td >{{ $provider->address }}</td>
										<td >{{ $provider->ubigeo }}</td>
										<td >{{ $provider->status }}</td>

                                            <td>
                                                <form action="{{ route('providers.destroy', $provider->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('providers.show', $provider->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('providers.edit', $provider->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $providers->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
