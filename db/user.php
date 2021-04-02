<?php 

class User{
    private $db;

    function __construct($conn){
        $this->db = $conn;
    }

    public function register($username, $email, $contact, $pass){
        try{
            $sql = "INSERT INTO users (username, email, contact, pass) VALUES (:username, :email, :contact, :pass)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':username', $username);
            $stmt->bindparam(':email', $email);
            $stmt->bindparam(':contact', $contact);
            $stmt->bindparam(':pass', $pass);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}

?>