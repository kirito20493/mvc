<?php
require './config/config.php';
class UserModel extends DBConnect
{
    public function getAllDataUsers()
    {
        $sql = "SELECT * FROM user";
        $result = mysqli_query($this->connect(), $sql);
        return $result;
    }
    // Hàm tạo mới Tài khoản
    public function adduser($username,$password,$email)
    {
        $sql = "INSERT INTO user(username, password, email) VALUES ('$username','$password','$email')";
        $result = mysqli_query($this->connect(), $sql);
        return $result;
    }
    // Hàm kiểm tra tài khoản LOGIN
    public function checkLogin($username,$password)
    {
        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($this->connect(), $sql);
        return $result;
    }
    // Hàm kiểm tra tài khoản đã tồn tại chưa
    function checkIssetUser($username)
    {
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($this->connect(), $sql);
        if(mysqli_num_rows($result) > 0) {
            return false;
        } else {
            return true;
        }
    }
    // Hàm kiểm tra Email đã tồn tại chưa
    function checkIssetEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($this->connect(), $sql);
        if(mysqli_num_rows($result) > 0) {
            return false;
        } else {
            return true;
        }
    }
    // Hàm thay đổi mật khẩu
    function changePassword($username,$password)
    {
        $sql = "UPDATE user SET password='$password' WHERE username = '$username'";
        $result = mysqli_query($this->connect(),$sql);
        return $result;
    }
    // hàm thay đổi Email
    function changeEmail($username,$password,$email)
    {
        $sql = "UPDATE user SET email='$email' WHERE username = '$username' AND password='$password'";
        $result = mysqli_query($this->connect(),$sql);
        return $result;
    }
}
?>