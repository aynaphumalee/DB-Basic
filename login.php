<?php
require 'connectdb.php';

$Username = mysqli_real_escape_string($con,$_POST['username']);
$Password = mysqli_real_escape_string($con,$_POST['password']);

$salt = 'dksjfgklrkgljfgj1j23jkfmdklgjlkr';
$hash_login_password = hash_hmac('sha256',$Password,$salt);

$sql = "SELECT * FROM tb_login WHERE Username=? AND Password=?";
$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt,"ss",$Username,$hash_login_password);
mysqli_stmt_execute($stmt);
$result_user = mysqli_stmt_get_result($stmt);
if($result_user->num_rows == 1) {
    session_start();
    $row_user = mysqli_fetch_array($result_user, MYSQLI_ASSOC);
    $_SESSION['login_id'] = $row_user['UserId'];
    header("Location: main.php");

} else {
    echo "<script>
    alert('Invalid username or password');
    window.location.href='index.php';
    </script>";
}