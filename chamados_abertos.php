<?php
require_once "global.php";
session_start();
$usuario_logado = unserialize($_SESSION["usuario"]);
$chamado = new Chamado();
$chamados = $chamado->buscarChamadosAbertosPorUsuario($usuario_logado->id);
?>

<table class="ui green celled padded table datatable" id="datatable">
  <thead>
    <th>#</th>
    <th>Problema</th>
    <th>Local</th>
    <th>Equipamento</th>
    <th>Abertura</th>
    <th>Prioridade</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($chamados as $chamado) : ?>
      <tr>
        <td><?= $chamado["id"] ?></td>
        <td class="single line"><?= $chamado["problema"] ?></td>
        <td><?= utf8_encode($chamado["local"]) . " (" . $chamado['localSigla'] . ")" ?></td>
        <td><?= $chamado["equipamento"] . " (" . $chamado['equipamentoSigla'] . ")" ?></td>
        <td><?= View::mostrarAbertura($chamado["dataAbertura"]) ?></td>
        <td><?= View::mostrarPrioridade($chamado["prioridade"]) ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>