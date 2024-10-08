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
                // Redimensionar la imagen utilizando GD
                $tempPath = $this->resizeImage($fotoPath, $item->Foto);

                if ($tempPath) {
                    $drawing = new Drawing();
                    $drawing->setPath($tempPath);
                    $drawing->setHeight(60); // Ajusta el tamaño de la imagen
                    $drawing->setOffsetX(5); // Ajuste horizontal para alinear la imagen
                    $drawing->setOffsetY(5); // Ajuste vertical para alinear la imagen
                    $drawing->setCoordinates('D' . $row);
                    $drawings[] = $drawing;
                }
            }
            $row++;
        }

        return $drawings;
    }

    private function resizeImage($originalPath, $filename)
    {
        list($width, $height) = getimagesize($originalPath);
        
        // Ajusta el nuevo ancho y altura para mejorar la resolución
        $newWidth = 640; // Aumenta este valor para una mejor resolución
        $newHeight = intval($height * ($newWidth / $width));

        $image_p = imagecreatetruecolor($newWidth, $newHeight);
        $image = imagecreatefromjpeg($originalPath);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $tempPath = public_path('images/temp/' . $filename);
        if (!is_dir(public_path('images/temp'))) {
            mkdir(public_path('images/temp'), 0777, true);
        }

        imagejpeg($image_p, $tempPath, 85); // Ajusta la calidad de la imagen (0-100)

        return $tempPath;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Ajustar la altura de las filas
                for ($row = 2; $row <= count($this->inventario) + 1; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(65);
                }

                // Ajustar el ancho de las columnas
                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setWidth(20); // Ajusta el ancho de la columna D para la foto
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
