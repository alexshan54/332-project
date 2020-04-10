<!DOCTYPE html>

<?php
include_once "../inc/function.php";
$dbh = new PDO('mysql:host=localhost;dbname=animal', "root", "");
?>
<html lang = "en">
<?php print_head('SPCA');?>
<body>
	<header>
		<?php include_once('../inc/header.php');?>
	<header>
	<main>
		<h2>SPCA</h2>
		<ul>
			<?php 
				$spcas = $dbh->query("select * from spca");
				foreach($spcas as $spca):?>
					<li><a href = "organization_result.php?ID=<?php echo $spca[0];?>"><?php echo $spca[0]."<br><br>";?></a></li>
				<?php endforeach;?>
			
		</ul>
	</main>
	
	<footer>
	
	</footer>

</body>
</html>