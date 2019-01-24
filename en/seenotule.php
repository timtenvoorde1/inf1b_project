<?php session_start();
    if(!isset($_SESSION['loggedin'])){
        header('Location: index.php');
    }?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Notulen</title>
        <link type="text/css" rel="stylesheet" href="../css/style.css">
        <link type="text/css" rel="stylesheet" href="../css/notulen.css">
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
                </div> 
            </div>  
            <div id="middlebox">
                <div id="tilecontainer">
                <?php
                    if(isset($_GET['notulen'])){
                        echo '<a href="shownotulen.php?notulen">Back</a>';
                    }
                    elseif(isset($_GET['agenda'])){
                        echo '<a href="shownotulen.php?agenda">Back</a>';
                    }
                ?>
                <?php
                    /*
                    * Programmer: Maurice Hoekstra
                    * Date Created: 17-01-2019
                    * Description: Agenda & Notule viewing
                    */
                    require '../DBFuncs.php';
                    if(isset($_GET['notulen'])){
                        $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                        $DBName = 'projectplenair';
                        $TableName = 'notulen';
                        $ID = filter_var($_GET['notulen'], FILTER_VALIDATE_INT);
                        if(TableExistCheck($DBConnect, $DBName, $TableName) === TRUE){
                            $Query = "SELECT Tekst"
                                    . " FROM ".$TableName
                                    . " WHERE AgendaNR = ? ;";
                            
                            if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                                mysqli_stmt_bind_param($stmt, 'i', $ID);
                                if(!mysqli_stmt_execute($stmt)){
                                    DBQueryError($DBConnect);
                                }
                                else{
                                    mysqli_stmt_bind_result($stmt, $Text);
                                    mysqli_stmt_store_result($stmt);
                                    if (mysqli_stmt_num_rows($stmt) == 0) {
                                        echo "<p>The minute does exist</p>";
                                    }
                                    else{
                                        while (mysqli_stmt_fetch($stmt)) {
                                            echo $Text;
                                        }         
                                    }

                                }
                                mysqli_stmt_close($stmt);
                            }
                            else{
                                DBQueryError($DBConnect);
                            }
                        }
                    mysqli_close($DBConnect);
                    }
                    if(isset($_GET['agenda'])){
                        $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                        $DBName = 'projectplenair';
                        $TableName = 'agenda';
                        $ID = filter_var($_GET['agenda'], FILTER_VALIDATE_INT);
                        if(TableExistCheck($DBConnect, $DBName, $TableName) === TRUE){
                            $Query = "SELECT Tekst"
                                    . " FROM ".$TableName
                                    . " WHERE AgendaNR = ? ;";
                            
                            if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                                mysqli_stmt_bind_param($stmt, 'i', $ID);
                                if(!mysqli_stmt_execute($stmt)){
                                    DBQueryError($DBConnect);
                                }
                                else{
                                    mysqli_stmt_bind_result($stmt, $Text);
                                    mysqli_stmt_store_result($stmt);
                                    if (mysqli_stmt_num_rows($stmt) == 0) {
                                        echo "<p>The Agenda does not exist!!</p>";
                                    }
                                    else{
                                        while (mysqli_stmt_fetch($stmt)) {
                                            echo '<p>Meeting points:</p><p>'.$Text.'</p>';
                                        }         
                                    }

                                }
                                mysqli_stmt_close($stmt);
                            }
                            else{
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


