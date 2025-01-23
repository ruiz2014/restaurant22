<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    
    <style>
        /* .mesa{
            border:solid 1px red;
        } */
        .mierda{
            display: flex;
            flex-wrap: wrap;
            width: 100%;
        }
        .mesa{
            width:20%;
        } 
        img{
            width:100%;
        } 
        .wrapper-mesa{
            border: solid 1px #a7a7ae;
            border-radius: 8px; 
        }
        .wrapper-mesa:hover{
            background: rgb(219, 219, 219);
        }
        .table-tag{
            position: absolute;
            border-radius: 50%;
            color: white;
            background: black;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            font-weight: 600;
        }
    </style>
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin:100px">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent" style="margin:200px">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="mierda">  
                <div class="col-3 col-lg-2 col-xl-2 mesa p-2 p-sm-3">
                    <span class="table-tag">132</span>
                    <div class="wrapper-mesa p-2 p-md-4 shadow btnModal">
                        <img src="img/table.png" alt="">
                    </div>
                </div>
                <div class="col-3 col-lg-2 col-xl-2 mesa p-2 p-sm-3">
                    <span class="table-tag">132</span>
                    <div class="wrapper-mesa p-2 p-md-4 shadow btnModal">
                        <img src="img/table.png" alt="">
                    </div>
                </div>
                <div class="col-3 col-lg-2 col-xl-2 mesa p-2 p-sm-3">
                    <span class="table-tag">132</span>
                    <div class="wrapper-mesa p-2 p-md-4 shadow btnModal">
                        <img src="img/table.png" alt="">
                    </div>
                </div>
                <div class="col-3 col-lg-2 col-xl-2 mesa p-2 p-sm-3">
                    <span class="table-tag">132</span>
                    <div class="wrapper-mesa p-2 p-md-4 shadow btnModal">
                        <img src="img/table.png" alt="">
                    </div>
                </div>
                <div class="col-3 col-lg-2 col-xl-2 mesa p-2 p-sm-3">
                    <span class="table-tag">132</span>
                    <div class="wrapper-mesa p-2 p-md-4 shadow btnModal">
                        <img src="img/table.png" alt="">
                    </div>
                </div>
                <div class="col-3 col-lg-2 col-xl-2 mesa p-2 p-sm-3">
                    <span class="table-tag">132</span>
                    <div class="wrapper-mesa p-2 p-md-4 shadow btnModal">
                        <img src="img/table.png" alt="">
                    </div>
                </div>
                <div class="col-3 col-lg-2 col-xl-2 mesa p-2 p-sm-3">
                    <span class="table-tag">132</span>
                    <div class="wrapper-mesa p-2 p-md-4 shadow btnModal">
                        <img src="img/table.png" alt="">
                    </div>
                </div>
                <div class="col-3 col-lg-2 col-xl-2 mesa p-2 p-sm-3">
                    <span class="table-tag">132</span>
                    <div class="wrapper-mesa p-2 p-md-4 shadow btnModal">
                        <img src="img/table.png" alt="">
                    </div>
                </div>
                <div class="col-3 col-lg-2 col-xl-2 mesa p-2 p-sm-3">
                    <span class="table-tag">132</span>
                    <div class="wrapper-mesa p-2 p-md-4 shadow btnModal">
                        <img src="img/table.png" alt="">
                    </div>
                </div>
            </div>     
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">..B.</div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...C</div>
    </div>

    <div class="container">
        <div class="row">
            @foreach($tables as $table)
            <div class="col-3 col-lg-2 col-xl-2 mesa p-2 p-sm-3">
                <span class="table-tag">{{ $table }}</span>
                <div class="wrapper-mesa p-2 p-md-4 shadow btnModal" id="{{ $table }}">
                    <img src="img/table.png" alt="">
                </div>
            </div>
            @endforeach
            <!-- <div class="col-3 col-lg-2 col-xl-2 mesa p-2 p-sm-3">
                <span class="table-tag">132</span>
                <div class="wrapper-mesa p-2 p-md-4 shadow btnModal">
                    <img src="img/table.png" alt="">
                </div>
            </div> -->
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
              @csrf
                <div class="">
                    <label for="" style="width:100%;">Platillos</label>
                    <select id="dishe" class="form-select dishes-select" aria-label="Default select example">  
                        <option value="">Seleccione platillo</option>    
                        @foreach($dishes as $id => $dishe)
                        <option value="{{$id}}">{{$dishe}}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="">
                    <label for="" style="width:100%;">Bebidas</label>
                <select id="drink" class="form-select drinks-select" aria-label="Default select example">
                    <option value="">Seleccione bebida</option>     
                    @foreach($drinks as $id => $drink)
                    <option value="{{$id}}">{{$drink}}</option>
                    @endforeach
                </select>
                </div> 
                <div class="">
                    <label for="" style="width:100%;">Guarniciones</label>
                <select id="fitting" class="form-select fittings-select" aria-label="Default select example">
                    <option value="">Seleccione guarnision</option>     
                    @foreach($fittings as $id => $fitting)
                    <option value="{{$id}}">{{$fitting}}</option>
                    @endforeach
                </select>
                </div> 
                <div class="">
                    <label for="" style="width:100%;">Otros</label>
                <select id="other" class="form-select others-select" aria-label="Default select example">
                    <option value="">Seleccione otros</option>     
                    @foreach($others as $id => $other)
                    <option value="{{$id}}">{{$other}}</option>
                    @endforeach
                </select>
                </div> 
                <div>
                    <input type="hidden" name="" id="in_use">
                    <button id="btn-add" class="btn btn-primary">Agregar</button>
                </div>



                <table id="table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>


                <textarea name="" id="">

                </textarea>
                <button id="send-kitchen">Enviar a cosina</button>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
