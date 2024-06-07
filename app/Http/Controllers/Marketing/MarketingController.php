<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Models\TPersonal;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpWord\IOFactory;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;

class MarketingController extends Controller
{
    public function __construct()
	{

		$this->middleware(['auth']);
	}
    public function generadorQR($id_personal)
    {
       // URL que deseas codificar
    $url = url('/id_personal=' . $id_personal);

    // Ruta a la imagen del logo
    $logoPath = url('assets/img/mexibus2024.png'); // Cambia esto a la ruta de tu imagen
//dd(url('assets/img/mexibus2024.png'));
    // Verifica si el archivo del logo existe
    $logo = null;
        $logo = Logo::create($logoPath)->setResizeToWidth(50); // Cambia el tamaño del logo si es necesario
    
    //dd($logo);
    // Generar el QR code
    $result = Builder::create()
        ->writer(new PngWriter())
        ->data($url)
        ->encoding(new Encoding('UTF-8'))
        ->size(300)
        ->margin(10)
        ->build();

    // Guardar el QR code en un archivo
    $qrCodePath = public_path('qrcodes/' . $id_personal . '.png');

    // Crea el directorio si no existe
    if (!is_dir(public_path('qrcodes'))) {
        mkdir(public_path('qrcodes'), 0755, true);
    }

    $result->saveToFile($qrCodePath);

    return response()->download($qrCodePath)->deleteFileAfterSend(true);


        
    }
    public function Contratos()
    {
        
        return view('Transmasivo.rh.Contratos');
    }
   
}
