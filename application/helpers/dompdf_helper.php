<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function pdf_create($html, $filename = '', $stream = TRUE)
{
    require_once(APPPATH . '../vendor/autoload.php');
    $dompdf = new Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->set_option('isHtml5ParserEnabled', true);
    $dompdf->set_option('isPhpEnabled', true);
    $dompdf->set_option('isRemoteEnabled', true);
    $dompdf->setPaper('A4', 'landscape');

    ###ไ ใ กร ไ 

    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename . ".pdf");
    } else {
        return $dompdf->output();
    }
}
