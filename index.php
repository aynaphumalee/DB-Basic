<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="style.css?v=1" rel="stylesheet">
</head>

<body>
<div>
    <br>
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" required autofocus>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <br>
        <br><br>
        <input type="submit" value="เข้าสู่ระบบ">
        <button type="button" onclick="window.location.href='form_register.php'">ลงทะเบียน</button>
    </form>
</div>
</body>


</html>