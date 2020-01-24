<?php $url = $_SERVER["PATH_INFO"] ?>

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
  <a href="chamados" class="item <?= ($url=='/chamados')?'active':'' ?>">
    Chamados
  </a>
  <a href="perfil" class="item <?= ($url=='/perfil')?'active':'' ?>">
    Perfil
  </a>
  <div class="right menu">
    <a href="logar.php" class="ui item">
      Sair
    </a>
  </div>
</div>