<?php
require_once "../global.php";

if(isset($_POST["acao"])){
    if ($_POST["acao"] == "filtrar_por_local"){
        $equipamento = new Equipamento();
        $idLocal = $_POST["idLocal"];
        $lista = $equipamento->buscarEquipamentosPorLocal($idLocal);
        echo json_encode($lista);
    }

}



?>