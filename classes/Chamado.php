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

	public function buscarChamadosFechadosPorUsuario($idUsuario){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT chamados.*, 
					DATE_FORMAT(chamados.dataAbertura, '%d/%m/%Y %h:%i') as abertura, 
					locais.nome as local, locais.sigla as localSigla, equipamentos.descricao as equipamento, equipamentos.sigla as equipamentoSigla 
					FROM chamados
					INNER JOIN locais on locais.id=chamados.idLocal
					INNER JOIN equipamentos on equipamentos.id=chamados.idEquipamento
					WHERE idUsuario=:idUsuario AND dataFechamento IS NOT NULL";
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
		$query = "INSERT INTO 
					chamados(problema, idLocal, idEquipamento, idUsuario, dataAbertura)
				VALUES 
					(:problema, :idLocal, :idEquipamento, :idUsuario, NOW())";

		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":problema", $this->problema);
		$stmt->bindValue(":idLocal", $this->idLocal);
		$stmt->bindValue(":idEquipamento", $this->idEquipamento);
		$stmt->bindValue(":idUsuario", $this->idUsuario);
		try {
			$stmt->execute();
			$_SESSION["green"] = "Chamado aberto com sucesso";
		} catch (\Throwable $e) {
			$_SESSION["red"] = "Erro ao abrir chamado. <br><br>[$e]";
		}
	}

	// Mudar para o ADM 
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

	public static function qtdeChamadosAbertos(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT * FROM chamados WHERE dataFechamento IS NULL";
		$stmt = $conexao->query($query);
		return $stmt->rowCount();
	}

	public static function tempoMedioDeEspera(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(timediff(dataAbertura, dataFechamento)))) as media FROM `chamados` WHERE dataFechamento is not null";
		$stmt = $conexao->query($query);
		return $stmt->fetchColumn(0);
	}

	public static function chamadoMaisAntigo(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT TIMEDIFF(MIN(dataAbertura),NOW()) FROM chamados WHERE dataFechamento IS NULL";
		$stmt = $conexao->query($query);
		return $stmt->fetchColumn(0);
	}

	public static function satisfacaoMedia(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT AVG(avaliacao) as media FROM `chamados` WHERE avaliacao IS NOT NULL AND dataFechamento IS NOT NULL";
		$stmt = $conexao->query($query);
		return $stmt->fetchColumn(0);
	}

}