<?php

include 'root/config.php';
unset($_SESSION['aid']);
unset($_SESSION['email']);
$ai_core->aiGoPage('index.php');
?>
