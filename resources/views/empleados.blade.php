<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empleados</title>
</head>
<style>
    @page {
        margin: 2.5cm 2cm 0.5cm 2cm;
        padding: 0;
    }

    * {
        font-size: 1rem;
    }

    .header {
        position: fixed;
        top: -2.5cm;
        left: 0;
        border-bottom: 1px solid rgb(124, 118, 118);
    }

    .header-container {
        width: 100%;
        position: relative;
        padding: 10px 0px;
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

    .header-text {
        width: 1000px;
        text-align: right;
        padding-top: 25px;
        color: rgb(124, 118, 118);
        font-style: italic;
        font-size: 13px
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

    /*FOOTER*/
    footer {
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        width: 100%;
    }

    footer p {
        /* padding: 10px 85px; */
        text-align: right;
        color: rgb(124, 118, 118);
        font-style: italic;
    }
</style>

<body>
    <div class="header">
        <div class="header-container">
            <div class="header-img">
                <img src="storage/image/hogar de Ancianos.png" alt="logo">
            </div>
            <p class="header-text">
                Hogar de Ancianos "Virgen del Rosario"
            </p>
        </div>
    </div>
    <div class="container">

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
                                <p></p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="datosFinales">
                    <table class="table_datosfinales">
                        <tr>
                            <td>
                                <p>
                                    Enfermeros:
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{ $cantidadEnfermeros }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Administradores:
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{ $cantidadAdministrador }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Staff:
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{ $cantidadStaff }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Total:
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{ $cantidadEmpleados }}
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <footer>
            <p> Impreso por {{ $users->username }} en fecha {{ $fechaActual }}</p>
        </footer>
    </div>
</body>

</html>