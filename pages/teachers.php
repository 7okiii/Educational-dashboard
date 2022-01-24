<?php
  include('../config.php');
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    table, th, td {
      border:1px solid black;
      text-align: center;
    } 
    td {
      height: 50px;
    }
    input {
      width: 100%;
      height: 100%;
      text-align: center;
    }
    textarea {
      display: flex;
      align-items: center;
      width: 100%;
      height: 100%;
      text-align: center;
    } */
  </style>
  <title>Teachers</title>
</head>
<body>
  <h3>Mark page</h3>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']."?add=teachers"?>">
      <input type="submit" value="See all the students" name="show"></input><br>
      <label for="stuId">Student ID:</label><br>
      <input type="text" id="course" name="stuId"><br>
      <label for="fname">Course ID</label><br>
      <input type="text" name="course"><br>
      <input type="submit" value="Chose the selected student" name="chose"></input><br>
      <!-- <input type="submit" value="See all the students" name="show"></input> -->
    </form>
    <table style="width:100%">
      <!-- <tr>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Marks</th>
        <th>Comments</th>
      </tr> -->
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']."?add=teachers"?>">
        <?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['chose']) {
            try {
              $dbConn = connect_to_database();
              $select_cmd = "SELECT * FROM marks_tb INNER JOIN users_tb ON users_tb.user_id = marks_tb.student_id WHERE marks_tb.student_id =".$_POST['stuId']." AND marks_tb.course_id =".$_POST['course'];
              $result = $dbConn->query($select_cmd);
              if ($dbConn->connect_error) {
                throw new Exception('Connection error');
              } else {
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr><th>Student Name</th><th>Student ID</th><th>Course ID</th><th>Marks</th><th>Comment</th></tr>";
                    echo "<tr style='text-align:center;'><td><input value='".$row['student_id']."' name='stu_id'></td><td><input value='".$row['fname']."_".$row['lname']."'></td><td><input value='".$row['mark']."' name='mark'></td><td><textarea name='comment'>".$row['comment']."</textarea></td></tr>";
                    // echo "</table>";
                  }
                } else {
                  echo "<p style='color:red;'>Something went wrong</p>";
                }
              }
              $dbConn->close();  
            } catch (Exception $ex) {
              echo $ex->getMessage();
            }
          }
        ?>
        <input type="submit" value="save" name="save">Save changes</input>
      </form>
    </table>
    <?php
      if ($_GET['add'] == 'teachers') {
        try {
          $dbConn = connect_to_database();
          $select_cmd = "SELECT * FROM marks_tb INNER JOIN users_tb ON users_tb.user_id = marks_tb.student_id";
          $result = $dbConn->query($select_cmd);
          if ($dbConn->connect_error) {
            throw new Exception('Connection error');
          } else {
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<table><tr><th>Student Name</th><th>Student ID</th><th>Course ID</th><th>Marks</th><th>Comment</th></tr>";
                echo "<tr><td>".$row['fname'].$row['lname']."</td><td>".$row['student_id']."</td><td>".$row['course_id']."</td><td>".$row['mark']."</td><td>".$row['comment']."</td></tr>";
                echo "</table>";
              }
            } else {
              echo "<p style='color:red;'>No data</p>";
            }
          }
          $dbConn->close();  
        } catch (Exception $ex) {
          echo $ex->getMessage();
        }
      }

      if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['save']) {
        try {
          $dbConn = connect_to_database();
          if ($dbConn->connect_error) {
            throw new Exception('Connection error');
          } else {
            $update_cmd = "UPDATE marks_tb SET mark='".$_POST['mark']."' WHERE student_id='".$_POST['stu_id']."'";
            $update_cmd2 = "UPDATE marks_tb SET comment='".$_POST['comment']."' WHERE student_id='".$_POST['stu_id']."'";
            if ($dbConn->query($update_cmd) && $dbConn->query($update_cmd2)) {
              echo "<p style='color:green;'>Successfully saved</p>";
            } else {
              echo "<p style='color:red;'>Something went wrong</p>";
            }
          }
          $dbConn->close();  
        } catch (Exception $ex) {
          echo $ex->getMessage();
        }

      }
    ?>
</body>
</html>  
  







