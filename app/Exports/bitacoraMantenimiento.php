<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;


class bitacoraMantenimiento implements FromCollection, WithHeadings, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        // Aquí defines los encabezados para tu archivo Excel
        return [
            'ID',
            'fecha_creacion',
            'n_economico',
            'nom_mecanico',
            'nom_supervisor',
            'Fecha',
            'km',
            'bares',
            'aceite_motor',
            'aceite_motor_lt',
            'aceite_motor_o',
            'refrigerante',
            'refrigerante_lt',
            'refrigerante_o',
            'aceite_hidra',
            'aceite_hidra_lt',
            'aceite_hidra_o',
            'hidroven',
            'hidroven_lt',
            'hidroven_o',
            'servicio',
            'servicio_fallas',
            'servicio_o',
            'emergencia',
            'emergencia_fallas',
            'emergencia_o',
            'neu_eje_dir_izq',
            'neu_eje_dir_izq_falla',
            'neu_eje_dir_izq_o',
            'neu_eje_dir_der',
            'neu_eje_dir_der_falla',
            'neu_eje_dir_der_o',
            'neu_eje_int_izq',
            'neu_eje_int_izq_falla',
            'neu_eje_int_izq_o',
            'neu_eje_int_der',
            'neu_eje_int_der_falla',
            'neu_eje_int_der_o',
            'neu_eje_motr_izq',
            'neu_eje_motr_izq_falla',
            'neu_eje_motr_izq_o',
            'neu_eje_motr_der',
            'neu_eje_motr_der_falla',
            'neu_eje_motr_der_o',
            'bal_eje_dir_izq',
            'bal_eje_dir_izq_falla',
            'bal_eje_dir_izq_o',
            'bal_eje_dir_der',
            'bal_eje_dir_der_falla',
            'bal_eje_dir_der_o',
            'bal_eje_int_izq',
            'bal_eje_int_izq_falla',
            'bal_eje_int_izq_o',
            'bal_eje_int_der',
            'bal_eje_int_der_falla',
            'bal_eje_int_der_o',
            'bal_eje_motr_izq',
            'bal_eje_motr_izq_falla',
            'bal_eje_motr_izq_o',
            'bal_eje_motr_der',
            'bal_eje_motr_der_falla',
            'bal_eje_motr_der_o',
            'bols_air_eje_dir_izq',
            'bols_air_eje_dir_izq_falla',
            'bols_air_eje_dir_izq_o',
            'bols_air_eje_dir_der',
            'bols_air_eje_dir_der_falla',
            'bols_air_eje_dir_der_o',
            'bols_air_eje_int_izq',
            'bols_air_eje_int_izq_falla',
            'bols_air_eje_int_izq_o',
            'bols_air_eje_int_der',
            'bols_air_eje_int_der_falla',
            'bols_air_eje_int_der_o',
            'bols_air_eje_motr_izq',
            'bols_air_eje_motr_izq_falla',
            'bols_air_eje_motr_izq_o',
            'bols_air_eje_motr_der',
            'bols_air_eje_motr_der_falla',
            'bols_air_eje_motr_der_o',
            'asiento_conductor',
            'asiento_conductor_falla',
            'asiento_conductor_o',
            'asiento_carro1',
            'asiento_carro1_falla',
            'asiento_carro1_o',
            'asiento_carro2',
            'asiento_carro2_falla',
            'asiento_carro2_o',
            'pasamanos_carro1',
            'pasamanos_carro1_o',
            'pasamanos_carro2',
            'pasamanos_carro2_o',
            'codigo_display',
            'codigo_display_o',
            'articulacion',
            'articulacion_falla',
            'articulacion_o',
            'articulacion_soporte',
            'articulacion_soporte_falla',
            'articulacion_soporte_o',
            'articulacion_granada',
            'articulacion_granada_falla',
            'articulacion_granada_o',
            'calibracion_neum_granada',
            'calibracion_neum_granada_falla',
            'calibracion_neum_granada_o',
            'eje_dir_izq',
            'eje_dir_izq_falla',
            'eje_dir_izq_o',
            'eje_dir_der',
            'eje_dir_der_falla',
            'eje_dir_der_o',
            'eje_inter_izq',
            'eje_inter_izq_falla',
            'eje_inter_izq_o',
            'eje_inter_der',
            'eje_inter_der_falla',
            'eje_inter_der_o',
            'eje_motr_izq',
            'eje_motr_izq_falla',
            'eje_motr_izq_o',
            'eje_motr_der',
            'eje_motr_der_falla',
            'eje_motr_der_o',
            'susp_eje1',
            'susp_eje1_falla',
            'susp_eje1_o',
            'susp_eje2',
            'susp_eje2_falla',
            'susp_eje2_o',
            'susp_eje3',
            'susp_eje3_falla',
            'susp_eje3_o',
            'tan_drenado',
            'tan_drenado_falla',
            'tan_drenado_o',
            
            'tan_chicote',
            'tan_chicote_falla',
            'tan_chicote_o',
            'soport_motor',
            'soport_motor_falla',
            'soport_motor_o',
            'soport_transmi',
            'soport_transmi_falla',
            'soport_transmi_o',
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
