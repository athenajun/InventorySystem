<?php
session_start();
session_destroy();

// Delete cookie
if (isset($_COOKIE['username'])) {
    setcookie("username", "", time() - 3600, "/"); // Expire cookie
}

echo "You have been logged out.";
?>
