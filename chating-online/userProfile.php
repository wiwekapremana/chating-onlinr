<?php require_once "controllerUser.php"; ?>
<?php
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if ($email != false && $password != false) {
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $run_Sql = mysqli_query($koneksi, $sql);
    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if ($status == "verified") {
            if ($code != 0) {
                header('Location: reset-code.php');
            }
        } else {
            header('Location: verifikasi.php');
        }
    }
} else {
    header('Location: userProfile.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="assets/gambar/si.png" />
    <title><?php echo $fetch_info['name'] ?> | Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<style>
    * {
        margin: 0%;
        font-family: Montserrat;
    }

    header nav {
        background-color: #6A1C89;
    }

    .container-fluid {
        font-size: 20px;
    }
</style>

<body>

    <div class="editProfile">
        <form action="userProfile.php" method="POST" autocomplete="" enctype="multipart/form-data">


            <header>
                <nav class="navbar  navbar-expand-lg fixed-top navbar-light bg-purple flex-md-nowrap p-1 shadow" aria-label="Main navigation">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index.php" style=" color:white">Chating Online</a>
                        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="navbar-nav">
                            <div class="nav-item">
                            <?php 
                            $sqlImage = mysqli_query($koneksi,"SELECT * FROM user WHERE email='$_SESSION[email]'");
                            if ($fetch_info['image_url'] == "") { ?>
                                <img style="border-radius : 50%; padding: 1px 9px; height : 50px;" src="assets/gambar/default.png" >
                            <?php }else{ ?>
                                <img style="border-radius : 50%; padding: 1px 9px; height : 50px; width: 65px;" src="uploads/<?php echo $fetch_info['image_url'] ?>">
                            <?php } ?>
                                <!-- <img style="border-radius : 50%; padding: 1px 9px; height : 50px;" src="uploads/<?php echo $fetch_info['image_url'] ?>"> -->
                            </div>

                            <div class="nav-item">
                                <li class="nav-item dropdown">

                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 90%; color: white"><?php echo $fetch_info['name'] ?></a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdown01">
                                        <li><a class="dropdown-item" href="userProfile.php">Profile</a></li>
                                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                                    </ul>
                                </li>

                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <br><br><br><br>

            <div class="row justify-content-evenly">
                <div class="col-4">
                    <div class="d-flex align-items-center p-3 my-3 text-white justify-content-sm-center bg-purple rounded shadow-sm text-center" style="background:#6A1C89">
                        <div class="lh-1 text-center">
                            <h1 class="h6 mb-0 text-white lh-1">Update Your Profile</h1>
                        </div>
                    </div>

                    <br>
                    <center>
                        <div class="">
                        
                            <?php 
                            $sqlImage = mysqli_query($koneksi,"SELECT * FROM user WHERE email='$_SESSION[email]'");
                            if ($fetch_info['image_url'] == "") { ?>
                                <img src="assets/gambar/default.png" style="height: 200px; border-radius : 100%">
                            <?php }else{ ?>
                                <img style="height: 300px; border-radius : 100%; width: 300px;" src="uploads/<?php echo $fetch_info['image_url']; ?>">
                            <?php } ?>
                           
                        <!-- <img style="height: 300px; border-radius : 30%" src="uploads/<?php echo $fetch_info['image_url'] ?>" style="width:30%; border-radius:100%;"></div> -->
                    </center>
                    <br>
                    <div class="form-group">
                        <label for="formFile" class="form-label">Full Name</label>
                        <input class="form-control" type="name" name="name" placeholder="Full Name" required value="<?php echo $fetch_info['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="formFile" class="form-label">Email</label>
                        <input class="form-control" type="name" name="email" placeholder="Email" aria-label="Disabled input example" disabled value="<?php echo $fetch_info['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="formFile" class="form-label">Picture</label>
                        <input class="form-control" type="file" accept="image/*" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="save" style=" background:  #6A1C89; color:white; border: none; width: 20%; float: left; margin-right:10% "> Save</button>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger" name="cancel" style=" color:white; border: none; width: 20%; float: left; ">Cancel</button>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex align-items-center p-3 my-3 text-white justify-content-sm-center bg-purple rounded shadow-sm text-center" style="background:#6A1C89">
                        <div class="lh-1 text-center">
                            <h1 class="h6 mb-0 text-white lh-1">Change Password</h1>
                        </div>
                    </div>

                    <?php
                    if (count($errors) > 0) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['info'])) {
                    ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- <div class="form-group">
                        <label for="formFile" class="form-label"> Old Password</label>
                        <input class="form-control" type="password" name="passwordLama" placeholder="Old Password">
                    </div> -->
                    <div class="form-group">
                        <label for="formFile" class="form-label">New Password</label>
                        <input class="form-control" type="password" name="password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="formFile" class="form-label">Confirm New Password</label>
                        <input class="form-control" type="password" name="password2" placeholder="Confirm New Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="change-password2" style="background : #6A1C89; color:white; border: none; width: 20%; float: left; margin-right:10% "> Save</button>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger" name="cancel" style=" color:white; border: none; width: 20%; float: left; ">Cancel</button>
                    </div>
                </div>
            </div>
    </div>
    </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>