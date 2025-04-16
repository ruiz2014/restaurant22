@extends('layouts.app')

@section('template_title')
    Cocina
@endsection


@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" /> -->
    <!-- <link href=" https://cdn.jsdelivr.net/npm/ionicons@7.4.0/dist/collection/components/icon/icon.min.css " rel="stylesheet"> 
    <script type="module" src="https://unpkg.com/ionicons@latest/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@latest/dist/ionicons/ionicons.js"></script> -->
    <style>
        /* .mesa{
            border:solid 1px red;
        } */
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
        .crono{
            margin:0;
        }
        .center{
            text-align:center;
        }
        .ready td{
            color:#9d9f9f !important;
        }
    </style>
@endpush

<!-- <body class="" onload="miTime();"> -->


@section('content')
    <audio id="notif_audio">
        <source src="{!! asset('sounds/cocina.ogg') !!}" type="audio/ogg">
        <source src="{!! asset('sounds/cocina.mp3') !!}" type="audio/mp3">
        <source src="{!! asset('sounds/cocina.wav') !!}" type="audio/wav">
    </audio>
    <div class="container mt-4">
        <div class="row">
        
            <div class="table-responsive">
                @csrf
                <table id="mytable" class="table table-bordred table-striped">
                    <thead>
                        <th>Mesa <ion-icon name="checkmark-outline" style="font-size:30px;color:red;"></ion-icon></th>
                        <th>Ambiente</th>
                        <th>Orden</th>
                        <th>Cantidad</th>
                        <th>Nota</th>
                        <th class="text-center">Estado</th>
                    </thead>
                
                    <tbody id="message-tbody">
                @foreach($orders as $order)
                        <tr class="{{ $order->status >= 3 ? 'ready' : '' }}">
                            <td>{{$order->identifier }}</td>
                            <td>{{$order->room }}</td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->amount}}</td>
                            <td>{{$order->note}}</td>
                            <td class="text-center">
                                <button id="{{$order->id}}" data-status="{{$order->status}} " class="status btn btn-outline-info"><ion-icon name="{{ $order->status >= 3 ? 'checkmark-outline' : 'hourglass-outline' }}"></ion-icon></button>
                                <p class="{{ $order->status >= 3 ? '' : 'crono' }}" data-time="{{ $order->created_at }}"></p>
                            </td>
                        </tr>
                @endforeach    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.js"></script>
<!-- <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script> -->
<!-- <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script> -->

<!-- <script>
    function mueveReloj(){
        momentoActual = new Date()
        hora = momentoActual.getHours()
        minuto = momentoActual.getMinutes()
        segundo = momentoActual.getSeconds()

        horaImprimible = hora + " : " + minuto + " : " + segundo

        let elementos = document.querySelectorAll('input[name="reloj"]');
        var numElementos = elementos.length;
        for (var i = 0; i < numElementos; i++) { 
            // if (elementos[i].style.backgroundColor != "red") {
            // elementos[i].style.backgroundColor = "red";
            // break;
            // }
            elementos[i].value = horaImprimible
        }
        // document.form_reloj.reloj.value = horaImprimible

        setTimeout("mueveReloj()",1000)
    }

</script> -->
<script>
    //  $('#notif_audio')[0].play();
    //     let elementos = document.querySelectorAll('input[name="reloj"]');
    //     elementos.forEach(function(element){
    //     element.addEventListener("load", function () {
    //         // element.parentNode.style.background = element.value;
    //     });
    // })
    function siSale(id){
        console.log("a ver");
        alert("salio")
    }

    function miTime(){

/*******************shipping time tiene que guardarse la hora de envio y esa ser leida*********************/

        let elementos = document.querySelectorAll('.crono');
        elementos.forEach(function(element){
            let timeD= element.getAttribute('data-time');
            momentoActual = new Date(timeD)
            // minuto = momentoActual.getMinutes()
            // segundo = momentoActual.getSeconds()
            // horaImprimible = minuto + " : " + segundo

            const endDate = Date.now(); // Current date and time in milliseconds
            // Calculate the time difference in milliseconds
            const timeDifferenceMS = endDate - momentoActual;

            const timeDifferenceSecs = Math.floor(timeDifferenceMS / 1000);
            // const timeDifferenceMins = Math.floor(timeDifferenceMS / 60000);

            // console.log(`Time difference in seconds: ${timeDifferenceSecs}`);
            // console.log(`Time difference in minutes: ${timeDifferenceMins}`);

            // const timeString = `${hours}:${minutes}:${seconds}`;
            // element.addEventListener("load", function () {
            //     let timeD= elemento.getAttribute('data-id');
            //     // element.parentNode.style.background = element.value;
            // });
            // alert(horaImprimible);
            let minut = Math.trunc(timeDifferenceSecs / 60); // 13
            // console.log(minut)
            element.innerText = `${minut} Minutos`;
            setTimeout("miTime()",1000)
            
        })
    }

    

