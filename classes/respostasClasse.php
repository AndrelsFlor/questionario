<?php
	require_once('CRUD.php');

	

	class respostas extends CRUD{
		
		protected $tabela = "tblrespostas";

		private $IDPergunta;
		private $IDTurma;
		private $resposta;

		public function insert(){
			$sql = "INSERT INTO $this->tabela(IDPergunta,IDTurma,Resposta) VALUES (:IDPergunta,:IDTurma,:Resposta)";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':IDPergunta',				$this->IDPergunta);
			$stmt->bindParam(':IDTurma',				$this->IDTurma);
			$stmt->bindParam(':Resposta',				$this->resposta);

			return $stmt->execute();
		}
		public function selectOrdenado(){
			
			return false;
		}

		public function update($id){
			$sql = "UPDATE $this->tabela SET IDQuestoesQuestionario = :IDQuestoesQuestionario, IDTurma = :IDTurma, Resposta = :Resposta WHERE ID = :id";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':IDQuestoesQuestionario',	$this->IDQuestoesQuestionario);
			$stmt->bindParam(':IDTurma',				$this->IDTurma);
			$stmt->bindParam(':Resposta',				$this->resposta);
			$stmt->bindParam(':id',						$id);

		}

		public function setIDPergunta($IDPergunta){
			$this->IDPergunta = $IDPergunta;
		}

		public function setIDTurma($IDTurma){
			$this->IDTurma = $IDTurma;
		}

		public function setResposta($resposta){
			$this->resposta = $resposta;
		}

		public function selectRespostas(){
			$sql = "SELECT * FROM $this->tabela,tblpergunta,tblprofessor WHERE $this->tabela.IDPergunta = tblpergunta.ID AND tblpergunta.IDProfessor = tblprofessor.ID";
			$stmt = BD::prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}
?>