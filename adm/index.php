<?php 

if (!isset($_SERVER["PATH_INFO"])) {
	require("../login.php");
	exit();
}

switch ($_SERVER["PATH_INFO"]) {
 	case '/chamados':
 		require("chamados.php");
 		break;
 	
 	case '/perfil':
 		require("perfil.php");
 		break;

	case '/usuarios':
		require("usuarios.php");
	break;

	case '/locais':
		require("locais.php");
	break;

	case '/equipamentos':
		require("equipamentos.php");
	break;

	case '/chamado_por_equipamento':
		require("chamado_por_equipamento.php");
	break;

	case '/equipamentos_por_local':
		require("equipamentos_por_local.php");
	break;

	case '/logar':
		require("../logar.php");
	break;


 	default:
 		echo "Erro 404 - página não encontrada";
 		break;
} 
?>
