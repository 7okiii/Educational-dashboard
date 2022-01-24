<!--you need add td elements in db teacher -->

<div>
    <table>
        <tr><td>Teacher ID</td><td>First Name</td><td>Last Name</td><td>Profile Picture</td></tr>
    <?php
        $con=connect_to_database();
        if($con->connect_error){
            die("Connection failed");
        }
        $select="SELECT user_id,fname,lname,profile_pic FROM users_tb WHERE user_type='teacher'";
        $result=$con->query($select);

        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                echo "<tr><td>".$row["user_id"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>";
                if(!empty($row["profile_pic"])){
                    echo "<img style='width:30px;height:30px;' src='".$row["profile_pic"]."'>";
                }
                echo "</td></tr>";
            }
        }

        $con->close();
    ?>
    </table>
</div>
<hr>
<br>


<div>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']."?add=edit_course_admin"?>">
        <div>
            <label for="coursename">Course Name</label>
            <input type="text" name="coursename" required>
        </div>
        <div>
            <label for="min">Minimum Number</label>
            <input type="text" name="min" required>
        </div>
        <div>
            <label for="max">Maximum Number</label>
            <input type="text" name="max" required>
        </div>
        <div>
            <label for="teacherid">Teacher ID</label>
            <select name="teacherid" id="teacherid">
                <?php
                    $con=connect_to_database();
                    if($con->connect_error){
                        die("Connection failed");
                    }
                    $select="SELECT user_id FROM users_tb WHERE user_type='teacher'";
                    $result=$con->query($select);
                    if($result->num_rows>0){
                        echo "<option selected></option>";
                        while($row=$result->fetch_assoc()){
                            echo "<option>".$row["user_id"]."</option>";
                        }
                    }
                    $con->close();
                ?>
            </select>
        </div>
        <button type="submit">Set</button>
    </form>
</div>
<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $con=connect_to_database();
        if($con->connect_error){
            die("Connection failed");
        }
        $insert="INSERT INTO course_tb (course_name,min_cap,max_cap,teacher_id) VALUES ('".$_POST["coursename"]."','".$_POST["min"]."','".$_POST["max"]."','".$_POST["teacherid"]."')";
        $result=$con->query($insert);
        echo "<p>".$_POST["coursename"]." is set</P>";
        $con->close();
    }
?>

