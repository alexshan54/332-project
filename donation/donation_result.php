<!DOCTYPE html>

<?php
include_once "../inc/function.php";
?>
<html lang = "en">
<?php print_head('donation_result');
$dbh = new PDO('mysql:host=localhost;dbname=animal', "root", "");?>
<body>
	<header>
		<?php include_once('../inc/header.php');?>
	<header>
	<main>
		<h2>Result</h2>
		<?php $event_id = $_GET['ID'];
		if($event_id == "donate"){
			$stmt = $dbh -> prepare("insert into moneytransactions
			values (:transaction_no, :startingpoint, :destination, :transaction_type, :amount, :todaydate)");
			
			$stmt -> bindParam(":transaction_no", $transaction_no);
			$stmt -> bindParam(":startingpoint", $startingpoint);
			$stmt -> bindParam(":destination", $destination);
			$stmt -> bindParam(":transaction_type", $transaction_type);
			$stmt -> bindParam(":amount", $amount);
			$stmt -> bindParam(":todaydate", $todaydate);
			
			$trans1 = "02";
			$trans2 = date("Ymd");
			$digits = 3;
			$trans3 = rand(pow(10,$digits-1),pow(10,$digits)-1);
			$transaction_no = $trans1.$trans2.$trans3;
			
			$startingpoint = $_POST["LastName"];
			$destination = $_POST["Destination"];
			$transaction_type = "Donation";
			$amount = $_POST["amount"];
			$todaydate = date("Y-m-d");
			
			$stmt -> execute();
			$infos = $dbh->query("select startingpoint, destination, amount from moneytransactions where transaction_no = \"$transaction_no\"");
			echo "<table>";
			foreach($infos as $info):?>
			<tr><th>Transition number</th>
				<th>Name</th>
				<th>Orgnization_name</th>
				<th>Amount</th>
			</tr>
			<tr>
				<td><?php echo $transaction_no;?></td>
				<td><?php echo $startingpoint;?></td>
				<td><?php echo $info[1];?></td>
				<td><?php echo $info[2];?></td>
			</tr>
			<?php endforeach;
			echo "</table>";
		}

		else if($event_id == "history"){
			$name = $_POST["lname"];
			$tmps = $dbh->query("select todaydate, amount, destination, transaction_no from moneytransactions where startingpoint = \"$name\" and transaction_type = \"Donation\"");
			echo "<table>";?>
			<tr><th>Transition number</th>
			<th> Orgnization_name</th>
			<th> Amount</th>
			<th> Date</th>
			</tr>
			<?php foreach($tmps as $temp):?>
				<tr><td><?php echo $temp[3];?></td>
				<td><?php echo $temp[2];?></td>
				<td><?php echo $temp[1];?></td>
				<td><?php echo $temp[0];?></td>
				</tr>
			<?php endforeach;?>
			</table>
		<?php }?>
	</main>
	
	<footer>
	
	</footer>

</body>
</html>