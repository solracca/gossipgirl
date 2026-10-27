<?php
session_start();
$_SESSION = [];
session_destroy();
header("Location: registro.php?cerrada=1");
exit;
?>