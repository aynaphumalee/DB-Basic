<?php
require 'connectdb.php';
session_start();
$user_profile = $_SESSION['login_id'];

$target_dir = "uploads/";
$RandomAccountNumber = uniqid();
$target_file = $target_dir .$RandomAccountNumber.basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "<script>alert('file is upload')</script>";
        $uploadOk = 1;
    } else {
        echo "<script>alert('File is not upload')</script>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "<script>alert('Sorry, file already exists')</script>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "<script>alert('Sorry, your file is too large')</script>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed')</script>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<script>alert('Sorry, your file was not uploaded');
    window.location.href='uploadfile.php';
    </script>";

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<script>alert('file has been uploaded')</script>";
        $query = "UPDATE tb_profile SET file_name = '$target_file' WHERE user_profile=$user_profile";
        $result = mysqli_query($con,$query);
        if($result) {
            header("Location: main.php");
        } else {
            echo "ผิดพลาดในการบันทึกข้อมูล ".mysqli_error($con);
        }
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.');
        window.location.href='uploadfile.php';</script>";
    }
}
?>