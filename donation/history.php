<!DOCTYPE html>

<?php
include_once "../inc/function.php";
?>
<html lang = "en">
<?php print_head('history');?>
<body>
	<header>
		<?php include_once('../inc/header.php');
		$dbh = new PDO('mysql:host=localhost;dbname=animal', "root", "");?>
	<header>
	<main>
		<h2>Donation History</h2>
		<form action = "donation_result.php?ID=history" method = "post">
			<input type = "text" name = "lname" placeholder = "Enter the last name" maxlength = "30" required>
			<input type = "submit" value = "submit">
		</form>
	</main>
	
	<footer>
	
	</footer>

</body>
</html>