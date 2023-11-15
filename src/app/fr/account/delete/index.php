<?php

// Initialize the session
session_start();
 
// Check if the user is not signed in, if no then redirect them to sign in page
if(!isset($_SESSION["signedIn"]) || isset($_SESSION["signedIn"]) && !$_SESSION["signedIn"] === true) {
    header("location: ../signin");
    exit;
};

// Include the config file
require_once "../../../config.php";

try {
    $id = $_SESSION['accountId'];
    $sql = "DELETE FROM account WHERE `account-id`=$id";

    if($db->exec($sql)) {
        // Unset all of the session variables
        $_SESSION = array();
        
        // Destroy the session.
        session_destroy();

        // Redirect to sign in page
        header("location: ../signin");
        exit;
    };
} catch(PDOException $e) {
    echo "Un problème s'est produit. Veuillez réessayer plus tard. Erreur: " . $e->getMessage();
    exit;
};

// Close connection
unset($db);

?>
