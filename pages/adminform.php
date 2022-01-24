<?php
include "./config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <!-- <link rel="stylesheet" href="./stylesheet/register_yuya.css"> -->
    <link rel="stylesheet" href="./stylesheet/style_dashboard.css">

    <!-----===== Boxicons CSS =====----->
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="./js/script_dashboard"></script>

    <title>Dashboard</title>
</head>

<body>

<!--------------------------------------FIRST FORM---------------------------------------------->
    <section class="d-flex justify-content-center">
        <div class="card col-sm-6 p-3">
            <div class="mb-3 text-center">
                <h1>General Information</h1>
            </div>
            <div class="mb-2">
                <form method="POST" id="registe_form" action="<?php echo $_SERVER["PHP_SELF"]."?add=register_yuya"?>" enctype="multipart/form-data">
                <div class="mb-2">
                    <label for="User_id">User ID</label>
                        <input type="text" class="form-control" name="User_id" id="User_id">
                    </div>
                    <div class="mb-2">
                        <label for="FName">First Name</label>
                        <input type="text" class="form-control" name="FName" id="FName">
                    </div>
                    <div class="mb-2">
                    <label for="LName">Last Name</label>
                        <input type="text" class="form-control" name="LName" id="LName">
                    </div>
                    <div class="mb-2">
                    <label for="Email">Email</label>
                        <input type="text" class="form-control" name="Email" id="Email">
                    </div>
                    <div class="mb-2">
                    <label for="Email">Password</label>
                        <input type="password" class="form-control" name="Password" id="Password" required>
                    </div>
                    <div class="mb-2">
                        <bottom onclick="page_handling(this,1)" class="btn btn-primary">Next</bottom>
                    </div>
                </form>
            </div>
        </div>
    </section>
<!-----------------------------------SECOND FORM--------------------------------------------->
    <section class="d-flex justify-content-center">
        <div class="card col-sm-6 p-3">
            <div class="mb-3 text-center">
                <h1>General Information</h1>
            </div>
            <div class="mb-2">
                <form action="">
                <div class="mb-2">
                    <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" id="floatingdob">
                    </div>
                    <div class="mb-2">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="FName">
                    </div>
                    <div class="mb-2">
                    <label for="position">Position</label>
                        <input type="text" class="form-control" name="position" id="position">
                    </div>
                    <div class="mb-2">
                    <label for="user_type">User type</label>
                    <select id="floatingSelect1" name="usertype" class="form-control" required>
                                <option selected></option>
                                <option value="admin">Admin</option>
                                <option value="teacher">Teacher</option>
                                <option value="student">Student</option>
                            </select>
                    </div>
                    <div class="mb-2">
                        <bottom class="btn btn-primary">Previous</bottom>
                        <bottom class="btn btn-primary">Next</bottom>
                    </div>
                </form>
            </div>
        </div>
    </section>
<!--------------------------------------THIRD FORM-------------------------------------------->
    <section class="d-flex justify-content-center">
        <div class="card col-sm-6 p-3">
            <div class="mb-3 text-center">
                <h1>Optional Information</h1>
            </div>
            <div class="mb-2">
                <form action="">
                <div class="mb-2">
                    <label for="gender">Gender</label>
                    <select class="form-select" name="gender" id="SelectGender">
                                <option selected></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="deny2">Prefer not to say</option>
                            </select>
                    </div>
                    <div class="mb-2">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" name="country" id="country">
                    </div>
                    <div class="mb-2">
                        <label for="profilepic">Profile picture</label>
                        <input type="file" style="width:280px;" class="form-control" name="profilepic" id="profilepic">
                    </div>
                    <div class="mb-2">
                    <label for="vaccine">Vaccinated</label><br>
                            <select class="form-select" name="vaccine" id="vaccine">
                                <option selected></option>
                                <option value="full">Full vaccinated</option>
                                <option value="one">One dose</option>
                                <option value="deny">Prefer not to say</option>
                            </select>
                    </div>
                    <div class="mb-2">
                        <bottom class="btn btn-primary">Previous</bottom>
                        <bottom class="btn btn-primary">Review</bottom>
                        <bottom class="btn btn-primary">Submit</bottom>
                    </div>
                </form>
            </div>
        </div>
    </section>

