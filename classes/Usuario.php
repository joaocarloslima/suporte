<?php

class Usuario{
	public $id;
	public $matricula;
	public $nome;
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
	    	$this->nome = $linha["nome"];
	    	$this->id = $linha["id"];
	    }

	}

	public function buscarTodos(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT * FROM usuarios";
        $stmt = $conexao->query($query);
        return $stmt->fetchAll();
	}

	public function apagar() {
		$conexao = Conexao::pegarConexao();
		$query = "DELETE FROM usuarios WHERE id=:id";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":id", $this->id);
		try{
			$stmt->execute();
			$_SESSION["green"] = "Usuario apagado com sucesso";
		}catch(\Throwable $e){
			$_SESSION["red"] = "Erro ao apagar usuario .<br><br>[$e]";
		}
	}

	public function inserir(){
		$conexao = Conexao::pegarConexao();
		$query = "INSERT INTO usuarios(matricula, nome, email, perfil, senha) 
					VALUES (:matricula, :nome, :email, :perfil, md5(:senha))";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":matricula", $this->matricula);
		$stmt->bindValue(":nome", $this->nome);
		$stmt->bindValue(":email", $this->email);
		$stmt->bindValue(":perfil", $this->perfil);
		$stmt->bindValue(":senha", $this->senha);
		try{
			$stmt->execute();
			$_SESSION["green"] = 'Usuario inserido com sucesso';
		}catch(\Throwable $e){
			$_SESSION["red"] = "Erro ao inserir usuario. <br><br>[$e]";
		}
	}
	
	public function atualizar(){
		$conexao = Conexao::pegarConexao();
		$query = "UPDATE usuarios SET matricula=:matricula, nome=:nome, email=:email, 
				  perfil=:perfil WHERE id=:id";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":matricula", $this->matricula);
		$stmt->bindValue(":nome", $this->nome);
		$stmt->bindValue(":email", $this->email);
		$stmt->bindValue(":perfil", $this->perfil);
		$stmt->bindValue(":id", $this->id);

		try{
			$stmt->execute();
			$_SESSION["green"] = "Usuario alterado com sucsso";
		}catch(\Throwable $e){
			$_SESSION["red"] = "Error ao alterar usuario. <br><br>[$e]";
		}
	}

	public function carregar(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT * FROM usuarios WHERE matricula=:matricula";
	    $stmt = $conexao->prepare($query);
	    $stmt->bindValue(":matricula", $this->matricula);
	    $stmt->execute();
	    if ($linha = $stmt->fetch()) {
	    	$this->id = $linha["id"];
	    	$this->nome = $linha["nome"];
	    	$this->email = $linha["email"];
	    	$this->perfil = $linha["perfil"];
	    	$this->senha = $linha["senha"];
	    }
	}

	public function alterarSenha(){
		$conexao = Conexao::pegarConexao();
		$query = "UPDATE usuarios SET senha=md5(:senha) WHERE id=:id";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":senha", $this->senha);
		$stmt->bindValue(":id", $this->id);

		try{
			$stmt->execute();
			$_SESSION["green"] = "Senha alterada com sucsso";
		}catch(\Throwable $e){
			$_SESSION["red"] = "Error ao alterar senha. <br><br>[$e]";
		}
	}



}