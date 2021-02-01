<?php
class DBConnect{
    public function connect(){
        $connect = new mysqli('localhost','root','','mvc-oop');
        mysqli_set_charset($connect,'utf8');
        return $connect;
    }
}
?>