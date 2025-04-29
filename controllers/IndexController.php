<?php
require_once 'Controllers.php';
class IndexController extends ContBase{


    public function Index(){
        header('Location:'.PATH.'productos');
    }

}


?>