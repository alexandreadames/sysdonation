<?php 

namespace App\Models\DAO;

use \App\Models\Entity\User;
use \App\Models\Entity\Response;
use \Firebase\JWT\JWT;
use \App\Models\Utils\Globals;
use \App\Models\Utils\TokenUtils;


class UserProfileDAO {
	

public function createOrUpdate($userprofile){

	$sql = new SQLUtils();

	$userProfileInDB = $this->getProfileUserById($userprofile->getIdUser());

	if ($userProfileInDB){

		$userprofile->setId( (int) $userProfileInDB["id"]);

		//User exists: Update
		$results = $sql->query(
			"
			UPDATE tbl_profile 
            	SET 
                  description = :description, 
                  profile_picture = :profile_picture, 
                  filetype = :filetype,
                  filename = :filename,
                  occupation = :occupation
            WHERE 
                  tbl_users_id = :iduser AND id = :id;"
                  , 

			array(
				":description"=>$userprofile->getDescription(),
				":profile_picture"=>$userprofile->getProfilePicture(),
				":filetype"=>$userprofile->getFileType(),
				":filename"=>$userprofile->getFileName(),
				":occupation"=>$userprofile->getOccupation(),
				":iduser"=>$userprofile->getIdUser(),
				":id" => $userprofile->getId()
			)
		);

		$data = $results[0];
		
		$response["error"] = false;
		
		$response["msg"] = "Perfil atualizado com sucesso";
			
		$response["data"]["result"]= $data;

	}

	else {

		//User not exists: create

		$results = $sql->query(
			"
			INSERT INTO tbl_profile 
            		( 
                        description, 
                        profile_picture, 
                        filetype,
                  		filename,
                        occupation, 
                        tbl_users_id 
            		) 
            VALUES 
            		( 
                        :description, 
                        :profile_picture, 
                        :filetype,
                  		:filename,
                        :occupation, 
                        :tbl_users_id
            		);
            ", 

			array(
				":description"=>$userprofile->getDescription(),
				":profile_picture"=>$userprofile->getProfilePicture(),
				":filetype"=>$userprofile->getFileType(),
				":filename"=>$userprofile->getFileName(),
				":occupation"=>$userprofile->getOccupation(),
				":tbl_users_id"=>$userprofile->getIdUser()
			)
		);

		$data = $results[0];
		

		$response["error"] = false;
		
		$response["msg"] = "Perfil criado com sucesso";
			
		$response["data"]["result"]= $data;

	}

	return $response;

}

public function getProfileUserById($iduser){

		$sql = new SQLUtils();

		$results = $sql->select("
			SELECT * 
				FROM   tbl_profile 
				WHERE  tbl_users_id = :iduser; ", 
			array(
				":iduser"=>$iduser
			));

		return $results[0];

}



}




 ?>