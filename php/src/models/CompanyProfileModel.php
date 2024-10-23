<?php
namespace app\models;
use app\db\DBconn;

class CompanyProfileModel {
    private $db;

    public function __construct(){
        $this->db = DBconn::getInstance();
    }

    public function getCompanyProfile(int $user_id){
        $sql = "SELECT cd.user_id, u.nama, cd.lokasi, cd.about
                FROM company_detail cd 
                    JOIN users u
                        ON u.user_id=cd.user_id
                WHERE cd.user_id=:user_id";
        $statement = $this->db->prepare($sql); 
        $this->db->bind($statement, ":user_id", $user_id);
        $this->db->execute($statement);
        return $statement->fetch();
    }

    public function updateCompanyProfile(int $user_id, string $nama, string $lokasi, string $about){
        $sql1 = "UPDATE users
                SET nama=:nama
                WHERE user_id=:user_id";
        $statement1 = $this->db->prepare($sql1);
        $this->db->bind($statement1, ":user_id", $user_id);
        $this->db->bind($statement1, ":nama", $nama);
        $exe1 = $this->db->execute($statement1);

        $sql2 = "UPDATE company_detail
                SET lokasi=:lokasi, about=:about
                WHERE user_id=:user_id";
        $statement2 = $this->db->prepare($sql2);
        $this->db->bind($statement2, ":user_id", $user_id);
        $this->db->bind($statement2, ":lokasi", $lokasi);
        $this->db->bind($statement2, ":about", $about);
        $exe2 = $this->db->execute($statement2);

        if ($exe1 && $exe2) {
            return true;
        } else {
            echo "Update query error!";
        }
    }
}