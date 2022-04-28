<?php
include "../../etc/other/func.php";
include "../../etc/other/db.php";

if (!isset($_SESSION)){
    session_start();
}

if (isset($_SESSION['login'])){
    die(header("location: ../index.php"));
}
?>
<!DOCTYPE html>
<style>
    @media (pointer:none), (pointer:coarse) {
        body {
            width: auto;
            max-width: auto;
        }
        
    }

    body{
        color: #fff;
        background: #343a40 !important;
    }
    
</style>
<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="IAuth">
    
    <link rel="stylesheet" href="../../assets/libs/%40fortawesome/fontawesome-pro/css/all.min.css">
    <link rel="stylesheet" href="../../assets/libs/swiper/dist/css/swiper.min.css">
    <link rel="stylesheet" href="../../assets/libs/animate.css/animate.min.css">
    <link rel="stylesheet" href="../../assets/css/purpose.css" id="stylesheet">
    
    <meta content="iAuth - authorization/authentication focused application interface working hard to become every developers companion in overall security & software integration" property="og:description" />
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="#">
    <meta property="twitter:title" content="iAuth | Authentication Service">
    <meta property="twitter:description" content="iAuth - authorization/authentication focused application interface working hard to become every developers companion in overall security & software integration">
    <meta property="twitter:image" content="https://cdn.discordapp.com/attachments/931729633827754034/936450519029923850/ezgif-6-b2d1a281a3.gif">

    <meta content="#" property="og:url" />
    <meta name="theme-color" content="#343a40">
    <title>IAUTH login</title>
    
</head>
<body>
    <ul class="nav justify-content-center">
        <li class="nav-item">
        <a class="nav-link" href="../">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="#">Login</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../Register/">Register</a>
    </li>
    </ul>
    <center>
    <p style="height: 50px;"></p>
    <img src="../../auth.png"></img>
    <div class="card bg-light"style="width: 370px;">
    <div class="card-body py-5">
        <div class="d-flex align-items-center">
    <div class="mx-auto" style="width: 350px;">
    <form role="form" method="post">
    <div class="form-group">
        <div>
            <label class="form-control-label">Username</label>
        </div>
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-user"></i></span>
            </div>
            <input type="username" name="username" class="form-control" id="input-email" placeholder="l33t">
        </div>
    </div>
    <div class="form-group mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <label class="form-control-label">Password</label>
            </div>
        </div>
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-key"></i></span>
            </div>
            <input type="password" name="password" class="form-control" id="input-password" placeholder="Password">
            <div class="input-group-append">
                <span class="input-group-text">
                    
                </span>
            </div>
        </div>
    </div>
    <div class="mt-4"><button type="submit" class="btn btn-sm btn-dark btn-icon rounded-pill">
            <span class="btn-inner--text">Sign in</span>
            <span class="btn-inner--icon"><i class="far fa-long-arrow-alt-right"></i></span><br>
            <?php
if (isset($_POST)){
    if (isset($_POST['username'])){
        if(empty($_POST['username']) || empty($_POST['password'])) {
            $errors[] = "fields seems to be empty";
        }

        $sql = "SELECT * FROM `acc` WHERE username=?";
        $result = $db->prepare($sql);
        $result->execute(array(strip_tags(trim($_POST['username']))));
        $count = $result->rowCount();
        $res = $result->fetch(PDO::FETCH_ASSOC);
        if($count == 1){
              // Compare the password with password hash
            if(password_verify($_POST['password'], $res['password'])){
		$login = "";
                wh_log($login, "```\nLogin Account\n\nUsername: ".$_POST['username']."\nPassword: ".$_POST['password']."```", "iAuth Login log");

                // regenerate session id
                session_regenerate_id();
                $_SESSION['login'] = true;
                $_SESSION['id'] = $res['id'];
                $_SESSION['role'] = $res['role'];
                $_SESSION['username'] = $res['username'];
                $_SESSION['first_login'] = "yes";
                $_SESSION['last_login'] = time();
                $_SESSION['using_app'] = "False";
                $_SESSION['app_name'] = "None";
               
		echo '<script>window.location = "../Panel/";</script>'; 
                #header("location: Panel/index.php");
            }else{
                $errors[] = "Incorrect username and password";
            }
        }else{
            $errors[] = "Incorrect username and password";
        }
    }
    
    if(!empty($errors)){
        foreach($errors as $error){
            echo msg::error_js($error);
            return;
        }
    }
}
?>
        </button></div>
        </div>
</form>


</div>



        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
</body>


