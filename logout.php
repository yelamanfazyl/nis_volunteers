<?php 
    require $_SERVER["DOCUMENT_ROOT"].'/utils/bd.php';
    session_destroy();
    header("Location: /index.php");
    die();
?>