<?php
    require_once 'Include/init.php';
    session_start();
    if(isset($_GET['url'])){
    $url = $_GET['url'];
    $url = explode('/',$url);
    }

?>

<?php require_once 'template.php';?>