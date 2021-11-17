<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Licencias</title>
    <style>
        #const {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #const td,
        #const th {
            border: 1px solid #ddd;
            padding: 8px;

        }

        #const th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #555755;
            color: #fff;

        }

    </style>
</head>

<body>
    @foreach ($departamentos as $dep)
                <h4 align="center">
                    Universidad de El Salvador<br>
                    Facultad Multidisciplinaria Paracentral <br>
                    Departamento: {{ $dep->nombre_departamento }}

                    <br>

                </h4>
        
                <table id="const" class="table">
                    <thead>
                        <tr>
                            <th class="col-sm-2">Nombre</th>
                            <th class="col-xs-1">Tipo</th>
                            <th class="col-xs-1">Fecha Presentación</th>
                            <th class="col-xs-1">Fecha Aceptación</th>
                            <th class="col-xs-1">Hora Incio</th>
                            <th class="col-xs-1">Hora Final</th>
                            <th class="col-xs-2">Tiempo Utilizar</th>
                            <th class="col-sm-2">Justificación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permisos as $item)
                        @if ($dep->id==$item->id_depto)
                       
                        <tr>
                            <td>{{ $item->nombre }}{{ ' ' }}{{ $item->apellido }}</td>
                            <td>{{ $item->tipo_permiso }}</td>
                            <td>{{ Carbon\Carbon::parse($item->fecha_presentacion)->format('d/M/Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($item->updated_at)->format('d/M/Y') }}</td>
                            <td>{{ date('H:i', strtotime($item->hora_inicio)) }}</td>
                            <td>{{ date('H:i', strtotime($item->hora_final)) }}</td>
                            <td>{{ '' . \Carbon\Carbon::parse($item->fecha_uso . 'T' . $item->hora_inicio)->diffAsCarbonInterval(\Carbon\Carbon::parse($item->fecha_uso . 'T' . $item->hora_final)) }}</span>
                            </td>
                            <td>{{ rtrim(mb_strimwidth(strip_tags($item->justificacion), 0, 125, '', 'UTF-8')) }}
                            </td>
                        </tr>
                        @endif
                        @endforeach  
                      
                       
                    </tbody>

                </table>
                @endforeach

</body>

</html>
