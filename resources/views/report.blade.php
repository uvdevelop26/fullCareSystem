<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Historial Clínico</title>

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
            text-align: left;
            float: left;
            overflow: hidden;
            position: absolute;
            left: 0;
            top: 0;
        }

        img {
            width: 85px;
            height: 85px;
        }

        .head-1 {
            text-align: center;
            font-size: 1.5rem;
            padding: 10px 0px;
        }

        .text-date {
            text-align: center;
            color: rgb(124, 118, 118);
            font-style: italic;
        }

        .sub-title {
            padding: 15px 0px;
            text-decoration: underline;
        }

        .parrafo {
            padding: 4px 0px
        }

        ul li {
            padding: 5px 0;
        }

        ul li .historia-info {
            width: 200px;
            display: inline-block;
        }

        ul li .historia-data {
            display: inline-block;
        }

        .enfermedades-ul {
            padding: 5px 0 0 10px;
            text-transform: capitalize;
            list-style: none;
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

        <h1 class="head-1">Historial Clínico</h1>

        <p class="text-date">
            <span>Fecha: {{ $historiale->fecha_registro}}</span>
        </p>

        <h2 class="sub-title">Datos Personales</h2>
        <ul>
            <li>
                <div class="historia-info"> Numero de Historia: </div>
                <div class="historia-data">{{$historiale->id}}</div>
            </li>
            <li>
                <div class="historia-info">Cédula:</div>
                <div class="historia-data">{{ $persona->ci_numero}}</div>
            </li>
            <li>
                <div class="historia-info">Nombres:</div>
                <div class="historia-data">{{ $persona->nombres}}</div>
            </li>
            <li>
                <div class="historia-info">Apellidos:</div>
                <div class="historia-data">{{ $persona->apellidos }}</div>
            </li>
            <li>
                <div class="historia-info">Sexo:</div>
                <div class="historia-data">{{ $persona->sexo }}</div>
            </li>
            <li>
                <div class="historia-info">Nacimiento:</div>
                <div class="historia-data">{{ $persona->fecha_nacimiento }}</div>
            </li>
            <li>
                <div class="historia-info">Dirección: </div>
                <div class="historia-data">{{ $persona->direccion }}</div>
            </li>
        </ul>
        <h2 class="sub-title">Valoración Inicial</h2>
        <ul>
            <li>
                <div class="historia-info"> Peso: </div>
                <div class="historia-data">{{ $caracteristica->peso }} kg</div>
            </li>
            <li>
                <div class="historia-info"> Altura:</div>
                <div class="historia-data">{{ $caracteristica->altura }} cm.</div>
            </li>
            <li>
                <div class="historia-info">Temperatura:</div>
                <div class="historia-data">{{ $caracteristica->temperatura }} C°</div>
            </li>
            <li>
                <div class="historia-info"> Presión Arterial:</div>
                <div class="historia-data">{{ $caracteristica->presion_arterial }} mmHg</div>
            </li>
        </ul>


        <h2 class="sub-title">Valoración médica</h2>

        <p>Se realizó valoración médica al residente {{ $persona->nombres }} {{ $persona->apellidos}} de {{
            $persona->edad
            }} años de edad, con fecha de ingreso a la institución {{
            $residente->fecha_ingreso }}.</p>
        <br>
        <p>El residente actualmente padece de las siguientes enfermedades:</p>
        <ul class="enfermedades-ul">
            @foreach($historialeHasEnfermedade as $item)
            <li class="enfermedades-li">{{ $item->nombre}}</li>
            @endforeach

        </ul>
        <p>Se han realizado las siguientes valoraciones médicas:</p>

        <ul>
            <li>
                Diagnóstico general: {{ $historiale->diagnostico}}
            </li>
            <li>
                Tratamiento: {{ $historiale->tratamiento }}
            </li>
            <li>
                Observaciones: {{ $historiale->observaciones}}
            </li>
        </ul>
        <!--FIRMA-->
        <div class="firma">
            Firma del Médico
        </div>
        {{-- FOOTER --}}
        <footer>
            <p> Impreso por {{ $users->username }} en fecha {{ $fechaActual }}</p>
        </footer>
    </div>
</body>

</html>