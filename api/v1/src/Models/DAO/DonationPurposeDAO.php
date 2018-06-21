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

public function getDonationPurposeByLoginSlug($login, $dpslug){

		$sql = new SQLUtils();

		$results = $sql->select("
			SELECT * FROM 
				tbl_donations_purposes dp 
			INNER JOIN tbl_users u ON dp.tbl_users_id = u.id 
			WHERE 
				login = :login 
			AND dp.slug = :slug;", 
			array(
				":login"=>$login,
				":slug"=>$dpslug
			));

		if (count($results)>0){
			return $results[0];
		}
		else{
			return array(
				'msg'=>'Nenhuma página encontrada'
			);
		}
}



}

 ?>