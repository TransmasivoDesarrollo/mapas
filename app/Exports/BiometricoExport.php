<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BiometricoExport implements FromView
{
    protected $consulta;

    public function __construct($consulta)
    {
        $this->consulta = $consulta;
    }

    public function view(): View
    {
        return view('Transmasivo.rh.excel_biometrico', [
            'consulta' => $this->consulta
        ]);
    }
}