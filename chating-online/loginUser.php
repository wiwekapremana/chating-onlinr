<?php require_once "controllerUser.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="assets/gambar/si.png" />
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="box">
    <center>
        <div class="container">
            <div class="foto">
                <img src="assets/gambar/Chatting-cuate.svg" alt="">
            </div>
            <div class="login">
                    <form action="loginUser.php" method="POST" autocomplete="">
                        <h1 class="text-center">USER</h1>
                        <h1 class="text-center">LOGIN</h1>
                        <p class="text-center">welcome to the chatting online</p>
                        <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php
                                foreach($errors as $showerror){
                                    echo $showerror;
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                        <br>
                        
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>"style= "font-size: 14px">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="password" placeholder="Password" required style= "font-size: 14px">
                        </div>
                        <div class="link forget-pass text-left"><a href="forgotPassword.php" style= "color:white; font-size: 12px">Forgot password?</a></div>
                        <div class="form-group">
                            <input class="form-control button" type="submit" name="login" value="Login"style= "background : white; color:purple; font-size: 14px">
                        </div>
                        <div class="link login-link text-center"style= "color:white; font-size: 12px">Dont have an account ? <a href="signupUser.php" style= "color:white; font-size: 12px"><u>Sign-up<u></a></div>
                    </form>

            </div>
        </div>
    </div>
    <center>
    </div>
</body>
</html>