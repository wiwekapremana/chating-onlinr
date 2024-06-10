<?php require_once "controllerUser.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: loginUser.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="assets/gambar/si.png" />
    <title>Create a New Password</title>
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
            <div class="new-password">
                <form action="newPassword.php" method="POST" autocomplete="off">
                    <h1 class="text-center">NEW PASSWORD</h1>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center" style="background-color:white; color: #6A1C89">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
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
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Masukan password baru" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password2" placeholder="konfirmasi password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Change" style= "background : white; color:purple; font-size: 14px">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>