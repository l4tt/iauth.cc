<script src='https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js'></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.sellix.io/static/js/embed.js"></script>
<link href="https://cdn.sellix.io/static/css/embed.css" rel="stylesheet"/>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css'>

<?php
global $register_webhook;
$register_webhook = "";

class outputs {
    public function json_success($input){
        return json_encode(array("iAuth-Success" => $input));
    }

    public function json_error($input)
    {
        return json_encode(array("iAuth-Error" => $input));
    }

    public function xss_clean($input)
    {
        return htmlspecialchars(trim($input));
    }

    public function strposa(string $haystack, array $needles, int $offset = 0): bool 
    {
        foreach($needles as $needle) {
            if(strpos($haystack, $needle, $offset) !== false) {
                return true; // stop on first true result
            }
        }

        return false;
    }

    public function status($input)
    {
        return http_response_code($input);
    }
}

function sanitize($input)
{
	if(empty($input) & !is_numeric($input))
	{
		return NULL;
	}
}
function generateRandomNum($length = 6)
        {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0;$i < $length;$i++)
            {
                $randomString .= $characters[rand(0, $charactersLength - 1) ];
            }
            return $randomString;
        }
        
function generateRandomString($length = 10)
{
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0;$i < $length;$i++)
            {
                $randomString .= $characters[rand(0, $charactersLength - 1) ];
            }
            return $randomString;
}

function gensecret($length = 15)
{
            $characters = '123456789abcdefghijklmnop$@[]{}#!/\()ABCDEFJHIJKLMNOP';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0;$i < $length;$i++)
            {
                $randomString .= $characters[rand(0, $charactersLength - 1) ];
            }
            return "API-".$randomString;
}

class msg {
    public function success_js($msg){
        $var = '
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
                                title: "'.$msg.'"
                            })
                            
                    }
                    </script>
        
        ';
        return $var;
    }

    public function error_js($msg) {
        $var = '<script>
        msg();
        function msg() {

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
                    icon: "error",
                    title: "'.$msg.'"
                })
        }
    function send() {
            window.location.replace("http://stackoverflow.com");
        }
    }
    </script>';
        return $var;
    }
}
function blacklist_words(){
    $bad_words = ["Nigger", "NIGGER", "FUCK", "fuCk", "Fuck", "NiggA", "nigger", "nigga", "niglet", "nig", "fuck", "admin", "iAuth", "iauth", "iauth.cc", "://", "hacker", "hacked", "fag", "faggot", "fags", "poop", "cunt", "fuckoff", "keyauth", "auth.gg", "no", "yes", "guest", "user", "panel", "hacked"];
    return $bad_words;
}



function filter_special_characters(){
    $filter_vals = [
    "&", 
    "/", 
    "&amp;", 
    "&lt;", 
    "&gt", 
    ">", 
    "?", 
    "[", 
    "]", 
    "'", 
    "<", 
    ":", 
    "*", 
    "$", 
    "%", 
    "#",
    "@", 
    ",", 
    "!", 
    "(", 
    ")",
    "<",
    "^",
    "-"
];
    return $filter_vals;
}

class user {
	public function ranks($role) {
        $limit = 0; 
        if($role == 'guest') {
            $limit = 10;
        }
        
        if($role == 'basic'){
            $limit = 150; 
        }
	
	if($role == 'vip'){
	    $limit = 1500;
	}
	
	if($role == 'Vip'){
	    $limit = 1500;
	}

        if($role == 'premium'){
            $limit = 300;
        }
        if($role == 'ultimate'){
            $limit = 900;
        }

        if($role == 'enterprise'){
            $limit = 100000;
        }

        if($role == 'admin'){
            $limit = 100000;
        }
        return $limit;
    }
}

function wh_log($webhook, $msg, $un)
{
    $timestamp = date("c", strtotime("now"));

    $json_data = json_encode([
    "content" => $msg,
    "username" => "$un",

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

?>
