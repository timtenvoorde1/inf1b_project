<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
if (isset($_SESSION['admin']) && isset($_GET['ID'])) {
    $ID = $_GET['ID'];
} else {
    header('Location: tips.php');
}