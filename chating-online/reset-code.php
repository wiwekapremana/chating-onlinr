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
            <div class="reset-code">
                <form action="reset-code.php" method="POST" autocomplete="off">
                    <h1 class="text-center">Code Verification</h1>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem; background-color:white; color: #6A1C89">
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
                        <input class="form-control" type="number" name="otp" placeholder="Enter code" required style= "font-size: 14px">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-reset-otp" value="Submit" style= "background : white; color:purple; font-size: 14px">
                    </div>
                </form>
            </div>
        </div>
    </center>
    </div>
    
</body>
</html>