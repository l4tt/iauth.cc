<?php
session_start();
if(isset($_SESSION) & !empty($_SESSION)){
    session_destroy();
    die(header("Location: Login/"));
}
?>