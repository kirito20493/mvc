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
    //check isset Username
    function checkIssetUser($username){
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($this->connect(),$sql);
        if(mysqli_num_rows($result) > 0) {
            return false;
        } else {
            return true;
        }
    }
    //check isset email
    function checkIssetEmail($email){
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($this->connect(),$sql);
        if(mysqli_num_rows($result) > 0) {
            return false;
        } else {
            return true;
        }
    }
}
?>