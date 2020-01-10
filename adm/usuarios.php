<?php
include "../notificacao.php";
require_once "../global.php";
require_once "../classes/Usuario.php";

// Listagem de usuarios
$usuario = new Usuario();
$listaUsuarios = $usuario->buscarTodos();

// Apagar usuario
if (isset($_POST["idApagar"])){
    $usuario = new Usuario();
    $usuario->id = $_POST["idApagar"];

    $usuario->apagar();
}

// Inserir
if (isset($_POST["matricula"]) && $_POST["idEditar"] == ""){
    $usuario = new Usuario();
    $usuario->matricula = $_POST["matricula"];
    $usuario->nome = $_POST["nome"];
    $usuario->email = $_POST["email"];
    $usuario->perfil = $_POST["perfil"];
    $usuario->senha = $_POST["senha"];

    $usuario->inserir();
}

// Atualizar
if(isset($_POST["idEditar"]) && $_POST["idEditar"] != ""){
    $usuario = new Usuario();
    $usuario->id = $_POST["idEditar"];
    $usuario->matricula = $_POST["matricula"];
    $usuario->nome = $_POST["nome"];
    $usuario->email = $_POST["email"];
    $usuario->perfil = $_POST["perfil"];
    $usuario->senha = $_POST["senha"];

    $usuario->atualizar();
}

?>

<?php include "cabecalho.php"; ?>

<?php
    mostrarNotificacao('red');
    mostrarNotificacao('green');
?>

<br>
<button class="ui button teal" id="btnNovo">
  <i class="icon plus"></i>
  Novo usuário 
</button>
<table class="ui teal celled padded table datatable" id="datatable">
  <thead>
    <th class="center aligned">#</th>
    <th>Matrícula</th>
    <th>Nome</th>
    <th>Email</th>
    <th>Perfil</th>
    <th>Ações</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($listaUsuarios as $usuario) : 
      $arquivo = "../fotos/".(string)$usuario['matricula'].".jpg"; 

      if($usuario["perfil"] == 0 )
          $usuario["perfil"] = "Usuario";
      elseif($usuario["perfil"] == 1 )
          $usuario["perfil"] = "Administrados";
      else
          $usuario["perfil"] = "Tecnico";
    ?>

      <tr>
        <td class="center aligned"><img class="ui avatar image" src="../fotos/<?= is_file($arquivo) == true?$usuario['matricula'] :'semFoto' ?>.jpg"></td>
        <td><?= $usuario['matricula'] ?></td>
        <td class="single line"><?= $usuario['nome'] ?></td>
        <td><?= $usuario['email'] ?></td>
        <td><?=$usuario['perfil'] ?></td>
        <td>

          <div class="ui small basic icon buttons">
            <button class="ui button"><i class="comment icon"></i></button>
            <button class="ui button"  onclick="editar('<?=$usuario['id'] ?>', '<?=$usuario['matricula'] ?>', 
                '<?=$usuario['nome'] ?>', '<?=$usuario['email'] ?>', '<?=$usuario['perfil'] ?>', '<?=$usuario['senha'] ?>')">
                <i class="pencil icon"></i>
            </button>
            <button class="ui red button" onclick="excluir(<?= $usuario['id'] ?>)"> <i class="trash icon"></i></button>
          </div>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>


<!-- modal inserir-->
<div class="ui modal" id="modalinserir">
  <div class="header">Cadastrar de Usuário</div>
  <div class="content">
    <form class="ui form" action="usuarios.php" method="POST">
      <input type="hidden" name='idEditar' id="campo-id">
      <div class="two fields">
        <div class="field">
          <label>Matrícula</label>
          <input type="number" name="matricula" id='campo-matricula'>
        </div>
        <div class="field">
          <label>Perfil</label>
          <div class="ui fluid selection dropdown">
            <input type="hidden" name="perfil" id='campo-perfil'>
            <i class="dropdown icon"></i>
            <div class="default text">selecione</div>
            <div class="menu">
              <div class="item" data-value = 0 data-text="Usuário">
                <i class="ui avatar icon user outline"></i> Usuário
              </div>
              <div class="item" data-value = 2 data-text="Técnico">
                <i class="ui avatar icon user"></i> Técnico
              </div>
              <div class="item" data-value = 1 data-text="Administrador">
                <i class="ui avatar icon user secret"></i> Administrador
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="field">
        <label>Nome</label>
        <input type="text" name="nome" placeholder="nome completo" id='campo-nome'>
      </div>
      <div class="two fields">
        <div class="field">
            <label>E-mail</label>
            <input type="email" name="email" placeholder="e-mail de contato" id='campo-email'>
        </div>
        <div class="field">
          <label>Senha</label>
          <input type="password" name="senha" placeholder="senha de acesso" id='campo-senha'>
        </div>
         </div>

        </div>
        <div class="actions">
            <div class="ui cancel button">Cancelar</div>
            <button type="submit" class="ui teal approve button">Salvar</button>
        </div>
    </form>
</div>

<!-- modal exluir-->
<div class="ui basic modal" id="modalexcluir">
  <div class="ui icon header">
    <i class="trash icon"></i> Apagar usuário
  </div>

  <div class="content">
    <p>Tem certeza que deseja apagar esse usuário? Todos os dados relacionados a ele serão perdidos. Essa ação não poderá ser desfeita</p>
  </div>

  <form action="usuarios.php" method="POST">  
    <input type="hidden" name="idApagar" id="id-apagar">
    <div class="actions">
      <div class="ui green basic cancel inverted button">
        <i class="remove icon"></i> Não Apagar
      </div>
      <button action="submit" class="ui red ok inverted button">
        <i class="checkmark icon"></i> Apagar
      </button>
    </div>
  </form>
</div>


<?php include "rodape.php" ?>

<script type="text/javascript">

    $('#btnNovo').on("click", function() {
    $('#campo-id').val("");
    $('#campo-matricula').val("");
    $('#campo-nome').val("");
    $('#campo-email').val("");
    $('#campo-perfil').val("Selecione");
    $('#campo-senha').val("");
    $('#modalinserir').modal('show');
  });

  function editar($id, $matricula, $nome, $email, $perfil, $senha){
    $('#campo-id').val($id);
    $('#campo-matricula').val($matricula);
    $('#campo-nome').val($nome);
    $('#campo-email').val($email);
    $('#campo-perfil').val("Selecione");
    $('#campo-senha').val($senha);
    $('#modalinserir').modal("show");
  }

  function excluir($id) {
      $('#id-apagar').val($id);
      $('#modalexcluir').modal('show');
  }

  $('.dropdown').dropdown();
</script>