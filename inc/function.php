<?php
function print_head($page_title){?>
	<head>
		<title><?php $page_title?></title>
		<meta charset = "utf-8"/>
		<meta name = "author" content = "Group 50"/>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
		<link rel = "stylesheet" href = "../css/style.css">		
	</head>
<?php
}
?>

<?php
	function clean($string) {
	   $string = preg_replace('/[^\da-z ]/i', '', $string);
	   return $string;
	}
?>