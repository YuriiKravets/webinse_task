<?php

class DB_adapter{

    public $domen = 'localhost';
    public $login = 'root';
    public $pass = '';
    public $name_db = 'webinse_task';
    private static $_instance = null;

    public function __construct() {
        $this->link = mysqli_connect($this->domen, $this->login, $this->pass, $this->name_db);
        $this->query=mysqli_query($this->link,"SET NAMES 'utf8'");
        $this->query=mysqli_query($this->link,"SET CHARACTER SET 'utf8'");
        $this->query=mysqli_query($this->link,"SET SESSION collation_connection = 'utf8_general_ci'");
    }

    static public function getInstance() {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getAllUsers(){
        $this->query = "SELECT * FROM users";
        $result=mysqli_query($this->link, $this->query);
        return $result;
    }

    public function createNewUser($firstName, $secondName, $email){
        $this->query = "INSERT INTO users (first_name, second_name, email) VALUES ('$firstName', '$secondName', '$email');";
        $result = mysqli_query($this->link, $this->query);
        $result = mysqli_insert_id($this->link);
        return $result;
    }
   
    public function updateUser($id, $newFirstName, $newSecondName, $newEmail){
        $this->query_read="UPDATE users SET first_name='$newFirstName', second_name='$newSecondName', email='$newEmail' WHERE id=$id;";
        $result=mysqli_query($this->link, $this->query_read);
        return $result;
    }
    public function deleteUser($id){
        $this->query_read="DELETE FROM users WHERE id=$id;";
        $result=mysqli_query($this->link, $this->query_read);
        return $result;
    }
    
    public function getInsertId(){
       return mysqli_insert_id($this->link);
    }

}