<?php
require_once "global.php";

//buscar os locais cadastrados
$local = new Local();
$locais = $local->buscarTodos();

//buscar os equipamentos cadastrados
$equipamento = new Equipamento();
$equipamentos = $equipamento->buscarTodos();

?>

<form class="ui form" action="chamados.php?f=a" method="POST">
  <div class="fields">
    <div class="four wide field required">
      <label>Local</label>
      <div class="ui fluid search selection dropdown" id="campo-local">
        <input type="hidden" name="idLocal">
        <i class="dropdown icon"></i>
        <div class="default text">selecione</div>
        <div class="menu">
          <?php foreach ($locais as $local) : ?>
            <div class="item" data-value="<?= $local["id"] ?>" 
              data-text="<?= $local["nome"] ?>"><?= $local["nome"] ?></div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
    <div class="six wide field required">
      <label>Equipamento</label>
      <div class="ui fluid search selection dropdown" id="campo-equipamento">
        <input type="hidden" name="idEquipamento">
        <i class="dropdown icon"></i>
        <div class="default text">selecione</div>
        <div class="menu">
          <?php foreach ($equipamentos as $equipamento) : ?>
            <div class="item" data-value="<?= $equipamento["id"] ?>" 
              data-text="<?= $equipamento["descricao"] ?>"><?= $equipamento["descricao"] ?></div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
  <div class="ten wide required field">
    <input name="problema" type="hidden">
    <label>Problema</label>
    <textarea rows="2" name="problema"></textarea>
  </div>
  <button type="submit" class="ui primary button">Abrir chamado</button>
</form>
