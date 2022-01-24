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
        $select="SELECT course_id,course_name FROM course_tb WHERE 1";
        $result=$con->query($select);

        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                echo "<tr><td>".$row["course_id"]."</td><td>".$row["course_name"]."</td></tr>";
            }
        }

        $con->close();
    ?>
    </table>
</div>
<hr>
<br>


<div>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']."?add=student_enroll"?>">
            <label for="courseid">Select Course: </label>
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
        </div>
        <button type="submit">Enroll</button>
    </form>
</div>
<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $total=0;
        echo "session".$_SESSION["userid"];
        $con=connect_to_database();
        if($con->connect_error){
            die("Connection failed");
        }
        $select="SELECT * FROM enroll_tb WHERE course_id='".$_POST["courseid"]."' AND student_id='".$_SESSION["userid"]."'";
        $result=$con->query($select);
        if($result->num_rows>0){
            echo "<p>Already registered</>";
        }
        else{
            echo "course".$_POST["courseid"]."<br>";
            echo $_SESSION["userid"]."<br>";

            $insert="INSERT INTO enroll_tb (course_id,student_id,price) VALUES ('".$_POST["courseid"]."','".$_SESSION["userid"]."','245')";
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
            echo "<input type='text' disabled value='".$total."'>$";
        }
        $con->close();
    }
?>
<hr>
<br>


<!--you need add enroll_tb in db -->


