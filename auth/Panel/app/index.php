
<?php
include 'header.php';
?>
<style>
    body {
        color: #fff;
    }
</style>
<?php


function gen_client_sec(){
    $secret = sha1("iAuth".generateRandomNum());
    return $secret;
}


if (isset($_POST) & !empty($_POST)){

    if(isset($_POST['APP_SECRET']) & !empty($_POST['APP_SECRET'])){
        $sql = "SELECT * FROM `app_web` WHERE web_secret=?";
        $result = $db->prepare($sql);
        $result->execute(array(strip_tags(trim($_POST["APP_SECRET"]))));
        $res = $result->fetch(PDO::FETCH_ASSOC);
        if($res){
            if(!$res['user'] == $_SESSION['username']){
            
                $errors[] = "this secret does not belong to your account";
            }
        }

        if($_SESSION['app_name'] == $res['app_name']){
            $errors[] = "You are already using this app";
        }

        if(empty($errors)){
            echo msg::success_js("Started using ".htmlspecialchars($res['app_name'])." app!");
        
            $_SESSION['using_app'] = "True";
            $_SESSION['app_name'] = $res['app_name'];
            $_SESSION['app_secret'] = $_POST['APP_SECRET'];
            
            echo "<meta http-equiv='Refresh' Content='0;'>";
        }
        
        
    }

    if(isset($_POST['app_name'])){
        if(empty($_POST['app_name'])) {
            $errors[] = "Your application name is required";

        }
        if($_SESSION['role'] == "guest"){
            $sql = "SELECT * FROM `app_web` WHERE user=?";
            $result = $db->prepare($sql);
            $result->execute(array(strip_tags(trim($_SESSION["username"]))));
            $count = $result->rowCount();
            
            if($count > 0){
                $errors[] = "Please buy a plan to create more apps";
            }
        }
        if(outputs::strposa($_POST['app_name'], blacklist_words())){
            // this needs to be fixed later because it can be bypassed
            $errors[] = "this word is blacklisted (devs look at comment)";
        }

        if(strlen($_POST["app_name"]) > 20){
            $errors[] = "Your application name can't exceed 20 characters";
        }
    
        if(empty($_POST["app_name"])) {
            $errors[] = "Your application name is required";
        } else {
            #$sql = "SELECT * FROM `app_web` WHERE app_name=?";
            #$result = $db->prepare($sql);
            #$result->execute(array(strip_tags(trim($_POST["app_name"]))));
            #$count = $result->rowCount();
            #$res = $result->fetch(PDO::FETCH_ASSOC);
            #if($count == 1){
                #$errors[] = "Sorry this app name is already registered to another app";
            #}
        }
        if(empty($errors)){
            $sql = "INSERT INTO `app_web` (user, app_name, web_secret) VALUES (:user, :app_name, :web_secret)";
            $result = $db->prepare($sql);
            $values = array(':user'        => strip_tags(trim($_SESSION['username'])),
                                            ':app_name'     => strip_tags(trim($_POST['app_name'])),
                                            ':web_secret' => gen_client_sec()
                                            );
            $res = $result->execute($values);
            echo msg::success_js("Created your application!");
	    $app = "https://discord.com/api/webhooks/936792359746797568/zJMAdhY2AB2JL9dXPk8nAl3lVoXY4qqCmB9z_YS0akmEdLNT1Uaa3tyk9O3ueFyCiTdr";
            wh_log($app, "```\nCreated iAuth app \n\nUsername: ".$_SESSION['username']."\nApp_name: ".strip_tags(trim($_POST['app_name']))."\nApp_secret: ".gen_client_sec()."```", "iAuth Create app");

        }
    }

    if(isset($_POST['delete']) & !empty($_POST['delete'])){
        $sql = "SELECT * FROM `app_web` WHERE web_secret=?";
        $result = $db->prepare($sql);
        $result->execute(array(strip_tags(trim($_POST["delete"]))));
        $res = $result->fetch(PDO::FETCH_ASSOC);
        if($res){
            if(!$res['user'] == $_SESSION['username']){
            
                $errors[] = "You can't delete this app because it doesn't belong to you";
            }
            $sql = "DELETE FROM `app_web` WHERE web_secret = ?";
            $db->prepare($sql)->execute([strip_tags($_POST['delete'])]);
            if($res['app_name'] == $_SESSION['app_name']){
                $_SESSION['app_name'] = "None";
            }
            echo msg::success_js("Success deleted app!");
	    $app = "https://discord.com/api/webhooks/936792359746797568/zJMAdhY2AB2JL9dXPk8nAl3lVoXY4qqCmB9z_YS0akmEdLNT1Uaa3tyk9O3ueFyCiTdr";
            wh_log($app, "```Deleted iAuth app \n\nUsername: ".$_SESSION['username']."\nApp_secret: ".$_POST["delete"]."```", "iAuth delete app");
        } else {
            $errors[] = "Something wrong happened when deleting this app";
        }
        
        
    } 
    
}


