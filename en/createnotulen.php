<?php session_start();
    if(!isset($_SESSION['loggedin'])){
        header('Location: index.php');
    }?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Notulen</title>
        <link type="text/css" rel="stylesheet" href="../css/style.css">
        <link type="text/css" rel="stylesheet" href="../css/notulen.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                            <li class=""><a href="createnotulen.php">NL</a></li>
                            <li class=""><a href="en/createnotulen.php">EN</a></li>
                        </ul>
                    </div>
                </div> 
            </div>
            <div id="middlebox">
                
                <div id="tilecontainer">
                    <div class="notulenupload">
                        <?php
                            /*
                              * Programmer: Maurice Hoekstra
                              * Date Created: 10-01-2019
                              * Description: Notulen upload functionality
                            */
                            require "../DBFuncs.php";
                            $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                            $DBName = "projectplenair";
                            $TableName = "notulen";
                            $Table2Name = "agenda";
                            if(TableExistCheck($DBConnect, $DBName, $TableName) === TRUE
                            && TableExistCheck($DBConnect, $DBName, $Table2Name) === TRUE){
                                    $Query = "SELECT ".$TableName.".AgendaNR, LeerlingNR, Schooljaar, Periode, WeekPeriode FROM ".$TableName.""
                                            . " JOIN ".$Table2Name
                                            ." ON ".$TableName.".AgendaNR = ".$Table2Name.".AgendaNR"
                                            . " WHERE LeerlingNR = ? ;";

                                    if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                                        mysqli_stmt_bind_param($stmt, 'i', $_SESSION['userID']);

                                    if(!mysqli_stmt_execute($stmt)){
                                        DBQueryError($DBConnect);
                                    }
                                    else{

                                        mysqli_stmt_bind_result($stmt, $AgendaNR, $LeerlingNR, $Year, $Period, $Week);
                                        mysqli_stmt_store_result($stmt);
                                        if (mysqli_stmt_num_rows($stmt) == 0) {
                                            echo "<p>You have not been assigned a minute</p>";
                                        }
                                        else{
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo '  
                                                <div class="notuledit">
                                                    <h2>Minutes of  '.$Year.' Period '.$Period.' Week '.$Week.'</h2>
                                                    <form action="'.htmlentities($_SERVER['PHP_SELF']).'" method="POST">
                                                    <input type="hidden" name="id" value="'.$AgendaNR.'">
                                                    <p>Present Teachers</p>
                                                    <textarea name="presentteachers"></textarea>
                                                    <p>Absentees</p>
                                                    <textarea name="absentees"></textarea>
                                                    <p>Opening</p>
                                                    <textarea name="opening"></textarea>
                                                    <p>Announcements</p>
                                                    <textarea name="announcements"></textarea>
                                                    <p>Questions</p>
                                                    <textarea name="questions"></textarea>
                                                    <p>Information</p>
                                                    <textarea name="information"></textarea>

                                                    <p><a href="shownotulen.php"><input type="submit" name="submit" value="Send"></a></p>
                                                    </form>
                                                </div>';
                                                }

                                        }
                                        mysqli_stmt_close($stmt);
                                    }
                                }
                                else{
                                    DBQueryError($DBConnect);
                                }
                                if(isset($_POST['submit'])){
                                    $Text = "<p>Present Teachers</p><p>".
                                            filter_var($_POST['presentteachers'], FILTER_SANITIZE_STRING) .
                                            "</p><p>Abscentees</p><p>".
                                            filter_var($_POST['absentees'], FILTER_SANITIZE_STRING) .
                                            "</p><p>Opening</p><p>".
                                            filter_var($_POST['opening'], FILTER_SANITIZE_STRING) .
                                            "</p><p>Announcements</p><p>".
                                            filter_var($_POST['announcements'], FILTER_SANITIZE_STRING) .
                                            "</p><p>Questions</p><p>".
                                            filter_var($_POST['questions'], FILTER_SANITIZE_STRING) .
                                            "</p><p>Information</p><p>".
                                            filter_var($_POST['information'], FILTER_SANITIZE_STRING).
                                            "</p>";
                                    $ID = filter_var($_POST['id'],FILTER_VALIDATE_INT);
                                    $UpdateQuery = 'UPDATE `'.$TableName.
                                    '` SET Tekst = ? '
                                    . 'WHERE AgendaNR = ?';
                                    if ($stmt = mysqli_prepare($DBConnect, $UpdateQuery)) {
                                        mysqli_stmt_bind_param($stmt, 'si', $Text, $ID);

                                        if(!mysqli_stmt_execute($stmt)){
                                            DBQueryError($DBConnect);
                                        }
                                        else{
                                            "<p>The minute has been send</p>";
                                        }
                                    }
                                    else{
                                        DBQueryError($DBConnect);
                                    }
                                }
                            }
                        mysqli_close($DBConnect);
                        ?>
                        <br>
                        <p><a href="shownotulen.php">&lt;&lt;Back</a></p>
                    </div>
                </div>
            </div>
            <?php include 'footer.html'; ?>
        </div>
    </body>
</html>
