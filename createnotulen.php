<?php session_start();
    if(!isset($_SESSION['loggedin'])){
        header('Location: index.php');
    }?>
<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Notulen</title>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/notulen.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    
                </div>
            </div> 
            <div id="middlebox">
                
                <div id="tilecontainer">
                    <div class="notulenupload">
                        <?php
                            /*
                              * Programmer: Maurice Hoekstra
                              * Date Created: 10-01-2019
                              * Description: Notule upload functionality
                            */
                            require "DBFuncs.php";
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
                                            echo "<p>Je hebt geen notulen aangewezen gekregen</p>";
                                        }
                                        else{
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo '  
                                                <div class="notuledit">
                                                    <h2>Notulen van Jaar '.$Year.' Periode '.$Period.' Week '.$Week.'<h2>
                                                    <form action="'.htmlentities($_SERVER['PHP_SELF']).'" method="POST">
                                                    <input type="hidden" name="id" value="'.$AgendaNR.'">
                                                    <p>Aanwezige docenten</p>
                                                    <textarea name="presentteachers"></textarea>
                                                    <p>Afwezige studenten</p>
                                                    <textarea name="absentees"></textarea>
                                                    <p>Opening</p>
                                                    <textarea name="opening"></textarea>
                                                    <p>Mededelingen</p>
                                                    <textarea name="announcements"></textarea>
                                                    <p>Rondvraag</p>
                                                    <textarea name="questions"></textarea>
                                                    <p>Informatie</p>
                                                    <textarea name="information"></textarea>

                                                    <input type="submit" name="submit" value="Opsturen">
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
                                    $Text = "<p>Aanwezige docenten</p><p>".
                                            filter_var($_POST['presentteachers'], FILTER_SANITIZE_STRING) .
                                            "</p><p>Afwezige studenten</p><p>".
                                            filter_var($_POST['absentees'], FILTER_SANITIZE_STRING) .
                                            "</p><p>Opening</p><p>".
                                            filter_var($_POST['opening'], FILTER_SANITIZE_STRING) .
                                            "</p><p>Mededelingen</p><p>".
                                            filter_var($_POST['announcements'], FILTER_SANITIZE_STRING) .
                                            "</p><p>Rondvraag</p><p>".
                                            filter_var($_POST['questions'], FILTER_SANITIZE_STRING) .
                                            "</p><p>Informatie</p><p>".
                                            filter_var($_POST['information'], FILTER_SANITIZE_STRING).
                                            "</p>";
                                    $ID = filter_var($_POST['id'],FILTER_VALIDATE_INT);
                                    $UpdateQuery = 'UPDATE `'.$TableName.
                                    '` SET Tekst = ? ,'
                                    . ' WHERE AgendaNR = ?';
                                    if ($stmt = mysqli_prepare($DBConnect, $UpdateQuery)) {
                                        mysqli_stmt_bind_param($stmt, 'si', $Text, $ID);

                                        if(!mysqli_stmt_execute($stmt)){
                                            DBQueryError($DBConnect);
                                        }
                                        else{
                                            "Notule is verzonden";
                                        }
                                    }
                                    else{
                                        DBQueryError($DBConnect);
                                    }
                                }
                            }
                        mysqli_close($DBConnect);
                        ?>    
                    </div>
                </div>
            </div>
            <div id="footer" >
                <div id="footercontainer" >
                    <div id="footersearch">
                        <div id="search">
                            <input type="text" placeholder="Zoeken..." class="zoektext">
                        </div>
                    </div>
                    <div id="footerinfo">
                        <div class="footertext" >
                            <p class="textfooter"> Contact </p>
                        </div>
                        <div class="footertext" >
                            <p class="textfooter"> Disclaimer </p>
                        </div>
                        <div class="footertext" >
                            <p class="textfooter"> &copy; NHL Stenden </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
