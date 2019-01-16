<?php
  require 'connectdb.php';

  session_start();
  $user_id = $_SESSION['login_id'];
  $user_profile = $_GET["user_profile"];

  $_SESSION['user_chat'] = $user_profile;

$sql = "SELECT tb_login.Username,tb_profile.file_name
FROM tb_login 
INNER JOIN tb_profile 
  on tb_profile.user_profile=tb_login.UserId
 WHERE user_profile=?";
$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt, "s", $user_profile);
mysqli_stmt_execute($stmt);
$result_user = mysqli_stmt_get_result($stmt);

$sql = "SELECT tb_massage.massage
FROM tb_massage
 WHERE user_id=?";
$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt, "s", $user_profile);
mysqli_stmt_execute($stmt);
$result_user2 = mysqli_stmt_get_result($stmt);


$sql = "SELECT chatmassage,user_login FROM tb_chatmassenger WHERE (user_login=$user_id or user_login=$user_profile) and (user_chat=$user_id or user_chat=$user_profile) order by time  ";
$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);



?>

<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    body{
        background-image: linear-gradient(to right,pink,peachpuff);
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
    .div2{
        font-family: "TH Sarabun New";
        font-size: 50px;
        font-weight: bold;
        margin-left: 585px;
    }
    #circle {
        width: 70px;
        height: 70px;
        border-radius: 50%
    }
    button[type=button] {
        font-family: "TH Sarabun New";
        font-size: 23px;
        font-weight: bold;
        width: 134px;
        height: 35px;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 3px 0 0 0px;
        margin-left: 797px;
    }
    button[type=button]:hover{
        background-color: aliceblue;
    }
</style>


<body>
<br><br><br>


<?php $row=mysqli_fetch_array($result_user);
    $image = $row['file_name'];
    $post_2 = $row['Username'];
    echo '<div style="margin-left: 550px; font-family: \'TH Sarabun New\'; font-size: 30px"><img src="'.$image.'" id="circle" alt="avatar" style="width: 150px; height: 150px"></div>';
    echo "<div class='div2'>$post_2</div>";
    ?>



<?php if($user_id!=$user_profile){
    echo "<button type=\"button\" onclick=\"openForm()\">ส่งข้อความ  <i class=\"fa fa-comment-o\" style=\"font-size:20px\"></i></button>
";
}
?>


<br><br>

 <?php while ($row2=mysqli_fetch_array($result_user2)) {
     if($row2['massage'] != null){
         $post=$row2['massage'];
         echo "<div class=\"div1\">$post</div >"."<br>";
     }
    }
    ?>

    <style>
        body {
            font-family: "TH Sarabun New";
            font-size: 20px;
        }
        h1{
            font-family: "TH Sarabun New";
            font-size: 25px;
            margin-top: -32px;;
            margin-left: 7px;
        }

        /* The popup chat - hidden by default */
        .chat-popup {
            width: 340px;
            height: 360px;
            display: none;
            position: fixed;
            bottom: 0px;
            right: 100px;
            border: 1px solid #f1f1f1;
            z-index: 9;
            background-color: white;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
        }

        /* Full-width textarea */
         input {
            width: 251px;
             height: 40px; ;
            padding: 15px;
            margin: 0px 0 22px 5px;
            border: none;
            background: #f1f1f1;
            resize: none;
            border-radius: 20px;
        }
         .inp{
             width: 300px;
             height: 40px; ;
             padding: 15px;
             margin: 0px 0 22px 5px;
             border: none;
             background: #f1f1f1;
             resize: none;
             border-radius: 20px;
             font-family: "TH Sarabun New";
             font-size: 20px;
         }

        /* When the textarea gets focus, do something */
        input:focus {
            background-color: #ddd;
            outline: none;
        }

        button[type=submit]{

        }

        a,a:visited{
            color: dimgrey;
        }

        button[type=button1]{
            background-color: whitesmoke;
            font-size: 20px;
            cursor: pointer;
            position: absolute;
            border: 1px solid whitesmoke ;
            margin-left: 299px;
        }
        .time{
            width: 325px;
            height: 27px;
            border: 1px whitesmoke ;
            border-bottom: 1px solid whitesmoke;
            background-color: white;
        }
        button[type=button2]{
            border: none;
            background-color: white;
        }
        button[type=button2]:hover{
            color: dimgrey;
        }
        .frame {
            width: 260px;
            height: 5px;;
            padding: 5px 0 22px 10px;
            margin-left: 50px;
            border: none;
            background: linear-gradient(to right,pink,peachpuff);;
            resize: none;
            border-radius: 20px;
        }
        .frame2 {
            width: 260px;
            height: 5px;;
            padding: 5px 0 22px 10px;
            margin-left: 10px;
            border: none;
            background: #f1f1f1;
            resize: none;
            border-radius: 20px;
        }
        .frm{
            width: 340px;
            height: 250px;
            overflow: auto;
        }
    </style>

<div class="chat-popup" id="myForm">
    <div class="time"><button type="button1" onclick="closeForm()">&times;</button></div>
    <h1><?php echo $row['Username'];?></h1>
    <div class="frm"><?php while ($row3=mysqli_fetch_array($result)) {
            if($row3['user_login']==$user_id){
                echo "<div class='frame'>".$row3['chatmassage']."</div>"."<br>";
            }else{
                echo "<div class='frame2'>".$row3['chatmassage']."</div>"."<br>";
            }
    }
    ?>
    </div>

    <form action="chatindb.php" class="form-container" method="post">

       <?php if($user_id==$user_profile){
           echo "<input class='inp' placeholder='ไม่สามารถส่งข้อความถึงตัวเองได้  กรุณากดปุ่มปิด'>";
       } else{
           echo "  <input  name=\"massage\" autofocus>";
           echo "<button type=\"button2\"><i class=\"fa fa-send-o\" style=\"font-size:27px\"></i></button>";
       }?>

    </form>

</div>

<script>
    console.log(openForm())
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";

    }
</script>


</body>
</html>



