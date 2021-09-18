<?php

if(!function_exists('limitar_texto')){

    function limitar_texto($texto)
    {
        return \Str::words($texto, 20, $end = ' ...');
    }

}

?>