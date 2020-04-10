<!DOCTYPE html>

<?php
include_once "../inc/function.php";
$dbh = new PDO('mysql:host=localhost;dbname=animal', "root", "");
?>
<html lang = "en">
<?php print_head('shelter');?>
<body>
	<header>
		<?php include_once('../inc/header.php');?>
	<header>
	<main>
		<h2>Shelters</h2>
		<ul>
			<?php 
				$shelters = $dbh->query("select * from shelter");
				foreach($shelters as $shelter):?>
					<li><a href = "organization_result.php?ID=<?php echo $shelter[0];?>"><?php echo $shelter[0]."<br><br>";?></a></li>
				<?php endforeach;?>
			
		</ul>
	</main>
	
	<footer>
	
	</footer>

</body>
</html>