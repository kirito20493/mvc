<?php
class LoginController{
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
}
?>