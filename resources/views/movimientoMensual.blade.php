<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movimientos Mensuales</title>
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
            height: 150px;
            background-color: #FFF;
            width: 100%;
            margin: 0px;
            padding: 0px;
        }

        .headerDatosh {
            text-align: center;
            color: #FFF;
            padding: 5px;
            background-color: #6C63FF;
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
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .table_materiales thead tr {
            background-color: #6C63FF;
            color: #FFF;
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
        .firma {
            border-top: 1px solid rgba(20, 20, 20, 0.5);
            text-align: center;
            width: 30%;
            margin-left: 70%;
            margin-top: 80px;
            padding-top: 5px;
        }

        /*FOOTER*/
        footer {
            width: 100%;
            text-align: center;
            position: absolute;
            bottom: 0px;
        }

        footer p {
            padding: 10px 85px;
            text-align: right;
            color: rgb(124, 118, 118);
            font-style: italic;
        }
    </style>

</head>

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
        <table class="div-1Header">
            <tr>
                <td class="datos-grales-td">
                    <table class="table_h_factura">
                        <thead>
                            <th class="headerDatosh titulos">Movimiento Financiero mes de: <span
                                    class="titulos">{{$mes}}</span></th>
                        </thead>
                        <tr>
                            <td class="titulos">
                                <p class="titulos">Hogar de Ancianos Virgen del Rosario</p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>TELEFONO: <span>5897485106</span> </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>E-MAIL: <span>hogarvdelRosario@gmail.com</span> </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--DATOS-->

        <!--MATERIAL/PRODUCTO-->
        <table class="table_materiales">
            <thead>
                <tr>
                    <td>Concepto</td>
                    <td>Fecha</td>
                    <td>Ingreso</td>
                    <td>Egreso</td>
                </tr>
            </thead>
            <tbody>
                @foreach($movimientosMensuales as $item)
                <tr>
                    <td>{{ $item->concepto}}</td>
                    <td>{{ $item->fecha}}</td>
                    <td>{{ $item->monto_ingreso}}</td>
                    <td>{{ $item->monto_egreso}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!--DATOS FINALES-->
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
                                    Total Ingresos:
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{ $totalIngresosMensuales }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Total Egresos:
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{ $totalEgresosMensuales }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Diferencia:
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{$diferencia}}
                                </p>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
        <!--FIRMA-->
        <div class="firma">
            Firma
        </div>
        <!--FOOTER-->
        <footer>
            <p> Impreso por {{ $users->username }} en fecha {{ $fechaActual }}</p>
        </footer>
    </div>

</body>

</html>