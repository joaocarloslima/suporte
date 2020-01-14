<?php
require_once "../global.php";

$chamados = new Chamado();
$chamadasEquipamento = $chamados->buscarChamadosPorEquipamento($_GET["idEquipamento"]);

$NomeEquipamento = $_GET["sigla"];

?>

<?php include "cabecalho.php"; ?>
<table class="ui blue celled padded table" id="datatable">
    <p>
        <h3>Chamados do <?= $NomeEquipamento ?></h3>
    </p>
    <thead>
        <th>Cod. Chamado</th>
        <th>Problema</th>
        <th>Local</th>
        <th>Solução</th>
        <th>Tempo de Atendimento</th>
        <th>Status</th>
        <th>Avaliacao</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($chamadasEquipamento as $chamadaEquipamento) : ?>
            <tr>
                <td><?= $chamadaEquipamento['id'] ?></td>
                <td class="single line"><?= $chamadaEquipamento["problema"] ?></td>

                <td><?= $chamadaEquipamento["local"] ?></td>

                <td><?= $chamadaEquipamento["solucao"] ?></td>

                <td><?= View::mostrarTempoDeAtendimento($chamadaEquipamento["dataAbertura"], $chamadaEquipamento["dataFechamento"]) ?></td>

                <td><?= $chamadaEquipamento["dataFechamento"] != null ? "Fechado" : "Aberto" ?></td>
                <td>
                    <div class="ui star rating" data-rating="<?= $chamadaEquipamento["avaliacao"]?>"></div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

</body>

<?php include "rodape.php" ?>

<script>
    $('.ui.rating').rating({
        interactive: false
    });
</script>

</html>