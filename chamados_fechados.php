<?php
require_once "global.php";
session_start();
$usuario_logado = unserialize($_SESSION["usuario"]);
$chamado = new Chamado();
$chamados = $chamado->buscarChamadosFechadosPorUsuario($usuario_logado->id);
?>

<table class="ui red celled padded table" id="datatable">
  <thead>
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
        <td><?= $chamado["local"] . " (" . $chamado['localSigla'] . ")" ?></td>
        <td><?= $chamado["equipamento"] . " (" . $chamado['equipamentoSigla'] . ")" ?></td>
        <td><?= $chamado["solucao"] ?></td>
        <td>2 dias e 14 horas</td>
        <td>
          <div class="ui star rating" data-rating="<?= $chamado["avaliacao"] ?>"></div>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>