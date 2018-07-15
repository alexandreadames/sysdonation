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
            :pdistrict,
            :pcity,
            :pstate,
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
				":pdistrict"=>$donation->getDonorDistrict(),
            	":pcity"=>$donation->getDonorCity(),
            	":pstate"=>$donation->getDonorState(),
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

public function getDonationsByUser($iduser){

	$sql = new SQLUtils();

		$results = $sql->select("
			SELECT 
				d.id, 
				d.donation_value, 
				d.tbl_donationspurposes_id, 
				d.tbl_users_id,
				d.donor_name, 
				d.donor_cpf, 
				d.donor_surname, 
				d.donor_email, 
				dp.title, 
				dp.slug 
			FROM tbl_donations d 
       		INNER JOIN tbl_donations_purposes dp 
               ON d.tbl_donationspurposes_id = dp.id
			WHERE 1=1  
			AND d.tbl_users_id = :iduser
			",
			array(
				"iduser" => $iduser
			)
		);

		return $results;
}

}


?>
