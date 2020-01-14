<?php

class Equipamento{
	public $id;
	public $descricao;
    public $sigla;
    public $patrimonio;
    public $tipo;
    public $idlocal;
    public $local;
    public $siglaLocal;

	public function buscarTodos(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT equipamentos.*, locais.id as idlocal, locais.sigla as siglalocal, locais.nome as local FROM equipamentos LEFT JOIN locais ON locais.id=equipamentos.idLocal";
	    $stmt = $conexao->query($query);
		return $stmt->fetchAll();
	}

	public function apagar() {
		$conexao = Conexao::pegarConexao();
		$query = "DELETE FROM equipamentos WHERE id=:id";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":id", $this->id);
		try {
			$stmt->execute();
			$_SESSION["green"] = "Equipamento apagado com sucesso";
		} catch (\Throwable $e) {
			$_SESSION["red"] = "Erro ao apagar equipamento. <br><br>[$e]";
		}
	}

	public function inserir() {
		$conexao = Conexao::pegarConexao();
		$query = "INSERT INTO equipamentos (id, descricao, sigla, patrimonio, tipo, idlocal) VALUES (0, :descricao, :sigla, :patrimonio, :tipo, :idlocal)";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":descricao", $this->descricao);
		$stmt->bindValue(":sigla", $this->sigla);
		$stmt->bindValue(":patrimonio", $this->patrimonio);
		$stmt->bindValue(":tipo", $this->tipo);
		$stmt->bindValue(":idlocal", $this->idlocal);
		try {
			$stmt->execute();
			$_SESSION["green"] = "Equipamento cadastrado com sucesso";
		} catch (\Throwable $e) {
			$_SESSION["red"] = "Erro ao cadastrar equipamento. <br><br>[$e]";
		}
	}

	public function atualizar() {
		$conexao = Conexao::pegarConexao();
		$query = "UPDATE equipamentos SET descricao=:descricao, sigla=:sigla, patrimonio=:patrimonio, tipo=:tipo, idlocal=:idlocal WHERE id=:id";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":id", $this->id);
		$stmt->bindValue(":descricao", $this->descricao);
		$stmt->bindValue(":sigla", $this->sigla);
		$stmt->bindValue(":patrimonio", $this->patrimonio);
		$stmt->bindValue(":tipo", $this->tipo);
		$stmt->bindValue(":idlocal", $this->idlocal);
		try {
			$stmt->execute();
			$_SESSION["green"] = "Equipamento alterado com sucesso";
		} catch (\Throwable $e) {
			$_SESSION["red"] = "Erro ao alterar equipamento. <br><br>[$e]";
		}
	}

}