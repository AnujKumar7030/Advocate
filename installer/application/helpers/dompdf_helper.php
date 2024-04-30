<?php if (!defined('BASEPATH')) { exit('No direct script access allowed');
}
use Dompdf\Dompdf;
function pdf_create($html, $filename='', $stream=true) 
{
	
    //include_once "dompdf/dompdf_config.inc.php";
	
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_option('isRemoteEnabled', true);
    $dompdf->render();
    
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }
}
?>
