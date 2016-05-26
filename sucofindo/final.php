<?php
	$myHost = "localhost";
	$myUser = "postgres";
	$myPassword = "1234";
	$myPort = "5432";
	
	// Create connection
	$conn = "host = ".$myHost." user = ".$myUser." password = ".$myPassword." port = ".$myPort." dbname = sucofindo";
	
	// Check connection
	if (!$database = pg_connect($conn)) {
		die("Could not connect to database");
	}
	
	/**
	$namapengguna = pg_fetch_array(pg_query("select nama from pengguna  ;"));
	$rows = pg_query("select nama from pengguna;");
	echo pg_num_rows($rows);
	echo $namapengguna [0];
	**/
	session_start();
	
	$jobTitle ="";
	$jobTitleErr = "";
	$jobTitleB = "*";
	$searchErr = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//supplierName
		if (empty($_POST["jobTitle"])) {
			$jobTitleErr = "Job title is required";
			$jobTitleB = "";
		}
		else {
			$jobTitle = test_input($_POST["jobTitle"]);
			if (!preg_match("/^[a-zA-Z ]*$/",$jobTitle)) {
				$jobTitleErr = "Only letters and white space allowed";
				$jobTitleB = "";
			}
		}

				
		
	}
	
	if(empty($jobTitleErr))
	{
		$query = "SELECT jobdesc FROM job WHERE jobtitle = '".$jobTitle."';";
                
                $result = pg_query($query);

                if (pg_num_rows($result)!=0){
                    echo "<br>"; 
                    echo "<h3>Job Description ".$jobTitle." </h3> <br>";
                    echo "<table class='table table-striped table-bordered'>"; 
                    echo "<thead>";
                    echo "<th>#</th>";
                    echo "<th>Job Description</th>";
                    echo "</thead>";
                    echo "<tbody>"; 
                       
                        $count=0;
                        while($value = pg_fetch_array($result)){
                            $count++;
                            echo "<td align='left'>".$count."</td>";
							echo "<td align='left'>".$value['jobdesc']."</td>";
                            echo "</tr>";
                           }
                        
                    echo "</tbody>";  
                    echo "</table>";
               
            }
            else {
                    echo "<h3>Job Description ".$jobTitle." tidak ditemukan</h3> <br>";
            }

            }
		
		
	

		
		//$result = pg_query($masukan);
	
	
		
	function test_input($data) {
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
		
	pg_close($database);	
?>

<!DOCTYPE html>
<html>
<head>
		<title> Job Desription </title>
		<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
			
</head>

<body>
	
	<div class="form2">	
	
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="on" id="search-form" novalidate>
		
		<span class="error"> <?php echo $searchErr;?></span>
		<br>
		<!-- id purchase order // pakai increment -->
		
		<!-- supplier dropdown -->
		<label for="jobTitle"> Job Title <span class="error"><?php echo $jobTitleB;?></span></label>
		<br><span class="error"><?php echo $jobTitleErr;?></span>
		<input class ="input" type="text" name="jobTitle" placeholder="Insert job title" id="jobTitle" required autofocus> 
				
		<br><br>

		
		<br><br>
		
		<!-- submit -->
		<input id="button" type="submit" value="SUBMIT" />
		<br><br>
			
				
	</div>	
		<!-- Test Inputan -->
		<?php
			echo "<h2>Your Input:</h2>";
			echo $jobTitle;
			echo "<br>";
			
			
		?>
			
	<footer>
		<h5> Created by Fauziah Raihani</h5>	
	</footer>
	
</body>
</html>