<?php
include "header.php";
?>
<style>
    button.close {
    padding: 0;
    background-color: transparent;
    border: 0;
    color: aliceblue;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
.blur {
    color: transparent;
    text-shadow: 0px 0px 5px #b2b9bf;
    transition: text-shadow 0.4s linear;
}
.blur:hover {
    text-shadow: 0px 0px 0px #b2b9bf;
}
.close {
    float: right;
    font-size: 23px;
    font-weight: 600;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
}
button.close:hover {
    color: #fff;
    text-shadow: 0 1px 0 #fff;
    opacity: 1;
}
</style>
<main class="content">
				<div class="container-fluid p-0">
                <?php
                            
                            if($_SESSION['app_name'] == "None"){
                                die("<center><h1 style='color: #fff;'>Go choose a app and come back here</h1>");
                            }
                            if(isset($_SESSION['app_secret']) & !empty($_SESSION['app_secret'])){
                                echo '<div class="card p-3 p-lg-4" style="background-color: #343a40">';
                                $sql = "SELECT * FROM `app_web` WHERE web_secret=?";
                                $result = $db->prepare($sql);
                                $result->execute(array(strip_tags(trim($_SESSION["app_secret"]))));
                                $count = $result->rowCount();
                                if($count == 0) {
                                    die("<center><h1 style='color: #fff;'>Go choose a app and come back here</h1>");
                                }
                            }
                            else {
                                if($_SESSION['app_name'] == "None"){
                                    die("<center><h1 style='color: #fff;'>Go choose a app and come back here</h1>");
                                }
                            }
                            // delete user
                            if(isset($_POST['delete']) & !empty($_POST['delete'])){
                                $sql = "SELECT * FROM `app_users` WHERE secret=?";
                                $result = $db->prepare($sql);
                                $result->execute(array(strip_tags(trim($_POST['delete']))));
                                $count = $result->rowCount();
                                $res = $result->fetch(PDO::FETCH_ASSOC);
                                if($res){
                                    if(!$res['app_secret'] == $_SESSION['app_secret']){
                                        echo msg::error_js("this user does not belong to your application");
                                        return;
                                    }
                                    $sql = "DELETE FROM `app_users` WHERE secret = ?";
                                    $db->prepare($sql)->execute([strip_tags(trim($_POST['delete']))]);
                                    if($db){
                                        $_SESSION['suc'] = msg::success_js("Success deleted user from app!");
                                        #echo "<meta http-equiv='Refresh' Content='0;'>";
                                    }
                                } else {
                                    echo msg::error_js("this user is invalid and cannot be deleted!");
                                    return;
                                }
                            }
                            // create user verify asset
                            if(isset($_POST['Username']) || isset($_POST['client_secret']) || isset($_POST['create_account']) || isset($_POST['api_key']) & !empty($_POST['client_secret'])) {
                                $api = $_POST['api_key'];
                                if(empty($_POST['api_key'])){
                                    $api = "Not Registered";
                                } else {
                                    $sql = "SELECT * FROM `app_users` WHERE api_key=?";
                                    $result = $db->prepare($sql);
                                    $result->execute(array(strip_tags(trim($_POST["api_key"]))));
                                    $count = $result->rowCount();
                                    if($count == 1){
                                        $errors[] = "Sorry this key is already registered to another user";
                                    } else {
                                        $sql = "SELECT * FROM `app` WHERE api_key=?";
                                        $result = $db->prepare($sql);
                                        $result->execute(array(strip_tags(trim($_POST["api_key"]))));
                                        $count = $result->rowCount();
                                        if(!$count == 1){
                                            $errors[] = "Sorry this key does not exist!";
                                        }
                                    }
                                }
                                if(!$_POST['create_account'] == "True"){
                                    $errors[] = "Something wen't wrong | Error [403]";
                                }
                                if(!$_SESSION['app_secret'] == $_POST['client_secret']){
                                    $errors[] = "The app secret submitted does not match you're current app!";
                                }
                                if(empty($_POST['Username'])){
                                    $errors[] = "Please submit a valid username!";
                                } else {
                                    $sql = "SELECT * FROM `app_users` WHERE username=?";
                                    $result = $db->prepare($sql);
                                    $result->execute(array(strip_tags(trim($_POST["Username"]))));
                                    $count = $result->rowCount();
                                    if($count == 1){
                                        $errors[] = "Sorry this username is already registered to another user";
                                    }
                                }
                                if(is_numeric($_POST['Username'])){
                                    $errors[] = "You're username must be a string";
                                }
                                if(strlen($_POST['Username']) > 15){
                                    $errors[] = "The submitted username is too long!";
                                }
                                $Username = filter_input(INPUT_POST, "Username", FILTER_SANITIZE_STRING);

                                if(outputs::strposa($Username, filter_special_characters())){
                                    $errors[] = "Special characters not allowed in your username";
                                }
                                if(empty($errors)){
                                    $sql = "INSERT INTO `app_users` (app_secret, username, api_key, secret, hwid, ip) VALUES ( :app_secret, :username, :api_key, :secret, :hwid, :ip)";
                                    $result = $db->prepare($sql);
                                    $values = array(
                                                                            ':app_secret'     => strip_tags(trim($_SESSION['app_secret'])),
                                                                            ':username' => strip_tags(trim($Username)),
                                                                            ':api_key' => $api,
                                                                            ':secret' => gensecret(),
                                                                            ':hwid' => "N/A",
                                                                            ':ip' => "N/A"
                                                                            );
                                    $res = $result->execute($values);
                                    #echo "<meta http-equiv='Refresh' Content='0;'>";
                                }
                                
                            }
                            
                ?>
                    
							<div class="card p-3 p-lg-4" style="background-color: #343a40; width:auto;">
                            <h1 style="color: #fff;"> Manage Users </h1>
                            <div style="height: 30px;"></div>
                            <div class="mb-4">
                            <button class="btn btn-info btn-primary" style="height: 40px; margin-left: auto;" type="submit" id="button-addon2" data-toggle="modal" data-target="#oo">Create User</button>
                            <button class="btn btn-warning btn-primary" style="height: 40px; margin-left: auto;" type="submit" id="button-addon2" data-toggle="tooltip" data-placement="top" title="Reset a user HWID">Reset HWID</button>
                            <button class="btn btn-success btn-primary" style="height: 40px; margin-left: auto;" type="submit" id="button-addon2" data-toggle="tooltip" data-placement="top" title="Reset a user IP">Reset IP</button>
                            <button class="btn btn-danger btn-primary" style="height: 40px; margin-left: auto;" type="submit" id="button-addon2" data-toggle="tooltip" data-placement="top" title="Delete all app users">Delete All Users</button>
                            </div>
                            <table class="table table-dark" style="border-color: transparent;">
                                    <thead>
                                        <tr>
                                        <th scope="col">Key</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Secret</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `app_users` WHERE app_secret=?";
                                        $result = $db->prepare($sql);
                                        $result->execute(array($_SESSION["app_secret"]));
                                        $count = $result->rowCount();
                                        $res = $result->fetchall();

                                        foreach ($res as $row){
                                            echo '
                                            <tr>
                                            <td>'.$row["api_key"].'</td>
                                            <td>'.htmlspecialchars($row["username"]).'</td>
                                            <td class="blur">'.$row["secret"].'</td><form method="post">
                                            <td><button style="margin-right: 20px;"type="submit" name="delete" value="'.$row['secret'].'" class="btn btn-danger rounded-circle btn-icon-only" data-toggle="tooltip" data-placement="top" title="Deletes this key">
                                            <span class="btn-inner--icon">
                                                <i class="far fa-trash-alt"></i>
                                            </span>
                                        </button></form></td>
                                            </tr>
                                            ';
                                        }
                                        
                                        
                                        ?>
                                        

<div class="modal" id="oo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: transparent;">
                                                    <div class="modal-dialog modal-dialog-centered" role="document" >
                                                        <div class="modal-content"style="background-color: #343a40">
                                                        <div class="modal-header" style="background-color: #343a40">
                                                            <h3 class="modal-title" style="color: #fff;" id="exampleModalLabel">Create User</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form method="post">
                                                        <h4 data-toggle="tooltip" data-placement="left" title="Username"  style="color: #fff;">Username</h4>
                                                        <input type="username" style= "color: #fff !important; height: auto; !important; background-color: #343a40 !important;" name="Username" class="form-control" placeholder="l33t" aria-label="Username" name="Username" aria-describedby="button-addon2">
                                                        <br>
                                                        <h4 data-toggle="tooltip" data-placement="left" title="Api key"  style="color: #fff;">Api key</h4>
                                                        <input type="username" style= "color: #fff !important; height: auto; !important; background-color: #343a40 !important;" name="api_key" class="form-control" placeholder="iAuth-XXXX-XXXX-XXXX" aria-label="api key" name="api_key" aria-describedby="button-addon2">
                                                        <input type="hidden" name="client_secret" value="<?php echo $_SESSION['app_secret']?>"></input>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" style="height: 40px;" name="create_account" value="True" class="btn btn-success">Create User</button>
                                                            
                                                            <button type="button" style="height: 40px; margin-left: 10px;" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </div>
                                                        </form>
                                                    <?php
                                                    
                                                    if(!empty($errors)){
                                                        foreach($errors as $error){
                                                            echo msg::error_js($error);
                                                        }
                                                    }
                                                    
                                                    ?>