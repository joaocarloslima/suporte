<?php
include "notificacao.php";
require_once "global.php";

session_start();

if (isset($_POST["nome"])) {
	$usuario = new Usuario();
	$usuario->matricula = $_POST["matricula"];
	$usuario->carregar();

	$usuario->nome = $_POST["nome"];
	$usuario->email = $_POST["email"];

	$usuario->atualizar();
}

// mudar senha
if (isset($_POST["senha"])) {
	$usuario = new Usuario();
	$usuario->id = $_POST["id"];
	$usuario->senha = $_POST["senha"];

	$usuario->alterarSenha();
}



//pegar dados do usuarios
$usuario_logado = unserialize($_SESSION["usuario"]);
$usuario = new Usuario();
$usuario->matricula = $usuario_logado->matricula;
$usuario->carregar();

?>

<?php include "cabecalho.php"; ?>

<?php
mostrarNotificacao('red');
mostrarNotificacao('green');
?>

<div class="ui placeholder segment">
	<div class="ui two column very relaxed stackable grid">
		<div class="column">
			<form class="ui form" action="perfil" method="POST">
				<input type="hidden" name="matricula" value="<?= $usuario->matricula ?>">
				<div class="field">
					<label>Nome</label>
					<input type="text" name="nome" placeholder="nome completo" value="<?= $usuario->nome ?>">
				</div>
				<div class="field">
					<label>E-mail</label>
					<input type="text" name="email" placeholder="e-mail de contato" value="<?= $usuario->email ?>">
				</div>
				<button class="ui primary button">Salvar</button>
			</form>
		</div>
		<div class="column">

		<form class="ui form" action="perfil" method="POST">
			<input type="hidden" name="id" value="<?= $usuario->id?>">
			<div class="four wide field">
				<label>Mudar senha</label>
				<input type="password" name="senha">
			</div>
			<button class="ui primary button">Salvar nova senha</button>
		</form>
		</div>
	</div>
	<div class="ui vertical divider">
		OU
	</div>
</div>


</body>

</html>