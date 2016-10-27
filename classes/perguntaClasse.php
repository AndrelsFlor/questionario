<?php
	require_once('CRUD.php');

	class pergunta extends CRUD{
		
		protected $tabela = "tblpergunta";

		private $idTopico;
		private $idProfessor;
		private $enunciado;
		private $tipo;
		private $enuncA;
		private $enuncB;
		private $enuncC;
		private $enuncD;
		private $enuncE;

		public function insert(){
			$sql = "INSERT INTO $this->tabela(IDTopico,IDProfessor,Enunciado,Tipo,enuncA,enuncB,enuncC,enuncD,enuncE) VALUES(:idTopico,:idProfessor,:enunciado,:tipo,:enuncA,:enuncB,:enuncC,:enuncD,:enuncE)";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':idTopico',	$this->idTopico);
			$stmt->bindParam(':idProfessor',$this->idProfessor);
			$stmt->bindParam(':enunciado',	$this->enunciado);
			$stmt->bindParam(':tipo',		$this->tipo);
			$stmt->bindParam(':enuncA',		$this->enuncA);
			$stmt->bindParam(':enuncB',		$this->enuncB);
			$stmt->bindParam(':enuncC',		$this->enuncC);
			$stmt->bindPAram(':enuncD',		$this->enuncD);
			$stmt->bindParam(':enuncE',		$this->enuncE);

			return $stmt->execute();
		}
	  
	   public function update($id){
	   		$sql = "UPDATE $this->tabela SET IDTopico = :idTopico,IDProfessor = :idProfessor,Enunciado = :enunciado,Tipo = :tipo,enuncA = :enuncA,enuncB = :enuncB,enuncC = :enuncC,enuncD = :enuncD,enuncE = enuncE: WHERE ID = :id";
	   		$stmt = BD::prepare($sql);
			$stmt->bindParam(':idTopico',	$this->idTopico);
			$stmt->bindParam(':idProfessor',$this->idProfessor);
			$stmt->bindParam(':enunciado',	$this->enunciado);
			$stmt->bindParam(':tipo',		$this->tipo);
			$stmt->bindParam(':enuncA',		$this->enuncA);
			$stmt->bindParam(':enuncB',		$this->enuncB);
			$stmt->bindParam(':enuncC',		$this->enuncC);
			$stmt->bindPAram(':enuncD',		$this->enuncD);
			$stmt->bindParam(':enuncE',		$this->enuncE);
			$stmt->bindParam(':id', 		$id);

			return $stmt->execute();
	   }	

	  public function setIDTopico($idTopico){
	  	$this->idTopico = $idTopico;
	  }

	  public function setIDProfessor($idProfessor){
	  	$this->idProfessor = $idProfessor;
	  }

	  public function setEnunciado($enunciado){
	  	$this->enunciado = $enunciado;
	  }

	  public function setTipo($tipo){
	  	$this->tipo = $tipo;
	  }

	  public function setEnuncA($enuncA){
	  	$this->enuncA = $enuncA;
	  }

	  public function setEnuncB($enuncB){
	  	$this->enuncB = $enuncB;
	  }

	  public function setEnuncC($enuncC){
	  	$this->enuncC = $enuncC;
	  }

	  public function setEnuncD($enuncD){
	  	$this->enuncD = $enuncD;
	  }

	  public function setEnuncE($enuncE){
	  	$this->enuncE = $enuncE;
	  }

	  public function selectOrdenado(){
	  	$sql = "SELECT * FROM $this->tabela, tblprofessor WHERE IDProfessor = tblprofessor.ID ORDER BY tblprofessor.Nome";
	  	$stmt = BD::prepare($sql);
	  	$stmt->execute();
	  	return $stmt->fetchAll();
	  }

	  public function selectTopico($idTopico){
	  	$sql = "SELECT * FROM $this->tabela,tblprofessor WHERE IDTopico = :idTopico AND IDProfessor = tblprofessor.ID ORDER BY tblprofessor.Nome ";
	  	$stmt = BD::prepare($sql);
	  	$stmt->bindParam(':idTopico',$idTopico);
	  	$stmt->execute();
	  	return $stmt->fetchAll();
	  }
	}
?>