</body>
    <script type="module"> 
        import { io } from "https://cdn.socket.io/4.7.5/socket.io.esm.min.js";
        // const socket = io('https://chapi.nafer.com.pe');
        const socket = io('http://localhost:3000');
        
        $('#send-kitchen').click(function(){
            
            try {
                    let body = ''
                    let table = $('#in_use').val();
                    var data = { table: table };
                    fetch(`send_kitchen`, {
                        method: "POST",
                        headers: { 
                            'Content-Type': 'application/json',
                            "X-CSRF-Token": document.querySelector('input[name=_token]').value
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(datos => {
                        console.log(datos)
                        if(datos.ok){
                            $('#tbody').empty();
                                datos.orders.forEach(p =>{
                                    body += `<tr>
                                                <td>${p.name}</td>
                                                <td>${p.price}</td>
                                                <td>
                                                    <span id="amount_${p.id}">${p.amount}</span>
                                                </td>
                                                <td>
                                                    Enviado 
                                                </td> 
                                            </tr>`;
                                })
                            $('#tbody').append(body)
                            socket.emit('chat', datos.sendOrders)
                            // socket.emit('new_message', { 
                            //     name: data.name,
                            //     email: data.email,
                            //     subject: data.subject,
                            //     created_at: data.created_at,
                            //     id: data.id
                            // });
                            $('#send-kitchen').prop('disabled', true);
                        }
                        else{
                            console.log(datos)
                        }
                    });
                } catch (err) {
                    console.log("Error al realizar la petición AJAX: " + err.message);
                }
        
            
            // let table = $('#in_use').val();
            // alert("Es table "+table);
            // socket.emit('chat', table)
        });

        socket.on('chat', (msg)=>{
                // let item = document.createElement('li')
                // item.textContent = msg
                // mensaje.appendChild(item)
                // window.scrollTo(0, document.body.scrollHeight)
                alert(msg)
        })

        socket.on('hall', (msg)=>{
            // if(msg.id == 6){
            // }
            alert(msg.message)
                // let item = document.createElement('li')
                // item.textContent = msg
                // mensaje.appendChild(item)
                // window.scrollTo(0, document.body.scrollHeight)
                // alert(msg)
        })
        
    </script>   

    <script>

        const btn = document.querySelectorAll(".btnModal");
        const modalRegistro = document.querySelector("#exampleModal");
        //las opciones son opcional - puedes quitarlo
        const myModal = new bootstrap.Modal(modalRegistro);
        
        document.addEventListener("DOMContentLoaded", function(e){
            $('#send-kitchen').prop('disabled', true);
            btn.forEach(mod => {
                mod.addEventListener("click",function(e){
                    e.preventDefault()
                    let table = $(this).attr("id");//e.target.getAttribute("id");
                    $('#in_use').val(table);

                    try {
                    $('#tbody').empty();
                    let body = ''
                    var data = { table: table };
                    fetch(`check`, {
                        method: "POST",
                        headers: { 
                            'Content-Type': 'application/json',
                            "X-CSRF-Token": document.querySelector('input[name=_token]').value
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(datos => {
                        console.log(datos)
                        if(datos.ok){
                            for(let i of datos['orders']){
                                body += `<tr>
                                        <td>${i.name}</td>
                                        <td>${i.price}</td>
                                        <td>
                                            ${i.status != 2 ? `<button class="btn" id="btn_add_${i.id}" onclick="modifyAmount(${i.id}, 'add')"> + </button>` : ""}<span id="amount_${i.id}">${i.amount}</span> ${i.status != 2 ? `<button class="btn" onclick="modifyAmount(${i.id}, 'sub')"> - </button>` : ""}
                                        </td>
                                        <td>
                                            ${i.status != 2 ? `<button class="btn btn-info" onclick="eliminarFila(${i.id})"><i class="fa-solid fa-trash"></i></button>` : 'Enviado'}
                                        </td>
                                    </tr>`;
                                if(i.status == 1) {
                                    $('#send-kitchen').prop('disabled', false); 
                                }   
                            }
                            $('#tbody').append(body)
                        }
                        else{
                            $('#send-kitchen').prop('disabled', true);
                            console.log(datos)
                        }
                    });
                } catch (err) {
                    console.log("Error al realizar la petición AJAX: " + err.message);
                }

                    myModal.show();
                    
                })
            })
        })
        // $('#exampleModal').modal();
    </script>
    <script>
        let idSelect = null;
        let textSelect = null;
        let priceSelect = null;
        let table = document.getElementById('table')
        let tb_data = document.getElementById('tbody')

        let productos = new Array();
        let obj = {}
        let total = 0;

        $('.form-select').change(function(){
            idSelect = $(this).val();
            textSelect = $(this).find('option:selected').text();
            let getPrice = textSelect.split(' ').reverse();
            priceSelect  = getPrice[0];
        })

        $("#btn-add").click(function(){
            tb_data.innerHTML=''
            let table = $('#in_use').val();
            alert(table)
            let producto = {table:table, id:idSelect, name:textSelect, cantidad:1, price:priceSelect}
            total += producto.price * producto.cantidad 
            productos.push(producto) 
            var data = { order: producto };
            $('#tbody').empty();
            let body = ''
            fetch(`add_order`, {
                method: "POST",
                headers: { 
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(datos => {
                console.log(datos)
                if(datos.ok){
                    for(let i of datos['orders']){
                        body += `<tr>
                                        <td>${i.name}</td>
                                        <td>${i.price}</td>
                                        <td>
                                            ${i.status != 2 ? `<button class="btn" id="btn_add_${i.id}" onclick="modifyAmount(${i.id}, 'add')"> + </button>` : ""}<span id="amount_${i.id}">${i.amount}</span> ${i.status != 2 ? `<button class="btn" onclick="modifyAmount(${i.id}, 'sub')"> - </button>` : ""}
                                        </td>
                                        <td>
                                            ${i.status != 2 ? `<button class="btn btn-info" onclick="eliminarFila(${i.id})"><i class="fa-solid fa-trash"></i></button>` : 'Enviado'}
                                        </td>
                                    </tr>`;
                            }
                    $('#tbody').append(body)
                    $('#send-kitchen').prop('disabled', false);
                }else{
                    console.log(datos)
                }
            });

            // productos.forEach(p =>{
            //     let fila = document.createElement('tr')
            //     let td = document.createElement('td')
            //     td.innerText = p.name
            //     fila.appendChild(td)

            //     td = document.createElement('td')
            //     td.innerText = p.price
            //     fila.appendChild(td)

            //     td = document.createElement('td')
            //     // td.innerText = p.cantidad
            //     td.innerHTML = `<button class="btn" id="btn_add_${p.id}" onclick="addAmount(${p.id})"> + </button><span id="amount_${p.id}">${p.cantidad}</span><button class="btn" onclick="subAmount(${p.id})"> - </button>`
            //     fila.appendChild(td)

            //     td = document.createElement('td')
            //     td.innerHTML = `<button class="btn btn-info" onclick="eliminarFila(${p.id})"><i class="fa-solid fa-trash"></i></button>`
            //     fila.appendChild(td)
            //     tb_data.appendChild(fila)
            // })

            // table.appendChild(tb_data)
            console.log(productos)
            idSelect = null;
            textSelect = null;
            priceSelect = null;

            $('#dishe').val("")
            $('#dishe').change()
            $('#drink').val("")
            $('#drink').change()
            $('#fitting').val("")
            $('#fitting').change()
            $('#other').val("")
            $('#other').change()
        });

        $('.dishes-select').select2({
            dropdownParent: $('#exampleModal .modal-body')
        });
        $('.drinks-select').select2({
            dropdownParent: $('#exampleModal .modal-body')
        });
        $('.fittings-select').select2({
            dropdownParent: $('#exampleModal .modal-body')
        });
        $('.others').select2({
            dropdownParent: $('#exampleModal .modal-body')
        });
        
        $(document).ready(function() {

            // $('.service').click(function(){
            //     $('#product_val').empty('')
            //     let opt = '<option value="">Seleccione un Producto</option>';
            //     valor = $(this).attr('id')
            //     service_id = valor.substring(8);
                
            //     let items = articulos.filter(element => element.service_id == service_id )

                
            //     $.each(items, (index, value) =>{
            //         opt += `<option value="${value.id}">${value.name}<option>`
            //     });

            //     $('#product_val').append(opt)
            // })             
            
        });

        const modifyAmount = (id, op) =>{

            let amount = $("#amount_"+id).text();
                if(op == 'add')
                    amount ++;
                else
                    amount --;

            var data = { id: id, amount: amount }; 
            fetch(`modify_amount`, {
                method: "POST",
                headers: { 
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json()) 
            .then(datos => {
                console.log(datos)
                if(datos.ok){
                    $("#amount_"+id).text(amount.toFixed(2));
                }else{
                    alert("no se pudo aumentar ")
                    resul = (op === 'add' ? --amount : ++amount);
                    $("#amount_"+id).text(resul.toFixed(2));
                   
                }
            });   
        }

        

        const eliminarFila = (id) => {
            var data = { id: id };
            $('#tbody').empty();
            let body = ''
            fetch(`delete_order`, {
                method: "POST",
                headers: { 
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(datos => {
                console.log(datos)
                if(datos.ok){
                    for(let i of datos['orders']){
                        body += `<tr>
                                    <td>${i.name}</td>
                                    <td>${i.price}</td>
                                    <td>
                                        ${i.status != 2 ? `<button class="btn" id="btn_add_${i.id}" onclick="modifyAmount(${i.id}, 'add')"> + </button>` : ""}<span id="amount_${i.id}">${i.amount}</span> ${i.status != 2 ? `<button class="btn" onclick="modifyAmount(${i.id}, 'sub')"> - </button>` : ""}
                                    </td>
                                    <td>
                                        ${i.status != 2 ? `<button class="btn btn-info" onclick="eliminarFila(${i.id})"><i class="fa-solid fa-trash"></i></button>` : 'Enviado'}
                                    </td>
                                </tr>`;
                    }
                    $('#tbody').append(body)
                    // $('#send-kitchen').prop('disabled', false);
                }else{
                    console.log(datos)
                }
            });
            // let indiceDeTres = productos.indexOf(id);
            // const filtrados = productos.filter(item => item.id != id)
            // // console.log(filtrados)
            // // console.log(carro)
            // productos = [...filtrados];
            // console.log(productos)
            // recorrer()
        }

        function recorrer(){
            // let tb_datos = document.getElementById('tbody')
            $('#tbody').empty();
            let body = ''
            productos.forEach(p =>{
                body += `<tr>
                            <td>${p.name}</td>
                            <td>${p.price}</td>
                            <td>
                                <button class="btn" id="btn_add_${p.id}" onclick="modifyAmount(${i.id}, 'add')"> + </button><span id="amount_${p.id}">${p.cantidad}</span><button class="btn" onclick="modifyAmount(${i.id}, 'sub')"> - </button>
                            </td>
                            <td>
                                <button class="btn btn-info" onclick="eliminarFila(${p.id})"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>`;
            })
            $('#tbody').append(body)
        }

        function save(){

            var pay=1;
            var customer_id = $('#customer_id option:selected').val();
            var doc_id = $('#document option:selected').val();
            

            if (customer_id == "") {
                $('.error1').text("Seleccione el cliente");
                // return false;
            } else if (doc_id == "") {
                $('.error2').text("Seleccione el tipo de comprobante");
                // return false;
            } else {
                $('.errors').hide();
            }

            try {
                if(productos.length > 0){
                    obj = {...productos}
                }
                else{
                    $('.msj').show();
                    $('.msj').text('No hay productos o servicios agregados aun');
                    setTimeout(function() {
                        $('.msj').text('');
                        $(".msj").hide();
                    },3000);
                    return false;
                }

                pay =$('input[name=pay]:checked').val();
                
                obj['customer'] = customer_id;
                obj['document'] = doc_id;
                obj['total'] = parseFloat(total);
                obj['pay_type'] = pay;
                console.log(obj);
                $('.loader').show();

                fetch(`save`, {
                    method: "POST",
                    headers: { 
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": document.querySelector('input[name=_token]').value
                    },
                    body: JSON.stringify(obj)
                })
                .then(response => response.json())
                .then(datos => {
                    // console.log(datos)
                    if(datos.ok){
                    // window.location.href = `show_document/${datos.code}`;
                    window.location.replace(`show_document/${datos.code}`);
                    // window.location=`http://localhost/erpf/origin2/public/venta/show_document/${datos.code}`
                    }
                    else{
                    console.log(datos)
                    }
                
                });
            } catch (err) {
                console.log("Error al realizar la petición AJAX: " + err.message);
            }
        }
    //         // Creamos un array vacio
// var ElementosClick = new Array();
// // Capturamos el click y lo pasamos a una funcion
// document.onclick = captura_click;

// function captura_click(e) {
// // Funcion para capturar el click del raton
// var HaHechoClick;
// if (e == null) {
// // Si hac click un elemento, lo leemos
// HaHechoClick = event.srcElement;
// } else {
// // Si ha hecho click sobre un destino, lo leemos
// HaHechoClick = e.target;
// }
// // Añadimos el elemento al array de elementos
// ElementosClick.push(HaHechoClick);
// // Una prueba con salida en consola
// // console.log("Contenido sobre lo que ha hecho click: "+clickedElement.innerHTML);

// console.log("Contenido sobre lo que ha hecho click: "+ ElementosClick.innerHTML);
// }


// const addAmount = (id)=>{
//             let amount = $("#amount_"+id).text();
//             amount ++
//             var data = { id: id, amount: amount };
//             $('#tbody').empty();
//             let body = ''
//             fetch(`modify_amount`, {
//                 method: "POST",
//                 headers: { 
//                     'Content-Type': 'application/json',
//                     "X-CSRF-Token": document.querySelector('input[name=_token]').value
//                 },
//                 body: JSON.stringify(data)
//             })
//             .then(response => response.json())
//             .then(datos => {
//                 console.log(datos)
//                 if(datos.ok){
//                     for(let i of datos['orders']){
//                         body += `<tr>
//                                     <td>${i.name}</td>
//                                     <td>${i.price}</td>
//                                     <td>
//                                         ${i.status != 2 ? `<button class="btn" id="btn_add_${i.id}" onclick="addAmount(${i.id})"> + </button>` : ""}<span id="amount_${i.id}">${i.amount}</span> ${i.status != 2 ? `<button class="btn" onclick="subAmount(${i.id})"> - </button>` : ""}
//                                     </td>
//                                     <td>
//                                         ${i.status != 2 ? `<button class="btn btn-info" onclick="eliminarFila(${i.id})"><i class="fa-solid fa-trash"></i></button>` : 'Enviado'}
//                                     </td>
//                                 </tr>`;
//                     }
//                     $('#tbody').append(body)
//                     // $('#send-kitchen').prop('disabled', false);
//                 }else{
//                     console.log(datos)
//                 }
//             });
//             $("#amount_"+id).text(amount);
//         }


// const addAmount = (id)=>{
        //     let amount = $("#amount_"+id).text();
        //     amount ++;  
        //     var data = { id: id, amount: amount };
        //     // $('#tbody').empty();
        //     // let body = ''
        //     fetch(`modify_amount`, {
        //         method: "POST",
        //         headers: { 
        //             'Content-Type': 'application/json',
        //             "X-CSRF-Token": document.querySelector('input[name=_token]').value
        //         },
        //         body: JSON.stringify(data)
        //     })
        //     .then(response => response.json())
        //     .then(datos => {
        //         console.log(datos)
        //         if(datos.ok){
        //             $("#amount_"+id).text(amount.toFixed(2));
        //         }else{
        //             console.log(datos)
        //             $("#amount_"+id).text(amount--);
        //             alert("no se pudo")
        //         }
        //     }); 
        // }

        // const subAmount = (id)=>{
        //     let amount = $("#amount_"+id).text();
        //     amount --
        //     var data = { id: id, amount: amount };
        //     // $('#tbody').empty();
        //     // let body = ''
        //     fetch(`modify_amount`, {
        //         method: "POST",
        //         headers: { 
        //             'Content-Type': 'application/json',
        //             "X-CSRF-Token": document.querySelector('input[name=_token]').value
        //         },
        //         body: JSON.stringify(data)
        //     })
        //     .then(response => response.json())
        //     .then(datos => {
        //         console.log(datos)
        //         if(datos.ok){
        //             $("#amount_"+id).html(amount.toFixed(2));
        //         }else{
        //             console.log(datos)
        //             $("#amount_"+id).text(amount++);
        //             alert("no se pudo")
        //         }
        //     });
        //     // $("#amount_"+id).text(amount);
        // }



    </script>
</html>