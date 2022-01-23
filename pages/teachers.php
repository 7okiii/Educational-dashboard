<?php
  include('../config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    table, th, td {
      border:1px solid black;
    } 
  </style>
  <title>Teachers</title>
</head>
<body>
  <h3>Mark page</h3>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
      <label for="course">Course:</label><br>
      <input type="text" id="course" name="course"><br>
      <button type="submit">Submit</button>
    </form>
    <table style="width:100%">
      <tr>
        <th>Student name</th>
        <th>Marks</th>
        <th>Comments</th>
      </tr>
      <?php
        // ★ couldn't connect to mark_tb so tried to make with another database and change the code later
        // this is just showing data in the table. ★ will add a function to edit the score and comment
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          try {
            $dbConn = connect_to_database();
            $select_cmd = "SELECT * FROM users_tb WHERE user_type ='".$_POST['course']."'";
            $result = $dbConn->query($select_cmd);
            if ($dbConn->connect_error) {
              throw new Exception('Connection error');
            } else {
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr style='text-align:center;'><td>".$row['fname']."</td><td>".$row['gender']."</td><td>".$row['country']."</td></tr>";
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
    </table>
</body>
</html>  
  







