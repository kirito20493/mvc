<div class="main">
        <div class="container">
            <h3 class="container_infor">USER'S INFORMATION</h3>
            
            <p class='container_username'>
                Hello <?php echo $_SESSION['username']; ?> !!!
            </p>
            <p class='container_username'>
                Your Email:  <?php echo $_SESSION['email']; ?> !!!
            </p>
        </div>
        
        <div class="button">
            <a href="index.php?controller=home&action=logout">LOG OUT</a>
            <a href="index.php?controller=home&action=changePass">Đổi mật khẩu!!</a>
            <a href="index.php?controller=home&action=changeEmail">Đổi Email!!</a>
        </div>
    </div>