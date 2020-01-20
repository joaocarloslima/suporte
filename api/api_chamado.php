<?php
require_once "../global.php";

if(isset($_POST["acao"])){
    if ($_POST["acao"] == "trocar_prioridade"){
        $chamado = new Chamado();
        $chamado->id = $_POST["id"];
        $chamado->carregar();
        $chamado->prioridade = ($chamado->prioridade + 1) % 3;
        $chamado->atualizar();
        echo View::mostrarPrioridade($chamado->prioridade, $chamado->id);
    }

    if($_POST["acao"] == "responder_chamados"){
        $chamado = new Chamado();
        $chamado->id = $_POST["id"];
        $chamado->carregar();
        $chamado->solucao = $_POST["solucao"];
        $chamado->atualizar();
        $_SESSION["success"] = "Chamado respondido";
    }
}



?>