<?php 

namespace App\Models\Entity;


/**
 * @Entity @Table(name="tbl_donations_purposes")
 **/
class DonationPurpose {

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
    protected $title;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $html_content;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $slug;

    /**
     * @var date
     * @Column(type="timestamp") 
     */
    protected $dtregister;

    /**
     * @var int
     * @Column(type="integer") 
     */
    protected $iduser;

    /**********************
     * Getters and Setters
     **********************/

    /*---------------------
    * Getters
    *----------------------*/

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getHtmlContent() {
        return $this->html_content;
    }

    public function getSlug() {
        return $this->slug;
    }    

    public function getIdUser() {
        return $this->iduser;
    }

    public function getDtRegister() {
        return $this->dtregister;
    }

    /*---------------------
    * Setters
    *----------------------*/

    public function setId($id){
        $this->id = $id;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setHtmlContent($html_content) {
        $this->html_content = $html_content;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
    }

    public function setIdUser($iduser) {
        $this->iduser = $iduser;
    }

    public function setDtRegister($dtregister) {
        $this->dtregister = $dtregister;
    }

}

 ?>