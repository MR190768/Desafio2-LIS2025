<?php

abstract class ContBase{
    public function Render($view,$viewBag=[]){
        $file='views/'.static::class.'/'.$view;
        $file=str_replace("Controller","",$file);
        if(is_file($file)){
            extract($viewBag);
            ob_start();//abre el buffer
            require($file);
            $content=ob_get_contents();
            ob_end_clean();//cerrando el bufer
            echo $content;
        }
        else{
            echo '<h1>View not found</h1>';
        }
    }
}


?>