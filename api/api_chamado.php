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
        $chamado->dataFechamento = date("Y-m-d H:i:s");
        $chamado->atualizar();
    }

    if($_POST["acao"] == 'avaliar-chamado'){
        $chamado = new Chamado();
        $chamado->carregar();
        $chamado->id = $_POST["id"];
        $chamado->avaliacao = $_POST["avaliacao"];
        $chamado->atualizar();
    }
}



?>