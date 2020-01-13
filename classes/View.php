<?php
class view{

    public static function mostrarPrioridade($prioridade){
        $PRIORIDADES = array("Alta", "Média", "Baixa");
        $ICONES = array("full red", "half yellow", "empty green");
        $icone = $ICONES[$prioridade];
        $html = "";
        $html.= "<i class='icon thermometer $icone'></i>";
        $html.= $PRIORIDADES[$prioridade];
        return $html;
    }

    public static function mostrarAbertura($data){
        $hoje = new DateTime();
        $abertura = new DateTime($data);
        $diferenca = $hoje->diff($abertura);
        $dias_em_aberto = $diferenca->days;
        if ($dias_em_aberto > 8) $icone = "end red";
        elseif ($dias_em_aberto < 4) $icone = "start green";
        else $icone = "half yellow";
        $html = "";
        $html.= "<i class='icon hourglass $icone'></i>";
        $html.= $abertura->format('d/m H:i');
        return $html;
    }

}