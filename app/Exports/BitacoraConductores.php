<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;

class BitacoraConductores implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $consulta;

    public function __construct($consulta)
    {
        $this->consulta = $consulta;
    }

    public function collection()
    {
        return collect($this->consulta);
    }

    public function headings(): array
    {
        return [
            'Servicio',
            'Jornada',
            'Hora de llegada',
            'Hora de salida',
            'dia del registro',
            'credencial del capturador',
            'credencial del conductor',
            'Nombre del conductor',
            'Posicion de registro',
            'Hora de salida del rol',
            'Estatus',
            'Hora de diferencia',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:' . $event->sheet->getHighestColumn() . '1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'], // Color del texto blanco
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '872637'], // Color de fondo #121212
                    ],
                ]);
            },
        ];
    }
}