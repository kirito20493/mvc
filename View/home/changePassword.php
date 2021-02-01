<div class="main">
        <form action="index.php?controller=home&action=changePass" method="POST" class="form" id="form-1">
            <h3 class="heading">Thay đổi mật khẩu</h3>
            <div class="spacer"></div>
            <p></p>
            <div class="form-group">
                <label for="passwordOld" class="form-label">Mật khẩu hiện tại: </label>
                <input id="passwordOld" name="passwordOld" type="password" class="form-control" >
                <?php
                if(isset($error['passwordOld'])){
                ?>
                <span class="form-message" style="color:red"><?php echo $error['passwordOld']; ?></span>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu mới: </label>
                <input id="password" name="password" type="password" class="form-control">
                <?php
                if(isset($error['password'])){
                ?>
                <span class="form-message" style="color:red"><?php echo $error['password']; ?></span>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="password-confirmation" class="form-label">Nhập lại mật khẩu: </label>
                <input id="password-confirmation" name="password-confirmation" type="password" class="form-control">
                <?php
                if(isset($error['password-confirmation'])){
                ?>
                <span class="form-message" style="color:red"><?php echo $error['password-confirmation']; ?></span>
                <?php } ?>
            </div>

            <button class="form-submit" name="changePassword">Xác nhận</button>
        </form>
    </div>