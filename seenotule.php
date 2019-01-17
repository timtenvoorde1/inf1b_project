<?php session_start();
    if(!isset($_SESSION['loggedin'])){
        header('Location: index.php');
    }?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Notulen</title>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/notulen.css">
    </head>
    <body>
        <div id="mainContainer">
            <div id="header">
                <div id="logo">
                    <img src="img/stenden.png" alt="NHL_STENDEN"> 
                </div>
                <div id="headertxt">
                    
                </div>
            </div> 
            <div id="middlebox">
                <div id="tilecontainer">
                <?php
                    if(isset($_GET['notulen'])){
                        echo '<a href="shownotulen.php?notulen">Terug</a>';
                    }
                    elseif(isset($_GET['agenda'])){
                        echo '<a href="shownotulen.php?agenda">Terug</a>';
                    }
                ?>
                <?php
                    /*
                    * Programmer: Maurice Hoekstra
                    * Date Created: 17-01-2019
                    * Description: Agenda & Notule viewing
                    */
                    require 'DBFuncs.php';
                    if(isset($_SESSION['admin'])){
                        echo '<a href="createplenagenda.php">Creëer agenda</a>';
                        echo '<a href="assignnotulen.php">Selecteer een student om de volgende notulen te uploaden:</a>';
                    }
                    if(isset($_GET['notulen'])){
                        $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                        $DBName = 'projectplenair';
                        $TableName = 'notulen';
                        if(TableExistCheck($DBConnect, $DBName, $TableName) === TRUE){
                                $Query = "";
                                if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                                    if(!mysqli_stmt_execute($stmt)){
                                        DBQueryError($DBConnect);
                                    }
                                    else{
                                        mysqli_stmt_bind_result($stmt, $AgendaNR, $Name,
                                                                $Year, $Period, $Week);
                                        mysqli_stmt_store_result($stmt);
                                        if (mysqli_stmt_num_rows($stmt) == 0) {
                                            echo "<p>De notule bestaat niet!</p>";
                                        }
                                        else{
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "<tr>
                                                    <td>".$Year." Periode ".$Period." Week ".$Week."</td>
                                                    <td>".$Name."</td>
                                                    <td><a href='seenotule.php?notule=".$AgendaNR."'>Bekijk Notule</a></td>
                                                    </tr>";
                                                }

                                        
                                    }
                                
                                }
                                mysqli_stmt_close($stmt);
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


