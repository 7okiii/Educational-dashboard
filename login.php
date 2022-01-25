<?php
    include('config.php');
    session_start();

    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(isset($_SESSION["userid"])){
            if(isset($_SESSION["logout"])){
                session_unset();
                session_destroy();
            }
            else{
                 header("location:dashboard2.php");
            }   
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./stylesheet/reset.css"> -->
    <style>
        <?php
            include('./stylesheet/login.css');
        ?>
    </style>
    <title>Login page</title>
</head>
<body>
    
<header>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" class="main-header">
        <h1>Login</h1>
        <h3>Welcome to Education </h3>
        <p><input type="text" placeholder="UserId" name="userId"></p>
        <p><input type="password" placeholder="Password" name="pass"></p>
        <p><button>Continue</button></p>
    </form>
</header>
    
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_id = $_POST['userId'];
        $pass = $_POST['pass'];
        //connect with database 
        $dbCon = new mysqli("localhost","root","","education");
        $select_cmd = "SELECT salt FROM users_tb WHERE user_id ='".$user_id."'";
        $result = $dbCon->query($select_cmd);
        if ($dbCon->connect_error) {
            echo "<p style='color:red;'>Connection error</p>";
        } else {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $salt = $row['salt'];
                }       
                $tmpPass = md5($pass.$salt);
                echo $tmpPass;// working
                $select_cmd = "SELECT * FROM users_tb WHERE user_id='".$user_id."' AND password='".$tmpPass."'";
                $result = $dbCon->query($select_cmd);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $userid=$row["user_id"];
                        echo $row['fname']." is logged in";
                        $userType = $row['user_type'];
                    }
                    $_SESSION["userid"]=$userid;
                    if ($userType == 'admin') {
                        $_SESSION['name'] = 0;
                    } elseif ($userType == 'teacher') {
                        $_SESSION['name'] = 1;
                    } else {
                        $_SESSION['name'] = 2;
                    }
                }
                    header("Location: dashboard.php");
                    exit();
            }
            else{
                echo "<p style='color:red;'>User ID or password is wrong</p>";
            }
        }
    }
   
?>
</body>
</html>
