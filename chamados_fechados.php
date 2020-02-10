<?php
require_once "global.php";
session_start();
$usuario_logado = unserialize($_SESSION["usuario"]);
$chamado = new Chamado();
$chamados = $chamado->buscarChamadosFechadosPorUsuario($usuario_logado->id);
?>

<table class="ui red celled padded table" id="datatable">
  <thead>
    <tr>
    <th>#</th>
    <th>Problema</th>
    <th>Local</th>
    <th>Equipamento</th>
    <th>Solução</th>
    <th>Tempo de Atendimento</th>
    <th>Avaliar</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($chamados as $chamado) : ?>
      <tr>
        <td><?= $chamado["id"] ?></td>
        <td class="single line"><?= $chamado["problema"] ?></td>
        <td><?= utf8_encode($chamado["local"]) . " (" . $chamado['localSigla'] . ")" ?></td>
        <td><?= $chamado["equipamento"] . " (" . $chamado['equipamentoSigla'] . ")" ?></td>
        <td><?= $chamado["solucao"] ?></td>
        <td><?= View::mostrarTempoDeAtendimento($chamado["dataAbertura"], $chamado["dataFechamento"])?></td>
        <td>
          <div data-id="<?=$chamado["id"]?>" class="ui star rating botao-rating" data-rating="<?= $chamado["avaliacao"] ?>"></div>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>