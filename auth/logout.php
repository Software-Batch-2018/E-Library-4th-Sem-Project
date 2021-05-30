<?php 

session_start();
session_destroy();
if (isset($_GET['redirect'])) {
    header('Location: ' . $_GET['redirect']);
} else {
    header("Location: /E-library/index.php");
}
?>