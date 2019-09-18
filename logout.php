<?php
session_start();
if(session_destroy()){
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    header("location: login.php");
    exit();
}