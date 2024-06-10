<?php 
$servername = "localhost";
$username = "webtesti_si4a_kelompok2";
$password = "wiwekaganteng";
$dbname = "webtesti_si4a_kelompok2";

// membuat koneksi
$koneksi = mysqli_connect($servername, $username, $password, $dbname);


if (mysqli_connect_errno()) {
    echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
}

?>
