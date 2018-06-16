<?php 

namespace App\Models\Entity;

use App\Models\Entity\Person;


/**
 * @Entity @Table(name="tbl_users")
 **/
class User extends Person {

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
    protected $login;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $password;


    protected $dtregister;

    public function getId(){
        return $this->id;
    }

    public function getLogin(){
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDtRegister() {
        return $this->dtregister;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setLogin($login){
        $this->login = $login;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setDtRegister($dtregister) {
        $this->dtregister = $dtregister;
    }


}

 ?>