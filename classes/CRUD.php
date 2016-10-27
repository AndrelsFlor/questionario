<?php
	require_once('BD.php');

	abstract class CRUD extends BD{
		protected $tabela;

		abstract function insert();
		abstract function update($id);
		abstract function selectOrdenado();
		
		public function selectAll(){
			$sql = "SELECT * FROM $this->tabela";
			$stmt = BD::prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function select($id){
			$sql = "SELECT * FROM $this->tabela WHERE ID = :id";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			return $stmt->fetch();
		}

		public function delete($id){
			$sql = "DELETE  FROM $this->tabela WHERE ID = :id";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':id',$id);
			return $stmt->execute();
		}

		
	}

?>