<!DOCTYPE html>

<?php
include_once "../inc/function.php";
?>
<html lang = "en">
<?php print_head('move');
  $dbh = new PDO('mysql:host=localhost;dbname=animal', "root", "");
?>
<body>
	<header>
		<?php include_once('../inc/header.php');?>
	<header>
	<main>
		<h2>Move animals</h2>
		<?php $id = $_GET['ID'];?>
		<form action = "animal_result.php?ID=move" method = "post" id = "move_animal">
			<?php $organizations = $dbh->query("select name from organization");?>
			<h4>Please select the destination: </h4>
			<select name = "location" required><br>
				<?php foreach($organizations as $org):?>
					<option value = "<?php echo $org[0];?>"><?php echo $org[0];?></option>
				<?php endforeach;?>
			</select><br>
			
			<h4>Please enter the date: </h4>
			<input type = "text" name = "date" placeholder = "YYYY-MM-DD" maxlength = "10" required/><br>
			
			<h4>Please select a driver: </h4>
			<?php $drivers = $dbh->query("select license_no,fname,lname from driver");?>
			<select name = "driver" required>
			<?php foreach($drivers as $driver):?>
				<option value = "<?php echo $driver[0];?>"><?php echo $driver[1]." ".$driver[2];?></option>
			<?php endforeach;?>
			</select><br><br>
			<input type = "submit" value = "submit">
			<input type = "text" name = "animalID" hidden value = "<?php echo $id;?>"/><br><br>
		</form>	
	</main>
	
	<footer>
	
	</footer>

</body>
</html>