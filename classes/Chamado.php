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

	public function buscarTodosChamadosAbertos(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT chamados.*, 
					DATE_FORMAT(chamados.dataAbertura, '%d/%m/%Y %h:%i') as abertura, 
						locais.nome as local, locais.sigla as localSigla, 
						equipamentos.descricao as equipamento, equipamentos.sigla as equipamentoSigla,
						usuarios.nome as usuario, usuarios.matricula as usuarioMatricula 
					FROM 
						chamados
					INNER JOIN 
						locais on locais.id=chamados.idLocal
					INNER JOIN 
						equipamentos on equipamentos.id=chamados.idEquipamento
					INNER JOIN
						usuarios on usuarios.id=chamados.idUsuario
					WHERE 
						dataFechamento IS NULL";

		$stmt = $conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function buscarTodosChamadosFechados(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT chamados.*, 
					DATE_FORMAT(chamados.dataAbertura, '%d/%m/%Y %h:%i') as abertura, 
						locais.nome as local, locais.sigla as localSigla, 
						equipamentos.descricao as equipamento, equipamentos.sigla as equipamentoSigla,
						usuarios.nome as usuario, usuarios.matricula as usuarioMatricula 
					FROM 
						chamados
					INNER JOIN 
						locais on locais.id=chamados.idLocal
					INNER JOIN 
						equipamentos on equipamentos.id=chamados.idEquipamento
					INNER JOIN
						usuarios on usuarios.id=chamados.idUsuario
					WHERE 
						dataFechamento IS NOT NULL";

		$stmt = $conexao->prepare($query);
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
		$query = "UPDATE chamados SET 
			problema=:problema,
			idLocal = :idLocal,
			idEquipamento = :idEquipamento,
			idUsuario = :idUsuario,
			solucao = :solucao,
			avaliacao = :avaliacao,
			dataAbertura = :dataAbertura,
			dataFechamento = :dataFechamento,
			prioridade = :prioridade
			 WHERE id=:id";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":id", $this->id);
		$stmt->bindValue(":problema", $this->problema);
		$stmt->bindValue(":idLocal", $this->idLocal);
		$stmt->bindValue(":idEquipamento", $this->idEquipamento);
		$stmt->bindValue(":idUsuario", $this->idUsuario);
		$stmt->bindValue(":solucao", $this->solucao);
		$stmt->bindValue(":avaliacao", $this->avaliacao);
		$stmt->bindValue(":dataAbertura", $this->dataAbertura);
		$stmt->bindValue(":dataFechamento", $this->dataFechamento);
		$stmt->bindValue(":prioridade", $this->prioridade);
		$stmt->execute();
	}

	public function carregar(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT * FROM chamados WHERE id=:id";
	    $stmt = $conexao->prepare($query);
	    $stmt->bindValue(":id", $this->id);
	    $stmt->execute();
	    if ($linha = $stmt->fetch()) {
	    	$this->problema = $linha["problema"];
	    	$this->idLocal = $linha["idLocal"];
	    	$this->idEquipamento = $linha["idEquipamento"];
	    	$this->idUsuario = $linha["idUsuario"];
	    	$this->solucao = $linha["solucao"];
	    	$this->avaliacao = $linha["avaliacao"];
	    	$this->dataAbertura = $linha["dataAbertura"];
	    	$this->dataFechamento = $linha["dataFechamento"];
	    	$this->prioridade = $linha["prioridade"];
	    }
	}

	public static function qtdeChamadosAbertosPorUsuario($idUsuario){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT * FROM chamados WHERE dataFechamento IS NULL AND idUsuario=:idUsuario";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":idUsuario", $idUsuario);
		$stmt->execute();
		return $stmt->rowCount();
	}

	public static function qtdeChamadosFechadosPorUsuario($idUsuario){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT * FROM chamados WHERE dataFechamento IS NOT NULL AND idUsuario=:idUsuario";
		$stmt = $conexao->prepare($query);
		$stmt->bindValue(":idUsuario", $idUsuario);
		$stmt->execute();
		return $stmt->rowCount();
	}

	public static function qtdeChamadosAbertos(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT * FROM chamados WHERE dataFechamento IS NULL";
		$stmt = $conexao->query($query);
		return $stmt->rowCount();
	}

	public static function qtdeChamadosFechados(){
		$conexao = Conexao::pegarConexao();
		$query = "SELECT * FROM chamados WHERE dataFechamento IS NOT NULL";
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