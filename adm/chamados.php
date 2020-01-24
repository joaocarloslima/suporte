<?php
include "cabecalho.php";
include "../notificacao.php";
require_once "../global.php";

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
		if (isset($_GET["f"]) && $_GET["f"] == "a") include "chamados_abertos.php";
		if (isset($_GET["f"]) && $_GET["f"] == "f") include "chamados_fechados.php";
		if (isset($_GET["f"]) && $_GET["f"] == "n") include "chamados_criar.php";
		?>
	</div>

</div>

</body>

<?php include "rodape.php" ?>

<script>

	//atualizar prioridade via ajax
	$('.botao-prioridade').click(alterarPrioridade);

	function alterarPrioridade() {
		const span = $(this);
		const id_chamado = (span.data('id'));
		$.ajax({
			url: "../api/api_chamado.php",
			method: "POST",
			data: {
				acao: "trocar_prioridade",
				id: id_chamado
			},
			success: function(novoSpanPrioridade) {
				novoSpanPrioridade = $.parseHTML(novoSpanPrioridade);
				$(novoSpanPrioridade).on('click', alterarPrioridade);
				const card = span.parents(".card");
				span.replaceWith(novoSpanPrioridade);
				const cor = pegarCor($(novoSpanPrioridade));
				card.removeClass('red').removeClass('yellow').removeClass('green').addClass(cor);
			}
		});
	}

	function pegarCor(elemento){
		const icone = elemento.children("i");
		let cor = "";
		if (icone.hasClass("red")) cor="red";
		if (icone.hasClass("green")) cor="green";
		if (icone.hasClass("yellow")) cor="yellow";
		return cor;
	}

	// Resposta do chamado 
	$('.botao-respoderChamado').click(enviarResposta);

	function enviarResposta(){
		const botao = $(this);
		const id_chamado = (botao.data('id'));
		const respostaChamado = botao.next().val();
		$.ajax({
			url: "../api/api_chamado.php",
			method: "POST",
			data: {
				acao: "responder_chamados",
				id: id_chamado,
				solucao: respostaChamado
			},
			success: function(){
				botao.next().hide();
				botao.hide();
				botao.prev().show();
			}
		});
	}

	// Reabrir chamado 
	$(".botao-reabrirChamado").click(reabrirChamado);

	function reabrirChamado(){
		const span = $(this);
		const id_chamado = (span.data('id'));
		$.ajax({
			url: "../api/api_chamado.php",
			method: "POST",
			data: {
				acao: "reabrir_chamado",
				id: id_chamado
			},
			success: function(){
				span.hide();
				span.prev().show();
			}
		});
	}


	$('.aviso-fechamento').hide();

	$('.aviso-reabertura').hide();

	$('.ui.rating').rating({
        interactive: false
    });

	$('.dropdown').dropdown();



</script>

<style>
	.botao-prioridade {
		cursor: pointer;
	}

	.botao-respoderChamado{
		cursor: pointer;
	}

	.botao-reabrirChamado{
		cursor: pointer;
	}
</style>

</html>