<?php
require 'connectdb.php';

session_start();
$user_id = $_SESSION['login_id'];
$massage_like = $_GET["massagelike"];

$sql = "SELECT user_login,massage_post FROM tb_like WHERE massage_post=? and user_login=?";
$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt, "ss", $massage_like,$user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result);
var_dump($row);

if($row['user_login'] ==null and $row['massage_post']==null){
    $sql2="INSERT INTO tb_like value ('','$user_id','$massage_like',1)";
    $result2=mysqli_query($con,$sql2);
    header("Location: main.php");
}else{
    $sql3="SELECT like_action FROM tb_like WHERE massage_post=? and user_login=?";
    $stmt3 = mysqli_prepare($con,$sql3);
    mysqli_stmt_bind_param($stmt3, "ss", $massage_like,$user_id);
    mysqli_stmt_execute($stmt3);
    $result3 = mysqli_stmt_get_result($stmt3);
    $row2 = mysqli_fetch_array($result3);
    var_dump($row2);
    if($row2['like_action']==1){
        $update = "UPDATE tb_like SET like_action=0 WHERE massage_post=? and user_login=? ";
        $stmt4 = mysqli_prepare($con,$update);
        mysqli_stmt_bind_param($stmt4, "ss", $massage_like,$user_id);
        mysqli_stmt_execute($stmt4);
        $result4 = mysqli_stmt_get_result($stmt4);
        header("Location: main.php");
    }else{
        $update2 = "UPDATE tb_like SET like_action=1 WHERE massage_post=? and user_login=? ";
        $stmt5 = mysqli_prepare($con,$update2);
        mysqli_stmt_bind_param($stmt5, "ss", $massage_like,$user_id);
        mysqli_stmt_execute($stmt5);
        $result5 = mysqli_stmt_get_result($stmt5);
        header("Location: main.php");

    }
}

//if($result){
  //  header("Location: main.php");
//} else{
  //  echo "เกิดข้อผิดพลาด".mysqli_error($con);
//}