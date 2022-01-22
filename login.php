<?php
    include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylesheet/reset.css">
    <style>
        <?php
            include('./stylesheet/login.css');
        ?>
    </style>
    <title>Login page</title>
</head>
<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
        <label for="username">Username</label>
        <input type="text" name="username" required>
        <label for="pass">Password</label>
        <input type="password" name="pass" required>
        <button type="submit">Login</button>
    </form>  
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $dbCon = new mysqli($dbsvname,$dbusername,$dbpassword,$db_table);
        if ($dbCon->connect_error) {
            echo "<p style='color:red;'>Connection error</p>";
        } else {
            echo "<p style='color:green;'>Connected to the database</p>";
            // take the data from database and check the type of users
            $fname = $_POST['username'];
            $select_cmd = "SELECT user_type FROM users_tb WHERE fname='".$fname."'";
            $result = $dbCon->query($select_cmd);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $userType = $row['user_type'];
                    if ($userType == 'admin') {
                        echo "admin";
                    } elseif ($userType == 'teacher') {
                        echo "teacher";
                    } else {
                        echo "student";
                    }
                }    
            } else {
                echo "<p style='color:red;'>Username or password is wrong</p>";
            }
        }
    }
?>
</body>
</html>