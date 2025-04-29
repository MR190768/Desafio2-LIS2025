<?php

use Dompdf\Dompdf;
use Dompdf\Options;

class PDFDoc
{
    private $dompdf;
    private $options;
    private $html;
    public function __construct()
    {
        $this->options = new Options();
        $this->options->set('isHtml5ParserEnabled', true);
        $this->options->set('isRemoteEnabled', true);
        $this->dompdf = new Dompdf($this->options);
    }

    public function generatePDF($fileName)
    {
        $tabla='';
        $subtotal=0;
        $envio=8;
        foreach ($_SESSION["carrito"] as $key => $value) {
            $calculo=floatval($value["precio"])*intval($value["cantidad"]);
            $subtotal += $calculo;
            $tabla.='<tr>
                <td>'.$key.'</td>
                <td>'.$value['nombre'].'</td>
                <td>'.$value['cantidad'].'</td>
                <td>$'.$value['precio'].'</td>
                <td>$'.$calculo.'</td>
            </tr>';
        }
        $this->html = '
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            max-width: 800px;
            margin: auto;
        }
        h1, h2, h3 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .text-right {
            text-align: right;
        }
        .total {
            font-weight: bold;
            font-size: 1.2em;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 400px;
            height: 150px;
        }
        .datos-empresa {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="https://i.ibb.co/pjbtY2Fv/Color.png" alt="Logo de la Empresa">
    </div>
    <div class="datos">
        <h2> '.$_SESSION["user"]["nombre"].'</h2>
        <p>Dirección: '.$_SESSION["user"]['direccion'].'</p>
        <p>Teléfono: '.$_SESSION["user"]['telefono'].'</p>
        <p>Email: '.$_SESSION["user"]['correo'].'</p>
    </div>
    <h1>Recibo de Venta</h1>
    <p><strong>Número de Recibo:</strong> '.time().'</p>
    <p><strong>Fecha:</strong> '.date("d/m/Y").'</p>
    <table>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>'.$tabla.'

            </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right">Subtotal</td>
                <td class="text-right">$ '.$subtotal.'</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Envio</td>
                <td class="text-right">$ '.$envio.'</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right total">Total</td>
                <td class="text-right total">$ '.$subtotal+$envio.'</td>
            </tr>
        </tfoot>
    </table>
    <div class="footer">
        <p>Gracias por su compra.</p>
    </div>
</body>
</html>
        ';
        $this->dompdf->loadHtml($this->html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        $output=$this->dompdf->output();
        file_put_contents('storage/pdf/'.$fileName, $output);
        $this->dompdf->stream($fileName, array("Attachment" => false));

    }
}
