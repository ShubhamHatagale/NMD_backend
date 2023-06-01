<?php

require_once 'config.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class Main
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function getAll($db_column)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $db_column");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Remove HTML tags from the fetched data
            foreach ($data as &$item) {
                foreach ($item as $key => &$value) {
                    $value = strip_tags($value);
                }
            }
    
            return $data;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    

    public function getById($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM blog WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Remove HTML tags from the fetched data
            foreach ($data as $key => &$value) {
                $value = strip_tags($value);
            }
    
            return $data;
        } catch (PDOException $e) {
            return false;
        }
    }
    

    // Add other CRUD methods: create(), update(), delete()
}
