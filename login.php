<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylesheet/reset.css">
    <link rel="stylesheet" href="./stylesheet/login.css">
    <title>Login page</title>
</head>
<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
        <label for="username">Username</label>
        <input type="text" name="usrname" required>
        <form for="pass">Password</form>
        <input type="password" name="pass" required>
        <button type="submit">Login</button>
    </form>  
</body>
</html>