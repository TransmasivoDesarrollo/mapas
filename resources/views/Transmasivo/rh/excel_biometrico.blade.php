<!-- resources/views/Transmasivo/rh/excel_biometrico.blade.php -->

<table>
    <thead>
        <tr>
            <th>Empleado</th>
            <th>Día</th>
            <th>Entrada oficina</th>
            <th>Salida oficina</th>
            <th>Tiempo de trabajo</th>
            <th>Retardo</th>
            <th>Salida</th>
            <th>Todas las fechas del día</th>
        </tr>
    </thead>
    <tbody>
        @foreach($consulta as $consul)
            <tr>
                <td>{{ $consul->id_elemento }}</td>
                <td>{{ $consul->dia[0] }}</td>
                <td>{{ $consul->inicio }}</td>
                <td>{{ $consul->fin }}</td>
                <td>{{ $consul->tiempo_trabajado }}</td>
                <td>{{ $consul->estado }}</td>
                <td>{{ $consul->salida_estado }}</td>
                <td>{!! $consul->todas_las_fechas !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>
