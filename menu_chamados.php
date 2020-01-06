<?php  
if (isset($_GET["f"]) && $_GET["f"]=="a") $active_aberto = "active"; else $active_aberto = "";
if (isset($_GET["f"]) && $_GET["f"]=="f") $active_fechado = "active"; else $active_fechado = "";
if (isset($_GET["f"]) && $_GET["f"]=="n") $active_novo = "active"; else $active_novo = "";
?>
<div class="ui vertical menu pointing">
  <a href="chamados.php?f=a" class="teal item <?= $active_aberto?>">
    Abertos
    <div class="ui teal left label">1</div>
  </a>
  <a href="chamados.php?f=f" class="item <?= $active_fechado?>">
    Fechados
    <div class="ui label">51</div>
  </a>
  <a href="chamados.php?f=n" class="item <?= $active_novo?>">
    Novo
  </a>
</div>
