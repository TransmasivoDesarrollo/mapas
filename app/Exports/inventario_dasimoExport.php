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

class inventario_dasimoExport implements FromCollection, WithHeadings, WithDrawings, WithMapping, WithEvents, WithStyles
{
    private $inventario;

    public function __construct()
    {
        $this->inventario = DB::connection('mysql')->select('select * from t_inventario_dasimo');
    }

    public function collection()
    {
        return collect($this->inventario);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Cantidad',
            'Categoria',
            'Foto'
        ];
    }

    public function map($item): array
    {
        return [
            $item->id_inventario_dasimo,
            $item->nombre,
            $item->cantidad,
            $item->categoria,
            '', // Deja esto vacío para la imagen
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $row = 2;

        foreach ($this->inventario as $item) {
            $fotoPath = public_path('images/Inventario_dasimo/' . $item->foto);
            if (file_exists($fotoPath)) {
                // Redimensionar la imagen utilizando GD
                $tempPath = $this->resizeImage($fotoPath, $item->foto);

                if ($tempPath) {
                    $drawing = new Drawing();
                    $drawing->setPath($tempPath);
                    $drawing->setHeight(60); // Ajusta el tamaño de la imagen
                    $drawing->setCoordinates('E' . $row);
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
        $newWidth = 100;
        $newHeight = intval($height * ($newWidth / $width));

        $image_p = imagecreatetruecolor($newWidth, $newHeight);
        $image = imagecreatefromjpeg($originalPath);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $tempPath = public_path('images/temp/' . $filename);
        if (!is_dir(public_path('images/temp'))) {
            mkdir(public_path('images/temp'), 0777, true);
        }

        imagejpeg($image_p, $tempPath, 75); // Ajusta la calidad de la imagen (0-100)

        return $tempPath;
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
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setWidth(15); // Ajusta el ancho de la columna E para la foto
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
