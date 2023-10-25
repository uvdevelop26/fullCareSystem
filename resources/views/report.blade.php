<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Historial Clínico</title>

    <style>
        * {
            font-size: 1rem
        }

        h1 {
            text-align: center;
            font-size: 1.5rem;
            text-decoration: underline
        }

        .text {
            font-weight: bold;
            text-align: center;

        }

        h2 {
            font-size: 1.5rem;
            text-decoration: underline;
        }

        li {
            list-style: inside;
            padding: 5px 0;
        }

        span {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <h1>Historial Clínico</h1>
    <p class="text">Hogar de Ancianos "Virgen del Rosario" <span>fecha: {{ $historiale->fecha_registro}} </span> </p>
    <h2>Datos Personales</h2>
    <ul>
        <li>
            Numero de Historia: <span>{{$historiale->id}}</span>
        </li>
        <li>
            Cédula: <span>{{ $persona->ci_numero}}</span>
        </li>
        <li>
            Nombres: <span>{{ $persona->nombres}}</span>
        </li>
        <li>
            Apellidos: <span> {{ $persona->apellidos }}</span>
        </li>
        <li>
            Sexo: <span> {{ $persona->sexo }} </span>
        </li>
        <li>
            Nacimiento: <span> {{ $persona->fecha_nacimiento }}</span>
        </li>
        <li>
            Dirección: <span> {{ $persona->direccion }} </span>
        </li>
    </ul>
    <h2 class="sub-title">Valoración Inicial</h2>
    <ul>
        <li>
            Peso: <span>{{ $caracteristica->peso }} kg</span>
        </li>
        <li>
            Altura: <span>{{ $caracteristica->altura }} cm.</span>
        </li>
        <li>
            Temperatura: <span>{{ $caracteristica->temperatura }} C°</span>
        </li>
        <li>
            Presión Arterial: <span>{{ $caracteristica->presion_arterial }}</span>
        </li>
    </ul>


    <h2 class="sub-title">Valoración médica</h2>

    <p>Se realizó valoración médica al residente {{ $persona->nombres }} {{ $persona->apellidos}} de {{ $persona->edad
        }} años de edad, con fecha de ingreso a la institución {{
        $residente->fecha_ingreso }} padece de las siguientes enfermedades:
        @foreach($historialeHasEnfermedade as $item)
        <span>
            {{ $item->nombre}}
        </span>
        @endforeach
        . Se han realizado las siguientes valoraciones médicas:
    </p>
    {{-- <ul>

        <li>{{ $item->nombre }}</li>

    </ul>
    --}}

    <ul>
        <li>
            Diagnóstico general: <span>{{ $historiale->diagnostico}}</span>
        </li>
        <li>
            Tratamiento: <span>{{ $historiale->tratamiento }}</span>
        </li>
        <li>
            Observaciones: <span>{{ $historiale->observaciones}}</span>
        </li>
    </ul>
</body>

</html>