<!-----------------------------------------PHP SECTION------------------------------------------------->
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            try{
                if(!empty($_POST["usetid"]) && !empty($_POST["fname"]) && !empty($_POST["lname"]) && !empty($_POST["email"]) && !empty($_POST["pass"]) && !empty($_POST["dob"]) && !empty($_POST["position"]) && !empty($_POST["usertype"]) && !empty($_POST["address"])){
                    $con=connect_to_database();
                    if($con->connect_error){
                        throw new Exception("Connection failed",0);
                    }
                    $selectcmd="SELECT * FROM users_tb where email='".$_POST["email"]."' OR user_id='".$_POST["usetid"]."'";
                    $result=$con->query($selectcmd);
                    if($result->num_rows>0){
                        echo "<p>Already exist username or user id</p>";
                    }
                    else{
                        //need to change
                        if(isset($_FILES["pics"]["name"])){
                            $dir="./profile_pictures/".basename($_FILES["pics"]["name"]);
                            upload_pics($_FILES["pics"]["tmp_name"],$dir);
                        }
                       

                        $salt=random_number();
                        $tmp=md5($_POST["pass"].$salt);
                        $insert=$con->prepare("INSERT INTO users_tb (user_id,email,password,fname,lname,dob,profile_pic,vaccine,gender,address,country,position,salt,user_type) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                        $insert->bind_param("isssssssssssss",$_POST["usetid"],$_POST["email"],$tmp,$_POST["fname"],$_POST["lname"],$_POST["dob"],$dir,$_POST["vaccine"],$_POST["gender"],$_POST["address"],$_POST["country"],$_POST["position"],$salt,$_POST["usertype"]);
                        $insert->execute();
                        echo "done";

                        $insert->close();
                        $con->close();
                        
                    }

                }
                else{
                    echo "<p>Please fill out General Information</p>";
                }
            }catch(Exception $ex){
                echo "Error code: ".$ex->getCode()."<br>".$ex->getMessage();
            } 
        }
    ?>

<script>
    $("#submiting").hide();
    $(".regi_pages").hide();
    $("#fistpage").show();
    var pagecount=0;
    function page_handling(event,count){
        let checkcount=0;
            if(event==$(".page_handle_button")[0]){
                console.log("first");
                for(let i=0;i<$(".form-control-first").length;i++){
                    if($(".form-control-first")[i].value==""){
                        checkcount++;
                        $(".form-control-first")[i].style.border="1px solid red";
                    }
                    else{
                        $(".form-control-first")[i].style.border="1px solid rgba(131, 197, 111, 1.000)";
                    }
                }
            }
            else if(event==$(".page_handle_button")[2]){
                console.log("second");
                for(let i=0;i<$(".form-control-second").length;i++){
                    if($(".form-control-second")[i].value==""){
                        checkcount++;
                        $(".form-control-second")[i].style.border="1px solid red";
                    }
                    else{
                        $(".form-control-second")[i].style.border="1px solid green";
                    }
                }
            }  
            if(checkcount==0){
                pagecount+=count;
                $(".regi_pages").hide();
                $("#submiting").hide();
                if(pagecount==0){
                    console.log(pagecount);
                    $("#fistpage").show();                    
                }
                else if(pagecount==1){
                    console.log(pagecount);
                    $("#secondpage").show();     
                }
                else if(pagecount==2){
                    console.log(pagecount);
                    $("#thirdpage").show();  
                }
                else{
                    $(".page_handle_button").hide();
                    $(".regi_pages").show();
                    $("#submiting").show();
                      
                }
            }
        }
</script>

</body>

</html>