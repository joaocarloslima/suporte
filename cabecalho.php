<?php 
$url = $_SERVER["PATH_INFO"];
$url_array = explode("/",$url);
?>

<!DOCTYPE html>
<html>
<head>
	<title>ETECIA - Suporte</title>
	<link rel="stylesheet" type="text/css" href="semanticui/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="semanticui/suporte.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
</head>
<body>
	<h1>Sistema de Suporte - ETECIA</h1>
<div class="ui secondary pointing menu">
  <a href="chamados" class="item <?= (in_array('chamados', $url_array))?'active':'' ?>">
    Chamados
  </a>
  <a href="perfil" class="item <?= (in_array('perfil', $url_array))?'active':'' ?>">
    Perfil
  </a>
  <div class="right menu">
    <a href="logar.php" class="ui item">
      Sair
    </a>
  </div>
</div>