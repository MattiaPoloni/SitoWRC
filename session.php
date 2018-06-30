<?php
include('connessione.php');
session_start();

$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($connessione,"select user from Amministratore where user = '$user_check' ");

$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

if(!isset($_SESSION['login_user'])){
    header("location:login.php");
}
