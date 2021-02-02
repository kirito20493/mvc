<?php
class HomeController
{
    public function homeController()
    {
        include_once './lib/validate.php';
        $action = isset($_GET['action'])?$_GET['action']:'index';
        $error = array();
        switch ($action) {
            // trang home show thông tin User
            case 'index':
                $this->showInfor();
                break;
            // Đăng xuất tài khoản và Xoá Session
            case 'logout':
                $this->logoutUser();
                break;
            // thay đổi mật khẩu
            case 'changePass':
                $this->changePassword();
                break;
            // thay đổi Email
            case 'changeEmail':
                $this->changeEmail();
                break;
        }
    }
    // trang home show thông tin User
    public function showInfor()
    {
        if(isset($_SESSION['username']) && isset($_SESSION['password'])){
            include_once './View/home/index.php';
        } else {
            header('Location: index.php?controller=login');
        }
    }
    // hàm đăng xuất user
    public function logoutUser()
    {
        session_destroy();
        header('Location: index.php?controller=login');
    }
    //hàm thay đổi mật khẩu
    public function changePassword()
    {
        $model = new UserModel();
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
        include_once './View/home/changePassword.php';
    }
    //hàm thay đổi email
    public function changeEmail()
    {
        $model = new UserModel();
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
        include_once './View/home/changeEmail.php';
    }
}
?>