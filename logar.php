<?php
require_once "global.php";
session_start();

if (isset($_POST["matricula"]) && isset($_POST["senha"])){
	$matricula = $_POST["matricula"];
	$senha = $_POST["senha"];
	$usuario = new Usuario();
	$usuario->matricula = $matricula;
	$usuario->senha = $senha;
	$usuario->logar();
	if ($usuario->logado){
		$_SESSION["usuario"] = serialize($usuario);
		if($usuario->perfil == 1 || $usuario->perfil == 2){
			header("Location: adm/chamados.php");
		}else{
			header("Location: chamados.php");
		}
	}else{
		$_SESSION["red"] = "Acesso negado";
		header("Location: login.php");
	}
}else{
	//logout
	unset($_SESSION["usuario"]);	
	$_SESSION["green"] = "Você fez logout do sistema";
	header("Location: login.php");

}
