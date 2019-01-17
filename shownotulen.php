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
                    <a href="shownotulen.php?notulen">Zie lijst van notulen</a>
                    <a href="shownotulen.php?agenda">Zie lijst van agendas</a>
                    <a href="createnotulen.php">Creëer notulen</a>
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
                        $Table2Name = 'users' ;
                        $Table3Name = 'agenda';
                        if(TableExistCheck($DBConnect, $DBName, $TableName) === TRUE
                        AND TableExistCheck($DBConnect, $DBName, $Table2Name) === TRUE
                        AND TableExistCheck($DBConnect, $DBName, $Table3Name) === TRUE){
                                $Query = "SELECT ".$TableName.".AgendaNR , Naam , Schooljaar , Periode, WeekPeriode FROM ".$TableName." "
                                        . " JOIN ".$Table2Name." ON ".$TableName.".LeerlingNR = ".$Table2Name.".LeerlingNR "
                                        . " JOIN ".$Table3Name." ON ".$TableName.".AgendaNR = ".$Table3Name.".AgendaNR " 
                                        . " GROUP BY ".$TableName.".LeerlingNR"
                                        . " ORDER BY ".$TableName.".AgendaNR DESC;";
                                if ($stmt = mysqli_prepare($DBConnect, $Query)) {

                                    if(!mysqli_stmt_execute($stmt)){
                                        DBQueryError($DBConnect);
                                    }
                                    else{
                                        mysqli_stmt_bind_result($stmt, $AgendaNR, $Name,
                                                                $Year, $Period, $Week);
                                        mysqli_stmt_store_result($stmt);
                                        if (mysqli_stmt_num_rows($stmt) == 0) {
                                            echo "<p>Er zijn geen notulen!</p>";
                                        }
                                        else{
                                            echo "<table>";
                                            echo "<tr>
                                                     <th>Datum</th>
                                                     <th>Naam Student</th>
                                                     <th></th>
                                                 </tr>";
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "<tr>
                                                    <td>".$Year." Periode ".$Period." Week ".$Week."</td>
                                                    <td>".$Name."</td>
                                                    <td><a href='seenotule.php?notulen=".$AgendaNR."'>Bekijk Notule</a></td>
                                                    </tr>";
                                                }
                                            echo "</table>";
                                        
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
                        if(TableExistCheck($DBConnect, $DBName, $TableName) === TRUE){
                                $Query = "SELECT AgendaNR, Cohort, Schooljaar, Periode, WeekPeriode FROM ".$TableName." "
                                        . " ORDER BY ".$TableName.".AgendaNR DESC;";
                                if ($stmt = mysqli_prepare($DBConnect, $Query)) {

                                    if(!mysqli_stmt_execute($stmt)){
                                        DBQueryError($DBConnect);
                                    }
                                    else{
                                        mysqli_stmt_bind_result($stmt, $AgendaNR, $Cohort ,
                                                                $Year, $Period, $Week);
                                        mysqli_stmt_store_result($stmt);
                                        if (mysqli_stmt_num_rows($stmt) == 0) {
                                            echo "<p>Er zijn geen agendas!</p>";
                                        }
                                        else{
                                            echo "<table>";
                                            echo "<tr>
                                                     <th>Cohort</th>
                                                     <th>Datum</th>
                                                     <th></th>
                                                 </tr>";
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "<tr>
                                                    <td><p>".$Cohort."</p></td>
                                                    <td><p>".$Year." Periode ".$Period." Week ".$Week."</p></td>
                                                    <td><a href='seenotule.php?agenda=".$AgendaNR."'>Bekijk Agenda</a></td>
                                                    </tr>";
                                                }
                                            echo "</table>";
                                        
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
