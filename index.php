<?php 

if (!isset($_SERVER["PATH_INFO"])) {
	require("login.php");
	exit();
}

switch ($_SERVER["PATH_INFO"]) {
 	case '/chamados':
 		require("chamados.php");
 		break;
 	
 	case '/perfil':
 		require("perfil.php");
 		break;

 	case '/tipos':
 		require("tipos.php");
 		break;

 	case '/alternativas':
 		require("alternativas.php");
		 break;
		 
	case '/logar':
		require("logar.php");
	break;

 	default:
 		echo "Erro 404 - página não encontrada";
 		break;
} 
?>
