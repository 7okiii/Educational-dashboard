<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register_yuya.css">
    <script src="./js/jquery.js"></script>
    <title>Document</title>
</head>
<body>
    <div id="admin_dash"> <!-- bgcolor-->
        <form method="POST" id="registe_form" action="<?php echo $_SERVER["PHP_SELF"]?>">
            <div><!--Form header-->
                <h2>Register Infrmation</h2>
            </div><!--end Form header-->

            <div id="contentpage" class><!--Form content-->
                <div id="fistpage" class="regi_pages"> <!--first page-->  
                    <div>            
                        <div class="form-floating">
                            <label for="floatingfname">First Name: </label>
                            <input type="text" class="form-control-first required" id="floatingfname" placeholder="First Name" required>
                        </div>  
                        <div class="form-floating">
                            <label for="floatinglname">Last Name: </label>
                            <input type="text" class="form-control-first required" id="floatinglname" placeholder="Last Name" required>
                        </div>  
                        <div class="form-floating">
                            <label for="floatingemail">Email: </label>
                            <input type="email" class="form-control-first required" id="floatingemail" placeholder="Email" required>
                        </div>  
                        <div class="form-floating">
                            <label for="floatingPassword">Password: </label>
                            <input type="password" class="form-control-first required" id="floatingPassword" placeholder="Password" required>
                        </div> 
                      
                    </div> 
                    <div>
                        <span onclick="page_handling(this,1)" class="page_handle_button" style="margin-left:290px;">Next</span>
                    </div>
                </div><!--end first page-->
            
                <div id="secondpage" class="regi_pages"><!--second page-->
                    <div>
                        <div class="form-floating">
                            <label for="floatingdob">Date of Birth: </label>
                            <input type="date" class="form-control-second required" id="floatingdob" required>
                        </div> 
                        <div class="form-floating">
                            <label for="floatingaddress">Address: </label>
                            <input type="text" class="form-control-second required" id="floatingaddress" placeholder="Address" required>
                        </div>  
                        <div class="form-floating">
                            <label for="floatingposition">Position: </label>
                            <input type="text" class="form-control-second required" id="floatingposition" placeholder="Position"  required>
                        </div>
                        <div class="form-floating">
                            <label for="floatingSelect1">User type</label>
                            <select id="floatingSelect1" class="form-control-second required" required>
                                <option selected></option>
                                <option value="admin">Admin</option>
                                <option value="teacher">Teacher</option>
                                <option value="student">Student</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <span onclick="page_handling(this,-1)" class="page_handle_button">Previous</span>
                        <span onclick="page_handling(this,1)" class="page_handle_button">Next</span>
                    </div>
                </div><!--end second page-->

                <div id="thirdpage" class="regi_pages"><!--third page-->
                    <div>
                        <div class="form-floating">
                            <label for="floatingSelect3">Gender</label>
                            <select class="form-select" id="floatingSelect3">
                                <option selected></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="deny2">Prefer not to say</option>
                            </select>
                        </div>
                        <div class="form-floating">
                            <label for="floatingcountry">Country: </label>
                            <input type="text" class="form-select" id="floatingcountry" placeholder="Country">
                        </div>
                        <div class="form-floating">
                            <label for="floatingpropic">Profile picture: </label><br>
                            <input style="width:280px;" class="form-select" type="file" id="floatingpropic" placeholder="Profile picture">
                        </div>
                        <div class="form-floating">
                            <label for="floatingSelect2">Vaccinated</label>
                            <select class="form-select" id="floatingSelect2">
                                <option selected></option>
                                <option value="full">Full vaccinated</option>
                                <option value="one">One dose</option>
                                <option value="deny">Prefer not to say</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <span onclick="page_handling(this,-1)" class="page_handle_button">Previous</span>
                        <span onclick="page_handling(this,1)" class="page_handle_button">Review</span>
                    </div>
                </div><!--end third page--> 
                <input id="submiting" type="submit" name="submit" 
                style=" background-color: rgba(128, 128, 128, 0.527);
                padding: 5px 10px;
                margin-top:20px;
                font-size: 18px;
                border: none;
                outline: none;
                width:60%;
                margin-left:20%;
                ">
            </div><!--end Form content-->
        </form>
    </div><!-- end bgcolor-->

    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            echo "post";
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
