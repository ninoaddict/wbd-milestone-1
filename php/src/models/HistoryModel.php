<?php
namespace app\models;
use app\db\DBconn;
use Exception;

class HistoryModel {
    private $db;

    public function __construct() {
        $this->db = DBconn::getInstance();
    }

    public function getAllLamaranHistory(int $user_id){
        $sql = "SELECT low.lowongan_id, u.nama, low.posisi, lam.created_at, lam.status
                FROM lamaran lam JOIN lowongan low 
                    ON lam.lowongan_id=low.lowongan_id 
                    JOIN users u 
                        ON u.user_id=low.company_id 
                WHERE lam.user_id=:user_id 
                ORDER BY lam.created_at 
                DESC";
                
        $statement = $this->db->prepare($sql);
        $this->db->bind($statement, ":user_id", $user_id);
        $this->db->execute($statement);
        return $statement->fetchAll();
    }

    public function getSelectedLamaranHistory(int $user_id, string $status){
        $sql = "SELECT low.lowongan_id, u.nama, low.posisi, lam.created_at, lam.status
                FROM lamaran lam JOIN lowongan low 
                    ON lam.lowongan_id=low.lowongan_id 
                    JOIN users u 
                        ON u.user_id=low.company_id 
                WHERE lam.user_id=:user_id 
                AND lam.status=:status
                ORDER BY lam.created_at 
                DESC";
                
        $statement = $this->db->prepare($sql);
        $this->db->bind($statement, ":user_id", $user_id);
        $this->db->bind($statement, ":status", $status);
        $this->db->execute($statement);
        return $statement->fetchAll();
    }
}