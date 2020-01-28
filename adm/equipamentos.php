<?php
require_once "../global.php";
include "../notificacao.php";

//apagar
if (isset($_POST["idApagar"])) {
    $equipamento = new Equipamento();
    $equipamento->id = $_POST["idApagar"];
    $equipamento->apagar();
}

//editar
if (isset($_POST["idEditar"]) && $_POST["idEditar"] != "") {
    $equipamento = new Equipamento();
    $equipamento->id = $_POST["idEditar"];
    $equipamento->descricao = $_POST["descricao"];
    $equipamento->sigla = $_POST["sigla"];
    $equipamento->patrimonio = $_POST["patrimonio"];
    $equipamento->tipo = $_POST["tipo"];
    $equipamento->idlocal = $_POST["idlocal"];
    $equipamento->atualizar();
}

//inserir
if (isset($_POST["descricao"]) && $_POST["idEditar"] == "") {
    $equipamento = new Equipamento();
    $equipamento->descricao = $_POST["descricao"];
    $equipamento->sigla = $_POST["sigla"];
    $equipamento->patrimonio = $_POST["patrimonio"];
    $equipamento->tipo = $_POST["tipo"];
    $equipamento->idlocal = $_POST["idlocal"];
    $equipamento->inserir();
}

//buscar os equipamentos cadastrados
$equipamento = new Equipamento();
$equipamentos = $equipamento->buscarTodos();

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
    Novo equipamento
</button>
<table class="ui teal celled padded table datatable" id="datatable">
    <thead>
        <th class="center aligned">#</th>
        <th>Descrição</th>
        <th>Sigla</th>
        <th>Patrimônio</th>
        <th>Tipo</th>
        <th>Local</th>
        <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($equipamentos as $equipamento) : ?>
            <tr>
                <td class="center aligned"><?= $equipamento["id"] ?></td>
                <td class="single line"><?= $equipamento["descricao"] ?></td>
                <td><?= $equipamento["sigla"] ?></td>
                <td><?= $equipamento["patrimonio"] ?></td>
                <td><?= $equipamento["tipo"] ?></td>
                <td><?= $equipamento["local"] ?></td>
                <td>
                    <div class="ui small basic icon buttons">
                        <a href="chamado_por_equipamento?idEquipamento=<?= $equipamento["id"]?>&sigla=<?=$equipamento["sigla"]?> "><button class="ui button" data-tooltip="ver chamados do equipamento" onclick="chamadosEquipamento('<?=$equipamento["id"] ?>')"><i class="comment icon"></i></button></a>
                        <button class="ui button" data-tooltip="editar" onclick="editar('<?= $equipamento["id"] ?>', '<?= $equipamento["descricao"] ?>', '<?= $equipamento["sigla"] ?>', '<?= $equipamento["patrimonio"]?>', '<?= $equipamento["tipo"]?>', '<?= $equipamento["idlocal"] ?>' )"><i class="pencil icon"></i></button>
                        <button class="ui button" data-tooltip="apagar" onclick="excluir(<?= $equipamento["id"] ?>)"><i class="trash icon"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


<!-- modal inserir-->
<div class="ui modal" id="modalinserir">
    <div class="header">Cadastro de Equipamento</div>
    <div class="content">
        <form class="ui form" action="equipamentos.php" method="POST">
            <input type="hidden" name="idEditar" id="campo-id">
            <div class="two fields">
                <div class="twelve wide field">
                    <label>Descrição</label>
                    <input type="text" name="descricao" placeholder="ex. Desktop Lenovo i5" id="campo-descricao">
                </div>
                <div class="four wide field">
                    <label>Sigla</label>
                    <input type="text" name="sigla" placeholder="ex. PC001" id="campo-sigla">
                </div>
            </div>
            <div class="tree fields">
                <div class="four wide field">
                    <label>Patrimônio</label>
                    <input type="text" name="patrimonio" placeholder="n. de patrimônio" id="campo-patrimonio">
                </div>
                <div class="four wide field">
                    <label>Tipo</label>
                    <div class="ui fluid selection dropdown" id="campo-tipo">
                        <input type="hidden" name="tipo">
                        <i class="dropdown icon"></i>
                        <div class="default text">selecione</div>
                        <div class="menu">
                            <div class="item" data-value="Desktop" data-text="Desktop">
                                <i class="ui avatar icon desktop"></i> Desktop
                            </div>
                            <div class="item" data-value="Notebook" data-text="Notebook">
                                <i class="ui avatar icon laptop"></i> Notebook
                            </div>
                            <div class="item" data-value="Impressora" data-text="Impressora">
                                <i class="ui avatar icon print"></i> Impressora
                            </div>
                            <div class="item" data-value="Outro" data-text="Outro">
                                <i class="ui avatar icon hdd"></i> Outro
                            </div>
                        </div>
                    </div>
                </div>
                <div class="eight wide field">
                    <label>Local</label>
                    <div class="ui fluid search selection dropdown" id="campo-local">
                        <input type="hidden" name="idlocal">
                        <i class="dropdown icon"></i>
                        <div class="default text">selecione</div>
                        <div class="menu">
                            <?php foreach ($locais as $local) : ?>
                                <div class="item" data-value="<?= $local["id"]?>" data-text="<?= $local["nome"]?>"><?= $local["nome"]?></div>
                            <?php endforeach ?>
                        </div>
                    </div>
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
        <i class="trash icon"></i> Apagar equipamento
    </div>
    <div class="content">
        <p>Tem certeza que deseja apagar esse equipamento? Todos os dados relacionados a ele serão perdidos. Essa ação não poderá ser desfeita</p>
    </div>
    <form action="equipamentos.php" method="POST">
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

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    $('#btnNovo').on("click", function() {
        $('#campo-id').val("");
        $('#campo-descricao').val("");
        $('#campo-sigla').val("");
        $('#campo-patrimonio').val("");
        $('#campo-tipo').dropdown('clear');
        $('#campo-local').dropdown('clear');
        $('#modalinserir').modal('show');
    });

    function excluir($id) {
        $('#id-apagar').val($id);
        $('#modalexcluir').modal('show');
    }

    function editar($id, $descricao, $sigla, $patrimonio, $tipo, $idlocal) {
        $('#campo-id').val($id);
        $('#campo-descricao').val($descricao);
        $('#campo-sigla').val($sigla);
        $('#campo-patrimonio').val($patrimonio);
        $('#campo-tipo').dropdown('set selected', $tipo);
        $('#campo-local').dropdown('set selected', $idlocal);
        $('#modalinserir').modal('show');
    }

    $('.dropdown').dropdown();
</script>