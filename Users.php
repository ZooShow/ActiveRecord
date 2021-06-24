<?php

class Users
{
    private $pdo;
    private $USER_ID;
    private $PASSWORD;
    private $LOGGIN;

    public function __construct($pdo){
        $this->pdo = $pdo;
        
    }

    public function getByID($id){
        $query = "SELECT * FROM USER WHERE USER_ID = $id";
        $usr = $this->pdo->query($query);
        $array = $usr->fetch(PDO::FETCH_ASSOC);
        
        $this->USER_ID = $array['USER_ID'];
        $this->LOGGIN = $array['LOGGIN'];
        $this->PASSWORD = $array['PASSWORD'];
    }

    public function all(){
        $query = "SELECT * FROM USER";
        $usrs = $this->pdo->query($query);
        $users = array();
        while ($usr = $usrs->fetch(PDO::FETCH_ASSOC)){
            $users[] = array('USER_ID'=>$usr['USER_ID'], 'LOGGIN'=>$usr['LOGGIN'], 'PASSWORD'=>$usr['PASSWORD']);
        }
        return($users);
    }

    public function save(){
        $query = "SELECT * FROM USER WHERE USER_ID = $this->USER_ID";
        $usr = $this->pdo->query($query);

        $a = 0;

        while ($row = $usr->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['USER_ID'];
            $a++;
        }

        if ($a == 1){
            $query = "UPDATE USER SET PASSWORD = " . "'$this->PASSWORD', LOGGIN = " . "'$this->LOGGIN'" . " WHERE USER_ID = $this->USER_ID";
            $this->pdo->exec($query);
        } else {
            $query = "INSERT INTO USER (USER_ID, PASSWORD, LOGGIN) VALUES ($this->USER_ID, " . "'$this->PASSWORD', ". "'$this->LOGGIN'".");";
            $this->pdo->exec($query);
        }
        
    }

    public function remove(){
        $query = "DELETE FROM USER WHERE USER_ID = $this->USER_ID;";
        $this->pdo->exec($query);
    }

    public function getByLoggin($LOGGIN){
        $query = "SELECT * FROM USER WHERE LOGGIN = " . "'$LOGGIN';";
        
        $usr = $this->pdo->query($query);
        $array = $usr->fetch(PDO::FETCH_ASSOC);
        
        $this->USER_ID = $array['USER_ID'];
        $this->LOGGIN = $array['LOGGIN'];
        $this->PASSWORD = $array['PASSWORD'];
    }

}



?>
