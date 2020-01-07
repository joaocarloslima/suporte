<?php

class Local{
	public $id;
	public $nome;
	public $sigla;

	public function buscarTodos(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT * FROM locais";
	    $stmt = $conexao->query($query);
		return $stmt->fetchAll();
	}

}