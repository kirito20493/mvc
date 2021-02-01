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
            include 'LoginController.php';
            $loginController = new LoginController();
            $loginController->loginController();
            break;
        case 'register';
            include 'RegisterController.php';
            $registerController = new RegisterController();
            $registerController->registerController();
            break;
        case 'home';
            include 'HomeController.php';
            $homeController = new HomeController();
            $homeController->homeController();
            break;
        default;
            $this->loginController();
            break;
        }
    }
}
?>