</script>


<script type="module"> 

    import { io } from "https://cdn.socket.io/4.7.5/socket.io.esm.min.js";
    // const socket = io('https://chapi.nafer.com.pe');
    const socket = io('http://localhost:3000');
    
    
    
    $('#aver').click(function(){
        alert("hola");
        socket.emit('chat', 'hola este es ')
    })

    socket.on('chat', (msg)=>{
        
        if (!msg.hasOwnProperty('message')) {
            notify("LLego un articulo para su preparacion...");
            $('#notif_audio')[0].play();
        }
        // $('#notif_audio')[0].play();
            let body = ''
            // alert('llego')
            // console.log(msg)
            msg.forEach(p =>{
                body += `<tr>
                            <td>${p.identifier}</td>
                            <td>${p.room}</td>
                            <td>${p.name}</td>
                            <td>${p.amount}</td>
                            <td>${p.note == null ? '' : p.note}</td>
                            <td class="text-center">
                                <button id="${p.id}" class="status btn btn-outline-danger"><ion-icon name="hourglass-outline"></ion-icon></button>
                                <p class="crono" data-time="${p.created_at}"></p>
                            </td> 
                        </tr>`;
            })
            $('#message-tbody').prepend(body)
            miTime()
    })

    $(document).on('click', '.status', function(){
        let temp_id = $(this).attr('id')
        
        var data = { id: temp_id };
        fetch(`dish_ready`, {
            method: "POST",
            headers: { 
                'Content-Type': 'application/json',
                "X-CSRF-Token": document.querySelector('input[name=_token]').value
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(datos => {
            // console.log(datos)
            if(datos.ok){
                socket.emit('hall', datos)
                location.reload();
            }
            
        })
        // alert(temp_id);
    })

    // function notify(){
    //     if (!("Notification" in window)) {
    //         alert(
    //         "Este navegador no es compatible con las notificaciones de escritorio",
    //         );
    //     }

    //     // Comprobamos si los permisos han sido concedidos anteriormente
    //     else if (Notification.permission === "granted") {
    //         // Si es correcto, lanzamos una notificación
    //         var img = "https://cvbox.org/_next/image?url=%2Fimages%2Flogo.png&w=256&q=75";
    //         var text = '¡OYE! Atiende la mesa pedaso de mierda...';
    //         var notification = new Notification("¡Hola normal!", {
    //                 body: text,
    //                 icon: img,
    //         });
    //     }

    //     // Si no, pedimos permiso para la notificación
    //     else if (Notification.permission !== "denied") {
    //         var img = "https://cvbox.org/_next/image?url=%2Fimages%2Flogo.png&w=256&q=75";
    //         var text = '¡OYE! Tu tarea ahora está vencida.';
    //         Notification.requestPermission().then(function (permission) {
    //         // Si el usuario nos lo concede, creamos la notificación
    //         if (permission === "granted") {
    //             var notification = new Notification("¡Hola al solicitar!", {
    //                 body: text,
    //                 icon: img,
    //             });
    //         }
    //         });
    //     }
    // }

    // function eliminarFila(id, status){
    //     alert("Joder tio");
    // }

    // function updateClock() {
    //     const now = new Date();
    //     const hours = String(now.getHours()).padStart(2, "0");
    //     const minutes = String(now.getMinutes()).padStart(2, "0");
    //     const seconds = String(now.getSeconds()).padStart(2, "0");

    //     const timeString = `${hours}:${minutes}:${seconds}`;

    //     document.getElementById("clock").innerText = timeString;
    // }

    // setInterval(updateClock, 1000);

    // function mueveReloj(){
    //     momentoActual = new Date()
    //     hora = momentoActual.getHours()
    //     minuto = momentoActual.getMinutes()
    //     segundo = momentoActual.getSeconds()

    //     horaImprimible = hora + " : " + minuto + " : " + segundo

    //     // let elementos = document.querySelectorAll('input[name="reloj"]');
    //     // var numElementos = elementos.length;
    //     // for (var i = 0; i < numElementos; i++) { 
    //     //     // if (elementos[i].style.backgroundColor != "red") {
    //     //     // elementos[i].style.backgroundColor = "red";
    //     //     // break;
    //     //     // }
    //     //     elementos[i].value = horaImprimible
    //     // }
    //     document.form_reloj.reloj.value = horaImprimible

    //     setTimeout("mueveReloj()",1000)
    // }
    


</script>           
@endpush