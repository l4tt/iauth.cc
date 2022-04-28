<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content="iAuth - authorization/authentication focused application interface working hard to become every developers companion in overall security & software integration" property="og:description" />
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="#">
    <meta property="twitter:title" content="iAuth | Authentication Service">
    <meta property="twitter:description" content="iAuth - authorization/authentication focused application interface working hard to become every developers companion in overall security & software integration">
    <meta property="twitter:image" content="https://cdn.discordapp.com/attachments/931729633827754034/936450519029923850/ezgif-6-b2d1a281a3.gif">

    <meta content="#" property="og:url" />
    <meta name="theme-color" content="#343a40">

	<title>IAuth</title>

	<link rel="preconnect" href="//fonts.gstatic.com/" crossorigin="">

	<!-- PICK ONE OF THE STYLES BELOW -->
	<link href="app_assets/css/classic.css" rel="stylesheet"> 
	<!-- <link href="css/corporate.css" rel="stylesheet"> -->
	<!-- <link href="css/modern.css" rel="stylesheet"> -->

	<!-- BEGIN SETTINGS -->
	<!-- You can remove this after picking a style -->
	<style>
		body {
            
			opacity: 0;
		}
	</style>
	<script src="app_assets/js/settings.js"></script>
	<!-- END SETTINGS -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-120946860-6');
</script></head>
<style>
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
<style>

.fade-in {
  animation: fadeIn ease 2s;
  -webkit-animation: fadeIn ease 2s;
  -moz-animation: fadeIn ease 2s;
  -o-animation: fadeIn ease 2s;
  -ms-animation: fadeIn ease 2s;
}


@keyframes fadeIn{
  0% {
    opacity:0;
  }
  100% {
    opacity:1;
  }
}

@-moz-keyframes fadeIn {
  0% {
    opacity:0;
  }
  100% {
    opacity:1;
  }
}

@-webkit-keyframes fadeIn {
  0% {
    opacity:0;
  }
  100% {
    opacity:1;
  }
}

@-o-keyframes fadeIn {
  0% {
    opacity:0;
  }
  100% {
    opacity:1;
  }
}

@-ms-keyframes fadeIn {
  0% {
    opacity:0;
  }
  100% {
    opacity:1;
  }
}
.rankprem {
  color: gold;
  background-image: url('https://cdn.discordapp.com/attachments/937058297910026301/937927300782104576/gold.gif');
  font-weight: bold;
}
.basic {
  color: #47bac1;
}
</style>

<?php
include '../../etc/other/db.php';
include '../../etc/other/func.php';

session_start();

if(isset($_SESSION['login']) & ($_SESSION['login'] == true)){
    

    if($_SESSION['first_login'] == "yes"){
        
        echo "
        <script>
        window.onload = () => {
            Swal.fire({
                title: 'Welcome ".htmlspecialchars(strtoupper($_SESSION['username']))."',
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Logout',
                color: '#fff',
                background: '#343a40',
                confirmButtonText: 'Continue'
            }).then((result) => {
                console.log(result);
                if (!result.isConfirmed) {
                    window.location = '../logout.php';
                }
            })
        }
        </script>
        ";
        #echo success_js("Welcome to your panel ".htmlspecialchars($_SESSION['username'])."");
        
        $_SESSION['first_login'] = "no";
    }
    
}else{
    header("Location: ../Login/");
    die();
}


?>

<body>
    
	<div class="wrapper">
		<nav id="sidebar" class="sidebar" style="background-color: #343a40;">
			<div class="sidebar-content" style="background-color: #343a40;">
				<a class="sidebar-brand" href="index.php">
          <i class="align-middle" style="color: #fff;" data-feather="lock"></i>
          <span class="align-middle">iAuth Panel</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Main
					</li>
					<li class="sidebar-item active">
						<a href="#dashboards" data-toggle="collapse" class="sidebar-link" style="background-color: #343a40;">
              <i class="align-middle" data-feather="sliders" style="background-color: #343a40;"></i> <span class="align-middle">Dashboard</span>
            </a>
						<ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show" data-parent="#sidebar" style="background-color: #343a40;">
							<li class="sidebar-item"><a style="background-color: #343a40;" class="sidebar-link" href="app/"><i  data-feather="box" style="color: #fffff;"></i>Apps</a></li>
							<li class="sidebar-item"> <a style="background-color: #343a40;" class="sidebar-link" href="app/keys"><i  data-feather="key" style="color: #fffff;"></i>Licenses</a></li>
							<li class="sidebar-item"><a style="background-color: #343a40;" class="sidebar-link" href="app/users"><i  data-feather="users" style="color: #fffff;"></i>Users</a></li>
							<li class="sidebar-item"><a  style="background-color: #343a40;" class="sidebar-link" href="app/blacklist"><i  data-feather="user-x" style="color: #fffff;"></i>Blacklist</a></li>
							<li class="sidebar-item"><a style="background-color: #343a40;" class="sidebar-link" data-sellix-product="61f210321aef0" type="submit" alt="Buy subscription for iAuth"><i  data-feather="star" style="color: #fffff;"></i>Upgrade <span class="sidebar-badge badge badge-primary">New</span></a></li>
						</ul>
					</li>
			
		</nav>
        <div class="main" style="background-color: #212529;">
			<nav style="background-color: #343a40;" class="navbar navbar-expand">
				<a class="sidebar-toggle d-flex mr-2">
          <i class="hamburger align-self-center"></i>
        </a>

				<form class="form-inline d-none d-sm-inline-block" >
				</form>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ml-auto" >
						<li class="nav-item dropdown">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

              <i class="align-middle <?php if($_SESSION['role'] == 'Vip' || $_SESSION['role'] == 'Premium') { echo "rankprem";} else { echo "basic";} ?>" style=" !important; margin-left: 10px;" data-feather="shield"></i> <span  class="text-light"><?php echo htmlspecialchars($_SESSION['role']);?></span>
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                            <i class="align-middle" style="color: #0000000;" data-feather="user"></i> <span  class="text-light"><?php echo htmlspecialchars($_SESSION['username']);?></span>
              </a>
							<div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item">Using app: <?php echo htmlspecialchars($_SESSION['app_name']);?> </a>
                <a class="dropdown-item" href="../logout.php">Logout</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<div class="fade-in">