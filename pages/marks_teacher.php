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
  <title>marks_teacher</title>
</head>
<body>
  <div class= "mark">
  <h3>Mark page</h3>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']."?add=marks_teacher"?>"class="mark-header">
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
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']."?add=marks_teacher"?>">
        <?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['chose']) {
            try {
              $dbConn = connect_to_database();
              $select_cmd = "SELECT * FROM enroll_tb INNER JOIN users_tb ON enroll_tb.student_id = users_tb.user_id  WHERE enroll_tb.student_id ='".$_POST['stuId']."' AND enroll_tb.course_id ='".$_POST['course']."'";
              // $select_cmd = "SELECT * FROM enroll_tb WHERE student_id =".$_POST['stuId']." course_id =".$_POST['course']."'";
              $result = $dbConn->query($select_cmd);
              if ($dbConn->connect_error) {
                throw new Exception('Connection error');
              } else {
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr><th>Student Name</th><th>Student ID</th><th>Course ID</th><th>Teacher ID</th><th>Mark</th><th>Comment</th></tr>";
                    echo "<tr style='text-align:center;'><td>".$row['fname'].' '.$row['lname']."</td><td><input value='".$row['student_id']."' name='stu_id'></td><td><input value='".$row['course_id']."' name='course_id'></td><td><input value='".$row['teacher_id']."' name='teacher_id'></td><td><input value='".$row['mark']."' name='mark'></td><td><input name='comment' value='".$row['comment']."'></td></tr>";
                    echo "</table>";
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
      <div class="save">
        <input type="submit" value="save" name="save"></input>
        </div>
      </form>
       
    </table>
    </div>

    <?php
      if ($_GET['add'] == 'marks_teacher') {
        try {
          $dbConn = connect_to_database();
          $select_cmd = "SELECT * FROM enroll_tb INNER JOIN users_tb ON users_tb.user_id = enroll_tb.teacher_id";
          $result = $dbConn->query($select_cmd);
          if ($dbConn->connect_error) {
            throw new Exception('Connection error');
          } else {
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<table><tr><th>Student ID</th><th>Course ID</th></tr>";
                echo "<tr><td>".$row['student_id']."</td><td>".$row['course_id']."</td></tr>";
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
            echo "error";
          } else {
            $select_cmd = "SELECT student_id FROM marks_tb WHERE student_id='".$_POST['stu_id']."'";
            $result = $dbConn->query($select_cmd);
            if ($result->num_rows > 0) {
              echo "bb";
            } else {
              $insert_cmd = "INSERT INTO marks_tb (student_id,teacher_id,course_id,mark,comment) values('".$_POST['stu_id']."','".$_POST['teacher_id']."','".$_POST['course_id']."','".$_POST['mark']."','".$_POST['comment']."');";
              // ★★
              if ($dbConn->query($insert_cmd) === true) {
                // echo "aa";
              } else {
                echo "study more stupid";
              }
            }
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
  







