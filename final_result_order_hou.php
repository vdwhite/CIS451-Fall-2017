<!--
Name: Guangyun Hou
Class: CIS 451, Fall 2017
Final

LEFT : ORDER, PRODUCTS, SCAN GRAPH, PRICE
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
$catelog_seller_query = "SELECT order_id, shipment_tracking_num, paid_date, seller_seller_id, item.brand, item.name, shipping_company.name AS sname
FROM `order`
JOIN seller 
JOIN item
JOIN shipping_company
JOIN shipment
WHERE 
    `order`.shipment_tracking_num = shipment.tracking_num 
    AND shipment.shipping_company_company_code = shipping_company.company_code
    AND seller.seller_id=`order`.seller_seller_id
    AND item.item_id=`order`.item_item_id
	AND MONTHNAME(paid_date) LIKE ?";


//initialize prepare statement 
$prep_stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($prep_stmt, $catelog_seller_query)){
	echo "Failed to prepare statement";
}else{
	$catelog = $_POST["month"];
	
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

		echo '<div class="col-sm-3">';
		print "Order ID";
		echo '</div>';

		echo '<div class="col-sm-3">';
		print "Paid Date";
		echo '</div>';
			
		echo '<div class="col-sm-3">';
		print "Shipping Company";
		echo '</div>';
				
		echo '<div class="col-sm-3">';
		print "Tracking Number";
		echo '</div>';
			
		echo '</div>';
		echo '<hr/>';

		echo '<div class="row">';
		while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
		  {
			echo '<div class="col-sm-3">';
			print "$row[order_id]"; 
			echo '</div>';
			
			echo '<div class="col-sm-3">';
			print "$row[paid_date]";
			echo '</div>';
			
			echo '<div class="col-sm-3">';
			print "$row[sname]";
			echo '</div>';
			
			echo '<div class="col-sm-3">';
			print "$row[shipment_tracking_num]";
			echo '</div>';
		  }
		echo '</div>';
		mysqli_free_result($result);
		mysqli_close($conn);
		?>
		</div>
</body>
</html>