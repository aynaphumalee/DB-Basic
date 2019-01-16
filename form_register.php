<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="style.css?v=1" rel="stylesheet">
</head>

<body>
<div>
    <br>
<h2>Register</h2>
<form action="register.php" method="POST">
    <label for="username">Username</label>
    <input type="text" name="username" required autofocus>
    <br>
    <label for="password">Password</label>
    <input type="password" name="password" required>
    <br>
    <label for="email">Email</label>
    <input type="email" name="email" placeholder="example@hotmail.com" required>
    <br><br>
    <input type="submit" value="ลงทะเบียน">
    <button type="button" onclick="window.location.href='index.php'">กลับหน้าหลัก</button>
</form>
</body>
</div>

</html>