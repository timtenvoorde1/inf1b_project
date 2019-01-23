<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="nl">
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/inlog.css">
        <link rel="stylesheet" type="text/css" href="css/groepen.css"
              <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Groepsindeling</title>
    </head>
    <body>
        <div id="mainContainer">
            <div id="header">
                <div id="logo">
                    <a href="StartPage.php">
                        <img src="img/stenden.png" alt="NHL_STENDEN"> 
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
                            <li><a href="logout.php" >Uitloggen</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div id="middlebox">
                <div class="groepenpage">
                    <ul>
                        <li><a href="showgroepen.php?groepen">Groepsindelingen</a></li>

                    </ul>
                </div>

                <?php
                require 'DBFuncs.php';

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_GET['groepen'])) {
                        $conn = DBHandshake('127.0.0.1', 'root', '');
                        $db_name = 'projectplenair';
                        $tb_name = 'groepsindeling';

                        if (TableExistCheck($conn, $db_name, $tb_name)) {
                            $query = "SELECT ID, Cohort, Schooljaar, Periode, ImagePath FROM " . $tb_name . " ORDER BY " . $tb_name . " Cohort DESC;";

                            if ($stmt = mysqli_prepare($conn, $query)) {
                                if (!mysqli_stmt_execute($stmt)) {
                                    DBQueryError($conn);
                                } else {
                                    mysqli_stmt_bind_result($stmt, $ID, $Cohort, $Year, $Period, $Week);
                                    mysqli_stmt_store_results($stmt);

                                    if (mysqli_stmt_num_rows($stmt) == 0) {
                                        echo "<p>Er zijn geen groepindeling fotos!</p>";
                                    } else {
                                        echo "<table>";
                                        echo "<tr>
						<th>Cohort</th>
						<th>Schooljaar</th>
						<th>Periode</th>
						<th>ImagePath</th>
						</tr>";
                                        while (mysqli_stmt_fetch($stmt)) {
                                            echo "<tr>
						<td><p>" . $Cohort . "</p></td>
						<td><p>" . $Schooljaar . "</p></td>
						<td><p>" . $Periode . "</p></td>
						<td><p><img src=" . $ImagePath . " alt='groep'></p></td>
						</tr>";
                                        }
                                        echo "</table>";
                                    }
                                }
                                mysqli_stmt_close($stmt);
                            } else {
                                DBQueryError($conn);
                            }
                        }
                    }
                    mysqli_close($conn);
                }
                ?>
            </div>
            <?php include 'footer.html'; ?>
        </div>
    </body>
</html>