?>
<style>

.blur {
    color: transparent;
    text-shadow: 0px 0px 5px #b2b9bf;
    transition: text-shadow 0.4s linear;
}
.blur:hover {
    text-shadow: 0px 0px 0px #b2b9bf;
}

</style>
<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<style>
    @media (pointer:none), (pointer:coarse) {
    
    .content {
    width: max-content;
    max-width: max-content;
    }
}
/* width */
::-webkit-scrollbar {
  width: 14px;
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

<main class="content">
				<div class="container-fluid p-0">
                    
							<div class="card p-3 p-lg-4" style="background-color: #343a40">
                            <h3 style=" color: #fff;">Create App</h3>
                            <h4 style=" color: #fff;"> create a new application with <strong>iAuth</strong> here </h3>
                            <form method="post">
                                <div style="width: 600px !important;" class="input-group mb-3">
                                <input type="text" style= "color: #fff !important; height: 50px !important; background-color: #343a40 !important;" class="form-control" placeholder="App name" aria-label="App name" name="app_name" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    
                                    <button class="btn btn-dark btn-primary" style="width: 100px; margin-left: 10px;" type="submit" id="button-addon2">Create</button>
                                
                                </form>
                                </div>
                                </div>
                                <table class="table table-dark" style="border-color: transparent;">
                                    <thead>
                                        <tr>
                                        
                                        <th scope="col">App Name</th>
                                        <th scope="col">Secret</th>
                                        <th scope="col">Use app</th>
                                        <th scope="col">Pause</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "SELECT * FROM `app_web` WHERE user=?";
                                    $result = $db->prepare($sql);
                                    $result->execute(array(strip_tags(trim($_SESSION["username"]))));
                                    $count = $result->rowCount();
                                    $res = $result->fetchall();
                                    
                                    if(!$count == 0){
                                        foreach($res as $row){
                                            echo '
                                            <tr>
                                            <td>'.htmlspecialchars($row['app_name']).'</td>
                                            <td class="blur">'.$row['web_secret'].'</td>
                                            <td><form method="post"><button style="margin-right: 20px;"type="submit" name="APP_SECRET" value="'.$row['web_secret'].'" class="btn btn-dark"  data-toggle="tooltip" data-placement="top" title="Use this current app">Use</td></form>
                                            <td><button style="margin-right: 20px;"type="submit" class="btn btn-animated btn-dark rounded-circle btn-icon-only"  data-toggle="tooltip" data-placement="top" title="Pause app (disabled)" disabled>
                                            <span class="btn-inner--icon">
                                                <i class="far fa-pause-circle"></i>
                                            </span>
                                        </button></td>
                                            <td><button style="margin-right: 20px;"type="submit" name="delete" value="'.$row['web_secret'].'" class="btn btn-danger rounded-circle btn-icon-only" data-toggle="modal" data-target="#Deleteform" data-toggle="tooltip" data-placement="top" title="Deletes this app">
                                            <span class="btn-inner--icon">
                                                <i class="far fa-trash-alt"></i>
                                            </span>
                                        </button></td> 
                                            </tr>
                                            
                                            
                                            <div class="modal fade" id="Deleteform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: transparent;">
                                                    <div class="modal-dialog modal-dialog-centered" role="document" >
                                                        <div class="modal-content"style="background-color: #343a40">
                                                        <div class="modal-header" style="background-color: #343a40">
                                                            <h3 class="modal-title" style="color: #fff;" id="exampleModalLabel">Delete app</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            are u sure that you want to delete this app, this will delete all keys under this app
                                                        </div>
                                                        <div class="modal-footer">
                                                        <form method="post">
                                                            <button type="submit" style="height: 40px;" name="delete" value="'.$row['web_secret'].'" class="btn btn-danger">Delete</button>
                                                            
                                                            <button type="button" style="height: 40px;" class="btn btn-success" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </form>
                                                    
                                            ';
                                        }
                                    }
                                    
                                    ?>

                                    
                                    
                                    </tbody>
                                    </table>
</div>  </div> </div>
                                </div>
<?php
if(!empty($errors)){
    foreach($errors as $error){
        echo msg::error_js($error);
        return;
    }
}


?>

