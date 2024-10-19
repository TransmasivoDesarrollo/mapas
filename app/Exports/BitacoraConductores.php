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
            'Credencial',
            'Conductor',
            'Servicio',
            'Ciclo',
            'Día',
            'Hora de salida 1',
            'Comentario hora de salida 1',
            'Terminal salida 1',
            'Economico salida 1',
            'Hora llegada 1',
            'Comentario hora de llegada 1',
            'Terminal llegada 1',
            'Economico llegada 1',
            'Hora de salida 2',
            'Comentario hora de salida 2',
            'Terminal salida 2',
            'Economico salida 2',
            'Hora llegada 2',
            'Comentario hora de llegada 2',
            'Terminal llegada 2',
            'Economico llegada 2',
            'Terminal salida 1',
            'Terminal llegada 1',
            'Terminal salida 2',
            'Terminal llegada 2',
            'Hora de salida 1 del rol',
            'Estatus salida 1',
            'Hora de diferencia salida 1',
            'Hora de salida 2 del rol',
            'Estatus salida 2',
            'Hora de diferencia salida 2',
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