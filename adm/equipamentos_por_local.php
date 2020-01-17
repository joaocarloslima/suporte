<?php
require_once "../global.php";

$equipamentos = new Equipamento();
$equipamentoLocal = $equipamentos->buscarEquipamentosPorLocal($_GET["idLocal"]);

$nomeLocal = $_GET["local"];

?>

<?php include "cabecalho.php"; ?>
<table class="ui blue celled padded table" id="datatable">
    <p>
        <h3>Equipamentos - <?= $nomeLocal ?></h3>
    </p>
    <thead>
        <th>Cod. Equipamento</th>
        <th>Descrição</th>
        <th>Sigla</th>
        <th>Patrimônio</th>
        <th>Tipo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($equipamentoLocal as $equipamento) : ?>
            <tr>
                <td><?= $equipamento['id'] ?></td>
                <td class="single line"><?= $equipamento["descricao"] ?></td>

                <td><?= $equipamento["sigla"]?></td>

                <td><?= $equipamento["patrimonio"] ?></td>

                <td><?=$equipamento["tipo"] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

</body>

<?php include "rodape.php" ?>
</html>