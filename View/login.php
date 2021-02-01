<div class="main">

    <form action="index.php?controller=login" method="POST" class="form" id="form-1">
        <h3 class="heading">Đăng nhập</h3>
        <div class="spacer"></div>
        <div class="form-group">
            <label for="username" class="form-label">Tài khoản</label>
            <input id="username" name="username" type="text" placeholder="abc123" class="form-control" value="">
            <span class="form-message" style="color:red"></span>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Mật khẩu</label>
            <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
            <?php
                if(isset($error['password'])){
            ?>
            <span class="form-message" style="color:red"><?php echo $error['password']; ?></span>
            <?php }?>
        </div>
        <button class="form-submit" name="login">Đăng nhập</button>
        <p id="registerBtn">
            Not yet registered?
            <a href="index.php?controller=register">Click here to register</a>
        </p>
    </form>
        
</div>