<?php include "cabecalho.php"; ?>
<br>
<div class="ui grid stackable">
	<div class="three wide column"><?php include "menu_chamados.php" ?></div>	
	<div class="thirteen wide column">
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
  $('.ui.rating').rating();
  $('.dropdown').dropdown();
</script>

</html>