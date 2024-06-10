<?php require_once "controllerUser.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="assets/gambar/si.png" />
    <title>Forgot Password</title>
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
            <div class="forgot-password">
                <form action="forgotPassword.php" method="POST" autocomplete="">
                    <h1 class="text-center">FORGOT</h1>
                    <h1 class="text-center">PASSWORD</h1>
                    <p class="text-center">input your email address</p>
                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
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
                        <input class="form-control button" type="submit" name="check-email" value="Next" style= "background : white; color:purple; font-size: 14px">
                    </div>
                </form>
            </div>
        </div>
    </center>
    </div>
    
</body>
</html>