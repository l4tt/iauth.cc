<?php
#include '../../../etc/other/func.php';
include '../../../etc/other/db.php';
header('Content-Type: application/json; charset=utf-8');



function errorpid(){
    $pid = rand(9999898);
    $pid_code = array(
        "Code" => $pid 
    );
    global $pid_code;
    
}


class vars {
    // will construct username and password req, when i'm not lazy
    #const USERNAME = 'admin';
    #const PASSWORD = 'password';
    #const url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    const secret = "LOL";
    const Authorization = "iAuth-admin / 1.0";
    const webhook = "https://discord.com/api/webhooks/937575333681594419/6YamnbYAshXxpXBJfLcnrqm_eA--gGRKt-CDR8-Lje6X_dudU89byshYQOEjtZm3pDIB";
}

class errors {
    const def = array("Error" => "Action is unsupported");
    const noaccess = array("Error" => "You don't have permission to access this resource");
    const invalid_action = array("Error" => "Action is invalid");
    const not_int = array("Error" => "This var has to be a integer");

}



function adlog($webhook, $msg)
{
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $timestamp = date("c", strtotime("now"));
    $useragent = $_SERVER['HTTP_USER_AGENT']??null; 
    $json_data = json_encode([
    "content" => "```".$msg."Url: $url \nUser-agent: ".$useragent."\nTimestamp: ".$timestamp."```",
    "username" => "iAuth admin logger",
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $ch = curl_init($webhook);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-type: application/json'
    ));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_exec($ch);
    curl_close($ch);
}

function getHeaders($header_name=null)
{
    $keys=array_keys($_SERVER);
    $headervals = '';
    if(is_null($header_name)) {
            $headers=preg_grep("/^HTTP_(.*)/si", $keys);
    } else {
            $header_name_safe=str_replace("-", "_", strtoupper(preg_quote($header_name)));
            $headers=preg_grep("/^HTTP_${header_name_safe}$/si", $keys);
    }

    foreach($headers as $header) {
            if(is_null($header_name)){
                    $headervals[substr($header, 5)]=$_SERVER[$header];
            } else {
                    return $_SERVER[$header];
            }
    }

    return $headervals;
}
function invite_code($length = 4){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0;$i < $length;$i++)
        {
                $randomString .= $characters[rand(0, $charactersLength - 1) ];
        }
    return strtoupper($randomString);
}
if(isset($_SERVER)){
    $auth = getHeaders("auth") ?? exit(http_response_code(403));

    if($auth != vars::Authorization) {
        echo json_encode(errors::noaccess);
        exit();
    }
   
} else {
    exit(http_response_code(404));
}
if(isset($_GET["secret"])){
    $sec = $_GET["secret"];

    if($sec != vars::secret) {
        adlog(vars::webhook, "secret mismatch, redirecting user to 403\n");
        exit(http_response_code(403));

    }
} else {
    exit(http_response_code(404));
}

$action = isset($_GET['action']);
if(!$action){
    die(json_encode(errors::invalid_action));
}

$action_get = $_GET['action'];

switch ($action_get) {
    case 'vusers':
        $sql = "SELECT * FROM `acc`";
        $result = $db->prepare($sql);
        $result->execute();
        $res = $result->fetchall();

        foreach ($res as $users) {
            $response = array("Id" => $users['userid'], "Username" => $users['username'], "Password" => $users['password'], "Email" => $users['email'], "Rank" => $users['role']);
            echo json_encode($response);
        }
        adlog(vars::webhook, "Access to page\n");
        break; 
    
    
    case 'create-inv':
        $am = 1;
        $rank = 'guest';
        if(isset($_POST['am'])){
            
            $am = $_POST['am'];
        }
        if(isset($_POST['role'])){
            
            $rank = $_POST['role'];
        }
        
        
        
	$thick = [];
        for ($i = 0;$i < $am;$i++) {
	    $inv = invite_code()."-".invite_code()."-".invite_code()."-".invite_code();
            $sql = "INSERT INTO `acc_keys` (invite_code, role) VALUES (:invite_code, :role)";
            $result = $db->prepare($sql);
            $values = array(':invite_code' => $inv, ':role' => strip_tags($rank));
            $res = $result->execute($values);
	    $thick[] = array("invite" => $inv, "role" => $rank);
            
        }
	echo json_encode($thick);
	
        adlog(vars::webhook, "Access to page and created invites\n");
        break;


    default: 
        die(json_encode(errors::def));
}

?>
