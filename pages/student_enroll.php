<!--you need add enroll_tb in db -->
<div>
    <h3>Classes</h3>
    <table>
        <tr><td>Course ID</td><td>Course Name</td><td>Price</td></tr>
    <?php
        $con=connect_to_database();
        if($con->connect_error){
            die("Connection failed");
        }
        $select="SELECT course_id,course_name,price FROM course_tb WHERE 1";
        $result=$con->query($select);

        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                echo "<tr><td>".$row["course_id"]."</td><td>".$row["course_name"]."</td><td>".$row["price"]."</td></tr>";
            }
        }
        $con->close();
    ?>
    </table>
</div>
<hr>
<br>


<div style="text-align:center;">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']."?add=student_enroll"?>">
            <label for="courseid"
            style="margin-right:20px;"
            >Select Course: </label>
            <select name="courseid" id="courseid" required>
                <?php
                    $con=connect_to_database();
                    if($con->connect_error){
                        die("Connection failed");
                    }
                    $select="SELECT course_id,course_name  FROM course_tb WHERE 1";
                    $result=$con->query($select);
                    if($result->num_rows>0){
                        echo "<option selected></option>";
                        while($row=$result->fetch_assoc()){
                            echo "<option value='".$row["course_id"]."'>".$row["course_id"]." : ".$row["course_name"]."</option>";
                        }
                    }
                    $con->close();
                ?>
            </select>
        <button type="submit"
        style="border:none;outline:none;background-color:grey; padding:5px 10px;margin-left:20px;"
        >Enroll</button>
    </form>
</div>
<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $total=0;
        $con=connect_to_database();
        if($con->connect_error){
            die("Connection failed");
        }
        $select="SELECT * FROM enroll_tb WHERE course_id='".$_POST["courseid"]."' AND student_id='".$_SESSION["userid"]."'";
        $result=$con->query($select);
        if($result->num_rows>0){
            echo "<p style='text-align:center;'>Already registered</p>";
        }
        else{
            $select="SELECT * FROM course_tb WHERE course_id='".$_POST["courseid"]."'";
            $result=$con->query($select);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    $price=$row["price"];
                    $teacherId=$row['teacher_id'];
                }
            }
            $insert="INSERT INTO enroll_tb (course_id,teacher_id,student_id,price) VALUES ('".$_POST["courseid"]."','".$teacherId."','".$_SESSION["userid"]."','".$price."')";
            $result=$con->query($insert);
        }
        $select="SELECT * FROM enroll_tb WHERE student_id='".$_SESSION["userid"]."'";
        $result=$con->query($select);
        if($result->num_rows>0){
            echo "<table><tr><td>Course ID</td><td>Price</td></tr>";
            while($row=$result->fetch_assoc()){
                echo "<tr><td>".$row["course_id"]."</td><td>".$row["price"]."</td></tr>";
                $total+=intval($row["price"]);
            }
            echo "</table>";
            echo "<br><hr><div style='width:100%; text-align:center;'>Total:  <input type='text' disabled value='".$total."'><span>$</span></div>";
        }
        $con->close();
    }
?>
<hr>
<br>


<!--you need add enroll_tb in db -->


