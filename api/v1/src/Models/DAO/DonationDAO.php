<?php 

namespace App\Models\DAO;

class DonationDAO {

	public function create($donation){

	$sql = new SQLUtils();

		$results = $sql->select("
			CALL sp_donation_save(
			:pname, 
            :psurname, 
            :pcpf, 
            :pemail, 
            :pphone_areacode, 
            :pphone_number,
            :pstreet_name,
            :pstreet_number,
            :pzip_code,
            :pdonation_value,
            :pdonation_purpose_id,
            :puser_id,
            :pmp_link_order)", array(
				":pname"=>$donation->getDonorName(),
				":psurname"=>$donation->getDonorSurName(),
				":pcpf"=>$donation->getDonorCPF(),
				":pemail"=>$donation->getDonorEmail(),
				":pphone_areacode"=>$donation->getDonorPhoneAreaCode(),
				":pphone_number"=>$donation->getDonorPhoneNumber(),
				":pstreet_name"=>$donation->getDonorStreetName(),
				":pstreet_number"=>$donation->getDonorStreetNumber(),
				":pzip_code"=>$donation->getDonorZipCode(),
				":pdonation_value"=>$donation->getDonationValue(),
				":pdonation_purpose_id"=>$donation->getDonationPurposeId(),
				":puser_id"=>$donation->getUserId(),
				":pmp_link_order"=>$donation->getMpLinkOrder()
			)
		);

		$data = $results[0];
		
		$response["error"] = false;
		
		$response["msg"] = "Doação criada com sucesso";
			
		$response["data"]["donation"] = $data;
			
		return $response;

}

}
?>
