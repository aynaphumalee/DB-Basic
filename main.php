<?php
require 'connectdb.php';
session_start();
$user_id = $_SESSION['login_id'];


$sql = "SELECT tb_profile.file_name
,tb_login.Username
,tb_massage.massage 
FROM tb_profile 
INNER JOIN tb_login 
  on tb_profile.user_profile=tb_login.UserId
INNER JOIN tb_massage
    on tb_login.UserId = tb_massage.user_id WHERE user_id=?";
$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt, "s", $user_id);
mysqli_stmt_execute($stmt);
$result_user = mysqli_stmt_get_result($stmt);


$sql = "SELECT tb_follow.user_foll
    ,tb_login.Username
    ,tb_massage.massage 
    ,tb_profile.file_name
FROM tb_follow
INNER JOIN tb_login 
    on tb_follow.user_foll = tb_login.UserId
INNER JOIN tb_massage
    on tb_follow.user_foll = tb_massage.user_id
INNER join tb_profile 
    on tb_follow.user_foll = tb_profile.user_profile
WHERE user_login=$user_id";
$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_execute($stmt);
$result_user2 = mysqli_stmt_get_result($stmt);

$sql = "SELECT file_name FROM tb_profile WHERE user_profile=?";
$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt, "s", $user_id);
mysqli_stmt_execute($stmt);
$result_user3 = mysqli_stmt_get_result($stmt);
$row3 = mysqli_fetch_array($result_user3);








?>

