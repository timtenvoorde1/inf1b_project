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
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
                            <?php
                                require "DBFuncs.php";
                                $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                                $DBName = "projectplenair";
                                $TableName = "students";
                                if(TableExistCheck($DBConnect, $DBName, $TableName) === TRUE){
                                    $Query = "SELECT StudentID, Name, StudentGroup FROM ".$TableName.""
                                            . " ORDER BY StudentGroup;";
                                    if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                                        
                                        if(!mysqli_stmt_execute($stmt)){
                                            DBQueryError($DBConnect);
                                        }
                                        else{
                                            mysqli_stmt_bind_result($stmt, $StudentID, $Name,
                                                                    $StudentGroup);
                                            mysqli_stmt_store_result($stmt);
                                            if (mysqli_stmt_num_rows($stmt) == 0) {
                                                echo "<p>Er zijn geen studenten!</p>";
                                            }
                                            else{
                                                echo "<table>";
                                                echo "<tr>
                                                         <th>Studentnummer</th>
                                                         <th>Naam</th>
                                                         <th>Groep</th>
                                                         <th>Selectie</th>
                                                     </tr>";
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    echo "<tr>
                                                        <td>".$StudentID."</td>
                                                        <td>".$Name."</td>
                                                        <td>".$StudentGroup."</td>
                                                        <td><input type='radio' name = 'id' value='".$StudentID."'</td>
                                                        </tr>";
                                                    }
                                                echo "</table>";
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                }
                                if(isset($_POST['submit']) AND isset($_POST['id'])){
                                $PleinairDate = date("Y-m-d");
                                $Table2Name = 'notules';
                                $StudentID = filter_var($_POST['id'], FILTER_VALIDATE_INT);
                                    if(TableExistCheck($DBConnect, $DBName, $Table2Name) === TRUE){
                                        mysqli_select_db($DBConnect, $DBName);
                                        $Query = 'INSERT INTO '.$Table2Name.
                                                '(`NotuleID`,`StudentID`,`NotuleLink`,`PlenairDate`) '.
                                                'VALUES(NULL, ? , NULL , ?);';
                                        if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                                            mysqli_stmt_bind_param($stmt, 'is', $StudentID,
                                                    $PleinairDate);
                                            $QueryResult = mysqli_stmt_execute($stmt);
                                            if ($QueryResult === FALSE) {
                                                DBQueryError($DBConnect);
                                            }
                                            else {    
                                            echo "De betreffende student is aangewezen voor de notulen van ".$PleinairDate;
                                            }
                                        }
                                        else{
                                            DBQueryError($DBConnect);
                                        }
                                        mysqli_stmt_close($stmt);
                                    }
                                }
                                mysqli_close($DBConnect);
                            ?>
                            <input type="submit" name="submit" value="Assign student">
                        </form>
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


