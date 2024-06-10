<?php require_once "controllerUser.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="assets/gambar/si.png" />
    <title>Signup </title>
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
            <div class="sign-up">
                <form action="signupUser.php" method="POST" autocomplete="">
                    <h1 class="text-center">USER</h1>
                    <h1 class="text-center">SIGN-UP</h1>
                    <p class="text-center">welcome to the chatting online</p>
                    <?php
                    if (count($errors) == 1) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    } elseif (count($errors) > 1) {
                    ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach ($errors as $showerror) {
                            ?>
                                <li><?php echo $showerror; ?></li>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Full Name" required value="<?php echo $name ?>"style= "font-size: 14px;">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>"style= "font-size: 14px">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required style= "font-size: 14px">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password2" placeholder="Confirm password" required style= "font-size: 14px">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="Sign-up" style= "background : white; color:purple; font-size: 14px">
                    </div>
                    <div class="link login-link text-center"style= "color:white; font-size: 12px">Already have an account? <a href="loginUser.php" style= "color:white; font-size: 12px"><u>Login</u></a></div>
                </form>
                </div>
        </div>
                </center>
    </div>

</body>

</html>