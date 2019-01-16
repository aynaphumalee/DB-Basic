<?php
//$result = array(
  //  "status" =>true,
    //"message" =>"your message has been send"
//);
//header("Content-Type: application/json; charset=UTF-8");
//echo json_encode($result);

?>

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

echo "<a href='insertindb.php?massagelike=$massage_like' class='like'><i class=\"glyphicon glyphicon-thumbs-up\" style='font-size: 18px'></i></a>";


//var_dump($row6['count(*)']);

if($row5[0]==1){
//  echo "<i class=\"glyphicon glyphicon-thumbs-up\" style='font-size: 18px'></i>";
echo " like $row6[0]</div>"."<br>";
}else{
echo "<br><br><br>";
}