<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


     <style>
         body{
             background-image: linear-gradient(to right,pink,peachpuff);
         }
         h2{
             font-family: "TH Sarabun New";
             font-size: 30px;
             margin-left: 325px;
         }
         button[type=button] {
             font-family: "TH Sarabun New";
             font-size: 20px;
             font-weight: bold;
             width: 10%;
             height: 5%;
             margin-left: 1120px;
             border: 1px solid #ccc;
             border-radius: 4px;
             box-sizing: border-box;
         }
         button[type=button]:hover{
          background-color: aliceblue;
         }
         input[type=text]{
             font-family: "TH Sarabun New";
             font-size: 25px;
             width: 600px;
             height: 200px;
             border: 1px solid #ccc;
             border-radius: 5px;
             box-sizing: border-box;
             padding: 0 0 165px 5px;
             display: block;
         }
         div{
             width: 600px;
             height: 100px ;
             margin: auto;
         }
         input[type=submit]{
             font-family: "TH Sarabun New";
             font-size: 20px;
             font-weight: bold;
             width: 10%;
             height: 30%;
             margin-left: 540px;
             border: 1px solid #ccc;
             border-radius: 4px;
             box-sizing: border-box;
         }
         input[type=submit]:hover{
          background-color: aliceblue;
         }
         .div1{
             font-family: "TH Sarabun New";
             font-size: 25px;
             width: 600px;
             height: 200px;
             border: 1px solid #ccc;
             border-radius: 5px;
             box-sizing: border-box;
             padding: 0 0 165px 5px;
             margin: auto;
             background-color: white;
         }
         input[type=text1]{
             font-family: "TH Sarabun New";
             font-size: 23px;
             width: 500px;
             height: 35px;
             border: 1px solid #ccc;
             border-radius: 4px;
             padding: 0 0 0 5px;
         }
         button[type=button1] {
             font-family: "TH Sarabun New";
             font-size: 23px;
             font-weight: bold;
             width: 96px;
             height: 35px;
             border: 1px solid #ccc;
             border-radius: 4px;
             padding: 0 0 0 5px;
         }
         button[type=button1]:hover{
             background-color: aliceblue;
         }
         input[type=text1],button[type=button1]{
             display: inline-block;
             vertical-align: middle;
             margin: 0px 0px;
         }
         .div2{
             width: 600px;
             height: 40px;
             margin: auto;
         }
         button[type=button2] {
             font-family: "TH Sarabun New";
             font-size: 14px;
             font-weight: bold;
             width: 70px;
             height: 20px;
             border: 1px solid #ccc;
             border-radius: 4px;
             margin-left: 9px;
         }
         button[type=button2]:hover{
             background-color: aliceblue;
         }

         #circle {
             width: 70px;
             height: 70px;
             border-radius: 50%
         }

         .a1{
             font-family: "TH Sarabun New";
             font-size: 25px;
             color: black;
         }
         .a1:hover{
             color: pink;
             text-decoration: none;
         }




     </style>

     <body>
     <br>

     <div style="margin-left:1138px">
         <?php echo "<a href=\"myprofile.php?user_profile=$user_id\" ><img src=\" $row3[0] \" id=\"circle\" alt=\"avatar\" style=\"width: 90px; height: 90px\"></a><br></a>"; ?>

             <button type="button2" onclick="window.location.href='uploadfile.php'">แก้ไขโปรไฟล์</button>
             <input type="file" name="fileToUpload" id="fileToUpload" style="display: none">
     </div>

     <br>

     <button type="button" onclick="window.location.href='logout.php'">ออกจากระบบ</button>

     <div class="div2">
         <form action="main_2.php" method="post">
         <input type= "text1" name="user_follow" placeholder="ค้นหาเพื่อนที่ต้องการติดตาม">
         <button type="button1"">ติดตาม</button>
         </form>
     </div>

     <div>
     <form action="data.php" method="post">
         <br>
         <label for="Massage"></label>
         <input type="text" name="massage" placeholder="คุณกำลังคิดอะไรอยู่"> <br>
         <input type="submit" value="โพสต์">
     </form>
     </div>

     <br><br><br><br><br><br><br><br><br><br>



     <?php while ($row=mysqli_fetch_array($result_user)) {
         $image = $row['file_name'];
         echo '<div class="div1"><a href="myprofile.php?user_profile='.$user_id.'" ><img src="'.$image.'" id="circle" alt="avatar" style="width: 70px;"></a>';
         $post=$row['massage'];
         $post_2 = $row['Username'];
         echo "<a href=\"myprofile.php?user_profile=$user_id\" class='a1'>$post_2</a><br> $post"."<br><br>";
         $sql = "SELECT id FROM tb_massage WHERE massage=?";
         $stmt = mysqli_prepare($con,$sql);
         mysqli_stmt_bind_param($stmt, "s", $post);
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);
         $row4 = mysqli_fetch_array($result);
         //var_dump($row4);
         $massage_like = $row4['id'];
         echo "<a href='insertindb.php?massagelike=$massage_like' class='a1'><i class=\"glyphicon glyphicon-thumbs-up\" style='font-size: 18px'></i></a>";
        // echo "<a href='updateib.php?massageunlike=$massage_like' class='a1'><i class=\"glyphicon glyphicon-thumbs-down\" style='font-size: 18px'></i></a>";


         $sql2 = "SELECT like_action FROM tb_like WHERE massage_post=? and user_login=?";
         $stmt2 = mysqli_prepare($con,$sql2);
         mysqli_stmt_bind_param($stmt2, "ss", $massage_like,$user_id);
         mysqli_stmt_execute($stmt2);
         $result2 = mysqli_stmt_get_result($stmt2);
         $row5 = mysqli_fetch_array($result2);

         $sql3 = "SELECT count(*)FROM tb_like WHERE like_action=1 and massage_post=$massage_like";
         $stmt3 = mysqli_prepare($con,$sql3);
         mysqli_stmt_execute($stmt3);
         $result3 = mysqli_stmt_get_result($stmt3);
         $row6 = mysqli_fetch_array($result3);

         //var_dump($row6['count(*)']);

         if($row5[0]==1){
             //  echo "<i class=\"glyphicon glyphicon-thumbs-up\" style='font-size: 18px'></i>";
             echo " like $row6[0]</div>"."<br>";
         }else{
             echo "<br><br><br>";
         }
     }

     ?>

     <?php while ($row2=mysqli_fetch_array($result_user2)) {
         $image = $row2['file_name'];
         $user_profile2 = $row2['user_foll'];
         echo '<div class="div1"><a href="myprofile.php?user_profile=' . $user_profile2 . '" ><img src="' . $image . '" id="circle" alt="avatar" style="width: 70px;"></a>';
         $post = $row2['massage'];
         $post_2 = $row2['Username'];
         echo "<a href='myprofile.php?user_profile=$user_profile2' class='a1'>$post_2</a><br> $post" . "<br><br>";

         $sql = "SELECT id FROM tb_massage WHERE massage=?";
         $stmt = mysqli_prepare($con,$sql);
         mysqli_stmt_bind_param($stmt, "s", $post);
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);
         $row4 = mysqli_fetch_array($result);
         //var_dump($row4);
         $massage_like = $row4['id'];
         echo "<a href='insertindb.php?massagelike=$massage_like' class='a1'><i class=\"glyphicon glyphicon-thumbs-up\" style='font-size: 18px'></i></a>";


         $sql2 = "SELECT like_action FROM tb_like WHERE massage_post=? and user_login=?";
         $stmt2 = mysqli_prepare($con,$sql2);
         mysqli_stmt_bind_param($stmt2, "ss", $massage_like,$user_id);
         mysqli_stmt_execute($stmt2);
         $result2 = mysqli_stmt_get_result($stmt2);
         $row5 = mysqli_fetch_array($result2);

         $sql3 = "SELECT count(*)FROM tb_like WHERE like_action=1 and massage_post=$massage_like";
         $stmt3 = mysqli_prepare($con,$sql3);
         mysqli_stmt_execute($stmt3);
         $result3 = mysqli_stmt_get_result($stmt3);
         $row6 = mysqli_fetch_array($result3);

         //var_dump($row6['count(*)']);

         if($row5[0]==1){
           //  echo "<i class=\"glyphicon glyphicon-thumbs-up\" style='font-size: 18px'></i>";
             echo " like $row6[0]</div>"."<br>";
             //echo " <a href='updateib.php?massageunlike=$massage_like' class='a1'><i class=\"glyphicon glyphicon-thumbs-down\" style='font-size: 18px'></i></a></div>"."<br>";

         }else{
             echo "<br><br><br>";
         }
     }
     ?>

     <br>

     </body>
</html>




