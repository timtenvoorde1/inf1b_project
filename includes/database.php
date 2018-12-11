<?php
	
	$DBConnect = mysqli_connect("127.0.0.1", "root", "");

			if ($DBConnect === FALSE)
			{
				echo "<p>Unable to connect to the database server.</p>"
				. "<p>Error code " . mysqli_errno() . ": "
				. mysqli_error() . "</p>";
			}
			
			else {

				$DBName = "plenairsysteem";
					if (!mysqli_select_db($DBConnect, $DBName)) 
					{
						$SQLstring = "CREATE DATABASE `". $DBName ."`";

						if ($stmt = mysqli_prepare($DBConnect, $SQLstring)) 
						{
							$QueryResult = mysqli_stmt_execute($stmt);

							if ($QueryResult === FALSE) 
							{
								echo "<p>Unable to create the
								database.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
							}
							else 
							{
								echo "<p>Database connected...</p>";
							}
						//Clean up the $stmt after use
						mysqli_stmt_close($stmt);
						}
					}
				mysqli_select_db($DBConnect, $DBName);
			}
?>