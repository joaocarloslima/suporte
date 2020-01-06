<?php
function mostrarNotificacao($tipo) {
	switch ($tipo) {
		case 'red':
			$titulo = "Erro!";
			break;
		
		default:
			$titulo = "Sucesso!";
			break;
	}

    if(isset($_SESSION[$tipo])) : ?>
      <div class="ui <?php echo $tipo?> negative message">
        <div class="header"><?= $titulo ?></div>
        <p><?php echo $_SESSION[$tipo] ?></p>
    </div>


<?php
        unset($_SESSION[$tipo]);
    endif;
}
