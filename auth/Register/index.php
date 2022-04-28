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
    body{
        color: #fff;
        background: #343a40 !important;
        .keep-scrolling {
        background-color: #eee;
        width: 200px;
        height: 100px;
        border: 1px dotted black;
        overflow-y: scroll; /* Add the ability to scroll y axis*/
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .keep-scrolling::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .keep-scrolling {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
        }
        
    }
    
</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content="iAuth - authorization/authentication focused application interface working hard to become every developers companion in overall security & software integration" property="og:description" />
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="#">
    <meta property="twitter:title" content="iAuth | Authentication Service">
    <meta property="twitter:description" content="iAuth - authorization/authentication focused application interface working hard to become every developers companion in overall security & software integration">
    <meta property="twitter:image" content="https://cdn.discordapp.com/attachments/931729633827754034/936450519029923850/ezgif-6-b2d1a281a3.gif">

    <meta content="#" property="og:url" />
    <meta name="theme-color" content="#343a40">
    <link rel="stylesheet" href="../../assets/libs/%40fortawesome/fontawesome-pro/css/all.min.css">
    <link rel="stylesheet" href="../../assets/libs/swiper/dist/css/swiper.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../assets/libs/animate.css/animate.min.css">
    
    <link rel="stylesheet" href="../../assets/css/purpose.css" id="stylesheet">
    <title>IAUTH register</title>
</head>
<style>
/* width */
::-webkit-scrollbar {
  width: 14px;
}
@media (pointer:none), (pointer:coarse) {
        body {
            width: auto;
            max-width: auto;
        }
        
    }

/* Track */
::-webkit-scrollbar-track {
  background: #343a40; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #555;
  border-radius: 15px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>

<script>
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("navbar").style.top = "0";
  } else {
    document.getElementById("navbar").style.top = "-50px";
  }
  prevScrollpos = currentScrollPos;
}
</script>

<body>

<ul class="nav justify-content-center">
        <li class="nav-item" id="navbar">
        <a class="nav-link" href="../">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../Login/">Login</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="#">Register</a>
    </li>
    </ul>
<center>
    <img src="../../auth.png" style="height: auto;"></img>
    
    <div class="card bg-light"style="width: 450px; height: auto;">
    <div class="card-body py-5">
        <div class="d-flex align-items-center">
<form role="form" method="post">
	<div class="form-group" style="width: 400px;">
		<label class="form-control-label">Email address</label>
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-user"></i></span>
            </div>
            <input type="email" name="email" class="form-control" id="input-email" placeholder="l33t@protonmail.com"  value="<?php if (isset($_POST['email'])){echo htmlspecialchars($_POST['email']);} ?>">
        </div>
    </div>
    <div class="form-group">
		<label class="form-control-label">Username</label>
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-user"></i></span>
            </div>
            <input type="Username" name="username" class="form-control" id="Username" placeholder="l33t" value="<?php if (isset($_POST['username'])){echo htmlspecialchars($_POST['username']);} ?>">
        </div>
    </div>
    
    <div class="form-group mb-4">
    	<label class="form-control-label">Password</label>
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-key"></i></span>
            </div>
            <input type="password" name="password" class="form-control" id="input-password" placeholder="********" value="<?php if (isset($_POST['password'])){echo htmlspecialchars($_POST['password']);} ?>">
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="far fa-eye"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group">
		<label class="form-control-label">Invite Code</label>
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-key"></i></span>
            </div>
            <input type="Invite Code" name="inv" class="form-control" id="Invite-Code" placeholder="XXXX-XXXX-XXXX-XXXX" value="<?php if (isset($_POST['inv'])){echo htmlspecialchars($_POST['inv']);} ?>">
        </div>
    </div>
    
    <div class="my-4">
        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" name="Terms" class="custom-control-input " id="check-terms" value="True">
            <label class="custom-control-label" for="check-terms">I agree to the <a href="#">terms and conditions</a></label>
        </div>
        
    </div>
    <div class="mt-4"><button type="submit" class="btn btn-sm btn-dark btn-icon rounded-pill">
            <span class="btn-inner--text">Create my account</span>
            
            <span class="btn-inner--icon"><i class="far fa-long-arrow-alt-right"></i></span>
        </button></div>
