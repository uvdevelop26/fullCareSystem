<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    * {
        font-size: 1rem;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        padding: 0px 70px;
    }

    .header-container {
        position: relative;
        padding-top: 30px;
        padding-bottom: 15px;
        margin-bottom: 10px;
        border-bottom: 1px solid gray;
    }

    .header-text {
        text-align: right;
        padding-top: 25px;
        color: rgb(124, 118, 118);
        font-style: italic;
        font-size: 13px
    }

    .header-img {
        overflow: hidden;
        position: absolute;
        left: 0;
        top: 0;
    }

    img {
        width: 85px;
        height: 85px;
    }

    .titulos {
        font-size: 15px;
        text-transform: uppercase;
    }

    /*HEADER*/
    .div-1Header,
    .div-1Datos {
        width: 100%;
    }



    .datos-grales-td,
    .receptor {
        width: 50%;
    }

    .table_h_factura {
        width: 50%;
        height: 10px;
        background-color: #FFF;
        width: 100%;
        margin: 0px;
        padding: 0px;
    }

    .headerDatosh {
        text-align: center;
        color: #4d4d53;
        padding: 5px;
        /*   background-color: #6C63FF; */
    }

    .table_h_factura tr td p {
        margin: 0px;
        padding: 2px;
        text-align: left;
        padding-right: 5px;
    }

    /*DATOS*/
    .table_receptor,
    .table_datos {
        width: 42%;
        height: 100px;
        background-color: rgba(243, 243, 243, 0.521);
        width: 100%;
        margin: 0px;
        padding: 10px;
        border-radius: 5px;
    }

    .table_receptor tr td p {
        margin: 0px;
        padding: 2px;
        text-align: left;
    }

    .tituloRec {
        color: #6C63FF;
    }

    .table_datos tr td p {
        margin: 0px;
        padding: 2px;
        text-align: left;
    }

    /*MATERIALES*/
    .table_materiales {
        width: 100%;
        /*  margin-top: 10px; */
        margin-bottom: 10px;
    }

    .table_materiales thead tr {
        background-color: #6C63FF;
        color: #FFF;
    }

    .table_materiales .capitalize {
        text-transform: capitalize;
    }

    .table_materiales thead tr td {
        padding: 5px;
        text-align: center;
        font-size: 14px;
    }

    .table_materiales tr td {
        text-align: center;
        padding: 5px;
        border-bottom: 1px solid rgba(20, 20, 20, 0.096);
    }

    /*DATOS FINALES*/
    .table_datosFtxt {
        width: 70%;
        height: 100px;
        width: 100%;
        margin: 0px;
    }

    .datosFinales {
        width: 30%;
    }

    .datosFinales .table_datosfinales {
        width: 42%;
        height: 100px;
        width: 100%;
        margin: 0px;
        padding: 10px;
        border: 1px solid rgba(20, 20, 20, 0.096);
    }

    .datosFinales .table_datosfinales tr td p {
        margin: 0px;
        padding: 2px;
        text-align: left;
    }

    /*FIRMA*/
    /* .firma {
        border-top: 1px solid rgba(20, 20, 20, 0.5);
        text-align: center;
        width: 30%;
        margin-left: 70%;
        margin-top: 80px;
        padding-top: 5px;
    }

    /*FOOTER*/
    /*  footer {
        width: 100%;
        text-align: center;
        position: absolute;
        bottom: 0px;
    } */
</style>

<body>
    <div class="container">
        <div class="header-container">
            <div class="header-img">
                <img src="storage/image/hogar de Ancianos.png" alt="logo">
            </div>
            <p class="header-text">
                Hogar de Ancianos "Virgen del Rosario"
            </p>
        </div>
        {{-- table 1 --}}
        <table class="div-1Header">
            <tr>
                <td class="datos-grales-td">
                    <table class="table_h_factura">
                        <thead>
                            <th class="headerDatosh titulos">
                                <span class="titulos">Listado de Empleados - Hogar de Ancianos "Virgen del
                                    Rosario"</span>
                            </th>
                        </thead>
                    </table>
                </td>
            </tr>
        </table>
        {{-- table 2 --}}
        <table class="table_materiales">
            <thead>
                <tr>
                    <td>Nombre y Apellido</td>
                    <td>Cédula</td>
                    <td>Teléfono</td>
                    <td>Edad</td>
                    <td>Sexo</td>
                    <td>Dirección</td>
                    <td>Fecha Ingreso</td>
                    <td>Correo</td>
                    <td>Seccion</td>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $item)
                <tr>
                    <td>{{ $item->persona->nombres}} {{ $item->persona->apellidos}}</td>
                    <td>{{ $item->persona->ci_numero}}</td>
                    <td>{{ $item->persona->telefono}}</td>
                    <td>{{ $item->persona->edad}}</td>
                    <td>{{ $item->persona->sexo}}</td>
                    <td class="capitalize">{{ $item->persona->ciudade->nombre_ciudad}}</td>
                    <td>{{ $item->fecha_inicio}}</td>
                    <td>{{$item->email}}</td>
                    <td class="capitalize">{{$item->seccion->nombre_seccion}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- tabla datos finales --}}
        <table class="div-1Datos">
            <tr>
                <td class="">
                    <table class="table_datosFtxt">
                        <tr>
                            <td>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum maxime eos minus
                                    illum dignissimos voluptas? Expedita optio eligendi hic pariatur quisquam ratione,
                                    ipsam ipsa temporibus perspiciatis, alias iure sequi sit.</p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="datosFinales">
                    <table class="table_datosfinales">
                        <tr>
                            <td>
                                <p>
                                    Cantidad
                                </p>
                            </td>
                            <td>
                                <p>
                                    fa
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Cantidad Activos
                                </p>
                            </td>
                            <td>
                                <p>
                                    fasdf
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Cantidad Inactivos
                                </p>
                            </td>
                            <td>
                                <p>
                                    fad
                                </p>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>