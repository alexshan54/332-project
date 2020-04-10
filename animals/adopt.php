<!DOCTYPE html>

<?php
include_once "../inc/function.php";
?>
<html lang = "en">
<?php print_head('Adopt');?>
<body>
	<header>
		<?php include_once('../inc/header.php');
		$dbh = new PDO('mysql:host=localhost;dbname=animal', "root", "");?>
	<header>
	<main>
		<h2>Adopt</h2>
		<?php $id = $_GET['ID'];?>
		<form action = "animal_result.php?ID=adopt" method = "post" id = "adopt_animal">
			<input type = "text" name = "LastName" placeholder = "Enter your last name" maxlength = "30" required/><br><br>
			<input type = "text" name = "Address" placeholder = "Enter your address" maxlength = "100" required/><br><br>
			<input type = "text" name = "City" placeholder = "City" maxlength = "20" required/><br><br>
			<input type = "text" name = "Phone" placeholder = "Enter your phone number" maxlength = "11" required/><br><br>
			<input type = "text" name = "Post" placeholder = "Enter your post code" maxlength = "6" required/><br><br>
			<input type = "submit" value = "submit">
			<input type = "text" name = "theID" hidden value = "<?php echo $id;?>"/>
			<?php $tmp = $dbh->query("select current_location from animals where id = \"$id\"");
			foreach ($tmp as $ttmp){
				$location = $ttmp[0];
			}?>
			<input type = "text" name = "current_location" hidden value = "<?php echo $location;?>"/>
			<?php 
				echo "<h4>The adoption fee for each animal is $100. </h4>";
				echo "<h4>The money will be donated to the current organization hosting this animal.</h4>"
			?>
		</form>
	</main>
	
	<footer>
	
	</footer>

</body>
</html>