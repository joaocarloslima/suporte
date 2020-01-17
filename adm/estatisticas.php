<?php
require_once "../global.php";
$qtdeChamadosAbertos = Chamado::qtdeChamadosAbertos();
$tempoMedio = Chamado::tempoMedioDeEspera();
$chamadoMaisAntigo = Chamado::chamadoMaisAntigo();
$satisfacaoMedia = Chamado::satisfacaoMedia();
?>

<div class="ui four statistics">
    <div class="statistic red">
      <div class="value"><i class="comment outline icon"></i> <?= $qtdeChamadosAbertos ?></div>
      <div class="label">Chamados Abertos</div>
    </div>
    <div class="statistic olive">
      <div class="value"><i class="clock outline icon"></i><?= View::mostrarEmHoras($tempoMedio) ?></div>
      <div class="label">tempo médio de espera</div>
    </div>
    <div class="statistic yellow">
      <?= View::mostrarEstrelas($satisfacaoMedia) ?>
      <div class="label">Satisfação do Usuário</div>
    </div>
    <div class="statistic orange">
      <div class="value"><i class="hourglass outline icon"></i> <?= View::mostrarEmHoras($chamadoMaisAntigo) ?></div>
      <div class="label">Chamado mais antigo</div>
    </div>
  </div>
