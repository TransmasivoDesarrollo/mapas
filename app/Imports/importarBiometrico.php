<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class importarBiometrico implements ToCollection
{
    public $result = [];  // Propiedad pública para almacenar los resultados

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            if ($row[0] != "Tiempo")
            {    
                $fechaExcel = $row[0];
                $fecha = Date::excelToDateTimeObject($fechaExcel);
                $this->result[] = [
                    'id' => $row[1],
                    'fecha_hora' => $fecha->format('Y-m-d H:i:s ') 
                ];
            }
        }
    }
}
