@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Customer
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Customer</span>
                    </div>
                    <div class="card-body bg-white">
                        <form id="customer_form" method="POST" action="{{ route('customers.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('admin.common.customer.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        // $('#customer_form').submit(function(e){
        //     let type=$('#tipo_doc').val();
        //     if(type == "1"){
        //         if($('#document').val().length == 8){
        //             return true;
        //         }
        //     }
        //     else if(type == "6"){
        //         if($('#document').val().length == 11){
        //             return true;
        //         }
        //     }
        //     e.preventDefault();
        // });
    </script>
@endsection        