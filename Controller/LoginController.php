<?php
class LoginController{
      //     include './lib/validate.php';
    //     if (isset($_POST['register'])){
    //         $error = array();
    //         //validate UserName
    //         if (empty($_POST['username'])) {
    //             $error['username'] = 'bạn cần nhập username';
    //         } else {
    //             if(!isUserName($_POST['username'])) {
    //                  $error['username'] = 'Username không đúng định dạng!'; 
    //             }else {
    //                 $username = $_POST['username'];
    //             }
    //         }
    //         // Validate Password
    //         if (empty($_POST['password'])) {
    //             $error['password'] = 'bạn cần nhập password ';
    //         } else {
    //             if(!isPassWord($_POST['password'])) {
    //                 $error['password'] = 'PassWord phải gôm chữ + số và không có ký tự trống!'; 
    //             }else {
    //                 $password = $_POST['password'];
    //             }
    //         }
    //         // validate Password-confirmation
    //         if (empty($_POST['password_confirmation'])) {
    //             $error['password_confirmation'] = 'bạn cần nhập lại password ';
    //         } else {
    //             if ($_POST['password_confirmation'] != $_POST['password']) {
    //                 $error['password_confirmation'] = 'Mật khẩu nhập lại không chính xác! Vui lòng nhập lại!';
    //             } else {
    //                 $password_confirmation = $_POST['password_confirmation'];
    //             }
    //         }

    //         //send mail
    //         if (empty($_POST['email'])) {
    //             $error['email'] = 'bạn cần nhập email ';
    //         } else {
    //             if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    //                 $error['email'] = "Email không đúng định dạng!";
    //             }else {
    //                 $email = $_POST['email'];
    //                 include './lib/sendMail.php';
    //                 $sendMail = sendMail($email,$username,$password);
    //             }
    //         }

    //         if(empty($error)) {
                
    //             $model = new UserModel();
    //             $result = $model->adduser($username,$password,$email);
    //             if($result === TRUE){
    //                 $sendMail->send();
    //                 $sendMail->smtpClose();
    //                 header('Location: index.php?controller=login');
    //             }
                
    //         }

    //     }
    //     include './View/register.php';
}
?>