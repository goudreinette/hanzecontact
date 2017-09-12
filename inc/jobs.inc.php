<?php

	/**
	 * Deze functie laat alle banen in het systeem zien	 *
	 */
	function displayAllJobs() {
		
		$sql = "SELECT * FROM `Jobs` ORDER BY `JobTitle`";		
		$result = mysql_query($sql);
		
		echo"<h1>Banen</h1>";
		
		echo"<br/>";
		echo"<input type=\"button\" onclick=\"document.location.href='?action=addjob';\" value=\"Baan toevoegen\" />";
		echo"<br/>";
		echo"<br/>";
		
		echo"<table>";
		
		echo"	<tr>";
		echo" 		<th>Titel</td>";
		echo" 		<th>Minimum salaris</td>";
		echo" 		<th>Maximum salaris</td>";
		echo" 		<th>Actie</td>";
		echo"	</tr>";
		
		while($row = mysql_fetch_assoc($result)) {
			
			$row = escapeArray($row); // alle slashes weghalen
			
			echo"	<tr>";
			echo"		<td>".$row['JobTitle']."</td>";
			echo"		<td>".$row['MinSalary']."</td>";
			echo"		<td>".$row['MaxSalary']."</td>";
			echo"		<td>";
			echo"			<a href=\"index.php?action=editjob&id=".$row['JobID']."\">Bewerken</a>";
			echo"			|";
			echo"			<a href=\"javascript:confirmAction('Zeker weten?', 'index.php?action=deletejob&id=".$row['JobID']."');\">Verwijderen</a>";
			echo"		</td>";
			echo"	</tr>";
		}
		echo"</table>";
	}
	
	
	/**
	 * Deze functie laat het banen toevoeg formulier zien	 *
	 */
	function displayAddJob() {
		
		echo"<h1>Baan bewerken</h1>";
		
		echo" <form method=\"post\" action=\"index.php?action=insertjob\">";
		echo" 	<table>";
		echo"		<tr>";
		echo"			<td>Titel:</td>";
		echo"			<td><input type=\"text\" name=\"JobTitle\" /></td>";
		echo"		</tr>";
		echo"		<tr>";
		echo"			<td>Minimuloon:</td>";
		echo"			<td><input type=\"text\" name=\"MinSalary\" /></td>";
		echo"		</tr>";
		echo"		<tr>";
		echo"			<td>Maximumloon:</td>";
		echo"			<td><input type=\"text\" name=\"Maxsalary\" /></td>";
		echo"		</tr>";
		echo"		<tr>";
		echo"			<td></td>";
		echo"			<td><input type=\"submit\" value=\"Opslaan\" /></td>";
		echo"		</tr>";
		echo" 	</table>";
		
		echo" </form>";			
	}
	
	/**
	 * Deze functie laat het banen bewerkformulier zien.
	 * Dit formulier is automatisch gevuld met de gegevens die bij het meegegeven ID horen	 *
	 */
	
	function displayEditJob() {
		
		$sql = sprintf( "SELECT * FROM `Jobs` WHERE `JobID` = %d", 
						mysql_escape_string($_GET['id']) );
						
		$result = mysql_query($sql);
		
		if($row = mysql_fetch_assoc($result)) {
		
			$row = escapeArray($row); // alle slashes weghalen
			
			echo"<h1>Baan bewerken</h1>";
			
			echo" <form method=\"post\" action=\"index.php?action=updatejob\">";
			echo" 	<table>";
			echo"		<tr>";
			echo"			<td>Titel:</td>";
			echo"			<td><input type=\"text\" name=\"JobTitle\" value=\"".$row['JobTitle']."\" /></td>";
			echo"		</tr>";
			echo"		<tr>";
			echo"			<td>Minimuloon:</td>";
			echo"			<td><input type=\"text\" name=\"MinSalary\" value=\"".$row['MinSalary']."\" /></td>";
			echo"		</tr>";
			echo"		<tr>";
			echo"			<td>Maximumloon:</td>";
			echo"			<td><input type=\"text\" name=\"Maxsalary\" value=\"".$row['MaxSalary']."\" /></td>";
			echo"		</tr>";
			echo"		<tr>";
			echo"			<td></td>";
			echo"			<td><input type=\"submit\" value=\"Opslaan\" /></td>";
			echo"		</tr>";
			echo" 	</table>";
			
			echo" <input type=\"hidden\" name=\"JobID\" value=\"".$row['JobID']."\" />";
			
			echo" </form>";		
			
		}
		else {
			die("Geen gegevens gevonden");
		}
	}
	
	/**
	 * Deze functie voegt een nieuwe record toe aan de tabel Jobs	 *
	 */
	function addJob() {
		
		// Letop we maken gebruik van sprintf. Kijk op php.net voor meer info.
		// Binnen sprintf staat %s voor een string, %d voor een decimaal (integer) en %f voor een float
		
		$sql = sprintf("INSERT INTO `Jobs` (`JobTitle`, `MinSalary`, `MaxSalary`) VALUES  ('%s', '%f', '%f')", 
						mysql_escape_string($_POST['JobTitle']),
						mysql_escape_string($_POST['MinSalary']),
						mysql_escape_string($_POST['Maxsalary']) );
						
		mysql_query($sql);
		
		header("location: index.php?action=jobs"); // terugkeren naar jobs
		exit();
	}
	
	/**
	 * Deze functie werkt de record met ID $_POST['JobID'] bij	 *
	 */
	
	function updateJob() {
		$sql = sprintf("UPDATE `Jobs` SET 
						`JobTitle` = '%s',
						`MinSalary` = '%s',
						`MaxSalary` = '%s'
						WHERE `JobID` = %d",
						mysql_escape_string($_POST['JobTitle']),
						mysql_escape_string($_POST['MinSalary']),
						mysql_escape_string($_POST['Maxsalary']),
						mysql_escape_string($_POST['JobID']) );
						
		mysql_query($sql);
		
		header("location: index.php?action=jobs"); // terugkeren naar jobs
		exit();
	}
	
	/**
	 * Deze functie verwijderd record met id $_GET['ID']  uit de tabel Jobs
	 */	
	function deleteJob() {
		$sql = sprintf("DELETE FROM `Jobs` WHERE `JobID` = %d", mysql_escape_string($_GET['id']));
		mysql_query($sql);
		
		header("location: index.php?action=jobs"); // terugkeren naar jobs
		exit();
	}

?>