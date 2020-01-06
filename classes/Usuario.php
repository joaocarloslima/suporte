<?php

class Usuario{
	public $matricula;
	public $senha;
	public $email;
	public $pefil;
	public $logado=false;

	public function logar(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT * FROM usuarios WHERE matricula=:matricula AND senha=md5(:senha)";
	    $stmt = $conexao->prepare($query);
	    $stmt->bindValue(":matricula", $this->matricula);
	    $stmt->bindValue(":senha", $this->senha);
	    $stmt->execute();
	    if ($linha = $stmt->fetch()) {
	    	$this->logado = true;
	    	$this->perfil = $linha["perfil"];
	    	$this->email = $linha["email"];
	    }

	}
}