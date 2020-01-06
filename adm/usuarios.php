<?php include "cabecalho.php" ?>
<br>
<button class="ui button teal" id="btnNovo">
  <i class="icon plus"></i>
  Novo usuário
</button>
<table class="ui teal celled padded table datatable" id="datatable" >
  <thead>
    <th></th>
    <th class="center aligned">#</th>
    <th>Matrícula</th>
    <th>Nome</th>
    <th>Email</th>
    <th>Perfil</th>
    <th>Ações</th>
  </tr></thead>
  <tbody>
    <tr>
      <td class="center aligned"><img class="ui avatar image" src="../fotos/42919.jpg"></td>
      <td class="center aligned">1</td>
      <td>42919</td>
      <td class="single line">João Carlos Lima e Silva</td>
      <td>joaocarloslima@me.com</td>
      <td>Super Administrador</td>
      <td>
        <div class="ui small basic icon buttons">
          <button class="ui button"><i class="comment icon"></i></button>
          <button class="ui button"><i class="pencil icon"></i></button>
          <button class="ui red button" onclick="excluir()"><i class="trash icon"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td class="center aligned"><img class="ui avatar image" src="../fotos/65594.jpg"></td>
      <td class="center aligned">4</td>
      <td>42919</td>
      <td class="single line">Renata Borges</td>
      <td>joaocarloslima@me.com</td>
      <td>Super Administrador</td>
      <td>
        <div class="ui small basic icon buttons">
          <button class="ui button"><i class="comment icon"></i></button>
          <button class="ui button"><i class="pencil icon"></i></button>
          <button class="ui red button" onclick="excluir()"><i class="trash icon"></i></button>
        </div>
      </td>
    </tr>
  </tbody>
</table>


<!-- modal inserir-->
<div class="ui modal" id="modalinserir">
  <div class="header">Cadastrar Usuário</div>
  <div class="content">
    <form class="ui form">
      <div class="two fields">
        <div class="field">
          <label>Matrícula</label>
          <input type="number" name="">
        </div>
        <div class="field">
          <label>Perfil</label>
          <div class="ui fluid selection dropdown">
            <input type="hidden" name="perfil">
            <i class="dropdown icon"></i>
            <div class="default text">selecione</div>
            <div class="menu">
              <div class="item" data-value="jenny" data-text="Usuário">
                <i class="ui avatar icon user outline"></i> Usuário
              </div>
              <div class="item" data-value="elliot" data-text="Técnico">
                <i class="ui avatar icon user"></i> Técnico
              </div>
              <div class="item" data-value="stevie" data-text="Administrador">
                <i class="ui avatar icon user secret"></i> Administrador
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="field">
        <label>Nome</label>
        <input type="text" name="" placeholder="nome completo">
      </div>
      <div class="two fields">
        <div class="field">
          <label>E-mail</label>
          <input type="email" name="" placeholder="e-mail de contato">
        </div>
        <div class="field">
          <label>Senha</label>
          <input type="password" name="" placeholder="senha de acesso">
        </div>
      </div>
    </form>

  </div>
  <div class="actions">
    <button class="ui cancel button">Cancelar</button>
    <button class="ui teal approve button">Salvar</button>
  </div>
</div>

<!-- modal exluir-->
<div class="ui basic modal" id="modalexcluir">
  <div class="ui icon header">
    <i class="trash icon"></i> Apagar usuário
  </div>
  <div class="content">
    <p>Tem certeza que deseja apagar esse usuário? Todos os dados relacionados a ele serão perdidos. Essa ação não poderá ser desfeita</p>
  </div>
  <div class="actions">
    <div class="ui green basic cancel inverted button">
      <i class="remove icon"></i> Não Apagar
    </div>
    <div class="ui red ok inverted button">
      <i class="checkmark icon"></i> Apagar
    </div>
  </div>
</div>


<?php include "rodape.php" ?>

<script type="text/javascript">
  $('#btnNovo').on("click", function(){
    $('#modalinserir').modal('show');
  });

  function excluir(){
    $('#modalexcluir').modal('show');
  }

  $('.dropdown').dropdown();


</script>

