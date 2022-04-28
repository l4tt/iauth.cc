

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<?php 
include 'header.php';

function keygen(){
    return strtoupper(uniqid(rand(0,99))."-".generateRandomString()."-".uniqid(rand(0,5)));
}

?>
<style>
.select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
  color: #fff;
  padding: 0;
}

.select {
    
    
    margin-left: 30px;
}
.blur {
    color: transparent !important;
    text-shadow: 0px 0px 5px #b2b9bf;
    transition: text-shadow 0.4s linear;
}
.blur:hover {
    text-shadow: 0px 0px 0px #b2b9bf;
}

.select2-container--bootstrap4.select2-container--open.select2-container--above .select2-selection {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  border-top-color: transparent;
}
.select2-container--bootstrap4 .select2-selection {
    background-color: #343a40;
    border: 1px solid #ced4da;
    border-top-color: rgb(206, 212, 218);
    border-right-color: rgb(206, 212, 218);
    border-bottom-color: rgb(206, 212, 218);
    border-left-color: rgb(206, 212, 218);
    border-radius: .2rem;
    border-top-left-radius: 0.2rem;
    border-top-right-radius: 0.2rem;
    color: white;
    font-size: .875rem;
    outline: 0;
}
.input-group-text {
    display: -webkit-box;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    padding: 0.25rem 0.7rem;
    margin-bottom: 0;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    text-align: center;
    white-space: nowrap;
    background-color: transparent;
    border: 1px solid #ced4da;
    border-radius: 0.2rem;
}
.select2-container--bootstrap4 .select2-selection {
  background-color: #343a40;
  border: 1px solid #ced4da;
  border-radius: .2rem;
  color: white;
  font-size: .875rem;
  outline: 0;
}
.form-control {
    display: block;
    width: 100%;
    height: calc(1.8125rem + 2px);
    padding: 0.25rem 0.7rem;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: transparent;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.2rem;
    -webkit-transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.form-control:focus {
    color: #fff;
    background-color: transparent;
    
}
@media (pointer:none), (pointer:coarse) {
    
    .content {
    width: min-content;
    max-width: min-content;
    }
}

.fa-search:before {
    content: "\f002";
    color: white;
}
.dropdown-item {
    display: block;
    width: 100%;
    padding: 0.35rem 1.5rem;
    clear: both;
    font-weight: 400;
    color: black;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}
.dropdown-item:focus {
    display: block;
    width: 100%;
    padding: 0.35rem 1.5rem;
    clear: both;
    font-weight: 400;
    color: black;
    text-align: inherit;
    white-space: nowrap;
    background-color: blueviolet;
    border: 0;
}
.menu:hover {
    background-color: blueviolet;

}
.page-link {
    position: relative;
    display: block;
    padding: 0.3rem 0.75rem;
    margin-left: -1px;
    line-height: 1.80;
    color: #fff;
    background-color: transparent;
    border: 1px solid #dee2e6;
}
</style>
<?php

if($_SESSION['role'] == 'guest'){
    $limit = 10;
}else{
    $limit = 15;
}
  
if (isset($_GET["p"])) {
	$page  = $_GET["p"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $limit;  

?>


<main class="content">
				<div class="container-fluid p-0" style="width:auto; height:auto;">
                    
							
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
                            ?>



<script>
    function myFunction() {
    /* Get the text field */
    var p1 = document.getElementById("copytable");

    // set "#Color 1" with the hidden field so that you can call select on it
    var hiddenField = document.getElementById("copytable");
    hiddenField.value = p1.innerHTML;
    hiddenField.select();
    document.execCommand("copy");

    alert("Copied the text: " + hiddenField.value);
} 
</script>


<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$(function () {
    $(".select").select2({
    
    color: "transparent"
});})

</script>
<main class="content">
<div class="container-fluid p-0" >
<div class="card p-3 p-lg-4" style="background-color: #343a40; width:auto; height:auto;">


                                <div style="width: auto; !important;" class="input-group mb-3">
                                <h2 style="color: #fff;"> Key Management </h2><br>

                                <div class="input-group-append">
                                    
                                    
                                
                                    <div class="modal fade" id="Deleteform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: transparent;">
                                                    <div class="modal-dialog modal-dialog-centered" role="document" >
                                                        <div class="modal-content"style="background-color: #343a40">
                                                        <div class="modal-header" style="background-color: #343a40">
                                                            <h3 class="modal-title" style="color: #fff;" id="exampleModalLabel">Create Keys</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form method="post">
                                                        <h4 data-toggle="tooltip" data-placement="left" title="Amount of keys to create"  style="color: #fff;">Amount</h4>
                                                        <input type="number" style= "color: #fff !important; height: auto; !important; background-color: #343a40 !important;" name="am" class="form-control" placeholder="1-<?php echo user::ranks($_SESSION['role']); ?>" aria-label="am" name="am" aria-describedby="button-addon2">
                                                        <br>
                                                        <h4 style="color: #fff;" data-toggle="tooltip" data-placement="left" title="set your key prefix example (IAUTH-XXXX-XXXX-XXXX)">Key prefix</h4>
                                                        <input type="text" style= "color: #fff !important; height: 40px; !important; background-color: #343a40 !important;" name="prefix" class="form-control" placeholder="IAUTH" aria-label="prefix" name="prefix" aria-describedby="button-addon2">
                                                        <br>
                                                        <h4 style="color: #fff;" data-toggle="tooltip" data-placement="left" title="Coming soon!">License Level</h4>
                                                        <input type="text" style= "color: #fff !important; height: 40px; !important; background-color: #343a40 !important;" name="level" class="form-control" placeholder="DEFAULT" aria-label="level" name="level" aria-describedby="button-addon2" disabled>
                                                        <br><h4 style="color: #fff;">Expires</h4>
                                                        
                                            
                                                        <select name="expiry" class="select"><option value="86400">Days</option><option value="60">Minutes</option><option value="3600">Hours</option><option value="1">Seconds</option><option value="604800">Weeks</option><option value="2629743">Months</option><option value="31556926">Years</option><option value="315569260">Lifetime</option></select>
                                                        <br><h4 style="color: #fff;">Expire time</h4>
                                                        <input type="number" style= "color: #fff !important; height: 40px; !important; background-color: #343a40 !important;" name="exptime" class="form-control" placeholder="1-999999" aria-describedby="button-addon2">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" style="height: 40px;" name="create_key" value="True" class="btn btn-success">Create</button>
                                                            
                                                            <button type="button" style="height: 40px; margin-left: 10px;" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    </div>
                                                    <div class="modal fade" id="Deletekeys" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: transparent;">
                                                    <div class="modal-dialog modal-dialog-centered" role="document" >
                                                        <div class="modal-content"style="background-color: #343a40">
                                                        <div class="modal-header" style="background-color: #343a40">
                                                            <h3 class="modal-title" style="color: #fff;" id="exampleModalLabel">Delete Keys</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="color: #fff;">
                                                            are u sure that you want to delete all <?php echo htmlspecialchars(trim(strip_tags($_SESSION['app_name']))) ?> keys?
                                                        </div>
                                                        <div class="modal-footer">
                                                        <form method="post">
                                                            <button type="submit" style="height: 40px;" name="delete" value="<?php echo $_SESSION['app_secret'] ?>" class="btn btn-danger">Delete</button>
                                                            
                                                            <button type="button" style="height: 40px;" class="btn btn-success" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </form>
                                
                                </div><br>
                                
                                
                                </div>

                                <div class="mb-4">


</form>
                                <br><button class="btn btn-dark btn-primary" style="width: 140px; height: 40px; margin-left: auto;" value="<?php echo $_SESSION['app_secret']; ?>" data-toggle="modal" data-target="#Deleteform" type="button" id="button-addon2">Create key</button>
                                <button class="btn btn-info btn-danger" style="width: 140px; height: 40px; margin-left: auto;" name="delete" value="<?php echo $_SESSION['app_secret']; ?>" type="submit" data-toggle="modal" data-target="#deletekeys" id="button-addon2">Delete all keys</button> 
                                <button class="btn btn-success btn-primary" style="width: 140px; height: 40px; margin-left: auto;" onclick="myFunction()" type="submit" id="button-addon2" disabled>Copy</button> 
                                
                                
                                
                                <button class="btn btn-info btn-primary" style="width: 140px; height: 40px; margin-left: auto;" type="submit" id="button-addon2" disabled>Download Keys</button> 
                                

                            </div>
                                <div class="form-group" style="margin-left: auto; width: auto; color: #fff; background: transparent;">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i>
</span>
                                        </div>
                                        <input type="text" id="myInput" onkeyup="search()" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1"></input>
                                    </div>
                                </div>
                            
                                <table class="table table-dark" style="border-color: transparent; width:auto; height:auto;" id="copytable">
                                    <thead>
                                        <tr>
                                        
                                        <th scope="col">Key</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Expires</th>
                                        <th scope="col">Ban Status</th>
                                        <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    <?php
                                    $sql = "SELECT * FROM `app` WHERE client_secret=? LIMIT {$start_from}, {$limit}";
                                    $result = $db->prepare($sql);
                                    $result->execute(array($_SESSION["app_secret"]));
                                    $count = $result->rowCount();
                                    $res = $result->fetchall();

                                    $sql = "SELECT count(*) FROM `app` WHERE client_secret = ?"; 
                                    $result = $db->prepare($sql); 
                                    $result->execute(array($_SESSION["app_secret"])); 
                                    $number_of_rows = $result->fetchColumn(); 
                                    
                                    if(!$count == 0){
                                        foreach($res as $row){
                                            $exp = $row["exp"] / 86400;
                                            echo '
                                            <tr>
                                            <td style="font-weight:bold; font-size:13px; width:auto; height:auto;">'.$row["api_key"].'</td>
                                            <td style="font-weight:bold; font-size:13px;">'.$row["status"].'</td>
                                            <td style="font-weight:bold; font-size:13px;">'.$exp.' Days</td>
                                            <td style="font-weight:bold; font-size:13px;">'.$row['ban'].'</td>
                                            <td>
                                            <div class="dropdown">
	<button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</button>
	<div style="color: #fff; background-color: blueviolet;" class="dropdown-menu dropdown-menu-dark bg-dark menu">
        <form method="post">
		<button style="background: transparent; border: none; width: 100%; border-color: transparent; focus{ border: none; }" type="submit" name="deletekey" value="'.$row["api_key"].'"><a style="color: #fff;" class="dropdown-item menu">Delete</a></button>
		<button style="background: transparent; border: none; width: 100%;" type="submit" disabled><a style="color: #fff;" class="dropdown-item menu" href="#">Ban</a></button>
		<button style="background: transparent; border: none; width: 100%;" type="submit" disabled><a style="color: #fff;" class="dropdown-item menu" href="#">Edit</a></button>
	</div>
</div> </form>
                                            
                                        
                                            </td> 
                                            </tr>
                                            
                                            
                                            
                                            ';
                                            
                                        }
                                        echo "</tbody>
                                        </table><br>";
                                        global $number_of_rows;
                                        $total_pages = ceil($number_of_rows / $limit); 
                                            /* echo  $total_pages; */
                                        $pagLink = "<ul style='margin-left:auto;' class='pagination'>";  
                                        for ($i=1; $i<=$total_pages; $i++) {
                                                $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?p=".$i."'>".$i."</a></li>";	
                                        }
                                        echo "<h4 style='margin-left: auto; margin-top: auto; color: #fff; font-weight:bold; font-size:14px;' id='res'>Showing ".$limit." entries out of ".$number_of_rows."</h4>";
                                        echo $pagLink . "</ul>";  
                                        
                                    }    
                                    ?>
                                <div>
                                </div> </div> </main>
<?php
if(!empty($_SESSION['errors'])){
    echo $_SESSION['errors'];
    $_SESSION['errors'] = ""; 
}
if(!empty($_SESSION['suc'])){
    echo $_SESSION['suc'];
    $_SESSION['suc'] = ""; 
}

if(isset($_GET['p'])){
    if($_SESSION['role'] == "guest"){
        if($_GET['p'] > 6){
            $_SESSION['errors'] = msg::error_js("Please buy a subscription to access more pages");
            die('<script>history.go(-1);</script>');
            
        }
    }
}

if(isset($_POST['deletekey']) & !empty($_POST['deletekey'])){
    $sql = "SELECT * FROM `app` WHERE api_key=?";
    $result = $db->prepare($sql);
    $result->execute(array(strip_tags(trim($_POST['deletekey']))));
    $count = $result->rowCount();
    $res = $result->fetch(PDO::FETCH_ASSOC);
    if($res){
        if(!$res['app'] == $_SESSION['app_name']){
            echo msg::error_js("this key does not belong to your application");
            return;
        }
        $sql = "DELETE FROM `app` WHERE api_key = ?";
        $db->prepare($sql)->execute([strip_tags(trim($_POST['deletekey']))]);
        if($db){
            $_SESSION['suc'] = msg::success_js("Success deleted key from app!");
            echo "<meta http-equiv='Refresh' Content='0;'>";
        }
    } else {
        echo msg::error_js("this key is invalid and cannot be deleted!");
        return;
    }

}

if(isset($_POST['delete']) & !empty($_POST['delete'])){
    $secret = $_POST['delete'];

    if(!$secret == $_SESSION['app_secret']){
        echo msg::error_js("Looks like these keys belongs to your application");
        return;
    }
    $sql = "DELETE FROM `app` WHERE client_secret = ?";
    $db->prepare($sql)->execute([strip_tags($secret)]);
    if($db){
        $_SESSION['suc'] = msg::success_js("Success deleted all keys in app!");
        echo "<meta http-equiv='Refresh' Content='0;'>";
    }
    
}

if(isset($_POST['create_key']) & !empty($_POST['create_key'])){
    if(!$_POST['create_key'] == "True"){
        return;
    }
    if(empty($_POST['exptime'])){
        echo msg::error_js("Expiry field must not be empty");
        return;
    }
    if(!intval($_POST['exptime'])){
        echo msg::error_js("Expiry field must be a integer");
        return;
        
    }
    $amount = $_POST['am'];
    $prefix = strtoupper($_POST['prefix']);
    $expint = $_POST['expiry'];
    $exptime = $_POST['exptime'];
    
    if($_SESSION['role'] == "guest"){
       // little bug here
        $limit = user::ranks($_SESSION['role']); 
        if(intval($number_of_rows) > $limit){
            echo msg::error_js("Looks like you have already created the max amount of keys for this app, Please upgrade to create more");
            return;
        }
        if($amount > $limit){
            echo msg::error_js("You can't create more then {$limit} keys as a guest user to create more please upgrade");
            return;
        }
    }

    if(!intval($amount)){
        echo msg::error_js("Something went wrong with the backend, contact iAuth staff");
        return;
    }
    
    if(!intval($expint)){
        echo msg::error_js("Something went wrong with the backend, contact iAuth staff");
        return;
    }


    if(empty($_POST['prefix'])){
        $prefix = "IAUTH";
    } else {
        
        if(is_numeric($_POST['prefix'])){
            echo msg::error_js("Key prefix must be a valid string");
            return; 
        }
        if(strlen($_POST['prefix']) > 7){
            echo msg::error_js("Key prefix can't be longer than 7 characters");
            return; 
        }
        if(strlen($_POST['prefix']) < 2){
            echo msg::error_js("Key prefix can't be shorter than 2 characters");
            return; 
        }

        $prefix = filter_input(INPUT_POST, "prefix", FILTER_SANITIZE_STRING);

        if(outputs::strposa($prefix, filter_special_characters())){
            echo msg::error_js("Special characters not allowed in your prefix");
            return;
            
        }
    }



    if(!empty($exptime)){
        $newexp = $exptime * $expint;
        
    } else {
        $newexp = 978883823;
    }
    

    for ($i = 0;$i < $amount;$i++)
    {
        $api_key = strtoupper(strip_tags(trim($prefix)))."-".keygen();

        $sql = "INSERT INTO `app` (app, client_secret, api_key, exp, status, genby) VALUES ( :app, :client_secret, :api_key, :exp, :status, :genby)";
        $result = $db->prepare($sql);
        $values = array(
                                                ':app'     => strip_tags(trim($_SESSION['app_name'])),
                                                ':client_secret' => $_SESSION['app_secret'],
                                                ':api_key' => $api_key,
                                                ':exp' => $newexp,
                                                ':status' => "N/A",
                                                ':genby' => strip_tags(trim($_SESSION['username']))
                                                );
        $res = $result->execute($values);
        
    }
    echo "<meta http-equiv='Refresh' Content='0;'>";
    #echo msg::success_js("Key created!");

}

?>

<?php

if(!empty($errors)){
    foreach($errors as $error){
        echo msg::error_js($error);
        return;
    }
}
?>

<script>
function search() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  
  tr = table.getElementsByTagName("tr");
  if (tr) {
        inputVal = tr;
    }
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
    
      txtValue = td.textContent || td.innerText;
      
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
        
      } else {

        tr[i].style.display = "none";
      }
    } 
  }
}
</script>