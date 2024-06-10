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
    header('Location: loginUser.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="assets/gambar/si.png" />
    <title><?php echo $fetch_info['name'] ?> | index</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
     * {
        margin: 0%;
        font-family: Montserrat;
     }
    header nav{
        background-color: #6A1C89;
    }
    .container-fluid{
        font-size: 20px;
    }
</style>
<body>
    <?php
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$_SESSION[email]'");
        $data = mysqli_fetch_array($query);
    ?>
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
                                <img style="border-radius : 50%; padding: 1px 9px; height : 50px; " src="assets/gambar/default.png" >
                            <?php }else{ ?>
                                <img style="border-radius : 100%; padding: 1px 9px; height : 50px; width: 65px;" src="uploads/<?php echo $fetch_info['image_url'] ?>">
                            <?php } ?>
                    <!-- <img style="border-radius : 100%; padding: 1px 9px; height : 50px;" src="uploads/<?php echo $fetch_info['image_url'] ?>"> -->
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

    <br>
    <br>
    <br>
    <br>
    <center>
    <section class="col-9">
    <p style="float:right">Tanggal/Waktu: <span id="tanggalwaktu"></span></p>
            <script>
                var tw = new Date();
                if (tw.getTimezoneOffset() == 0)(a = tw.getTime() + (7 * 60 * 60 * 1000))
                else(a = tw.getTime());
                tw.setTime(a);
                var tahun = tw.getFullYear();
                var hari = tw.getDay();
                var bulan = tw.getMonth();
                var tanggal = tw.getDate();
                var hariarray = new Array("Minggu,", "Senin,", "Selasa,", "Rabu,", "Kamis,", "Jum'at,", "Sabtu,");
                var bulanarray = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember");
                document.getElementById("tanggalwaktu").innerHTML = hariarray[hari] + " " + tanggal + " " + bulanarray[bulan] + " " + tahun + " Jam " + ((tw.getHours() < 10) ? "0" : "") + tw.getHours() + ":" + ((tw.getMinutes() < 10) ? "0" : "") + tw.getMinutes() + (" WITA ");
            </script>
            <br>
        <div class="box box-success">
            <div class="box-header">
                <h4 class="box-title" style="float:left;">New Messages</h4>
            </div>
            <br>
            <br>
            <div class="box-body" >
                <form action="" method="post">
                    <div class="form-group" >
                        <textarea class="form-control" rows="3" placeholder="enter your message here..." name="msg" required style="background:#F5F3F5"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="send"style= "background : #6A1C89; color:white; border: none; width: 20%; float: left; "> Send</button>
                        </div><!-- /.col -->
                    </div>
                </form>
                <?php
                if (isset($_POST['send'])) {
                    $pesan  = $_POST['msg'];
                    $sender = $data['name'];
                    $query = mysqli_query($koneksi, "INSERT INTO msg VALUES (NULL, NOW(), '$sender', '$pesan', '$email')");

                    if ($query) {
                ?>
                        <script type="text/javascript">
                            alert("Pesan Terkirim!");
                            document.location.href = "index.php";
                        </script>
                    <?php

                    } else {
                    ?>
                        <script type="text/javascript">
                            alert("Pesan Tidak Terkirim!");
                            document.location.href = "index.php";
                        </script>
                <?php
                    }
                }
                ?>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        <br>
        <br>
        <br>
        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title" style="float:left;">Messages Data</h4>
            </div>
            <br>
            <br>
            <div class="card" >
                    <div class="card-body" style="background:#F5F3F5" >
                        <table class="table" style="background:#F5F3F5">
                            <thead style="background: #6A1C89; color: white" >
                                <tr>
                                <th>Datetime</th>
                                <th>Sender</th>
                                <th>Message</th>
                            </tr>
                            </thead>

                        <?php
                        $query_mysql = mysqli_query($koneksi, "SELECT * FROM msg ORDER BY datetime DESC");
                        while ($data = mysqli_fetch_array($query_mysql)) {
                        ?>
                            <tr>
                                <td><?php echo $data['datetime']; ?></td>
                                <td><?php echo $data['sender'] ?></td>
                                <td><?php echo $data['message']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section><!-- /.content -->
    </div><!-- /.container -->
    </div>
    </div>
    </div>
    </section>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>