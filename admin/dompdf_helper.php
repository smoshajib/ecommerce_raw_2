<?php


function pdf_create($html, $filename='', $stream=TRUE) 
{
    require_once("dompdf/dompdf_config.inc.php");
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    if ($stream) {
         $dompdf->stream($filename.".pdf");
        
    } else {
        return $dompdf->output();
    }
}
?>
