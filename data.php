<?php
require 'connectdb.php';
session_start();
if(!isset($_SESSION['login_id'])){
    header("Location: index.php");
}

//$date = new DateTime();
//$str_date = $date->format('Y-m-d H:i:s');
$massage = mysqli_real_escape_string($con,$_POST['massage']);
$user_id = $_SESSION['login_id'];

//var_dump($massage);

$insertData = "INSERT INTO tb_massage (massage,time,user_id) VALUES ('$massage',now(),$user_id )";
$result = mysqli_query($con,$insertData);

if($result){
    //echo "บันทึกข้อมูลเรียบร้อย<br>";
    header("Location: main.php");
}else{
    echo "ผิดพลาดในการบันทึกข้อมูล ".mysqli_error($con);
}
?>
