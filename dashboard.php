<?php
    include ('./config.php');
    session_start();
    // if($_SERVER["REQUEST_METHOD"]="GET"){
    //     if(!isset($_SESSION["userid"])){
    //         $_SESSION["logout"]=1;
    //         header("location:login.php");
    //         exit();
    //     }

    //     if(isset($_GET["add"])){
    //         if($_GET["add"]=="logout"){
    //             $_SESSION["logout"]=1;
    //             header("location:login.php");
    //             exit();
    //         }
           
    //     }
    // }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <title>Dashboard</title>
    <style>
        <?php
            include('./stylesheet/dashboard.css'); // 0. dashboard.php
            include('./stylesheet/register_yuya.css'); // 1. register.admin.php
            include('./stylesheet/edit_user_admin.css'); // 2. edit_user_admin.php
            include('./stylesheet/edit_admin_form.css'); // 3. edit_admin_form2.php
            // edit_course_admin.php has internal css code // 4
            include('./stylesheet/mark_teacher.css'); // 5.  marks_teacher.php
            // ★★★★★ marks_student.php => make CSS later ★★★★★ // 6
            // student_enroll.php // 7
        ?>
    </style>

<script src="./js/jquery.js"></script>

<title>Dashboard</title>
    <!-- Box-icons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <!-- <img src="images/logo.png" alt="logo"> -->
                    <i class="fas fa-user-graduate" id="top-icon"></i>
                </span>

                <div class="text header-text">
                    <span class="name">Dashboard</span>
                    <span class="profession">Web Developer</span>
                </div>

            </div>

            <i class="bx bx-chevron-right toggle"></i>
        </header>
        
        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link" 
                        <?php 
                            if($_SESSION['name'] != 0){
                                // echo "style='display:none;'";
                            }
                        ?>>
                        <a href="<?php page_handling("register_admin")?>">
                            <!-- <i class="bx bx-home-alt icon"></i> -->
                            <i class="fas fa-user-circle icon"></i>
                            <span class="text nav-text">Register for Admin</span>
                        </a>
                    </li>
                    <li class="nav-link"
                        <?php 
                            if($_SESSION['name'] != 0){
                                // echo "style='display:none;'";
                            }
                        ?>>
                        <a href="<?php page_handling("edit_user_admin")?>">
                            <!-- <i class="bx bx-bar-chart-alt-2 icon"></i> -->
                            <i class="fas fa-user-edit icon"></i>
                            <span class="text nav-text">Edit user info(Admin)</span>
                        </a>
                    </li>
                    <li class="nav-link"
                        <?php 
                            if($_SESSION['name'] != 0){
                                // echo "style='display:none;'";
                            }
                        ?>>
                        <a href="<?php page_handling("edit_course_admin")?>">
                            <!-- <i class="bx bx-pie-chart-alt icon"></i> -->
                            <i class="fas fa-edit icon"></i>
                            <span class="text nav-text">Edit course info(Admin)</span>
                        </a>
                    </li>
                    <li class="nav-link"
                        <?php 
                            if($_SESSION['name'] != 1){
                                // echo "style='display:none;'";
                            }
                        ?>>
                        <a href="<?php page_handling("marks_teacher")?>">
                            <!-- <i class="bx bx-bell icon"></i> -->
                            <i class="fas fa-graduation-cap icon"></i>
                            <span class="text nav-text">Mark and comment(Teacher)</span>
                        </a>
                    </li>
                    <li class="nav-link"
                        <?php 
                            if($_SESSION['name'] != 2){
                                // echo "style='display:none;'";
                            }
                        ?>>
                        <a href="<?php page_handling("marks_student")?>">
                            <!-- <i class="bx bx-heart icon"></i> -->
                            <i class="fas fa-chalkboard-teacher icon"></i>
                            <span class="text nav-text">Check the mark and comment(student)</span>
                        </a>
                    </li>
                    <li class="nav-link"
                        <?php 
                            if($_SESSION['name'] != 2){
                                // echo "style='display:none;'";
                            }
                        ?>>
                        <a href="<?php page_handling("student_enroll")?>">
                            <!-- <i class="bx bx-wallet icon"></i> -->
                            <i class="fas fa-school icon"></i>
                            <span class="text nav-text">Enroll for the new course(student)</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="<?php page_handling("logout")?>">
                        <i class="bx bx-log-out icon"></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
                <li class="mode">
                    <div class="moon-sun">
                        <i class="bx bx-moon icon moon"></i>
                        <i class="bx bx-sun icon sun"></i>
                    </div>
                    <span class="mode-text text">Dark Mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>

            </div>
        </div>
    </nav>
    <script src="./js/script.js"></script>
    <section class="home">
        <div class="content">
            <?php
                if(isset($_GET["add"])){
                    include ("pages/".$_GET["add"].".php");
                }
            ?>
        </div>
    </section>
    
</body>
</html>