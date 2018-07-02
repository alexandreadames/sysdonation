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

public function getPaymentMethodByUserId($iduser){

		$sql = new SQLUtils();

		$results = $sql->select("
			SELECT 
			    pm.client_id,
			    pm.client_secret
			FROM
			    tbl_payment_methods pm
			WHERE pm.tbl_users_id = :iduser;", 
			array(
				":iduser"=>$iduser
			));

		if ($results){
			return $results[0];	
		}
		else {
			return $results;
		}
		

}


}

 ?>