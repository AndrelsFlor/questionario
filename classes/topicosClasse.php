<?php
	require_once('CRUD.php');

	class topicos extends CRUD{


		protected $tabela = 'tbltopicos';

		private $nome;
		private $desc;


		public function insert(){
			$sql = "INSERT INTO $this->tabela(Nome) VALUES(:nome)";

			$stmt = BD::prepare($sql);
			$stmt->bindParam(':nome',$this->nome);
	
			return $stmt->execute();
		}

		public function update($id){
			$sql = "UPDATE $this->tabela SET Nmoe = :nome, Desc = :Desc WHERE ID = :id";

			$stmt = BD::prepare($sql);
			$stmt->bindParam(':nome',$this->nome);
			$stmt->bindParam(':desc',$this->desc);
			$stmt->bindParam(':id',$id);

			return $stmt->execute();

		}
		public function selectOrdenado(){
			$sql = "SELECT * FROM $this->tabela ORDER BY  Nome";
			$stmt = BD::prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function deletaTopico($id){
			$sql = "DELETE FROM $this->tabela WHERE ID = :id";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':id',$id);
			return $stmt->execute();
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function setDesc($desc){
			$this->desc = $desc;
		}
	}
	
?>