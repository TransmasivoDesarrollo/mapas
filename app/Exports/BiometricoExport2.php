<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class BiometricoExport2 implements FromView, WithEvents
{
    protected $consulta;

    public function __construct($acomodado, $elementos, $fechas_formateadas)
    {
        $this->acomodado = $acomodado;
        $this->elementos = $elementos;
        $this->fechas_formateadas = $fechas_formateadas;
    }

    public function view(): View
    {
        return view('Transmasivo.rh.excel_biometrico2', [
            'acomodado' => $this->acomodado,
            'elementos' => $this->elementos,
            'fechas_formateadas' => $this->fechas_formateadas,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Adjust column widths automatically
                foreach (range('A', 'Z') as $columnID) { // Adjust 'I' to your maximum column
                    $event->sheet->getDelegate()->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}
