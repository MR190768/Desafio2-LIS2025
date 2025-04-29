<?php
require_once 'model.php';
class VentasModel extends Models{


    public function Insertarventa($cliente_id,$total,$tarjeta,$nametarjeta,$numtarjeta,$fectarjeta,$cvv,$pdf_comprobante){
        $query="INSERT INTO ventas (cliente_id, total, tarjeta, nameTarjeta, numTarjeta, fecTarjeta, cvv, pdf_comprobante) VALUES (:cliente_id, :total, :tarjeta, :nameTarjeta, :numTarjeta, :fecTarjeta, :cvv, :pdf_comprobante)";
        return $this->set_query($query,[':cliente_id'=>$cliente_id,':total'=>$total,':tarjeta'=>$tarjeta,':nameTarjeta'=>$nametarjeta,':numTarjeta'=>$numtarjeta,':fecTarjeta'=>$fectarjeta,':cvv'=>$cvv,':pdf_comprobante'=>$pdf_comprobante]);
    }

    public function get(){
        $query="SELECT * FROM ventas ORDER BY id DESC";
        return $this->get_query($query);
    }


}


?>