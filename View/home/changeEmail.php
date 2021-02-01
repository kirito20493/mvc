<div class="main">
        <form action="index.php?controller=home&action=changeEmail" method="POST" class="form" id="form-1">
            <h3 class="heading">Thay đổi Email</h3>
            <div class="spacer"></div>
            <p></p>
            <div class="form-group">
                <label for="email" class="form-label">Email mới </label>
                <input id="email" name="email" type="text" class="form-control" >
                <?php
                if(isset($error['email'])){
                ?>
                <span class="form-message" style="color:red"><?php echo $error['email']; ?></span>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu: </label>
                <input id="password" name="password" type="password" class="form-control">
                <?php
                if(isset($error['password'])){
                ?>
                <span class="form-message" style="color:red"><?php echo $error['password']; ?></span>
                <?php } ?>
            </div>

            <button class="form-submit" name="changeEmail">Xác nhận</button>
        </form>
    </div>