</form>
<?php 
if (isset($_POST) & !empty($_POST)){
    // code need's to be cleaned after iauths launch

    if (isset($_POST['Terms'])){
        if (!$_POST['Terms'] == True) {
            $errors[] = "You have to accept the terms of service agreement";
        }
    } else {
        $errors[] = "You have to accept the terms of service agreement";
    }
    if (isset($_POST['username']) || isset($_POST['email']) || isset($_POST['password']) || isset($_POST['inv']))  {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $inv = filter_input(INPUT_POST, "inv", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

        if(outputs::strposa($username, filter_special_characters())){
            $errors[] = "Special characters are not allowed in your username";
        }

        if(strlen($username) > 7){
            $errors[] = "Username is too long must be under 6 letters";
        }
        if(strlen($username) < 2){
            $errors[] = "Username is too short";
        }

        if(strlen($email) > 35){
            $errors[] = "Woah buddy email seems to be too long";
        }

        if(strlen($inv) < 19){
            $errors[] = "Incorrect invite code format";
        }
        if (empty($_POST['inv'])) {} else {
            
            $sql = "SELECT * FROM `acc` WHERE inv=?";
            $result = $db->prepare($sql);
            $result->execute(array($inv));
            $count = $result->rowCount();
           
            if($count > 0){
                
                $errors[] = "This invite code has already been used";
            } else {
                $sql = "SELECT * FROM `acc_keys` WHERE invite_code=?";
                $result = $db->prepare($sql);
                $result->execute(array($inv));
                $count = $result->rowCount();
                $res = $result->fetchall();
                foreach($res as $row){
                    $rank = $row['role'];
                    if(empty($rank)){
                        $rank = 'guest';
                    }
                    
                }
                
                if(!$count == 1){
                    $errors[] = "Invalid invite code";
                }
            }
        }

        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['inv'])) {echo msg::error_js("fields are empty"); return;} else {
        
            // Check Username is Unique to DB
            $sql = "SELECT * FROM `acc` WHERE username=?";
            $result = $db->prepare($sql);
            $result->execute(array(strip_tags(trim($username))));
            $count = $result->rowCount();
            if($count == 1){
                $errors[] = "Username has already been taken";
            }
        }
        if (empty($_POST['email'])) {} else {
            
                $sql = "SELECT * FROM `acc` WHERE email=?";
                $result = $db->prepare($sql);
                $result->execute(array($email));
                $count = $result->rowCount();
                if($count == 1){
                    $errors[] = "Email has already been used";
                }
            }
        }
        
        if(!empty($errors)){
            foreach($errors as $error){
                echo msg::error_js($error);
                return;
            }
        }
        
        if(empty($errors)){
            $password = $_POST['password'];
            // bycript is the def hashing function
            $pass = password_hash($password, PASSWORD_DEFAULT);

            
            $sql = "INSERT INTO `acc` (userid, username, password, inv, email, role) VALUES (:userid, :username, :password, :inv, :email, :role)";
            $result = $db->prepare($sql);
            $values = array(':userid'     => $db->lastInsertId(),
                                    ':username'        => strip_tags(trim($username)),
                                    ':password'     => $pass,
                                    ':inv' => $inv,
                                    ':email' => $email,
                                    ':role' => $rank
                                    );
                    
            $res = $result->execute($values);
            $useragent = $_SERVER['HTTP_USER_AGENT']??null; 
            
            echo '
                <script>
                    window.onload = () => {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            color: "#fff",
                            background: "#343a40",
                            timerProgressBar: true,
                            didOpen: (toast) => {
                              toast.addEventListener("mouseenter", Swal.stopTimer)
                              toast.addEventListener("mouseleave", Swal.resumeTimer)
                              
                            }
                          })
                          
                          Toast.fire({
                            icon: "success",
                            title: "Success registered your account"
                          })
                        
                }
                </script>
            ';
        }
}
?>
</body>
