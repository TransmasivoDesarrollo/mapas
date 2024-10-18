<?php
// app/Http/Controllers/QrCodeController.php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Response;

class QrCodeController extends Controller
{
    public function generarQR($texto)
    {
        // Generar el código QR en formato PNG
        $qr = QrCode::format('png')->size(1500)->margin(2)->generate($texto);
        
        // Devolver el archivo como una descarga
        return Response::make($qr, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="codigo_qr.png"',
        ]);
    }
}

