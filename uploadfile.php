<html>
<style>
    body{
        background-image: linear-gradient(to right,pink,peachpuff);
    }
div{
    width: 200px;
    height: 100px;
    display: block;
    margin: auto;
}



</style>

<body>
<br><br><br><br>

<div>
<form action="uploadfile2.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
    <input type="submit" value="Upload Image" name="submit">
</form>
</div>

</body>
</html>