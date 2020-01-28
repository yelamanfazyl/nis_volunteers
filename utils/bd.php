<?php    
    require $_SERVER["DOCUMENT_ROOT"].'/assets/libs/rb.php';

    $host = 'localhost';
    $dbname = 'novel_volunters';
    $username = 'novel_novel_ela';
    $password = 'elaman10082003';

    R::setup('mysql:host='.$host.';dbname='.$dbname,$username,$password);

    $testconnection = R::testConnection();

    session_start();
?>