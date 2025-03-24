@extends('layouts.app')

@section('template_title')
    Products
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="{{ route('summary.search') }}" method="POST">
                    @csrf    
                    <div class="form-group">
                            <label class="form-label-2">Date:</label>
                            <div class="input-group date" id="">
                                <input type="date" id="date" name="date" class="form-control-2"  />
                            </div>
                        </div>
                    <div class="card-footer mt-3 mb-4">
                        <button type="button" class="btn btn-primary modal-date" >
                        Launch demo modal
                        </button>
                    </div>
                </form>
            </div>
        </div>    

        <div class="row padding-1 p-1">
            <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Categories') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <td>Id</td>
                                        <td>F. Creacion</td>
                                        <td>F. Envio</td>
                                        <td class="hidden-column-1000">hash</td>
                                        <td>Estado</td>
                                        <td class="hidden-column-700">Codigo</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($summaries as $summary)
                                    <tr>
                                        <td>{{ $summary->id }}</td>
                                        <td>{{ $summary->date_created }}</td>
                                        <td>{{ $summary->date_send}}</td>
                                        <td>{{ $summary->hash }}</td>
                                        <td>{{ $summary->status }}</td>
                                        <td>{{ $summary->cdr }}</td>
                                        <td>{{ $summary->ticket }}</td>
                                    </tr>
                                @endforeach        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $summaries->withQueryString()->links() !!}
                
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Boletas a Enviar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table" style="width: 100%;">
                        <thead class="table-dark">
                            <tr>
                                <th>Fecha</th>
                                <th>Documento</th>
                                <th>Total</th>
                            </tr>
                        </thead>    
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('summary') }}" method="POST">
                        @csrf
                        <input type="hidden" name="date_form" id="date_form">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                    
                </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $('.modal-date').click(()=>{
            $('#tbody').empty();
            let date = $('#date').val();
            var json = { date: date}; 
            let body = '';
            fetch(`summary/search`, {
                method: "POST",
                headers: { 
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                },
                body: JSON.stringify(json)
            })
            .then(response => response.json()) 
            .then(datos => {
                if(datos.ok){
                    // $('#tbody').append(body)
                    datos.document.forEach( i =>{
                        body += `<tr>
                                    <td>
                                        ${i.date}
                                    </td>
                                    <td>
                                        ${i.identifier}
                                    </td>
                                    <td>
                                        ${i.total.toFixed(2)}
                                    </td>
                                    
                                </tr>`

                    });
                    $("#date_form").val(date);
                    $('#tbody').append(body)
                    $('#exampleModal').modal('show');
                }
                else{
                    alert("No hay datos que mostrar");
                }
                
                console.log(datos)
            });
            
        })
    </script>
@endsection