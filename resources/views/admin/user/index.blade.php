@extends('layouts.app')

@section('template_title')
    Users
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Users') }}
                            </span>

                             <div class="float-right">
                                <a class="btn btn-primary btn-sm float-right"  data-placement="left" href="{{ route('formRegistro') }}">
                                    {{ __('Register') }}
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
                            <table class="table table-striped table-hover" id="myTable">
                                <thead class="thead">
                                    <tr>
                                        <th >Name</th>
                                        <th >Rol</th>
                                        <th >Email</th>
                                        <th >DNI</th>
                                        <th >Telefono</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>  
                                            <td >{{ $user->name }}</td>
                                            <td >
                                                {{ isset($user->role->name) ? $user->role->name : ''}}
                                            </td>
                                            <td >{{ $user->email }}</td>
                                            <td >{{ isset($user->employee->dni) ? $user->employee->dni : '' }}</td>
                                            <td >{{ isset($user->employee->phone) ? $user->employee->phone : '' }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary " href="{{ route('users.show', $user->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('users.edit', $user->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#myTable').DataTable(); 
    </script>
@endsection
