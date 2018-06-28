<?php

namespace App\Models\DAO;

class PersonDAO {

public function updatePerson($person, $iduser) {

	$sql = new SQLUtils();

	$sql->query("
	UPDATE tbl_persons AS p 
       INNER JOIN tbl_users u ON p.id = u.tbl_persons_id 
	   SET 
		   p.name = :name, 
	       p.email = :email, 
	       p.phone = :phone, 
	       p.site = :site, 
	       p.address = :address, 
	       p.cpf = :cpf 
	   WHERE  u.id = :iduser", 
			array(
				":name"=>$person->getName(),
				":email"=>$person->getEmail(),
				":phone"=>$person->getPhone(),
				":site"=>$person->getSite(),
				":address"=>$person->getAddress(),
				":cpf"=>$person->getCPF(),
				":iduser"=>$iduser
			));
	
		$response["error"] = false;
		
		$response["msg"] = "Dados pessoais atualizados com sucesso";
			
		return $response;

	}

}
?>
