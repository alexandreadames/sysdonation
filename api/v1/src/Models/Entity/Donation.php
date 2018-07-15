<?php  

namespace App\Models\Entity;
/*
Table: tbl_donations
	Columns:
	id int(11) AI PK 
	donation_value double 
	tbl_donationspurposes_id int(11) 
	tbl_users_id int(11) 
	donor_name varchar(255) 
	donor_cpf varchar(11) 
	donor_surname varchar(255) 
	donor_email varchar(255) 
	dt_created timestamp 
	donor_phone_area_code varchar(45) 
	donor_phone_number varchar(45) 
	donor_street_name varchar(255) 
	donor_street_number int(11) 
	donor_zipcode varchar(45) 
	mp_link_order varchar(255)
*/

/**
 * @Entity @Table(name="tbl_donations")
 **/
class Donation {

	/**
     * @var int
     * @Id @Column(type="integer") 
     * @GeneratedValue
     */
    protected $id;

     /**
     * @var string
     * @Column(type="string") 
     */
    protected $donorName;

     /**
     * @var string
     * @Column(type="string") 
     */
    protected $donorSurName;

     /**
     * @var string
     * @Column(type="string") 
     */
    protected $donorEmail;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $donorPhoneAreaCode;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $donorPhoneNumber;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $donorCPF;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $donorStreetName;

    /**
     * @var integer
     * @Column(type="int") 
     */
    protected $donorStreetNumber;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $donorDistrict;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $donorCity;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $donorState;


    /**
     * @var string
     * @Column(type="string") 
     */
    protected $donorZipCode;

    /**
     * @var double
     * @Column(type="double") 
     */
    protected $donationValue;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $donationCode;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $donationTitle;

	/**
     * @var string
     * @Column(type="string") 
     */
    protected $mpLinkOrder;

	/**
     * @var integer
     * @Column(type="int") 
     */
    protected $donationPurposeId;

    /**
     * @var integer
     * @Column(type="int") 
     */
    protected $userId;

    protected $dtcreated;

    //Getters
    public function getId(){
        return $this->id;
    }

    public function getDonorName(){
        return $this->donorName;
    }

    public function getDonorSurName(){
        return $this->donorSurName;
    }

    public function getDonorEmail(){
        return $this->donorEmail;
    }

    public function getDonorPhoneAreaCode(){
        return $this->donorPhoneAreaCode;
    }

    public function getDonorPhoneNumber(){
        return $this->donorPhoneNumber;
    }

    public function getDonorCPF(){
        return $this->donorCPF;
    }

    public function getDonorStreetName(){
        return $this->donorStreetName;
    }

    public function getDonorStreetNumber(){
        return $this->donorStreetNumber;
    }

    public function getDonorDistrict(){
        return $this->donorDistrict;
    }

    public function getDonorCity(){
        return $this->donorCity;
    }

    public function getDonorState(){
        return $this->donorState;
    }

    public function getDonorZipCode(){
        return $this->donorZipCode;
    }

    public function getDonationValue(){
        return $this->donationValue;
    }

    public function getDonationCode(){
        return $this->donationCode;
    }

    public function getDonationTitle(){
        return $this->donationTitle;
    }

    public function getMpLinkOrder(){
        return $this->mpLinkOrder;
    }

    public function getDonationPurposeId(){
        return $this->donationPurposeId;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function getDtCreated(){
        return $this->dtcreated;
    }


    //Setters
    public function setId($id){
        $this->id = $id;
    }

    public function setDonorName($donorName){
        $this->donorName = $donorName;
    }

    public function setDonorSurName($donorSurName){
        $this->donorSurName = $donorSurName;
    }

    public function setDonorEmail($donorEmail){
        $this->donorEmail = $donorEmail;
    }

    public function setDonorPhoneAreaCode($donorPhoneAreaCode){
        $this->donorPhoneAreaCode = $donorPhoneAreaCode;
    }

    public function setDonorPhoneNumber($donorPhoneNumber){
        $this->donorPhoneNumber = $donorPhoneNumber;
    }

    public function setDonorCPF($donorCPF){
        $this->donorCPF = $donorCPF;
    }

    public function setDonorStreetName($donorStreetName){
        $this->donorStreetName = $donorStreetName;
    }

    public function setDonorStreetNumber($donorStreetNumber){
        $this->donorStreetNumber = $donorStreetNumber;
    }

    public function setDonorDistrict($donorDistrict){
        $this->donorDistrict = $donorDistrict;
    }

    public function setDonorCity($donorCity){
        $this->donorCity = $donorCity;
    }

    public function setDonorState($donorState){
        $this->donorState = $donorState;
    }

    public function setDonorZipCode($donorZipCode){
        $this->donorZipCode = $donorZipCode;
    }

    public function setDonationValue($donationValue){
        $this->donationValue = $donationValue;
    }

    public function setDonationCode($donationCode){
        return $this->donationCode = $donationCode;
    }

    public function setDonationTitle($donationTitle){
        return $this->donationTitle = $donationTitle;
    }

    public function setMpLinkOrder($mpLinkOrder){
        $this->mpLinkOrder = $mpLinkOrder;
    }

    public function setDonationPurposeId($donationPurposeId){
        $this->donationPurposeId = $donationPurposeId;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

    public function setDtCreated($dtcreated){
        $this->dtcreated = $dtcreated;
    }

    
}




?>