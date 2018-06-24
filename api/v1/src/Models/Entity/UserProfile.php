<?php 

namespace App\Models\Entity;

/**
*Table: tbl_profile
*   Columns:
*       id int(11) AI PK 
*       description longtext 
*       profile_picture longtext 
*       occupation varchar(255)
*       tbl_users_id int(11)
**/

/**
 * @Entity @Table(name="tbl_persons")
 **/
class UserProfile {

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
    protected $profilePicture;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $filetype;


    /**
     * @var string
     * @Column(type="string") 
     */
    protected $filename;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $occupation;

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

    public function getProfilePicture() {
        return $this->profilePicture;
    }

    public function getFileType() {
        return $this->filetype;
    }

    public function getFileName() {
        return $this->filename;
    }    


    public function getOccupation() {
        return $this->occupation;
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

    public function setProfilePicture($profilePicture) {
        $this->profilePicture = $profilePicture;
    }

    public function setFileType($filetype) {
        return $this->filetype = $filetype;
    }

    public function setFileName($filename) {
        return $this->filename = $filename;
    } 

    public function setOccupation($occupation) {
        $this->occupation = $occupation;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

}

 ?>