<!DOCTYPE html>

<?php
include_once "inc/function.php";
?>
<html lang = "en">
<?php print_head('result');?>
<body>
	<header>
		<?php include_once('inc/header.php');
		$dbh = new PDO('mysql:host=localhost;dbname=animal', "root", "");
		?>
	<header>
	
	<main>
		<h1> Result: </h1>
		<?php	

			$SearchType = $_POST["animal_type"];
			$rows = $dbh->query("select * from animals");
			foreach($rows as $row) {
				echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr><br>";
			}
		?>
		<br>
		<?php
			$searchID = $_POST["animalId"];
			echo $searchID;
		?>
		
	
	</main>
	
	
	
	<footer>
	
	</footer>

</body>
</html>