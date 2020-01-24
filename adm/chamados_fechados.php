<?php
require_once "../global.php";
session_start();
$chamado = new Chamado();
$chamados = $chamado->buscarTodosChamadosFechados();
?>

<table class="ui red celled padded table" id="datatable">
  <thead>
    <tr>
    <th>#</th>
    <th>Problema</th>
    <th>Usuario</th>
    <th>Local</th>
    <th>Equipamento</th>
    <th>Solução</th>
    <th>Tempo de Atendimento</th>
    <th>Avaliação</th>
    <th>Reabrir chamado</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($chamados as $chamado) : ?>
      <tr>
        <td><?= $chamado["id"] ?></td>
        <td class="single line"><?= $chamado["problema"] ?></td>
        <td class="single line"><?= $chamado["usuario"] . " - " . $chamado["usuarioMatricula"]?></td>
        <td><?= $chamado["local"] . " (" . $chamado['localSigla'] . ")" ?></td>
        <td><?= $chamado["equipamento"] . " (" . $chamado['equipamentoSigla'] . ")" ?></td>
        <td><?= $chamado["solucao"] ?></td>
        <td><?= View::mostrarTempoDeAtendimento($chamado["dataAbertura"], $chamado["dataFechamento"])?></td>
        <td>
        <div class="ui star rating" data-rating = "<?= $chamado["avaliacao"]?>"> </div>
        </td>
        <td>
            <span class="single line aviso-reabertura">CHAMADO REABERTO</span>
            <span class="botao-reabrirChamado" data-tooltip="reabrir chamado" data-id="<?= $chamado["id"]?>">
              <i class="large undo alternate icon"></i>
            </span>
        </td> 
      </tr>
    <?php endforeach ?>
  </tbody>
</table>