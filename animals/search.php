<!DOCTYPE html>

<?php
include_once "../inc/function.php";
?>
<html lang = "en">
<?php print_head('Search');?>
<body>
	<header>
		<?php include_once('../inc/header.php');
		$dbh = new PDO('mysql:host=localhost;dbname=animal', "root", "");?>	
	<header>
	<main>
		<h3>Search for animal by type</h3>
		<form action = "animal_result.php?ID=searchByType" method = "post" id = "search_animal">
			<?php $types = $dbh->query("select distinct type from animals");?>
			<select name = "animalType" placeholder = "Animal type" required><br><br>
			<?php foreach($types as $type):?>
				<option value = "<?php echo $type[0];?>"><?php echo $type[0];?></option>
			<?php endforeach;?>
			</select><br><br>
			<input type = "submit" value = "submit">
		</form>
		
		<h3>Search for animal by id</h3>
		<form action = "animal_result.php?ID=searchByID" method = "post">
		    <input type = "text" name = "theID" placeholder = "Enter the animal ID" maxlength = "13" required><br><br>
			<input type = "submit" value = "submit">
		</form>
	</main>
	
	<footer>
	
	</footer>

</body>
</html>