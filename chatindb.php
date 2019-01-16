<?php
 require 'connectdb.php';

 session_start();
 $user_login = $_SESSION['login_id'];
 $user_chat = $_SESSION['user_chat'];
 $massage = mysqli_real_escape_string($con,$_POST['massage']);

 $query = "INSERT INTO tb_chatmassenger(user_login,user_chat,chatmassage,time) VALUE ('$user_login','$user_chat','$massage',now())";
 $result = mysqli_query($con,$query);

if($result){
    //echo "บันทึกข้อมูลเรียบร้อย<br>";
    header("Location: myprofile.php?user_profile=$user_chat");
}else{
    echo "ผิดพลาดในการบันทึกข้อมูล ".mysqli_error($con);
}
?>



