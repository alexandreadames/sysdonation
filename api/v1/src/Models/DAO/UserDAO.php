<?php

namespace App\Models\DAO;

use \App\Models\Entity\User;
use \App\Models\Entity\Response;
use \Firebase\JWT\JWT;
use \App\Models\Utils\Globals;
use \App\Models\Utils\TokenUtils;


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

			$custom_payload = array(
				"userId" => $data["id"]
			);

			$jwt = TokenUtils::generateToken($custom_payload);
			
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

		$custom_payload = array(
			"userId" => $data["id"]
		);

		$response["error"] = false;
		
		$response["msg"] = "Registro de Usuário efetivado com sucesso";

		$jwt = TokenUtils::generateToken($custom_payload);
			
		$response["data"]["token"]= $jwt;
			
		return $response;

}

public function getUserById($iduser){

		$sql = new SQLUtils();

		$results = $sql->select("
			SELECT 
			    u.login,
			    u.dtregister,
			    p.name,
			    p.email,
			    p.phone,
			    p.site,
			    p.address,
			    p.cpf
			FROM
			    tbl_users u
			        INNER JOIN
			    tbl_persons p ON u.tbl_persons_id = p.id
			WHERE u.id = :iduser;", 
			array(
				":iduser"=>$iduser
			));

		return $results[0];

}

public function getPersonalDataAndProfile($iduser) {

	$sql = new SQLUtils();

	$results = $sql->select("
			SELECT p.name, 
			       p.email, 
			       p.phone, 
			       p.site, 
			       p.address, 
			       p.cpf, 
			       prof.description, 
			       prof.occupation, 
			       prof.profile_picture, 
			       prof.filetype, 
			       prof.filename 
			FROM   tbl_persons p 
			       INNER JOIN tbl_users u 
			               ON p.id = u.tbl_persons_id 
			       LEFT JOIN tbl_profile prof 
			               ON u.id = prof.tbl_users_id 
			WHERE u.id = :iduser;", 
			array(
				":iduser"=>$iduser
			));

		return $results[0];
}


}




 ?>