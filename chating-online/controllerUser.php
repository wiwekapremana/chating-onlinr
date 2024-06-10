<?php 
session_start();
require "config.php";
$email = "";
$name = "";
$errors = array();

//kondisi jika user melakukan signup
if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($koneksi, $_POST['name']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $password2 = mysqli_real_escape_string($koneksi, $_POST['password2']);
    if($password !== $password2){
        $errors['password'] = "konfirmasi password tidak sesuai!";
    }
    $email_check = "SELECT * FROM user WHERE email = '$email'";
    $res = mysqli_query($koneksi, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email anda sudah terdaftar!!";
    }
    if(count($errors) === 0){
         // enkripsi password
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO user (name, email, password, code, status)
                        values('$name', '$email', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($koneksi, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: chatingonline4a@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "Masukan kode Verifikasi yang kami kirim ke - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: verifikasi.php');
                exit();
            }else{
                $errors['otp-error'] = "Pengiriman kode gagal!";
            }
        }else{
            $errors['db-error'] = "Data tidak dapat diinputkan ke Database!";
        }
    }

}
    //mengecek kode user-otp OTP signup sudah sesuai
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($koneksi, $_POST['otp']);
        $check_code = "SELECT * FROM user WHERE code = $otp_code";
        $code_res = mysqli_query($koneksi, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE user SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($koneksi, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: index.php');
                exit();
            }else{
                $errors['otp-error'] = "Terjadi kesalahan saat memperbarui kode!";
            }
        }else{
            $errors['otp-error'] = "Kode yang anda masukan salah!";
        }
    }

    //login user
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);
        $check_email = "SELECT * FROM user WHERE email = '$email'";
        $res = mysqli_query($koneksi, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: index.php');
                }else{
                    $info = "Anda belum mealakukan verifikasi menggunakan kode yang kami kirimkan ke - $email";
                    $_SESSION['info'] = $info;
                    header('location: verifikasi.php');
                }
            }else{
                $errors['email'] = "Email atau Password Salah!";
            }
        }else{
            $errors['email'] = "Data anda belum terdaftar! silahkan buat akun baru!.";
        }
    }

    //kondisi ketika user ingin mengganti password
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $check_email = "SELECT * FROM user WHERE email='$email'";
        $run_sql = mysqli_query($koneksi, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE user SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($koneksi, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: chatingonline4a@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "Masukan kode otp reset password yang kami kirim ke - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Gagal saat mengirim kode!";
                }
            }else{
                $errors['db-error'] = "Terjadi KEsalahan!";
            }
        }else{
            $errors['email'] = "Email anda tidak terdaftar!";
        }
    }

    //mengecek kode verik\fikasi otp reset password
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($koneksi, $_POST['otp']);
        $check_code = "SELECT * FROM user WHERE code = $otp_code";
        $code_res = mysqli_query($koneksi, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Silahkan untuk membuat password baru.";
            $_SESSION['info'] = $info;
            header('location: newPassword.php');
            exit();
        }else{
            $errors['otp-error'] = "Kode yang anda masukan Salah!";
        }
    }

    //kondisi ketika user mengganti password
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);
        $password2 = mysqli_real_escape_string($koneksi, $_POST['password2']);
        if($password !== $password2){
            $errors['password'] = "konfirmasi password tidak sesuai!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; 
             // enkripsi password
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE user SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($koneksi, $update_pass);
            if($run_query){
                $info = "Password anda telah terganti.";
                $_SESSION['info'] = $info;
                header('Location: changePassword.php');
            }else{
                $errors['db-error'] = "Gagal untuk merubah password!";
            }
        }
    }
    // Edit Password
    if(isset($_POST['change-password2'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);
        $password2 = mysqli_real_escape_string($koneksi, $_POST['password2']);    
        if($password !== $password2){
            $errors['password'] = "konfirmasi password tidak sesuai!";
        }
        else{
            $code = 0;
            $email = $_SESSION['email']; 
             // enkripsi password
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE user SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($koneksi, $update_pass);
            if($run_query){
                $info = "Password anda telah terganti.";
                $_SESSION['info'] = $info;
                header('Location: userProfile.php');
            }else{
                $errors['db-error'] = "Gagal untuk merubah password!";
            }
        }
         $info = "Password anda telah terganti.";
    }

    // edit profile
      if (isset($_POST["save"])) {
        $_SESSION['info'] = "";
        $name = mysqli_real_escape_string($koneksi, $_POST['name']);
    
            $image_name = $_FILES["image"]["name"];
            $image_tmp_name = $_FILES["image"]["tmp_name"];
            $image_size = $_FILES["image"]["size"];
            $image_new_name = rand() . $image_name;
    
            if ($image_size > 5242880) {
                echo "<script>alert('Gambar terlalu besar. Maksimal 5MB.');</script>";
            } else {
                $sql = "UPDATE user, msg SET name='$name' ,image_url='$image_new_name' WHERE email='{$_SESSION["email"]}'";
                $result = mysqli_query($koneksi, $sql);
                if ($result) {
                    echo "<script>alert('Profil Berhasil Diperbaharui.');</script>";
                    move_uploaded_file($image_tmp_name, "uploads/" . $image_new_name);
                } else {
                    echo "<script>alert('Profile tidak dapat diperbaharui');</script>";
                    echo  $koneksi->error;
                }
            
        if (mysqli_query($koneksi, $sql)) {
            header('Location: userProfile.php');
          }
    }
}
    
   //menerima nilai "login-now"
    if(isset($_POST['login-now'])){
        header('Location: loginUser.php');
    }
