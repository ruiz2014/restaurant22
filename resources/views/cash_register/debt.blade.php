<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @if($type == 2)
    <style>
        @page{
        margin-top: 1em;
        margin-left: 0.5em;
        margin-right: 0.5em;
    }
    body{
        font-size: 7px;
        font-family: "sans-serif";
    }
    table{
        border-collapse: collapse;
    }
    td{
        font-size: 7px;
    }
    </style>
    @endif
</head>
<body>
    <table style="width:100%">
        <tr>
            <td>Detalle</td>
            <td>P. Uni</td>
            <td>Cant.</td>
            <td>Monto</td>
        </tr>
        <tbody>
        @foreach($temps as $temp)    
            <tr>
                <td class="item_name">{{ $temp->product->name }}</td>
                <td class="text-right">{{ $temp->price }} S/.</td>
                <td class="text-right">{{ $temp->amount }}</td>
                <td class="text-right">{{ $temp->price * $temp->amount }} S/.</td>
            </tr>
        @endforeach  
        <tr>
            <td colspan="2"></td>
            <td >Total</td>
            <td >{{ $total }}</td>
        </tr> 
        </tbody>
    </table>
</body>
</html>