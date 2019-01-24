<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Notulen</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="../css/notulen.css">
        <link type="text/css" rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div id="mainContainer">
            <div id="header">
                <div id="logo">
                    <a href="StartPage.php">
                        <img src="../img/stenden.png" alt="NHL_STENDEN"> 
                    </a>
                </div>
                <div id="headertxt">
                    <div class="home">
                        <ul>
                            <li><a href="startpage.php">Home</a></li>
                        </ul>
                    </div>
                    <div class="login">
                        <ul>
                            <li><a href="logout.php" >Log out</a></li>
                        </ul>
                    </div>
                    <div class="language">
                        <ul>
                            <li>&#127760;</li>
                            <li class=""><a href="../shownotulen.php">NL</a></li>
                            <li class=""><a href="shownotulen.php">EN</a></li>
                        </ul>
                    </div>
                </div> 
            </div> 
            <div id="middlebox">
                <div id="notulentiles">
                    <ul>
                        <li><a href="shownotulen.php?notulen">See list of Minutes</a></li>
                        <li><a href="shownotulen.php?agenda">See list of Agendas</a></li>
                        <li><a href="createnotulen.php">Create Minutes</a></li>

                        <?php
                        /*
                         * Programmer: Maurice Hoekstra
                         * Date Created: 17-01-2019
                         * Description: Agenda & Notule viewing
                         */
                        require '../DBFuncs.php';
                        if (isset($_SESSION['admin'])) {
                            echo '<li><a href="createplenagenda.php">Create an agenda</a></li>';
                            echo '<li><a href="assignnotulen.php">Select a student to upload the next minute</a></li>';
                        }
                        ?>
                    </ul>
                </div>

                <div id="phpbox">
                    <?php
                    if (isset($_GET['notulen'])) {
                        $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                        $DBName = 'projectplenair';
                        $TableName = 'notulen';
                        $Table2Name = 'users';
                        $Table3Name = 'agenda';
                        if (TableExistCheck($DBConnect, $DBName, $TableName) === TRUE
                                AND TableExistCheck($DBConnect, $DBName, $Table2Name) === TRUE
                                AND TableExistCheck($DBConnect, $DBName, $Table3Name) === TRUE) {
                            $Query = "SELECT " . $TableName . ".AgendaNR , Naam , Schooljaar , Periode, WeekPeriode FROM " . $TableName . " "
                                    . " JOIN " . $Table2Name . " ON " . $TableName . ".LeerlingNR = " . $Table2Name . ".LeerlingNR "
                                    . " JOIN " . $Table3Name . " ON " . $TableName . ".AgendaNR = " . $Table3Name . ".AgendaNR "
                                    . " GROUP BY " . $TableName . ".LeerlingNR"
                                    . " ORDER BY " . $TableName . ".AgendaNR DESC;";
                            if ($stmt = mysqli_prepare($DBConnect, $Query)) {

                                if (!mysqli_stmt_execute($stmt)) {
                                    DBQueryError($DBConnect);
                                } else {
                                    mysqli_stmt_bind_result($stmt, $AgendaNR, $Name, $Year, $Period, $Week);
                                    mysqli_stmt_store_result($stmt);
                                    if (mysqli_stmt_num_rows($stmt) == 0) {
                                        echo "<p>There are no minutes!!</p>";
                                    } else {
                                        echo "<table>";
                                        echo "<tr>
                                                <th>Date</th>
                                                <th>Name Student</th>
                                                <th></th>
                                            </tr>";
                                        while (mysqli_stmt_fetch($stmt)) {
                                            echo "<tr>
                                                    <td>" . $Year . " Periode " . $Period . " Week " . $Week . "</td>
                                                    <td>" . $Name . "</td>
                                                    <td><a href='seenotule.php?notulen=" . $AgendaNR . "'>See Minutes</a></td>
                                                    </tr>";
                                        }
                                        echo "</table>";
                                    }
                                }
                                mysqli_stmt_close($stmt);
                            } else {
                                DBQueryError($DBConnect);
                            }
                        }
                        mysqli_close($DBConnect);
                    }
                    if (isset($_GET['agenda'])) {
                        $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                        $DBName = 'projectplenair';
                        $TableName = 'agenda';
                        if (TableExistCheck($DBConnect, $DBName, $TableName) === TRUE) {
                            $Query = "SELECT AgendaNR, Cohort, Schooljaar, Periode, WeekPeriode FROM " . $TableName . " "
                                    . " ORDER BY " . $TableName . ".AgendaNR DESC;";
                            if ($stmt = mysqli_prepare($DBConnect, $Query)) {

                                if (!mysqli_stmt_execute($stmt)) {
                                    DBQueryError($DBConnect);
                                } else {
                                    mysqli_stmt_bind_result($stmt, $AgendaNR, $Cohort, $Year, $Period, $Week);
                                    mysqli_stmt_store_result($stmt);
                                    if (mysqli_stmt_num_rows($stmt) == 0) {
                                        echo "<p>There are no agendas!</p>";
                                    } else {
                                        echo "<table>";
                                        echo "<tr>
                                                     <th>Cohort</th>
                                                     <th>Datum</th>
                                                     <th></th>
                                                 </tr>";
                                        while (mysqli_stmt_fetch($stmt)) {
                                            echo "<tr>
                                                    <td>" . $Cohort . "</td>
                                                    <td>" . $Year . " Periode " . $Period . " Week " . $Week . "</td>
                                                    <td><a href='seenotule.php?agenda=" . $AgendaNR . "'>See Agenda</a></td>
                                                    </tr>";
                                        }
                                        echo "</table>";
                                    }
                                }
                                mysqli_stmt_close($stmt);
                            } else {
                                DBQueryError($DBConnect);
                            }
                        }
                        mysqli_close($DBConnect);
                    }
                    ?>
                </div>
            </div>
            <?php include 'footer.html'; ?>
        </div>
    </body>
</html>
