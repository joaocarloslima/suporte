<?php
//buscar os locais cadastrados
require_once "../global.php";
$local = new Local();
$locais = $local->buscarTodos();

?>

<?php include "cabecalho.php" ?>
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
                        <button class="ui button" data-tooltip="ver equipamentos do local"><i class="desktop icon"></i></button>
                        <button class="ui button" data-tooltip="editar"><i class="pencil icon"></i></button>
                        <button class="ui button" data-tooltip="apagar" onclick="excluir()"><i class="trash icon"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


<!-- modal inserir-->
<div class="ui modal" id="modalinserir">
    <div class="header">Cadastrar Local</div>
    <div class="content">
        <form class="ui form">
            <div class="two fields">
                <div class="twelve wide field">
                    <label>Nome</label>
                    <input type="text" name="nome" placeholder="nome do local">
                </div>
                <div class="four wide field">
                    <label>Sigla</label>
                    <input type="text" name="sigla" placeholder="sigla do local">
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
    $('#btnNovo').on("click", function() {
        $('#modalinserir').modal('show');
    });

    function excluir() {
        $('#modalexcluir').modal('show');
    }

    $('.dropdown').dropdown();
</script>