<?php 

namespace App\Models\DAO;


class PaymentMethodDAO {


public function createOrUpdate($paymentMethod){

	$sql = new SQLUtils();

		$results = $sql->select("CALL sp_payment_method_save_or_update(:pdescription, :pclientId, :pclientSecret, :piduser)", array(
				":pdescription"=>$paymentMethod->getDescription(),
				":pclientId"=>$paymentMethod->getClientId(),
				":pclientSecret"=>$paymentMethod->getClientSecret(),
				":piduser"=>$paymentMethod->getIdUser()
			)
		);

		$data = $results[0];
		
		$response["error"] = false;
		
		$response["msg"] = "Método de pagamento atualizado";
			
		$response["data"]["payment_method"] = $data;
			
		return $response;

}

/*public function getDonationPurposeByLoginSlug($username, $dpslug){

		$sql = new SQLUtils();

		$results = $sql->select("
			SELECT * FROM 
				tbl_donations_purposes dp 
			INNER JOIN tbl_users u ON dp.tbl_users_id = u.id 
			WHERE 
				login = :username 
			AND dp.slug = :slug;", 
			array(
				":username"=>$username,
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
}*/


}

 ?>