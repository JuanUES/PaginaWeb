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

        .page-break {
            page-break-after: always;
        }

    </style>
  
</head>

<body>

    @foreach ($departamentos as $dep)
        <h4 align="center">
            Universidad de El Salvador<br>
            Facultad Multidisciplinaria Paracentral <br>
            Departamento: {{ $dep->nombre_departamento }}{{ ' ' }}
            Periodo de:
            {{ Carbon\Carbon::parse($request->inicioR)->format('d/M/Y') }}{{ ' al ' }}{{ Carbon\Carbon::parse($request->finR)->format('d/M/Y') }}
            <br>

        </h4>

        <table id="const" class="table">
            <thead>
                <tr>
                    <th class="col-sm-2" style="text-align: center">Nombre</th>
                    <th class="col-xs-1" style="text-align: center">Tipo</th>
                    <th class="col-xs-1" style="text-align: center">Fecha Presentación</th>
                    <th class="col-xs-1" style="text-align: center">Fecha uso</th>
                    <th class="col-xs-1" style="text-align: center">Fecha Aceptación</th>
                    <th class="col-xs-1" style="text-align: center">Hora Incio</th>
                    <th class="col-xs-1" style="text-align: center">Hora Final</th>
                    <th class="col-xs-2" style="text-align: center">Tiempo Utilizar</th>
                    <th class="col-sm-2" style="text-align: center">Justificación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permisos as $item)
                    @if ($dep->id == $item->id_depto)

                        <tr>
                            <td>{{ $item->nombre }}{{ ' ' }}{{ $item->apellido }}</td>
                            <td>{{ $item->tipo_permiso }}</td>
                            <td>{{ Carbon\Carbon::parse($item->fecha_presentacion)->format('d/M/Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($item->fecha_uso)->format('d/M/Y') }}</td>
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
        <div class="page-break"></div>
    @endforeach
    {{-- PARA EL PAGINADO DE PAGINAS --}}
    <script type="text/php">
        if ( isset($pdf) ) {
                            $pdf->page_script('
                                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                                $pdf->text(370, 570, "Pág $PAGE_NUM de $PAGE_COUNT", $font, 10);
                            ');
                        }
    </script>
    {{--FIN DE PAGINADO--}}


</body>

</html>
