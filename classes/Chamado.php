<?php

class Chamado{
	public $id;
	public $problema;
    public $idLocal;
    public $idEquipamento;
    public $idUsuario;
    public $solucao;
    public $avaliacao;
    public $dataAbertura;
    public $dataFechamento;
    public $prioridade;
    public $local;
    public $equipamento;
    public $usuario;

	public function buscarChamadosAbertosPorUsuario($idUsuario){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT chamados.*, 
					DATE_FORMAT(chamados.dataAbertura, '%d/%m/%Y %h:%i') as abertura, 
					locais.nome as local, locais.sigla as localSigla, equipamentos.descricao as equipamento, equipamentos.sigla as equipamentoSigla 
					FROM chamados
					INNER JOIN locais on locais.id=chamados.idLocal
					INNER JOIN equipamentos on equipamentos.id=chamados.idEquipamento
					WHERE idUsuario=:idUsuario AND dataFechamento IS NULL";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":idUsuario", $idUsuario);
		$stmt->execute();
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

	public function buscarChamadosPorEquipamento($id){
		$conexao = Conexao::pegarConexao();

		$query = 
		"SELECT chamados.*, 
			TIMEDIFF(dataAbertura, dataFechamento) as media, 
			locais.nome as local, locais.sigla as localSigla, 
			equipamentos.descricao as equipamento, equipamentos.sigla as equipamentoSigla 
			FROM 
				chamados
			INNER JOIN 
				locais on locais.id=chamados.idLocal
			INNER JOIN 
				equipamentos on equipamentos.id=chamados.idEquipamento
			WHERE 
				idEquipamento=:id";

		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":id", $id);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function calculaMediaTempo($id){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT TIMEDIFF(dataAbertura, dataFechamento) as media FROM chamados 
				  WHERE idEquipamento=:id";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":id", $id);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}