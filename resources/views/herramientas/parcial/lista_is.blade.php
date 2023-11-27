@foreach ($monitoreos as $monitoreo)
    @php
        if (!$monitoreo->herramienta || !$monitoreo->herramienta->nombre) {
            $monitoreo->delete();
        }
    @endphp
    <tr>
        <td>{{ $monitoreo->fecha_registro }}</td>
        <td>{{ $monitoreo->herramienta->nombre }}</td>
        <td>{{ $monitoreo->accion }}</td>
    </tr>
@endforeach
