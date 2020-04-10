<!DOCTYPE html>

<?php
include_once "../inc/function.php";
?>
<html lang = "en">
<?php print_head('animal_result');?>
<body>
	<header>
		<?php include_once('../inc/header.php');
		$dbh = new PDO('mysql:host=localhost;dbname=animal', "root", "");?>	
	<header>
	<main>
		<h2>Result</h2>
		<?php $event_id = $_GET['ID'];
		if($event_id == "move"){
			$animal_id = $_POST["animalID"];
			$destination = $_POST["location"];
			$date = $_POST["date"];
			$driverid = $_POST["driver"];
			$nametemp = $dbh->query("select fname,lname from driver where license_no = \"$driverid\"");
			foreach($nametemp as $names){
				$fname = $names[0];
				$lname = $names[1];
			}
			$IDS = $dbh->query("select id from animals");
			$id_array = array();
			foreach($IDS as $id){
				array_push($id_array, $id[0]);
			}
			if(in_array($animal_id, $id_array)){
				$tmps = $dbh->query("select current_location from animals where id = \"$animal_id\"");
				foreach($tmps as $temp){
					$oldPos = $temp;
				}
				$dbh->query("update animals set current_location = \"$destination\",startdate = \"$date\" where id = \"$animal_id\"");
				$rows = $dbh->query("select picture, id, current_location from animals where id = \"$animal_id\"");
				$insert = $dbh->prepare("insert into transfer
				values(:animal_id, :fname, :lname, :startingpoint, :destination, :date)");
				$insert->bindParam(":animal_id", $animal_id);
				$insert->bindParam(":fname", $fname);
				$insert->bindParam(":lname", $lname);
				$insert->bindParam(":startingpoint", $oldPos[0]);
				$insert->bindParam(":destination",$destination);
				$insert->bindParam(":date",$date);
				$insert -> execute();
				
				echo "<table>";
				foreach($rows as $row):?>
					<tr><td><img class = "animal_pic" src = "<?php echo $row[0];?>" width = "200px"/></td>
					<td><i>Animal ID: </i><?php echo $row[1];?></td>
					<td><strong>Current location: </strong><?php echo $row[2];?></td></tr>
				<?php endforeach;
				echo "</table>";
			}
			else{
				echo "Can not find the animal, please try again.<br>";
				echo "<a href = \"move.php\"><strong>Click here</strong></a>";
			}
				
		}else if ($event_id == "searchByType"){
			$animal_type = $_POST["animalType"];
			$rows_search = $dbh->query("select picture, id, current_location from animals where type = \"$animal_type\" and current_location != \"\"");
			echo "<table>";
			foreach($rows_search as $row_search):?>
					<tr><td><img class = "animal_pic" src = "<?php echo $row_search[0];?>" width = "200px"/></td>
					<td><i>Animal ID: </i><?php echo $row_search[1];?></td>
					<td><strong>Current location: </strong><?php echo $row_search[2];?></td>
					<?php
					$rescuersName = $dbh ->query("select name from rescuer");
					$rescuerArray = array();
					foreach($rescuersName as $name){
						array_push($rescuerArray, $name[0]);
					}
					if(!in_array($row_search[2],$rescuerArray)):?>
						<td><form action = "adopt.php?ID=<?php echo $row_search[1];?>" method = "post">
							<input type = "submit" value = "Adopt">
							</form></td>
						<?php endif;?>
					<td><form action = "move.php?ID=<?php echo $row_search[1];?>" method = "post">
						<input type = "submit" value = "Move">
						</form></td>
					</tr><br>
				<?php endforeach;
			echo "</table>";
		}
		else if($event_id == "searchByID"){
			$animal_id = $_POST["theID"];
			$IDS = $dbh->query("select id from animals");
			$id_array = array();
			foreach($IDS as $id){
				array_push($id_array, $id[0]);
			}
			if(in_array($animal_id, $id_array)){
				$rows = $dbh->query("select picture, id, current_location from animals where id = \"$animal_id\"");
				echo "<table>";
				foreach($rows as $row):
					if($row[2] == ""){
						$row[2] = "Adopted";
					}?>
					<tr><td><img class = "animal_pic" src = "<?php echo $row[0];?>" width = "200px"/></td>
					<td><i>Animal ID: </i><?php echo $row[1];?></td>
					<td><strong>Current location: </strong><?php echo $row[2];?></td>
					
					<?php 
					$rescuersName = $dbh ->query("select name from rescuer");
					$rescuerArray = array();
					foreach($rescuersName as $name){
						array_push($rescuerArray, $name[0]);
					}
					if(!in_array($row[2],$rescuerArray)):?>
					<td><form action = "adopt.php?ID=<?php echo $row[1];?>" method = "post">
						<input type = "submit" value = "adopt">
						</form>
					</td>
					<?php endif;?>
					<td><form action = "move.php?ID=<?php echo $row_search[1];?>" method = "post">
						<input type = "submit" value = "Move">
					</td>
					</tr>
				<?php endforeach;
				echo "</table>";
			}
			else{
				echo "Can not find the animal, please try again.<br>";
				echo "<a href = \"search.php\"><strong>Click here</strong></a>";
			}
		}	
		else if($event_id == "adopt"):
			$last_name = $_POST["LastName"];
			$id = $_POST["theID"];
			$leave_date = date("Y-m-d");
			$des = $_POST["current_location"];
			$phone = $_POST["Phone"];
			$address = $_POST["Address"];
			$city = $_POST["City"];
			$post = $_POST["Post"];
			#update animal table current_location=null
			$dbh->query("update animals set current_location = NULL,startdate =\"$leave_date\" where id = \"$id\"");
			
			#insert into moneytransactions table
			$stmt = $dbh -> prepare("insert into moneytransactions
			values (:transaction_no, :startingpoint, :destination, :transaction_type, :amount, :todaydate)");
			
			$stmt -> bindParam(":transaction_no", $transaction_no);
			$stmt -> bindParam(":startingpoint", $startingpoint);
			$stmt -> bindParam(":destination", $destination);
			$stmt -> bindParam(":transaction_type", $transaction_type);
			$stmt -> bindParam(":amount", $amount);
			$stmt -> bindParam(":todaydate", $todaydate);
			
			$trans1 = "01";
			$trans2 = date("Ymd");
			$digits = 3;
			$trans3 = rand(pow(10,$digits-1),pow(10,$digits)-1);
			$transaction_no = $trans1.$trans2.$trans3;
			
			$startingpoint = $_POST["LastName"];
			$destination = $des;
			$transaction_type = "Adoption";
			$amount = 100;
			$todaydate = date("Y-m-d");
			$stmt -> execute();
			
			
			$stmt2 = $dbh -> prepare("insert into family
			values (:lname, :phone,:street,:city,:postal_code)");
			
			$stmt2 -> bindParam(":lname", $last_name);
			$stmt2 -> bindParam(":phone", $phone);
			$stmt2 -> bindParam(":street", $address);
			$stmt2 -> bindParam(":city", $city);
			$stmt2 -> bindParam(":postal_code", $post);
			$stmt2 -> execute();
			
			#insert into adopt table
			$stmt1 = $dbh -> prepare("insert into adopt
			values (:animal_id, :lname,:transaction_no)");
			
			$stmt1 -> bindParam(":animal_id", $id2);
			$stmt1 -> bindParam(":lname", $last_name2);
			$stmt1 -> bindParam(":transaction_no", $transaction_no2);
			
			$id2 = $id;
			$last_name2 = $last_name;
			$transaction_no2 = $transaction_no;
			
			
			$stmt1 -> execute();
			echo "<h3>Thank you for your love!</h3>";
			
		endif;
		?>
	</main>
	
	<footer>
	
	</footer>

</body>
</html>