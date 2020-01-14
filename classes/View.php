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

    public static function mostrarTempoDeAtendimento($dataAbertura, $dataFechamento){
        $abertura = new DateTime($dataAbertura);
        $fechamento = new DateTime($dataFechamento);
        $diferenca = $abertura->diff($fechamento);
        $html = "";
        $partes = array();
        if ($diferenca->y > 1) array_push($partes, $diferenca->y . " anos");
        elseif ($diferenca->y > 0) array_push($partes, $diferenca->y . " ano");
        if ($diferenca->m > 1) array_push($partes, $diferenca->m . " meses");
        elseif ($diferenca->m > 0) array_push($partes, $diferenca->m . " mês");
        if ($diferenca->d > 1) array_push($partes, $diferenca->d . " dias");
        elseif ($diferenca->d > 0) array_push($partes, $diferenca->d . " dia");
        if ($diferenca->h > 1) array_push($partes, $diferenca->h . " horas");
        elseif ($diferenca->h > 0) array_push($partes, $diferenca->h . " hora");
        if ($diferenca->i > 1) array_push($partes, $diferenca->i . " minutos");
        elseif ($diferenca->i > 0) array_push($partes, $diferenca->i . " minuto");

        $html.= join(", ", $partes);
        return $html;

    }

}