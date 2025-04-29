<?php

function isText($var){
    return preg_match('/^[a-zA-Z áéíóúÁÉÍÓÚñ]+$/',$var);
}

function esTarjeta($var){

    return preg_match('/^[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}$/',$var);
}

function esFecha($var){

    return preg_match('/^(0[1-9]|1[0-2])\/?([0-9]{2})$/',$var);
}
function esCVV($var){

    return preg_match('/^[0-9]{3}$/',$var);
}
function esCodigo($var){
    return preg_match('/^PROD{4}$/',$var);
}

function esTelefono($var){
    return preg_match('/^[0-9]{8}$/',$var);
    
}
?>