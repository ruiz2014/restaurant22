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
                                {{ __('Categories') }}
                            </span>

                            
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
									<th >Description</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $categorie)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $categorie->name }}</td>
										<td >{{ $categorie->description }}</td>
                                            <td>
                                                <form action="{{ route('categories.restore', $categorie->id) }}" method="POST">
                                                    @csrf
                                                    <!-- method('DELETE') -->
                                                    <button type="submit" class="btn btn-outline-success btn-sm" onclick="event.preventDefault(); confirm('Are you sure to restore?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Restore') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $categories->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
