<?php 
include "cabecalho.php";
include "notificacao.php";
require_once "global.php";

session_start();
$usuario_logado = unserialize($_SESSION["usuario"]);

if (isset($_POST["problema"]) && $_POST["idLocal"] != "") {
    $chamado = new Chamado();
    $chamado->idLocal = $_POST["idLocal"];
    $chamado->idEquipamento = $_POST["idEquipamento"];
	$chamado->problema = $_POST["problema"];
	$chamado->idUsuario = $usuario_logado->id;
	
    $chamado->inserir();
}

?>

<br>
<div class="ui grid stackable">
	<div class="three wide column"><?php include "menu_chamados.php" ?></div>	
	<div class="thirteen wide column">
		<?php
		mostrarNotificacao('red');
		mostrarNotificacao('green');
		?>
		<?php
			if (isset($_GET["f"]) && $_GET["f"]=="a") include "chamados_abertos.php";
			if (isset($_GET["f"]) && $_GET["f"]=="f") include "chamados_fechados.php";
			if (isset($_GET["f"]) && $_GET["f"]=="n") include "chamados_criar.php";
		?>
	</div>	
	
</div>

</body>

<?php include "rodape.php" ?>

<script>
	$('.botao-rating').click(avaliarChamado);

	function avaliarChamado(){
		const botao = $(this);
		const id_chamado = (botao.data('id'));
		const avaliacao = botao.rating("get rating");
		$.ajax({
			url: "../api/api_chamado.php",
			method: "POST",
			data: {
				acao: "avaliar_chamado",
				id: id_chamado,
				avaliacao: avaliacao
			},
			success: function(){
				console.log("funciona", avaliacao);
			}
		})
	}


</script>

<script>
  $('.ui.rating')
  	.rating({
    	initialRating: 0,
		maxRating: 4
    });

  $('.dropdown').dropdown();
</script>

</html>