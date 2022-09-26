<?php    
    require $_SERVER["DOCUMENT_ROOT"].'/assets/libs/rb.php';

    $host = 'localhost';
    $dbname = 'volun';
    $username = 'root';
    $password = '';

    R::setup('mysql:host='.$host.';dbname='.$dbname,$username,$password);

    $testconnection = R::testConnection();

    session_start();
?>