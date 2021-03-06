<?php session_start();
    if(!isset($_SESSION['loggedin'])){
        header('Location: index.php');
    }?>
<!DOCTYPE html>
<html lang="nl">
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
                            <li><a href="logout.php" >Uitloggen</a></li>
                        </ul>
                    </div>
                    <div class="language">
                        <ul>
                            <li>&#127760;</li>
                            <li class=""><a href="assignnotulen.php.php">NL</a></li>
                            <li class=""><a href="en/assignnotulen.php">EN</a></li>
                        </ul>
                    </div>
                </div> 
            </div>
            <div id="middlebox">
                
                <div id="tilecontainer">
                    <div class="notulenupload">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
                        <?php
                            require "../DBFuncs.php";
                            $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                            $DBName = "projectplenair";
                            $TableName = "users";
                            if(TableExistCheck($DBConnect, $DBName, $TableName) === TRUE){
                                $Query = "SELECT LeerlingNR, Naam, Cohort FROM ".$TableName.""
                                        . " ORDER BY LeerlingNR;";
                                if ($stmt = mysqli_prepare($DBConnect, $Query)) {

                                    if(!mysqli_stmt_execute($stmt)){
                                        DBQueryError($DBConnect);
                                    }
                                    else{
                                        mysqli_stmt_bind_result($stmt, $StudentID, $Name,
                                                                $Cohort);
                                        mysqli_stmt_store_result($stmt);
                                        if (mysqli_stmt_num_rows($stmt) == 0) {
                                            echo "<p>There are no students!</p>";
                                        }
                                        else{
                                            echo "<table>";
                                            echo "<tr>
                                                     <th>Studentnummer</th>
                                                     <th>Naam</th>
                                                     <th>Cohort</th>
                                                     <th>Selectie</th>
                                                 </tr>";
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "<tr>
                                                    <td>".$StudentID."</td>
                                                    <td>".$Name."</td>
                                                    <td>".$Cohort."</td>
                                                    <td><input type='radio' name = 'id' value='".$StudentID."'></td>
                                                    </tr>";
                                                }
                                            echo "</table>";
                                        }
                                        mysqli_stmt_close($stmt);
                                    }
                                }
                            }
                            $Table2Name = 'agenda';
                            if(TableExistCheck($DBConnect, $DBName, $Table2Name) === TRUE){
                                $Query = "SELECT AgendaNR, Cohort, Schooljaar, Periode, Weekperiode FROM ".$Table2Name.""
                                        . " ORDER BY AgendaNR;";
                                if ($stmt = mysqli_prepare($DBConnect, $Query)) {

                                    if(!mysqli_stmt_execute($stmt)){
                                        DBQueryError($DBConnect);
                                    }
                                    else{
                                        mysqli_stmt_bind_result($stmt, $AgendaNR, $Cohort,
                                                                $Year, $Period, $Week);
                                        mysqli_stmt_store_result($stmt);
                                        if (mysqli_stmt_num_rows($stmt) == 0) {
                                            echo "<p>There are no agendas for the pleinair</p>";
                                        }
                                        else{
                                            echo "<p>Which student is going to make the minute??</p>";
                                            echo "<select name='plenair'>";
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "<option value='".$AgendaNR."'>Cohort: ".$Cohort." Year: ".$Year." Period: ".$Period." Week: ".$Week."</option>";
                                                }
                                            echo "</select>";

                                        }
                                        mysqli_stmt_close($stmt);
                                    }
                                }
                            }
                            
                        ?>
                            <p><input type="submit" name="submit" value="Assign student"><p>
                    </form>
                    <?php
                        if(isset($_POST['submit'])){
                        $Table3Name = 'notulen';
                        $LeerlingNR = filter_var($_POST['id'], FILTER_VALIDATE_INT);
                        $AgendaID = filter_var($_POST['plenair'], FILTER_VALIDATE_INT);
                            if(TableExistCheck($DBConnect, $DBName, $Table3Name) === TRUE){
                                mysqli_select_db($DBConnect, $DBName);
                                $Query = 'INSERT INTO '.$Table3Name.
                                        '(`AgendaNR`,`LeerlingNR`,`Tekst`) '.
                                        'VALUES(?, ? , NULL);';
                                if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                                    mysqli_stmt_bind_param($stmt, 'ii', 
                                            $AgendaID,$LeerlingNR);
                                    $QueryResult = mysqli_stmt_execute($stmt);
                                    if ($QueryResult === FALSE) {
                                        DBQueryError($DBConnect);
                                    }
                                    else {    
                                    echo "The student has been assigned for the minutes ";
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
                        <br>
                        <p><a href="shownotulen.php">&lt;&lt;Back</a></p>       
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.html'; ?>
    </body>
</html>