<!DOCTYPE html>

<?php
include_once "../inc/function.php";
$dbh = new PDO('mysql:host=localhost;dbname=animal', "root", "");
?>
<html lang = "en">
<?php print_head('rescuer');?>
<body>
	<header>
		<?php include_once('../inc/header.php');?>
	<header>
	<main>
		<h2>Rescuers</h2>
		<ul>
			<?php 
				$rescuers = $dbh->query("select * from rescuer");
				foreach($rescuers as $rescuer):?>
					<li><a href = "organization_result.php?ID=<?php echo $rescuer[0];?>"><?php echo $rescuer[0]."<br><br>";?></a></li>
				<?php endforeach;?>
			
		</ul>
	</main>
	
	<footer>
	
	</footer>

</body>
</html>