<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class InventarioExport implements FromCollection, WithHeadings, WithDrawings, WithMapping, WithEvents, WithStyles
{
    private $inventario;
    
    public function __construct()
    {
        $this->inventario = DB::connection('mysql')->select('select * from t_caja_herramienta');
    }
    
    public function collection()
    {
        return collect($this->inventario);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Refaccion',
            'Cantidad',
            'Foto'
        ];
    }

    public function map($item): array
    {
        return [
            $item->id,
            $item->Refaccion,
            $item->Cantidad,
            '', // Deja esto vacío para la imagen
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $row = 2;

        foreach ($this->inventario as $item) {
            $fotoPath = public_path('images/Caja de herramienta/' . $item->Foto);
            if (file_exists($fotoPath)) {
                $drawing = new Drawing();
                $drawing->setPath($fotoPath);
                $drawing->setHeight(60); // Ajusta el tamaño de la imagen
                $drawing->setCoordinates('D' . $row);
                $drawings[] = $drawing;
            }
            $row++;
        }

        return $drawings;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Ajustar la altura de las filas
                for ($row = 2; $row <= count($this->inventario) + 1; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(60);
                }

                // Ajustar el ancho de las columnas
                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setWidth(15); // Ajusta el ancho de la columna D para la foto
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Establece la altura de la primera fila (encabezados)
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
    }
}
