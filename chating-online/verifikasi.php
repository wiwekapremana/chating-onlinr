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
    <title>Code Verification</title>
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
                <div class="verifikasi">
                <form action="verifikasi.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
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
                    <br>
                    <div class="form-group">
                        <input class="form-control" type="number" name="otp" placeholder="Enter verification code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check" value="Submit" style= "background : white; color:purple; font-size: 14px">
                    </div>
                </form>
            </div>
        </div>
                </center>
    </div>
    
</body>
</html>