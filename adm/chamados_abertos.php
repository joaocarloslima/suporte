<?php
require_once "../global.php";

$chamado = new Chamado();
$listaChamados = $chamado->buscarTodosChamadosAbertos();
$tempoMedio = Chamado::tempoMedioDeEspera();

$COR = array("red", "yellow", "green");


?>

<div class="ui four doubling cards">
  <div class="ui cards">
    <?php foreach ($listaChamados as $chamado) : ?>
      <?php $arquivo = "../fotos/" . (string) $usuario['matricula'] . ".jpg"; ?>
      <div class="card <?= $COR[$chamado["prioridade"]]?>">
        <div class="content">
          <img class="right floated mini ui image" src="../fotos/<?= is_file($arquivo) == true ? $usuario['matricula'] : 'semFoto' ?>.jpg">

          <div class="header"><?= $chamado["usuario"] ?></div>
          <div class="meta"><?= utf8_encode($chamado["local"]) . " - " . $chamado["equipamentoSigla"] ?> </div>
          <div class="description">
            <?= $chamado["problema"] ?>
          </div>
        </div>
        <div class="extra content">
          <span class="right floated">
            <td><?= View::mostrarPrioridade($chamado["prioridade"], $chamado["id"]) ?></td>
          </span>
          <i class="clock outline icon"></i><?= View::mostrarTempoDeAtendimento($chamado["dataAbertura"], date("Y-m-d H:i:s")) ?>
        </div>
        <div class="extra content">
          <div class="ui large transparent left icon input">
            <span class="header aviso-fechamento">CHAMADO FECHADO</span>
            <span data-id="<?= $chamado["id"]?>" class="botao-respoderChamado">
              <i class="check icon"></i>
            </span>
            <input name="input-resposta" type="text" placeholder="responder chamado" />
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>