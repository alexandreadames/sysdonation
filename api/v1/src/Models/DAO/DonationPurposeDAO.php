<?php 

namespace App\Models\DAO;

use \App\Models\Utils\Utils;


class DonationPurposeDAO {


public function create($donation_purpose){

	$sql = new SQLUtils();

		$results = $sql->select("CALL sp_donations_purposes_save(:ptitle, :phtmlcontent, :pslug, :piduser)", array(
				":ptitle"=>$donation_purpose->getTitle(),
				":phtmlcontent"=>Utils::prepareHtml($donation_purpose->getHtmlContent()),
				":pslug"=>$donation_purpose->getSlug(),
				":piduser"=>$donation_purpose->getIdUser()
			)
		);

		$data = $results[0];
		
		$response["error"] = false;
		
		$response["msg"] = "Criação de Finalidade de Doação com sucesso";
			
		$response["data"]["donation_purpose"] = $data;
			
		return $response;

}

public function getDonationPurposeByLoginSlug($username, $dpslug){

		$sql = new SQLUtils();

		$results = $sql->select("
			SELECT 
				   u.id as userid,
				   p.name,
			       prof.description,
			       prof.occupation,
			       prof.profile_picture,
			       prof.filetype,
			       prof.filename,
			       dp.id as donationpurpose_id,
			       dp.title,
			       dp.html_content,
			       dp.slug
			FROM tbl_donations_purposes dp
			INNER JOIN tbl_users u ON dp.tbl_users_id = u.id
			INNER JOIN tbl_persons p ON u.tbl_persons_id = p.id
			INNER JOIN tbl_profile prof ON u.id = prof.tbl_users_id
			WHERE 
				login = :username 
			AND dp.slug = :slug;", 
			array(
				":username"=>$username,
				":slug"=>$dpslug
			));

		if (count($results)>0){
			//Make a custom response...

			$response = array(
				'error' => false,
				'data' => array(
					'owner' => array(
						'iduser'=> $results[0]['userid'],
						'name' => $results[0]['name'],
						'occupation' => $results[0]['occupation'],
						'description' => $results[0]['description'],
						'profile_picture' => $results[0]['profile_picture'],
						'filetype' => $results[0]['filetype'],
					),
					'donationpurpose'=> array(
						'donationpurpose_id' => $results[0]['donationpurpose_id'],
						'title' => $results[0]['title'],
						'html_content' => Utils::decodeHtml($results[0]['html_content']),
						'slug' => $results[0]['slug']
					)
				)
			);
		}
		else{
			$response = array(
				'error' => true,
				'data' => array(
					'msg' => 'Nenhuma página encontrada'
				)
			);
		}

		return $response;
}


public function listAll(){

	$sql = new SQLUtils();

		$results = $sql->select("
			SELECT dp.id, 
			       dp.title, 
			       dp.html_content, 
			       dp.tbl_users_id, 
			       dp.dtregister, 
			       dp.slug, 
			       u.login, 
			       u.tbl_persons_id, 
			       p.NAME, 
			       p.email, 
			       p.phone, 
			       p.site, 
			       p.cpf 
			FROM   tbl_donations_purposes dp 
			       INNER JOIN tbl_users u 
			               ON dp.tbl_users_id = u.id 
			       INNER JOIN tbl_persons p 
			               ON u.tbl_persons_id = p.id 
			WHERE  1=1
			"
			);

		if (count($results)>0){
			return $results;
		}
		else{
			return array(
				'msg'=>'Nenhuma página encontrada'
			);
		}
}

public function getDonationsPurposesByUser($iduser){

	$sql = new SQLUtils();

		$results = $sql->select("
			SELECT dp.id, 
			       dp.title, 
			       dp.html_content, 
			       dp.tbl_users_id, 
			       dp.dtregister, 
			       dp.slug, 
			       u.login, 
			       u.tbl_persons_id, 
			       p.NAME, 
			       p.email, 
			       p.phone, 
			       p.site, 
			       p.cpf 
			FROM   tbl_donations_purposes dp 
			       INNER JOIN tbl_users u 
			               ON dp.tbl_users_id = u.id 
			       INNER JOIN tbl_persons p 
			               ON u.tbl_persons_id = p.id 
			WHERE  1=1
			AND tbl_users_id = :iduser
			",
			array(
				"iduser" => $iduser
			)
		);

		return $results;
}


public function delete($id, $iduser) {

	$sql = new SQLUtils();

		$result = $sql->query("
			DELETE FROM tbl_donations_purposes WHERE id = :id AND tbl_users_id = :iduser
			",
			array(
			  ':id' => $id,
			  ':iduser' => $iduser
			)
		);

		if ($result) {
			
			$error = false;
		
			$msg = "Finalidade de doação excluída com sucesso!";

			$data = array(
				"result" => $result
			);
		}
		else {

			$error = true;
		
			$msg = "Não foi possível executar essa operação";	

			$data = array(
				"result" => $result
			);

		}
		
			
		return Utils::prepareResponse($error, $msg, $data);

}


}

 ?>