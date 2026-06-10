<?php 
    require_once 'my-lib/session.php';

    startSession();
    session_destroy();
    deleteFullSession();
    header('Location: /messages.php');
    exit;
?>