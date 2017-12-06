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
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Search Result</title>
</head>
  
  <body bgcolor="white">
  
<?php
 

//created a template
$catelog_seller_query = "SELECT store_name, phone, rating FROM seller
JOIN catelog
JOIN seller_has_catelog
WHERE seller.seller_id = seller_has_catelog.seller_seller_id
AND  seller_has_catelog.catelog_cat_id = catelog.cat_id and catelog.name LIKE ?";


//initialize prepare statement 
$prep_stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($prep_stmt, $catelog_seller_query)){
	echo "Failed to prepare statement";
}else{
	$catelog = $_POST["catelog"];
	
	//bind parameters, manufacurer is string type
	mysqli_stmt_bind_param($prep_stmt, "s", $catelog);
	
	//execute query
	mysqli_stmt_execute($prep_stmt);
	$result = mysqli_stmt_get_result($prep_stmt);
}?>


<div class="container">
	<h1>Result:</h1>

	<?php
	//get the result from query

	echo '<div class="row">';
		echo '<div class="col-sm-4">';
		print "Store Name";
		echo '</div>';

		echo '<div class="col-sm-4">';
		print "Phone Number";
		echo '</div>';
		
		echo '<div class="col-sm-4">';
		print "Rating (Out of 5)";
		echo '</div>';
	echo '</div>';
	echo '<hr/>';
	echo '<div class="row">';
	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	  {
		print "\n";
			echo '<div class="col-sm-4">';
			print "$row[store_name]";	
			echo '</div>';

			echo '<div class="col-sm-4">';
			print "$row[phone]";	
			echo '</div>';

			echo '<div class="col-sm-4">';
			print "$row[rating]";	
			echo '</div>';	
	  }
	echo '</div>';
	mysqli_free_result($result);
	mysqli_close($conn);
	?>
	<h3>Code of this page: <a href="http://ix.cs.uoregon.edu/~ghou/final_project/code/final_result_catelog_hou.txt">Code</a></h3>
	</div>
</body>
</html>