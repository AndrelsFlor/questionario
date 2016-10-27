<?php
	require_once('CRUD.php');

	class questionario extends CRUD{
		protected $tabela = "tblquestionario";

		private $idTurma;
		private $descricao;

		public function insert(){
			$sql = "INSERT INTO $this->tabela(IDTurma,Desc) VALUES(:idTurma,:descricao)";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':idTurma',$this->idTurma);
			$stmt->bindParam(':desc',$this->descricao);

			return $stmt->execute();
		}

		public function update($id){
			$sql = "UPDATE $this->tabela SET IDTurma = :idTurma, Desc = :desc WHERE ID = :id";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':idTurma',$this->idTurma);
			$stmt->bindParam(':desc',$this->desc);
			$stmt->bindParam(':id',$id);

			return $stmt->execute();
		}

		public function setIDTurma($idTurma){
			$this->idTurma = $idTurma;
		}

		public function setDesc($desc){
			$this->desc = $desc;
		}

		

		public function selecionaPerguntas($idTurma){
			$sql = "SELECT * FROM tblpergunta INNER JOIN professorturma ON professorturma.idProfessor = tblpergunta.idProfessor AND professorturma.idTurma = :idTurma INNER JOIN tblprofessor ON professorturma.idProfessor = tblprofessor.ID";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':idTurma',$idTurma);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function insereQuestoes($idPergunta, $idProfessor){
			$sql = "INSERT INTO tblquestionarioquestoes(IDPergunta, IDProfessor) VALUES(:idPergunta, :idProfessor)";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':idPergunta', $idPergunta);
			$stmt->bindParam(':idProfessor', $idProfessor);
			return $stmt->execute();
		}
	

	public function selectOrdenado(){
		return false;
	}
}
?>