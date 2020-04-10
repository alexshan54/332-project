<!DOCTYPE html>

<?php
include_once "../inc/function.php";
?>
<html lang = "en">
<?php print_head('donate');
$dbh = new PDO('mysql:host=localhost;dbname=animal', "root", "");?>
<body>
	<header>
		<?php include_once('../inc/header.php');?>
	<header>
	<main>
		<h2>Donate</h2>
		<form action = "donation_result.php?ID=donate" method = "post" id = "donate">
			
			<input type = "text" name = "LastName" placeholder = "Enter your last name" maxlength = "13" required/><br><br>
			Select the organization name<br>
			<select name = "Destination" required>
			<?php $orgs = $dbh->query("select name from organization");
			foreach($orgs as $org):?>
				<option value = "<?php echo $org[0];?>"><?php echo $org[0];?></option>
			<?php endforeach;?>
			</select><br><br>
			<input type = "text" name = "amount" placeholder = "$$$" maxlength = "10" required/><br><br>
			<input type = "submit" value = "submit">
		</form>	
	</main>
	
	<footer>
	
	</footer>

</body>
</html>