<div class="main">
        <form action="index.php?controller=register" method="POST" class="form" id="form-1" enctype="multipart/form-data">
            <h3 class="heading">Đăng ký thành viên</h3>
            <div class="spacer"></div>

            <div class="form-group">
                <label for="username" class="form-label">Tài khoản</label>
                <input id="username" name="username" type="text" placeholder="abc123" class="form-control" value="">
                <?php 
                    if(isset($error['username'])){
                ?>
                <span class="form-message" style="color:red"><?php echo $error['username'];?></span>
                <?php }?>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="text" placeholder="VD: email@domain.com" class="form-control" value="">
                <?php
                    if(isset($error['email'])){
                ?>
                <span class="form-message" style="color:red"><?php echo $error['email']; ?></span>
                <?php }?>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu</label>
                <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                <?php
                    if(isset($error['password'])){
                ?>
                <span class="form-message" style="color:red"><?php echo $error['password'];?></span>
                <?php }?>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                <input id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu"
                    type="password" class="form-control">
                <?php
                    if(isset($error['password_confirmation'])){
                ?>
                <span class="form-message" style="color:red"><?php echo $error['password_confirmation'];?></span>
                <?php }?>
            </div>
            <!-- avatar -->
            <!-- <div class="form-group">
                <label for="avatar" class="form-label">Avatar</label>
                <input id="avatar" name="avatar" type="file" class="form-control">
                <span class="form-message" style="color:red"></span>
            </div> -->

            <button class="form-submit" name="register">Đăng ký</button>
        </form>

    </div>