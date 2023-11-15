<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();
 
// Redirect to sign in page
header("location: ../signin");
exit;

?>
