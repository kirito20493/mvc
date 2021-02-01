<?php
include './Model/UserModel.php';
class controller{
    public function handleRequest(){
        $controller = isset($_GET['controller'])?$_GET['controller']:'login';
        switch ($controller){
            case 'login';
                // include 'index.php?controller=login';
                $this->loginController();
                break;
            case 'register';
                $this->registerController();
                break;
            case 'home';
                $this->homeController();
                break;
            default;
                $this->loginController();
                break;
        }
    }


    // LOGIN
    public function loginController(){
        if (isset($_POST['login'])){
            $error = array();
            if (empty($_POST['username']) || empty($_POST['password'])){
                $error['password'] = 'Tài khoản hoặc Mật khẩu không được bỏ trống, Vui lòng nhập!';
            } else {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $model = new UserModel();
                $result = $model->checkLogin($username,$password);
                $data = $result->fetch_assoc();
                if ($data['username'] == $username && $data['password'] == $password){
                    header('Location: index.php?controller=home');
                } else {
                    $error['password'] = "Tài khoản hoặc Mật khẩu không chính xác!";
                }
            }
        }
        include './View/login.php';
    }


    // REGISTER
    public function registerController(){
        include './lib/validate.php';
        $model = new UserModel();
        if (isset($_POST['register'])){
            $error = array();
            //validate UserName
            if (!checkEmptyUserName($_POST['username'])){
                $error['username'] = "Bạn chưa nhập tài khoản! Vui lòng nhập!";
            }
            if(!$model->checkIssetUser($_POST['username'])){
                $error['username'] = "Tài khoản này đã tồn tại! Vui lòng chọn tài khoản khác!";
            }
            if(!isUserName($_POST['username'])) {
                $error['username'] = 'Username không đúng định dạng!'; 
            }else{
                $username = $_POST['username'];
            }
            
            // Validate Password
            if (!checkEmptyPassword($_POST['password'])) {
                $error['password'] = 'bạn cần nhập password!';
            } 
            if(!isPassWord($_POST['password'])) {
                $error['password'] = 'PassWord phải gôm chữ + số và không có ký tự trống!'; 
            }else{
                $password = $_POST['password'];
            }
            
            // validate Password-confirmation
            if (empty($_POST['password_confirmation'])) {
                $error['password_confirmation'] = 'bạn cần nhập password-congirmation ';
            } else {
                if ($_POST['password_confirmation'] != $_POST['password']) {
                    $error['password_confirmation'] = 'Mật khẩu nhập lại không chính xác! Vui lòng nhập lại!';
                } else {
                    $password_confirmation = $_POST['password_confirmation'];
                }
            }

            //send mail
            if (empty($_POST['email'])) {
                $error['email'] = 'bạn cần nhập email ';
            } else {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $error['email'] = "Email không đúng định dạng!";
                }else {
                    $email = $_POST['email'];
                    include './lib/sendMail.php';
                    $sendMail = sendMail($email,$username,$password);
                }
            }
            if(empty($error)) {
                $model = new UserModel();
                $result = $model->adduser($username,$password,$email);
                if($result === TRUE){
                    $sendMail->send();
                    $sendMail->smtpClose();
                    header('Location: index.php?controller=login');
                }
                
            }

        }
        include './View/register.php';
    }

    // Home
    public function homeController(){
        include './View/home.php';
    }
}
?>