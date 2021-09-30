<?php

if(!function_exists("backoffice_menus")){

    function backoffice_menus()
    {
        return [
            [
                'key'=>'',
                'title'=>'Ficheiros',
                'icon'=>'nav-icon fas fa-th',
                'route'=>route("files"),
            ],
            [
                'key'=>'',
                'title'=>'Tipos de Ficheiros',
                'icon'=>'nav-icon fas fa-th',
                'route'=>route("file-types"),
            ],
            [
                'key'=>'',
                'title'=>'Utilizadores',
                'icon'=>'nav-icon fas fa-th',
                'route'=>route("user-management.index"),
            ],
        ];
    }

}

?>
