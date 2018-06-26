<?php 

namespace App\Models\Entity;

/**
*Table: tbl_payment_methods
    Columns:
        id int(11) AI PK 
        description varchar(255) 
        client_id varchar(255) 
        client_secret varchar(255) 
        tbl_users_id int(11)
**/

/**
 * @Entity @Table(name="tbl_payment_methods")
 **/
class PaymentMethod {

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
    protected $description;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $clientId;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $clientSecret;

    /**
     * @var int
     * @Column(type="integer") 
     */
    protected $idUser;

    //Gets...

    public function getId(){
        return $this->id;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getClientId() {
        return $this->clientId;
    }

    public function getClientSecret() {
        return $this->clientSecret;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    //Sets...   

    public function setId($id){
        $this->id = $id;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setClientId($clientId) {
        $this->clientId = $clientId;
    }

    public function setClientSecret($clientSecret) {
        $this->clientSecret = $clientSecret;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }
}

 ?>