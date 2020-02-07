<?php
require_once "../global.php";
include "../notificacao.php";

//apagar
if (isset($_POST["idApagar"])) {
    $local = new Local();
    $local->id = $_POST["idApagar"];
    $local->apagar();
}

//editar
if (isset($_POST["idEditar"]) && $_POST["idEditar"]!="") {
    $local = new Local();
    $local->id = $_POST["idEditar"];
    $local->nome = $_POST["nome"];
    $local->sigla = $_POST["sigla"];
    $local->atualizar();
}

//inserir
if (isset($_POST["nome"]) && $_POST["idEditar"]=="") {
    $local = new Local();
    $local->nome = $_POST["nome"];
    $local->sigla = $_POST["sigla"];
    $local->inserir();
}

//buscar os locais cadastrados
$local = new Local();
$locais = $local->buscarTodos();

?>

<?php include "cabecalho.php" ?>
<?php
mostrarNotificacao('red');
mostrarNotificacao('green');
?>
<br>
<button class="ui button teal" id="btnNovo">
    <i class="icon plus"></i>
    Novo local
</button>
<table class="ui teal celled padded table datatable" id="datatable">
    <thead>
        <th class="center aligned">#</th>
        <th>Nome</th>
        <th>Sigla</th>
        <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($locais as $local) : ?>
            <tr>
                <td class="center aligned"><?= $local["id"] ?></td>
                <td class="single line"><?= $local["nome"] ?></td>
                <td><?= $local["sigla"] ?></td>
                <td>
                    <div class="ui small basic icon buttons">
                        <a href="equipamentos_por_local?idLocal=<?= $local["id"]?>&local=<?=$local["nome"]?>"><button class= "ui button" data-tooltip="ver equipamentos do local"><i class="desktop icon"></i></button></a>
                        <button class="ui button" data-tooltip="editar" onclick="editar('<?= $local["id"] ?>', '<?= $local["nome"] ?>', '<?= $local["sigla"]?>')"><i class="pencil icon"></i></button>
                        <button class="ui button" data-tooltip="apagar" onclick="excluir(<?= $local["id"] ?>)"><i class="trash icon"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


<!-- modal inserir-->
<div class="ui modal" id="modalinserir">
    <div class="header">Cadastro de Local</div>
    <div class="content">
        <form class="ui form" action="locais.php" method="POST">
            <input type="hidden" name="idEditar" id="campo-id">
            <div class="two fields">
                <div class="twelve wide field">
                    <label>Nome</label>
                    <input type="text" name="nome" placeholder="nome do local" id="campo-nome">
                </div>
                <div class="four wide field">
                    <label>Sigla</label>
                    <input type="text" name="sigla" placeholder="sigla do local" id="campo-sigla">
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
        <i class="trash icon"></i> Apagar local
    </div>
    <div class="content">
        <p>Tem certeza que deseja apagar esse local? Todos os dados relacionados a ele serão perdidos. Essa ação não poderá ser desfeita</p>
    </div>
    <form action="locais.php" method="POST">
        <input type="hidden" name="idApagar" id="id-apagar">
        <div class="actions">
            <div class="ui green basic cancel inverted button">
                <i class="remove icon"></i> Não Apagar
            </div>

            <button class="ui red ok inverted button">
                <i class="checkmark icon"></i> Apagar
            </button>
        </div>
    </form>
</div>


<?php include "rodape.php" ?>

<script type="text/javascript">
    $('#btnNovo').on("click", function() {
        $('#campo-id').val("");
        $('#campo-nome').val("");
        $('#campo-sigla').val("");
        $('#modalinserir').modal('show');
    });

    function excluir($id) {
        $('#id-apagar').val($id);
        $('#modalexcluir').modal('show');
    }

    function editar($id, $nome, $sigla){
        $('#campo-id').val($id);
        $('#campo-nome').val($nome);
        $('#campo-sigla').val($sigla);
        $('#modalinserir').modal('show');
    }

    $('.dropdown').dropdown();
</script>