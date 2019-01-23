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
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
                            <p>Cohort</p>
                            <input type="text" name="cohort" placeholder="9 karakters, bv: 2018-2019">
                            <p>Schooljaar</p>
                            <input type="number" name="year" <?php echo 'value="'.date("Y").'"'?> min="1970" max="2100">
                            <p>Periode</p>
                            <input type="number" name="period"  value="1" min="1" max="4">
                            <p>Week van de periode</p>
                            <input type="number" name="week" value="1" min="1" max="10">
                            <p>Bespreekpunten</p>
                            <textarea name="meetingpoints"></textarea>
                            
                            <input type="submit" name="submit" value="Creëer Agenda">
                        </form>
                        <?php
                            require "DBFuncs.php";
                            $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                            $DBName = "projectplenair";
                            $TableName = "agenda";
                            if(isset($_POST['submit'])){
                                $Cohort = filter_var($_POST['cohort'], FILTER_SANITIZE_STRING);
                                $Year = filter_var($_POST['year'], FILTER_VALIDATE_INT);
                                $Period = filter_var($_POST['period'], FILTER_VALIDATE_INT);
                                $Week = filter_var($_POST['week'], FILTER_VALIDATE_INT);
                                $Tekst = filter_var($_POST['meetingpoints'], FILTER_SANITIZE_STRING);
                                if(TableExistCheck($DBConnect, $DBName, $TableName) === TRUE){
                                    mysqli_select_db($DBConnect, $DBName);
                                    $Query = 'INSERT INTO '.$TableName.
                                            '(`AgendaNR`,`Cohort`,`Schooljaar`,`Periode`, `WeekPeriode`, `Tekst`)'.
                                            'VALUES(NULL, ? , ?, ?, ?, ?);';
                                    if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                                        mysqli_stmt_bind_param($stmt, 'siiis', $Cohort,
                                                $Year, $Period, $Week, $Tekst);
                                        $QueryResult = mysqli_stmt_execute($stmt);
                                        if ($QueryResult === FALSE) {
                                            DBQueryError($DBConnect);
                                        }
                                        else {    
                                        echo "De Agenda is aangemaakt";
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
                    </div>
                </div>
            </div>
            <?php include 'footer.html'; ?>
        </div>
    </body>
</html>


