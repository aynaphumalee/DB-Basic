<?php

  require 'connectdb.php';

  $user_follow = $_POST['user_follow'];
  session_start();
  $user_login = $_SESSION['login_id'];

  $sql = "SELECT UserId FROM tb_login WHERE Username=? ";
  $stmt = mysqli_prepare($con,$sql);
  mysqli_stmt_bind_param($stmt, "s", $user_follow);
  mysqli_stmt_execute($stmt);
  $result_user = mysqli_stmt_get_result($stmt);
  $row= mysqli_fetch_array($result_user);

  $query = "INSERT INTO tb_follow(user_login,user_foll) VALUE ('$user_login','$row[0]')";
  $result = mysqli_query($con,$query);

  header("Location: main.php");



