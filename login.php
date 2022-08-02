<?php
define("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce", "");
require_once("header.php");
?>
<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2>Hesabına giriş yap</h2>
                    <form action="admin/backend/direct.php" method="post">
                        <input name="email" type="email" placeholder="E-posta adresi" />
                        <input name="password" type="password" placeholder="Şifre" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Beni hatırla
                        </span>
                        <button name="login" type="submit" class="btn btn-default">Giriş yap</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">YADA</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>Yeni hesap oluştur!</h2>
                    <form action="admin/backend/direct.php" method="post">
                        <input name="name" type="text" placeholder="Ad" />
                        <input name="surname" type="text" placeholder="Soyad" />
                        <input name="email" type="email" placeholder="E-posta adresi" />
                        <input name="phone" type="number" placeholder="Telefon numarası" maxlength="11" />
                        <input name="birthday" type="date">
                        <input name="password" type="password" placeholder="Şifre" />
                        <input name="repassword" type="password" placeholder="Şifre tekrar" />
                        <button name="register" type="submit" class="btn btn-default">Kayıt ol</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</section>
<!--/form-->
<?php require_once("footer.php"); ?>
</body>

</html>