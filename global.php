<?php
require_once 'config.php';

spl_autoload_register('carregarClasse');

function carregarClasse($nomeClasse)
{
    if (file_exists('classes/' . $nomeClasse . '.php')) {
        require_once 'classes/' .$nomeClasse . '.php';
    }
}

function formatarData($data){
	$data_array = explode("-", $data);	
	return $data_array[2] . "/" . $data_array[1] . "/" . $data_array[0] ;
}