<!--
Name: Guangyun Hou
Class: CIS 451, Fall 2017
Final 
-->
<?php

include('connectionData.txt');
$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <title>Search Result</title>
</head>
  <body bgcolor="white">
  
<?php
 
//created a template
$product_query = "SELECT item.name, brand, unit_price FROM item
JOIN catelog
WHERE item.catelog_cat_id = catelog.cat_id and catelog.name LIKE ?";

//initialize prepare statement 
$prep_stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($prep_stmt, $product_query)){
	echo "Failed to prepare statement";
}else{
	$product_catelog = $_POST["catelog"];
	
	//bind parameters, manufacurer is string type
	mysqli_stmt_bind_param($prep_stmt, "s", $product_catelog);
	
	//execute query
	mysqli_stmt_execute($prep_stmt);
	$result = mysqli_stmt_get_result($prep_stmt);
}?>
	<div class="container">
		<h1>Result</h1>

		<?php
		//get the result from query
		echo '<div class="row">';
	
		echo '<div class="col-sm-6">';
		print "Item";
		echo '</div>';

		echo '<div class="col-sm-6">';
		print "Price";
		echo '</div>';
		
		echo '</div>';
		echo '<hr/>';
		
		echo '<div class="row">';
		while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
		  {
			echo '<div class="col-sm-6">';
			print "$row[brand] $row[name]";
			echo '</div>';
			
			echo '<div class="col-sm-6">';
			print "$row[unit_price]";
			echo '</div>';			
		  }
		echo '</div>';
		mysqli_free_result($result);
		mysqli_close($conn);
		?>
		<h3>Code of this page: <a href="http://ix.cs.uoregon.edu/~ghou/final_project/code/final_result_products_hou.txt">Code</a></h3>
	</div>
</body>
</html>