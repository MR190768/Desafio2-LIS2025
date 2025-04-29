<?php
require_once 'Controllers.php';
class ViewDocController extends ContBase{

    public function verRecibo($file) {
        $archivo = 'storage/pdf/' . $file[0];
        
        if (file_exists($archivo)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="'.basename($archivo).'"');
            header('Content-Length: ' . filesize($archivo));
            readfile($archivo);
            exit();
        } else {
            http_response_code(404);
            echo "Archivo PDF no encontrado: " . $archivo;
        }
    }

}


?>