@extends('layouts.app')

@section('template_title')
    Caja
@endsection

@section('content')
    <div class="container-fluid">
    <!-- https://e-consultaruc.sunat.gob.pe/cl-ti-itmrconsruc/FrameCriterioBusquedaWeb.jsp -->
    <!-- <div class="wrapper-mesa p-2 p-md-3 shadow" id="btnModal">
                hola
    </div> -->
    <button type="button" class="btn btn-default btn-circle btn-lg">C</i></button>
    <button type="button" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-check"></i></button>
    <button id="btnModal" type="button" class="btn btn-outline-success btn-circle btn-lg"><i class="glyphicon glyphicon-link"></i></button>
    <button type="button" class="btn btn-info btn-circle btn-lg"><i class="glyphicon glyphicon-ok"></i></button>
    <button type="button" class="btn btn-warning btn-circle btn-lg"><i class="glyphicon glyphicon-remove"></i></button>
    <button type="button" class="btn btn-outline-danger btn-circle btn-lg"><i class="glyphicon glyphicon-heart"></i></button>
    <form id="prue" action="{{ route('pay.store') }}" method="POST">
            @csrf    
        <div class="row padding-1 p-1">
            
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label for="receipt" class="form-label-2">{{ __('Type of receipt') }}</label>
                    <select name="receipt" id="receipt" class="form-control-2 line vld draw mt-2">
                        <option value="00">Ticket</option>
                        <option value="03">Boleta</option>
                        <option value="01">Factura</option>
                    </select>
                    {!! $errors->first('receipt', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="position-relative">
                    <label for="contact" class="form-label-2">{{ __('Contact') }}</label>
                    <div class="d-flex input-group-sm">
                        <div class="input-group-prepend">
                            <!-- <span class="input-group-text" id="inputGroup-sizing-sm">Small</span> -->
                            <button type="button" id="clean" class="btn btn-primary btn-sm">Small</button>
                        </div>
                        <input type="text" id="term" autocomplete="off" class="form-control-2" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        <input type="hidden" name="customer_id" id="customer_id">
                        <input type="hidden" name="code" id="code" value="{{ $order }}">
                    </div>
                    
                    <div class="result position-absolute">
                        <ul id="box-search">
                                <!-- <li>juan</li>
                                <li>luis</li>
                                <li>varios</li> -->
                        </ul>
                    </div>
                </div>
                {!! $errors->first('customer_id', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
                {!! $errors->first('code', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
            </div> 

            <div class="col-md-6">
                <div class="form-group mb-2 mb20">
                    <label for="customer_doc" class="form-label-2">{{ __('Document') }}</label>
                    <input type="text" name="customer_doc" class="form-control-2 @error('customer_doc') is-invalid @enderror" value="" id="customer_doc" placeholder="Documento">
                    {!! $errors->first('customer_doc', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
           
            
            <div class="col-md-6">
                <div class="form-group mb-4 mb20 position-relative">
                    <label for="provider_id" class="form-label-2">{{ __('Customer') }}</label>
                    <input type="text" name="term-3" id="term-3-y-medio" class="form-control-2">
                    
                    <!-- <div class="result position-absolute">
                        <ul id="box-search"> -->
                            <!-- <li>juan</li>
                            <li>luis</li>
                            <li>varios</li> -->
                        <!-- </ul>
                    </div> -->
                    <!-- <select name="provider_id" id="" class="form-control-2 line vld draw">
                        <option value="">Varios</option>
                    </select> -->
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="form-group mb-2 mb20">
                    <label for="phone" class="form-label-2"></label>
                    <input type="text" name="phone" class="form-control-2 @error('phone') is-invalid @enderror" value="" id="phone" placeholder="Phone">
                    
                </div>
            </div> -->
            
            <!-- <div class="col-md-12 mt20 mt-2">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            </div> -->
        </div>
    </form>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Atenciones
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
                                        <th >Mesa</th>
                                        <th >Nombre</th>
                                        <th >Precio</th>
                                        <th >Order</th>
                                        <th >Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attentions as $attention)
                                        <tr>
                                            <td>1</td>
                                            
										<td >{{ $attention->table_id }}</td>
										<td >{{ $attention->name }}</td>
										<td >{{ $attention->price }}</td>
										<td >{{ $attention->order_id }}</td>
										<td >{{ $attention->status }}</td>


                                            <td>
                                                <a class="btn btn-sm btn-primary " href="{{ route('pay.show', ['order'=> $attention->code]) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href=""><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
        <div class="row">
            {{ $total }}
            <button id="btn-generate" class="btn btn-outline-primary" >Generar Comprobante</button>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                
                <a href="https://e-consultaruc.sunat.gob.pe/cl-ti-itmrconsruc/FrameCriterioBusquedaWeb.jsp" target="_blank" class="btn btn-outline-primary mb-3">Validar Usuario</a>
                <div class="alert alert-success d-none" role="alert" id="success">
                    <p>Hola</p>
                </div>
                <div class="alert alert-danger d-none" role="alert" id="error">
                    <p>Hola</p>
                </div>

                <form id="customer_form">
                @csrf
                <div class="row padding-1 p-1">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_doc" class="form-label-2">{{ __('Type of document') }}</label>
                            <select name="tipo_doc" id="tipo_doc" class="form-control-2 line vld draw mt-2">
                                <option value="1">DNI</option>
                                <option value="6">RUC</option>
                                <option value="7">Pasaporte</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-2 mb-2 mb20">
                            <label for="document" class="form-label-2">{{ __('Document') }}</label>
                            <input type="text" name="document" class="form-control-2" value="" id="document" placeholder="Documento">
                            <div class="invalid-feedback error-document" role="alert"><strong></strong></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2 mb20">
                            <label for="name" class="form-label-2">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control-2" value="" id="name" placeholder="Nombre">
                            <div class="invalid-feedback error-name" role="alert"><strong></strong></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2 mb20">
                            <label for="Address" class="form-label-2">{{ __('Address') }}</label>
                            <input type="text" name="address" class="form-control-2" value="" id="Address" placeholder="Direccion">
                            <div class="invalid-feedback error-address" role="alert"><strong></strong></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2 mb20">
                            <label for="phone" class="form-label-2">{{ __('Phone') }}</label>
                            <input type="text" name="phone" class="form-control-2" value="" id="phone" placeholder="Telefono">
                            <div class="invalid-feedback error-phone" role="alert"><strong></strong></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2 mb20">
                            <label for="email" class="form-label-2">{{ __('Email') }}</label>
                            <input type="text" name="email" class="form-control-2" value="" id="email" placeholder="Correo">
                            <div class="invalid-feedback error-email" role="alert"><strong></strong></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2 mb20">
                            <label for="ubigeo" class="form-label-2">{{ __('Ubigeo') }}</label>
                            <input type="text" name="ubigeo" class="form-control-2" value="" id="ubigeo" placeholder="Ubigeo">
                            <div class="invalid-feedback error-ubigeo" role="alert"><strong></strong></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2 mb20">
                            <label for="status" class="form-label-2">{{ __('Status') }}</label>
                            <input type="text" name="status" class="form-control-2" value="" id="status" placeholder="Estado">
                            <div class="invalid-feedback error-status" role="alert"><strong></strong></div>
                        </div>
                    </div>
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary">Save changes</button>
              </div>
            </form>  
            </div>
          </div>
        </div>
    </div>
    <style>
    .result{
        background: #fcfdff;
        z-index: 1;
        width: 100%;
    }
    #box-search{
        border:1px solid black;
        border-top: none;
        margin:0px;
        padding-left: 0px;
        /* height: 150px;*/
        overflow-y: auto;
    }
    #box-search li{
        list-style: none;
        padding: 3px 0px 3px 10px;
    }
    #box-search li:hover{
        background: #007bff;
        color:white;
    }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    .btn-circle.btn-lg {
        width: 50px;
        height: 50px;
        padding: 10px 16px;
        font-size: 18px;
        line-height: 1.33;
        border-radius: 25px;
    }
    .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        font-size: 24px;
        line-height: 1.33;
        border-radius: 35px;
    }
    </style>
@endsection
@section('script')
<script>
    window.addEventListener("load", function(){
        let receipt = document.getElementById('receipt');
        let term = document.getElementById('term');
        let box = document.getElementById('box-search');
        let customer_id = document.getElementById('customer_id');
        let customer_doc = document.getElementById('customer_doc');
        let code = document.getElementById('code');
        
        let clear_btn = document.getElementById('clean');
        let error = document.querySelector('.alert-danger');
        let success = document.querySelector('.alert-success');

        let ed = document.querySelector('.error-document');
        let cn = document.querySelector('.error-name');

        let ifeed = document.querySelectorAll('.invalid-feedback');
        let tipo_doc = document.getElementById('tipo_doc');
        let current_doc = document.getElementById('document');
        let customer_name = document.getElementById('name');

        let btn_generate = document.getElementById('btn-generate');

        let customer_form = document.getElementById('customer_form');

        const btn = document.getElementById("btnModal");
        const modalRegistro = document.querySelector("#exampleModal");
        //las opciones son opcional - puedes quitarlo
        const myModal = new bootstrap.Modal(modalRegistro);

        btn.onclick = () =>{ myModal.show(); }

        receipt.onchange = () =>{ clean(); }
        tipo_doc.onchange = () =>{ current_doc.value = ''; }
        clear_btn.onclick = ()=>{ clean(); } 

        btn_generate.onclick = ()=>{ generate_receipt(); }

        term.onclick = function(e){ 
            const url = `/tool/search?customer=`;
            if(box.childElementCount > 0){
                box.innerHTML = "";
                box.style.height = '0px'
                return
            }
            box.style.height = '150px'
            search(e, url)
            // console.log(box.childElementCount); 
        }

        term.addEventListener("keyup", (e)=>{
            // console.log(e.type)
            const url = `/tool/search?customer=${term.value}`;
            search(e, url)
        })

        function search(e, url){
            
            fetch(url,{
                method: "get",
                headers: { 
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                box.innerHTML = "";
                data.forEach(p =>{
                    box.innerHTML += `<li data-document=${p.document} data-search=${p.id}> ${p.name} </li>`;
                })
                
                box.addEventListener("click", function(li) {
                    // li.target.style.color = "blue";
                    // alert(li.target.dataset.search);
                    term.value = li.target.innerHTML
                    customer_id.value = li.target.dataset.search
                    box.innerHTML = "";
                    box.style.height = '0px'
                    customer_doc.value = li.target.dataset.document
                    // term.disabled=true
                    // term.onselectstart = function() {
                    //     return true;
                    // };
                    if(e.type == 'click'){
                        console.log(e.type)
                        term.onmousedown = function()
                        {
                            return false;
                        }
                    }
                    
                }, false);
            })
        }

        function clean(){
            term.value=''; 
            customer_id.value=''
            customer_doc.value = '';
            box.innerHTML = "";
            box.style.height = '0px'
            term.onmousedown = function()
            {
                return true;
            }
        }

        customer_form.addEventListener('submit', e =>{
            e.preventDefault();
            sendData()
        })

        function sendData(){
            ifeed.forEach(xale => { 
                xale.style.display = "none"
			});

            if(tipo_doc.value == 1 && current_doc.value.length != 8){
                ed.style.display='block';
                ed.textContent = "El DNI debe ser 8 digitos";
                return 0;
            }

            if(tipo_doc.value == 6 && current_doc.value.length != 11){
                ed.style.display='block';
                ed.textContent = "El RUC debe ser 11 digitos";
                return 0;
            }

            const pattern = new RegExp('^[A-ZÁÉÍÓÚÑ ]+$', 'i');

            if(!pattern.test(customer_name.value)){
                cn.style.display='block';
                cn.textContent = "El campo nombre es obligatorio";
                return 0;
            }

            // alert(tipo_doc.value)

            console.log()

            const form = new FormData(customer_form); 
           
            // const nameC = form.get("name");
	        // console.log(name);

            fetch(`/tool/register_customer`, {
                method: "POST",
                body: form,
                headers: { 
                    'Accept':'application/json',
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                } 
            })
            .then(response => response.json())
            .then(result => {
                if(result.errors){

                    for (var key in result.errors) {
                        merror = document.querySelector(`.error-${key}`);
                        merror.style.display='block';
                        merror.textContent = result.errors[key][0];
                    }
                }
                else{
                    error.classList.add("d-none");
                    success.classList.remove("d-none");
                    success.textContent = 'Agregado con Exito';
                    
                }
                // setTimeout(() => {
                //     ifeed.forEach(xale => { 
                //         xale.style.display = "none";
                //     });
			    // }, 3000);
            })
        }

        function generate_receipt(){
            
            let prue = document.getElementById('prue');

            // var form_receipt = new FormData(prue); 
            // form_receipt.append("customer_id", customer_id.value);
            // form_receipt.append("customer_doc", customer_doc.value);
            // form_receipt.append("receipt", receipt.value);
            // form_receipt.append("code", code.value);
            // form_receipt.append("_token", document.querySelector('input[name=_token]').value);

            prue.submit();

            // var request = new XMLHttpRequest();
            // request.open("POST", "{{ route('pay.store') }}");
            // request.send(form_receipt);
        }
        // clear.addEventListener("click", function() {
        //     term.value=''; 
        //     customer_id.value=''
        //     customer_doc.value = '';
        //     term.onmousedown = function()
        //     {
        //         return true;
        //     }
        // })

        // function sendData(){
        //     ifeed.forEach(xale => { 
        //             xale.style.display = "none"
		// 	    });

        //     const form = new FormData(customer_form); 
        //     // const dataObject = Object.fromEntries(form.entries());
        //     // data.forEach((value, key) => {
        //     //     console.log(`${key}: ${value}`);
        //     // });
        //     // const nameC = form.get("name");
	    //     // console.log(name);
	    //     // console.log(dataObject);
        //     // alert("llego");
        //     // var dataset = { name : nameC };
        //     fetch(`/tool/register_customer`, {
        //         method: "POST",
        //         body: form,
        //         headers: { 
        //             'Accept':'application/json',
        //             "X-CSRF-Token": document.querySelector('input[name=_token]').value
        //             // 'Content-Type': 'application/json',
        //         } 
        //     })
        //     .then(response => response.json())
        //     .then(result => {
        //         if(result.errors){

        //             for (var key in result.errors) {
        //                 merror = document.querySelector(`.error-${key}`);
        //                 merror.style.display='block';
        //                 merror.textContent = result.errors[key][0];
        //             }
        //             // success.classList.add("d-none");
        //             // error.classList.remove("d-none");
        //             // error.textContent = errorResp;
        //             // console.log(result.errors.name[0]);
        //             // console.log(result.errors);
        //         }
        //         else{
        //             error.classList.add("d-none");
        //             success.classList.remove("d-none");
        //             success.textContent = 'Agregado con Exito';
                    
        //         }
        //         // setTimeout(() => {
        //         //     ifeed.forEach(xale => { 
        //         //         xale.style.display = "none";
        //         //     });
		// 	    // }, 3000);
        //         // ifeed.forEach(xale => { 
        //         //     xale.style.display = "none"
		// 		//     // span.style.textAlign = "left";
		// 	    // });
        //     })
        // }

    });
</script>
@endsection
