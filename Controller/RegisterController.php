<?php
class RegisterController
{
    //Loading REGISTER Controller
    public function registerController()
    {
        include_once './lib/validate.php';
        $model = new UserModel();
        if (isset($_POST['register'])) {
            $error = array();
            //validate UserName
            if (!checkEmptyUserName($_POST['username'])) {
                $error['username'] = "Bạn chưa nhập tài khoản! Vui lòng nhập!";
            }
            if(!$model->checkIssetUser($_POST['username'])) {
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
            //validate Email
            if (empty($_POST['email'])) {
                $error['email'] = 'bạn cần nhập email ';
            } else {
                if(!$model->checkIssetEmail($_POST['email'])) {
                    $error['email'] = "Email này đã tồn tại! Vui lòng chọn Email khác!";
                }
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $error['email'] = "Email không đúng định dạng!";
                }else {
                    $email = $_POST['email'];
                    include './lib/sendMail.php';
                    $sendMail = sendMail($_POST['email'], $_POST['username'], $_POST['password']);
                }
            }
            if(empty($error)) {
                $model = new UserModel();
                $result = $model->adduser($username, $password, $email);
                if($result === true) {
                    $sendMail->send();
                    $sendMail->smtpClose();
                    header('Location: index.php?controller=login');
                }   
            }
        }
        include_once './View/register.php';
    }
}
?>