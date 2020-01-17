<?php
require_once "../global.php";

$chamado = new Chamado();
$listaChamados = $chamado->buscarTodosChamadosAbertos();

?>

<div class="ui four doubling cards">
  <div class="ui cards">
    <form action="chamados.php" method="POST">
      <?php foreach ($listaChamados as $chamado) : ?>
      <?php $arquivo = "../fotos/" . (string) $usuario['matricula'] . ".jpg"; ?>
        <div class="card blue">
          <div class="content">
            <img class="right floated mini ui image" 
              src="../fotos/<?= is_file($arquivo) == true ? $usuario['matricula'] : 'semFoto' ?>.jpg">

            <div class="header"><?= $chamado["usuario"]?></div>
            <div class="meta"><?= $chamado["local"] . " - " . $chamado["equipamentoSigla"]?> </div>
            <div class="description">
              <?= $chamado["problema"]?>
            </div>
          </div>
          <div class="extra content">
            <span class="right floated">
            <td><?= View::mostrarPrioridade($chamado["prioridade"], $chamado["id"] ) ?></td>  
            </span>
            <i class="clock outline icon"></i><?= View::mostrarTempoDeAtendimento($chamado["dataAbertura"], date('Y-m-d H:i:s'))?>
          </div>
          <div class="extra content">
            <div class="ui large transparent left icon input">
              <i class="check icon"></i>
              <input type="text" placeholder="responder chamado">
            </div>
          </div>
        <?php endforeach ?>
    </form>
  </div>
</div>

