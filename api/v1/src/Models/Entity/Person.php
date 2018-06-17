<?php 

namespace App\Models\Entity;

/**
 * @Entity @Table(name="tbl_persons")
 **/
class Person {

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
    protected $name;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $email;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $phone;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $site;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $address;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $cpf;

    //Gets...

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getSite() {
        return $this->site;
    }

    public function getAddress() {
        return $this->address;
    }    

    public function getCPF() {
        return $this->cpf;
    }    

    //Sets...   

    public function setId($id){
        $this->id = $id;
        
    }

    public function setName($name){
        $this->name = $name;
        
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setSite($site) {
        $this->site = $site;
    }

    public function setAddress($address) {
        $this->address = $address;
    }    

    public function setCPF($cpf) {
        $this->cpf = $cpf;
    }
}

 ?>