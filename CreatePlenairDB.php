<?php
/* 
 * Programmer: Maurice Hoekstra
 * Date Created: 19-12-2018
 * Description: Plenair Database existence check & creation
 */

require 'DBFuncs.php';
$DBConnect = mysqli_connect('127.0.0.1', 'root', '');
if(!DBHandshake($DBConnect, 1)){
    die();
}

$DBName = 'ProjectPlenair';
if(!DBExistCheck($DBConnect, $DBName, 1)){
   echo '<br><br>Creating Database...<br><br>';
   $Query = 'CREATE DATABASE `'.$DBName.'`;';
    if($stmt = mysqli_prepare($DBConnect, $Query)){
        mysqli_execute($stmt);
        echo 'Database has been created!';
        mysqli_stmt_close($stmt);
        
    }
    else{
        DBQueryError($DBConnect);
    }
}
$TableStudent = 'Student';
$TableTeacher = 'Teacher';
$TableEvalation = 'Evaluation';
$TableEvalresult = 'Evaluationresult';
$TableAgenda = 'Agenda';
$TableAgendapoints = 'Agendapoints';
$TableNotules = 'Notules';
$TableSuggestions = 'Suggestions';
$TableWeeklyNotule = 'Weekly_Notule';
$Tablesarray = array($TableStudent, $TableTeacher, $TableEvalation,
                    $TableEvalresult, $TableAgenda, $TableAgendapoints,
                    $TableNotules, $TableSuggestions, $TableWeeklyNotule);

if(!TableArrayExistCheck($DBConnect, $DBName, $Tablesarray, 1)){
    echo '<br>Not all tables exists, dropping existing ones and re-creating now...';
    foreach($Tablesarray as $Table){
        
    }
}
else{
    'Tables already exists';
}