<?php

include_once 'inscription.php';

Class Auth {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }
 
    public function inscription($username, $password , $f_name ,$l_name ,$img){
        $inscription = new Inscription($this->conn);
        return $inscription->enregistrerUtilisateur($username, $password ,$f_name ,$l_name ,$img);
    }

    public function login($username, $password , $f_name ,$l_name ,$img){
        $query = "SELECT id, username, password,f_name,l_name,img, role FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":f_name", $f_name);
        $stmt->bindParam(":l_name", $l_name);
        $stmt->bindParam(":img", $img);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashedPasseword = $user['password'];

            if(password_verify($password, $hashedPasseword )) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['users_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                return true;
            }
        }

        return false;
    }

    public function IsAuthenficated(){
        return isset($_SESSION['username']);
        return isset($_SESSION['f_name']);
        return isset($_SESSION['l_name']);
        return isset($_SESSION['img']);

    }

    public function IsModerator(){
        return isset($_SESSION['role']) && $_SESSION['role'] === 'modérateur';
    }

    public function IsAdmin(){
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

    }

}
?>