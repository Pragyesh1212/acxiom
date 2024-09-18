<?php
session_start();

// Destroy session
session_destroy();

// Redirect to index page
header("Location: index1.php");
exit;
?>