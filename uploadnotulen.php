<?php session_start()?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
                            $TableName = "notules";
                            if(TableExistCheck($DBConnect, $DBName, $TableName) === TRUE){
                                $Query = "SELECT NotuleID, PlenairDate FROM ".$TableName.""
                                        . " WHERE StudentID = ? ;";
                                if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                                    mysqli_stmt_bind_param($stmt, 'i', $_SESSION['userID']);
                                    if(!mysqli_stmt_execute($stmt)){
                                        DBQueryError($DBConnect);
                                    }
                                    else{
                                        mysqli_stmt_bind_result($stmt, $NotuleID, $PlenairDate);
                                        mysqli_stmt_store_result($stmt);
                                        if (mysqli_stmt_num_rows($stmt) == 0) {
                                            echo "<p>Je hebt geen notulen aangewezen gekregen</p>";
                                        }
                                        else{
                                            echo '
                                                <table>
                                                    <tr>
                                                        <th>Datum</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>';
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo '
                                                    <tr>
                                                        <td>'.$PlenairDate.'</td>
                                                        <form enctype="multipart/form-data" action="'.htmlentities($_SERVER['PHP_SELF']).'" method="POST">
                                                        <td>
                                                            <input id= "fileinput" name="notule" type="file"/>
                                                        </td>
                                                        <td>
                                                            <input type="submit" name="submit" value="Upload">
                                                        </td>
                                                        </form>
                                                    </tr>';
                                                }
                                                echo '</table>';
                                        }
                                        mysqli_stmt_close($stmt);
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
                            <input type="text" placeholder="Zoeken...">
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
