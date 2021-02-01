<?php
require './Model/UserModel.php';
session_start();
class controller
{
    // Hàm điều hướng Controller
    public function handleRequest()
    {
        $controller = isset($_GET['controller'])?$_GET['controller']:'login';
        switch ($controller){
        case 'login';
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


    //Loading LOGIN Controller
    public function loginController()
    {
        $model = new UserModel();
        if (isset($_POST['login'])) {
            $error = array();
            if (empty($_POST['username']) || empty($_POST['password'])) {
                $error['password'] = 'Tài khoản hoặc Mật khẩu không được bỏ trống, Vui lòng nhập!';
            } 
            if ($model->checkIssetUser($_POST['username']) === TRUE) {
                $error['username'] = "Tài khoản này không tồn tại!";
            } else {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $result = $model->checkLogin($username, $password);
                $data = $result->fetch_assoc();
                if ($data['username'] == $username && $data['password'] == $password) {
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['password'] = $data['password'];
                    $_SESSION['email'] = $data['email'];
                    header('Location: index.php?controller=home');
                } else {
                    $error['password'] = "Mật khẩu không chính xác!";
                }
            }
        }
        include './View/login.php';
    }


    //Loading REGISTER Controller
    public function registerController()
    {
        include './lib/validate.php';
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
                    $sendMail = sendMail($email, $username, $password);
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
        include './View/register.php';
    }
    // Loading HOME Controller
    public function homeController()
    {
        include './lib/validate.php';
        $action = isset($_GET['action'])?$_GET['action']:'index';
        $model = new UserModel();
        $error = array();
        switch ($action) {
            // trang home show thông tin User
            case 'index':
                if(isset($_SESSION['username']) && isset($_SESSION['password'])){
                    include './View/home/index.php';
                } else {
                    header('Location: index.php?controller=login');
                }
                break;
            // Đăng xuất tài khoản và Xoá Session
            case 'logout':
                session_destroy();
                header('Location: index.php?controller=login');
                break;
            // thay đổi mật khẩu
            case 'changePass':
                if (isset($_POST['changePassword'])){
                    if (empty($_POST['passwordOld'])) {
                        $error['passwordOld'] = "Không được để trống!";
                    } elseif ($_POST['passwordOld'] != $_SESSION['password']) {
                        $error['passwordOld'] = "Mật khẩu không chính xác!";
                    }
                    if (empty($_POST['password'])) {
                        $error['password'] = "Không được để trống!";
                    } elseif (!isPassWord($_POST['password'])) {
                        $error['password'] = 'PassWord phải gồm chữ + số và không có ký tự trống!'; 
                    } else {
                        $password = $_POST['password'];
                    }
                    if (empty($_POST['password-confirmation'])) {
                        $error['password-confirmation'] = "Không được để trống!";
                    } elseif ($_POST['password-confirmation'] != $_POST['password']) {
                        $error['password-confirmation'] = "Mật khẩu nhập lại không chính xác!";
                    }
                    // gọi hàm thay đổi mật khẩu từ UserModel
                    if (empty($error)){
                        $result = $model->changePassword($_SESSION['username'],$password);
                        $_SESSION['password'] = $password;
                        header('Location: index.php?controller=home');
                    }
                }
                include './View/home/changePassword.php';
                break;
            // thay đổi Email
            case 'changeEmail':
                if (isset($_POST['changeEmail'])) {
                    if (empty($_POST['email'])){
                        $error['email'] = "Không được để trống!";
                    } elseif(!$model->checkIssetEmail($_POST['email'])) {
                        $error['email'] = "Email này đã tồn tại! Vui lòng chọn Email khác!";
                    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        $error['email'] = "Email không đúng định dạng!";
                    } else {
                        $email = $_POST['email'];
                    }
                    if (empty($_POST['password'])) {
                        $error['password'] = "Không được để trống!";
                    } elseif ($_POST['password'] != $_SESSION['password']) {
                        $error['password'] = "Mật khẩu không chính xác!";
                    }
                    if (empty($error)){
                        $model->changeEmail($_SESSION['username'],$_SESSION['password'],$email);
                        $_SESSION['email'] = $email;
                        header('Location: index.php?controller=home');
                    }
                }
                include './View/home/changeEmail.php';
                break;
        }
    }
}
?>