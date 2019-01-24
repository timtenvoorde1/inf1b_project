<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
if (isset($_SESSION['admin']) && isset($_GET['ID'])) {
    require "DBFuncs.php";
    $DBConnect = DBHandshake('127.0.0.1', 'root', '');
    $DBName = "projectplenair";
    $TableName = "feedbacksuggestie";
    if (TableExistCheck($DBConnect, $DBName, $TableName) === TRUE) {
        $Query = "DELETE FROM `feedbacksuggestie` WHERE `feedbacksuggestie`.`ID` = ?";
        if ($stmt = mysqli_prepare($DBConnect, $Query)) {
            $ID = $_GET['ID'];
            mysqli_stmt_bind_param($stmt, 's', $ID);
            $QueryResult = mysqli_stmt_execute($stmt);
            if ($QueryResult === FALSE) {
                echo "<p>Something went wrong!.</p>"
                . "<p>Error code "
                . mysqli_errno($DBConnect)
                . ": "
                . mysqli_error($DBConnect)
                . "</p>";
            } else {
                header('Location: tips.php');
            }
        } else {
            DBQueryError($DBConnect);
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($DBConnect);
} else {
    header('Location: tips.php');
}