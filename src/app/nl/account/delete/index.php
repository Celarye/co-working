<?php

// Initialize the session
session_start();
 
// Check if the user is not signed in, if no then redirect them to login page
if(isset($_SESSION["signedIn"]) && !$_SESSION["signedIn"] === true) {
    header("location: ../signin");
    exit;
}

// Include the config file
require_once "../../../config.php";

$id = $_SESSION['accountId'];

try {
    $sql = "DELETE FROM account WHERE `account-id`=$id";
    $db->exec($sql);

    // Unset all of the session variables
    $_SESSION = array();
    
    // Destroy the session.
    session_destroy();

    // Redirect to login page
    header("location: ../signin");
    exit;

} catch(PDOException $e) {
    echo "Er is iets misgegaan. Probeer het later nog eens. " . $e->getMessage();
}

// Close connection
unset($pdo);

?>
