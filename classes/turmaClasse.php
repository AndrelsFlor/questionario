<?php
	require_once('CRUD.php');

	class turma extends CRUD{
		protected $tabela = "tblturma";

		private $login;
		private $QtdAlunos;
		private $termo;
		private $ano;
		private $semestre;
		private $idTurma;

		public function selectOrdenado(){
			$sql = "SELECT * FROM $this->tabela ORDER BY  Ano DESC, Semestre ASC ";
			$stmt = BD::prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function insert(){
			$sql = "INSERT INTO $this->tabela(Login,QtdAlunos,Termo,Ano,Semestre) VALUES(:login,:QtdAlunos,:termo,:ano,:semestre)";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':login',		$this->login);
			$stmt->bindParam(':QtdAlunos',	$this->QtdAlunos);
			$stmt->bindParam(':termo',		$this->termo);
			$stmt->bindParam(':ano',		$this->ano);
			$stmt->bindParam(':semestre',	$this->semestre);
			return $stmt->execute();

			
		}

		public function update($id){
			$sql = "UPDATE $this->tabela SET Login = :login, QtdAlunos = :QtdAlunos, Termo = :termo, WHERE ID = :id";

			$stmt = BD::prepare($sql);
			$stmt->bindParam(':login',		$this->login);
			$stmt->bindParam(':QtdAlunos',	$this->QtdAlunos);
			$stmt->bindParam(':termo',		$this->termo);
			
			$stmt->bindParam(':id',$id);
			
			return $stmt->execute();



		}


		public function login(){
			$sql = "SELECT * FROM $this->tabela WHERE Login = :login";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':login', $this->login);
			$stmt->execute();
			$valor = $stmt->fetch();
			if(empty($valor)){
				return 'false';
			}
			else{
				return $valor->ID;
			}
		}

		public function getId(){
				$sql = "SELECT LAST_INSERT_ID()";
				$stmt = BD::prepare($sql);
				$stmt->execute();
				return $stmt->fetch(PDO::FETCH_NUM);
		}

		public function insereProfessor($idProfessor){
			$sql = "INSERT INTO professorturma(idProfessor,idTurma) VALUES(:idProfessor, :idTurma)";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':idProfessor',$idProfessor);
			$stmt->bindParam(':idTurma',$this->idTurma);
			return $stmt->execute();

		}

		public function listaProfessor(){
			$sql = "SELECT * FROM professorturma,tblprofessor WHERE professorturma.idTurma = :idTurma AND tblprofessor.ID = professorturma.idProfessor ";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':idTurma', $this->idTurma);
			$stmt->execute();
			return $stmt->fetchAll();
			
		}

		public function deletaProfessor($idProfessor){
			$sql = "DELETE FROM professorturma WHERE idProfessor = :idProfessor AND idTurma = :idTurma";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':idProfessor', $idProfessor);
			$stmt->bindParam(':idTurma', $this->idTurma);
			return $stmt->execute();
		}

		public function setLogin($login){
			$this->login = $login;
		}

		public function setqtdAlunos($QtdAlunos){
			$this->QtdAlunos = $QtdAlunos;
		}

		public function setTermo($termo){
			$this->termo = $termo;
		}

		public function setAno($ano){
			$this->ano = $ano;
		}

		public function setSemestre($semestre){
			$this->semestre = $semestre;
		}

		public function setIdTurma($idTurma){
			$this->idTurma = $idTurma;
		}


	}
?>