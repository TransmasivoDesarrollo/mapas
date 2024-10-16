<table>
    <thead>
        <tr>
            <th>Credencial</th>
            <th>Hora de Salida</th>
            <th>Hora de Llegada</th>
            <th>...</th>
        </tr>
    </thead>
    <tbody>
        @foreach($consulta as $registro)
            <tr>
                <td>{{ $registro['credencial'] }}</td>
                <td>{{ $registro['hora_salida'] }}</td>
                <td>{{ $registro['hora_llegada'] }}</td>
                <td>...</td>
            </tr>
        @endforeach
    </tbody>
</table>
