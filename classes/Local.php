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

	public function apagar() {
		$conexao = Conexao::pegarConexao();
		$query = "DELETE FROM locais WHERE id=:id";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":id", $this->id);
		try {
			$stmt->execute();
			$_SESSION["green"] = "Local apagado com sucesso";
		} catch (\Throwable $e) {
			$_SESSION["red"] = "Erro ao apagar local. <br><br>[$e]";
		}
	}

	public function inserir() {
		$conexao = Conexao::pegarConexao();
		$query = "INSERT INTO locais (id, nome, sigla) VALUES (0, :nome, :sigla)";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":nome", $this->nome);
		$stmt->bindValue(":sigla", $this->sigla);
		try {
			$stmt->execute();
			$_SESSION["green"] = "Local cadastrado com sucesso";
		} catch (\Throwable $e) {
			$_SESSION["red"] = "Erro ao cadastrar local. <br><br>[$e]";
		}
	}

	public function atualizar() {
		$conexao = Conexao::pegarConexao();
		$query = "UPDATE locais SET nome=:nome, sigla=:sigla WHERE id=:id";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":id", $this->id);
		$stmt->bindValue(":nome", $this->nome);
		$stmt->bindValue(":sigla", $this->sigla);
		try {
			$stmt->execute();
			$_SESSION["green"] = "Local alterado com sucesso";
		} catch (\Throwable $e) {
			$_SESSION["red"] = "Erro ao alterar local. <br><br>[$e]";
		}
	}
}