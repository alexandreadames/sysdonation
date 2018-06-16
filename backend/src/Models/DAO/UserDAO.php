<?php 

namespace App\Models\DAO;

use \App\Models\Entity\User;
use \App\Models\Entity\Response;
use \Firebase\JWT\JWT;
use \App\Models\Utils\Globals;


class UserDAO {


	public static function login($login, $password){
		
		$sql = new SQLUtils();

		$results = $sql->select("SELECT * FROM tbl_users u 
		INNER JOIN tbl_persons p ON u.tbl_persons_id = p.id 
		WHERE u.login = :LOGIN", array(
			":LOGIN"=>$login
		));

		if (count($results) === 0){
			$response["error"] = true;
			$response["msg"] = "Usuário Inexistente";

			return $response;

		}

		$data = $results[0];

		if (password_verify($password, $data["password"]) === true){

			$response["error"] = false;
			$response["msg"] = "Login efetuado";

			//Retirar dados que não precisam ir para o front
			unset(
				$data["id"], 
				$data["password"], 
				$data["tbl_persons_id"] 
			);

			$jwt = JWT::encode($data, Globals::SECRET_KEY);
			
			$response["data"]["token"]= $jwt;
			
			return $response;
		}
		else{
			
			$response["error"] = true;
			$response["msg"] = "Senha Inválida";
			
			return $response;
		}

	}	

public function register($user){

	$pass_encrypt = password_hash($user->getPassword(), PASSWORD_DEFAULT);

	$user->setPassword($pass_encrypt);

	$sql = new SQLUtils();

		$results = $sql->select("CALL sp_users_save(:pname, :pemail, :pphone, :psite, :paddress, :pcpf, :plogin, :ppassword)", array(
			":pname"=>$user->getName(),
			":pemail"=>$user->getEmail(),
			":pphone"=>$user->getPhone(),
			":psite"=>$user->getSite(),
			":paddress"=>$user->getAddress(),
			":pcpf"=>$user->getCPF(),
			":plogin"=>$user->getLogin(),
			":ppassword"=>$user->getPassword()
		));

		$data = $results[0];
		
		//Retirar dados que não precisam ir para o front
		unset(
			$data["id"], 
			$data["password"], 
			$data["tbl_persons_id"] 
		);

		$response["error"] = false;
		
		$response["msg"] = "Registro de Usuário efetivado com sucesso";
			
		$jwt = JWT::encode($data, Globals::SECRET_KEY);
			
		$response["data"]["token"]= $jwt;
			
		return $response;

}

public function getUserById($iduser){

		$sql = new SQLUtils();

		$results = $sql->select("SELECT * FROM tbl_users u INNER JOIN tbl_persons p ON u.tbl_persons_id = p.id WHERE u.id = :iduser;", array(
			":iduser"=>$iduser
		));

		return $results[0];

}


}




 ?>