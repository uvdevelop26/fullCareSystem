<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
        width: 100%;
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
        height: 50px;
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
    .firma {
        border-top: 1px solid rgba(20, 20, 20, 0.5);
        text-align: center;
        width: 30%;
        margin-left: 70%;
        margin-top: 80px;
        padding-top: 5px;
    }

    /*footer*/
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
                                <span class="titulos">Sueldos Pagados en el mes de {{ $nombreMes }}</span>
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
                    <td>Nombres</td>
                    <td>Apellidos</td>
                    <td>Cédula</td>
                    <td>Sección</td>
                    <td>Fecha</td>
                    <td>Monto</td>
                </tr>
            </thead>
            <tbody>
                @foreach($sueldos as $item)
                <tr>
                    <td>{{ $item->empleado->persona->nombres }}</td>
                    <td>{{ $item->empleado->persona->apellidos }}</td>
                    <td>{{ $item->empleado->persona->ci_numero }}</td>
                    <td>{{ $item->empleado->seccion->nombre_seccion }}</td>
                    <td>{{ $item->fecha }}</td>
                    <td>{{ $item->monto }} Gs.</td>
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
                                    Total Pagado
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{ $totalSueldos }} Gs.
                                </p>
                            </td>
                        </tr>
                        {{-- <tr>
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
                        </tr> --}}
                        {{-- <tr>
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
                        </tr> --}}

                    </table>
                </td>
            </tr>
        </table>
        {{-- firma --}}
        <div class="firma">
            Firma
        </div>
        {{-- footer --}}
        <footer>
            <p> Impreso por {{ $users->username }} en fecha {{ $fechaActual }}</p>
        </footer>
    </div>
</body>

</html>