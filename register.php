<?php
  require 'connectdb.php';



  $Username = $_POST['username'];
  $Password = $_POST['password'];
  $Email = $_POST['email'];

  //เข้ารหัส password
  $salt = 'dksjfgklrkgljfgj1j23jkfmdklgjlkr';
  $hash_login_password = hash_hmac('sha256',$Password,$salt);

  $query = "INSERT INTO tb_login(Username,Password,Email) VALUE ('$Username','$hash_login_password','$Email')";
  $result = mysqli_query($con,$query);

$sql = "SELECT UserId FROM tb_login  WHERE Username=?";
$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt, "s", $Username);
mysqli_stmt_execute($stmt);
$result_user = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result_user);




$query2 = "INSERT INTO tb_profile(user_profile,file_name) VALUE ('$row[0]','user.png')";
$result2 = mysqli_query($con,$query2);

if($result2){
    echo "<script>alert('Register successfully');
      window.location.href='index.php';
      </script>";
} else{
    echo "เกิดข้อผิดพลาด".mysqli_error($con);
}


  mysqli_close($con);




