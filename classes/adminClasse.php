<?php
	class admin extends CRUD{
		protected $tabela = 'tbladmin';

		public function insert(){
			return false;
		}

		public function selectOrdenado(){
		
			return false;
		}

		public function update($id){
			return false;
		}

		public function login($login, $senha){
			$valor = $this->selectAdm($login);
			if(empty($valor)){
				return false;
			}
			else{
				$senhaBanco = $valor->senha;
				if($senha == $senhaBanco){
					return true;
				}
				else{
					return false;
				}
			}

		}

		public function selectAdm($login){
			$sql = "SELECT * FROM $this->tabela WHERE username = :login";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':login',$login);
			$stmt->execute();
			return $stmt->fetch();
		}

	}
?>