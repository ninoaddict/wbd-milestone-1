<?php
namespace app\models;
use app\db\DBconn;
use Exception;

class CompanyProfileModel {
    private $db;

    public function __construct(){
        $this->db = DBconn::getInstance();
    }

    public function queryCompanyProfile(int $id){
        $sql = "SELECT cd.user_id, u.nama, cd.lokasi, cd.about FROM company_detail cd JOIN users u ON cd.user_id=u.user_id WHERE cd.user_id=:id";
        $statement = $this->db->prepare($sql);
        $this->db->bind($statement,':id', $id);
        $this->db->execute($statement);
        return $this->db->fetch($statement);
    }
}