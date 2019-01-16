<?php
    /*
    * Programmer: Maurice Hoekstra
    * Date Created: 1-12-2018
    * Description: Basic Database Function
    */
    function DBHandshake($host, $user, $password, $check = 0){
        /*Checks the database connection,
         *returns True if the connection is valid.
         *Otherwise returns false and an error.
         *Can give optional argument 1 to return an echo to confirm the
         *connection is TRUE.
        */
        
        if(mysqli_connect($host, $user, $password) === FALSE){
            echo "<p>Unable to connect to Database</p>"
            ."<p>Error Code: ".mysqli_errno(). " : ".mysqli_error()."</p>";
            return FALSE;
        }
        else if($check === 1){
            echo "<p>Succesfully connected to Database</p>";
            echo "<br>------------------------------------------<br>";
            return mysqli_connect($host, $user, $password);
        }
        else{
            return mysqli_connect($host, $user, $password);
        }
    }
    
    function DBExistCheck($DBConnect, $DBName, $check = 0){
        /*Checks whether the specified database exists,
         *returns True if it exists.
         *Otherwise returns false and an error.
         *Can give optional argument 1 to return an echo to confirm that
         *the specified database exists. 
        */
        if(!mysqli_select_db($DBConnect, $DBName)){
            echo "Database does not exist!";
            return FALSE;
        }
        else if($check === 1){
            echo "Database exists.";
            return TRUE;
        }
        else{
            return TRUE;
        }
    }
    
    function TableExistCheck($DBConnect, $DBName, $TableName, $check = 0){
        /*Checks whether the specified table exists, returns True if it exists.
         *Otherwise returns false and an error.
         *Can give optional argument 1 to return an echo to confirm that
         *the specified table exists.
        */
        if(DBExistCheck($DBConnect, $DBName) === TRUE){
            $SQLstring = "SELECT * FROM ".$TableName;
            if (!$stmt = mysqli_prepare($DBConnect, $SQLstring)) {
                echo "Table ".$TableName." does not exist!";
                return FALSE;
            }
            else if($check === 1){
                mysqli_stmt_close($stmt);
                echo "Table Exists.";
                return TRUE;
            }
            else{
                mysqli_stmt_close($stmt);
                return TRUE;
            }
            
        }
    }
    
    function DBTypeValidityCheck($Data, $Type, $Size = 0){
        /*Checks if the data entered is valid for the database,
         *if TRUE, continue, if FALSE, return error.
         * Size argument is purely to check the strlen of the string
        */
        switch($Type){
            case "str":
                if(is_string($Data) AND strlen($Data) < $Size){
                    return TRUE; 
                }
                else{
                    return FALSE;
                }
                break;
            case "int":
                if (is_int($Data)){
                    return TRUE;
                }
                else{
                    return FALSE;
                }
                break;
            case "float":
                if(is_float($Data)){
                    return TRUE;
                }
                else{
                    return FALSE;
                }
                break;
            default:
                echo "No proper datatype argument has been entered!";
                return FALSE;
        }
    }
    
    function DBQueryError($DBConnect){
    //Echos error statement whenever Databse Query is incorrect.
        echo "<p>Unable to execute the query.</p>"
            . "<p>Error code "
            . mysqli_errno($DBConnect)
            . ": "
            . mysqli_error($DBConnect)
            . "</p>"; 
    }