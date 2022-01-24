<!--you need add td elements in db teacher -->

<div>
    <br>
    <h3>Available Teachers</h3>
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
<br>
<hr>
<br>
<div>
    <h3>Existing Classes</h3>
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
<br>
<hr>
<br>


<div style="padding:20px;display:flex;flex-direction:column;align-items:center;">
    <h3>Create new course</h3><br>
    <form style="width:400px;" method="POST" action="<?php echo $_SERVER['PHP_SELF']."?add=edit_course_admin"?>">
        <div>
            <label for="coursename">Course Name:</label>
            <input type="text" name="coursename" required>
        </div><br>
        <div>
            <label for="min">Minimum Number:</label>
            <input type="number" name="min" required min=0>
        </div><br>
        <div>
            <label for="max">Maximum Number:</label>
            <input type="number" name="max" required min=0>
        </div><br>
        <div>
            <label for="teacherid">Teacher ID:</label>
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
        </div><br>
        <div>
            <label for="price">Price:</label>
            <input type="text" name="price" required>
        </div><br>
        <div style="text-align: center;">
            <button type="submit"
            style="border:none;
            outline:none;
            padding:5px 10px;
            background-color:grey;
            width:150px;"
            
            >Set</button>
        </div>
    </form>
</div>
<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $con=connect_to_database();
        if($con->connect_error){
            die("Connection failed");
        }
        $insert="INSERT INTO course_tb (course_name,min_cap,max_cap,teacher_id,price) VALUES ('".$_POST["coursename"]."','".$_POST["min"]."','".$_POST["max"]."','".$_POST["teacherid"]."','".$_POST["price"]."')";
        $result=$con->query($insert);
        echo "<p style='text-align:center; color:red;'>Class: ".$_POST["coursename"]." is set</P>";
        $con->close();
    }
?>


