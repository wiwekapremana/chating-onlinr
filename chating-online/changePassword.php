<?php require_once "controllerUser.php"; ?>
<?php
if($_SESSION['info'] == false){
    header('Location: loginUser.php');  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="assets/gambar/si.png" />
    <title>Login Form</title>
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
            <div class="change-password">
            <?php 
            if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php
            }
            ?>
                <form action="loginUser.php" method="POST">
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login-now" value="Login Now" style= "background : white; color:purple; font-size: 14px">
                    </div>
                </form>
            </div>
        </div>
        </center>
    </div>
    
</body>
</html>