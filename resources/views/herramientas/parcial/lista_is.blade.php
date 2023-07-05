@foreach ($monitoreos as $monitoreo)
    <tr>
        <td>{{ $monitoreo->fecha_registro }}</td>
        <td>{{ $monitoreo->herramienta->nombre }}</td>
        <td>{{ $monitoreo->accion }}</td>
    </tr>
@endforeach
