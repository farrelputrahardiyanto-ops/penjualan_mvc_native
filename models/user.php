<?php


class User{
    private $conn;
    private string $table = "user";

    public string $id;
    public string $username;
    public string $password;
    public string $user_nama;
    public string $user_status;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //login
    public function Login($username, $password){
        $sql = "SELECT * FROM {$this->table} WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){
            unset($user['password']);
            return $user;
        }

        return false;
    }

    //create
    public function Create($username, $password, $user_nama, $user_status){
        $sql = "INSERT INTO {$this->table} VALUES (NULL, :username, :password, :user_nama, :user_status)";
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':user_nama', $user_nama);
        $stmt->bindParam(':user_status', $user_status);

        $stmt->execute();

        return $stmt;
        
    }

    //read
    public function Read(){
        try {
            $sql = "SELECT * FROM {$this->table}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;


            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;

        } catch (Exception $e) {
            echo("eror". $e->getMessage());
        }
        
    }

    //read by id
    public function ReadById($id){
        try {
            $sql = "SELECT * FROM {$this->table} WHERE user_id = :id";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(":id", $id);

            $stmt->execute();
            return $stmt;

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        
        } catch (Exception $e) {
            echo("error". $e->getMessage());
        }
    }


    //update
    public function Update($id, $username, $password, $user_nama, $user_status){
        $sql = "UPDATE {$this->table} SET   username = :username,
                                            password = :password,
                                            user_nama = :user_nama,
                                            user_status = :user_status  WHERE user_id = :id";
        $stmt = $this->conn->prepare($sql);


        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':user_nama', $user_nama);
        $stmt->bindParam(':user_status', $user_status);

        $stmt->execute();
        return $stmt;
        
    }

    //delete
    public function Delete($id){
        $sql = "DELETE FROM {$this->table} WHERE :id = user_id";
        $stmt= $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt;
    }

}