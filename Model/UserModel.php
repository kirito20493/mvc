<?php
include './config/config.php';
class UserModel extends DBConnect{
    public function getAllDataUsers(){
        $sql = "SELECT * FROM user";
        $result = mysqli_query($this->connect(),$sql);
        return $result;
    }
    public function adduser($username,$password,$email){
        $sql = "INSERT INTO user(username, password, email) VALUES ('$username','$password','$email')";
        $result = mysqli_query($this->connect(),$sql);
        return $result;
    }
    public function checkLogin($username,$password){
        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($this->connect(),$sql);
        return $result;
    }

}
?>