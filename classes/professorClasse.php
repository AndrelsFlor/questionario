<?php
	
	 require_once('CRUD.php');
	 class professor extends CRUD{
	 	private $nome;

	 	protected $tabela = "tblprofessor";
		
		public function insert(){
			$sql = "INSERT INTO $this->tabela(Nome) VALUES(:nome)";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':nome',$this->nome);
			return $stmt->execute();
		}

		public function update($id){
			$sql = "UPDATE $this->tabela SET nome = :nome WHERE ID = :id";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':nome',$this->nome);
			$stmt->bindParam(':id',$id);
			return $stmt->execute();
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function selectOrdenado(){
			$sql = "SELECT * FROM $this->tabela ORDER BY  Nome ASC";
			$stmt = BD::prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}
?>