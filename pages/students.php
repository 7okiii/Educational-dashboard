<?php
    include('../config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            width: 200px;
            margin-bottom: 10px;
        }
        button {
            width: 208px;
        }
    </style>
</head>
<body>
<div>
    <h2>Your grade and comment form teacher</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']."?add=students"?>">
            <h3>Enter your information here</h3>
            <label for="stuId">Student ID</label>
            <input type="text" name="stuId">
            <label for="course">Course ID</label>
            <input type="text" name="course">
            <button type="submit">Chose</button>
        </form>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mark</th>
                <th>Comment</th>
            </tr>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $dbConn = connect_to_database();
                        $select_cmd = "SELECT * FROM marks_tb INNER JOIN users_tb ON users_tb.user_id = marks_tb.student_id WHERE marks_tb.student_id =".$_POST['stuId']." AND marks_tb.course_id =".$_POST['course'];
                        $result = $dbConn->query($select_cmd);
                    if ($dbConn->connect_error) {
                        echo "error";
                    } else {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>".$row['fname']."</td><td>".$row['lname']."</td><td>".$row['mark']."</td><td>".$row['comment']."</td></tr>";
                            }
                        } else {
                            echo "<p style='color:red;'>Student ID or Course ID is wrong</p>";
                        }
                    }
                }
            ?>
        </table>
    </div>
  
</body>
</html>
