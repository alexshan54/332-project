<!DOCTYPE html>

<?php
include_once "../inc/function.php";
?>
<html lang = "en">
<?php print_head('organization_result');?>
<body>
	<header>
		<?php 
			include_once('../inc/header.php');
			$dbh = new PDO('mysql:host=localhost;dbname=animal', "root", "");
		?>
	<header>
	<main>
		<?php 
			$org_id = $_GET['ID'];?>
			<h2><?php echo $org_id ?></h2>
			<h3>Animals:</h3>
			<table id = "animal_table" cellspacing = "20px">
			<?php 
				$rows = $dbh->query("select picture, id, type from animals where current_location = \"$org_id\"");
				foreach($rows as $row):?>
					<tr><td><img class = "animal_pic" src = "<?php echo $row[0];?>" width = "200px"/></td>
					<td><i>Animal ID: </i><?php echo $row[1];?></td>
					<td><strong>Animal Type: </strong><?php echo $row[2];?></td></tr>
				<?php endforeach?>	
			</table>
			<br>
			<?php 
			$rescuersName = $dbh ->query("select name from rescuer");
			$rescuerArray = array();
			foreach($rescuersName as $name){
				array_push($rescuerArray, $name[0]);
			}?>
			<h3>Employee:</h3>
			<table id = "employee_table" cellspacing = "20px">
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Phone Number</th>
			</tr>
			<?php 
				
				$employees = $dbh->query("select fname, lname, phone from employee where work_location = \"$org_id\"");
				foreach($employees as $e):?>
					<tr><td><i><?php echo $e[0];?></i></td>
					<td><i><?php echo $e[1];?></i></td>
					<td><i><?php echo $e[2];?></i></td></tr>
				<?php endforeach;?>
			</table>	
			<?php
			if(in_array($org_id ,$rescuerArray)):			
				?>
				<h3>Driver:</h3>
				<table cellspacing = "20px">
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Driver License</th>
					<th>License Plate</th>
				</tr>
				<?php
				$drivers = $dbh->query("select d.fname, d.lname, d.license_no, d.license_plate 
				from driver d left join employee e on d.fname = e.fname and d.lname = e.lname 
				where e.work_location = \"$org_id\"");
				foreach($drivers as $d):?>
					<tr><td><i><?php echo $d[0];?></i></td>
					<td><i><?php echo $d[1];?></i></td>
					<td><i><?php echo $d[2];?></i></td>
					<td><i><?php echo $d[3];?></i></td>
					</tr>
			<?php endforeach;?>
			</table>
			<?php endif;
			$res2018 = $dbh->query("select count(*) from animals where current_location = \"$org_id\" and year(startdate) = 2018");
			foreach($res2018 as $num){
				echo "<h3>The animal we rescured in 2018 is: ".$num[0]."</h3>";
			}
			
			$res2019 = $dbh->query("select count(*) from animals where current_location = \"$org_id\" and year(startdate) = 2019");
     		foreach($res2019 as $num){
				echo "<h3>The animal we rescured in 2019 is: ".$num[0]."</h3>";
			}

			$don2018 = $dbh->query("select sum(amount) from moneytransactions where destination = \"$org_id\" and year(todaydate) = 2018");
			
			foreach($don2018 as $num){
				if($num[0] == ""){
					echo "<h3>The donation we received in 2018 is: $0</h3>";
				}
				else{
					echo "<h3>The donation we received in 2018 is: $ ".$num[0]."</h3>";
				}
			}
	
			$don2019 = $dbh->query("select sum(amount) from moneytransactions where destination = \"$org_id\" and year(todaydate) = 2019");
			foreach($don2019 as $num){
				if($num[0] == ""){
					echo "<h3>The donation we received in 2019 is: $0 </h3>";
				}
				else{
					echo "<h3>The donation we received in 2019 is: $ ".$num[0]."</h3>";
				}
			}
			?>
				
				
	</main>
	
	<footer>
	
	</footer>

</body>
</html>