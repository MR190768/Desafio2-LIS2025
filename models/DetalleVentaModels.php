<?php
require_once 'model.php';
class DetalleVentaModel extends Models{

    public function InsertarDetalle($venta_id,$producto_id, $cantidad, $precio_unitario,$subtotal){
        $query="INSERT INTO detalle_venta (venta_id,producto_id, cantidad, precio_unitario,subtotal) VALUES (:venta_id,:producto_id, :cantidad, :precio_unitario,:subtotal)";
        return $this->set_query($query,[':venta_id'=>$venta_id,':producto_id'=>$producto_id,':cantidad'=>$cantidad,':precio_unitario'=>$precio_unitario,':subtotal'=>$subtotal]);
    }

    public function getById($id=''){
            $query="SELECT * FROM detalle_venta WHERE venta_id=:codigo";
            return $this->get_query($query,[':codigo'=>$id]);

    }

}





?>