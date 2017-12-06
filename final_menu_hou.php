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
       <title>Final by Guangyun Hou</title>
</head>


<div class="container">
	<h1>Final project by Guangyun Hou for CIS 451</h1>
	<h2>A Tiny Arcade Parts Selling System</h2>
	<h2>Connecting to FinalProject using MySQL/PHP</h2>
	<h5>Github: https://github.com/vdwhite/CIS451-Fall-2017</h5>
	<h5>Connection data can be seen here: <a href="http://ix.cs.uoregon.edu/~ghou/final_project/connectionData.txt">Connection Data</a></h5>
	<h5>Code of this page: <a href="http://ix.cs.uoregon.edu/~ghou/final_project/code/final_menu_hou.txt">Code</a></h5>
	<p>Choose a catelog to see who's selling those items:</p>
	<form action="final_result_catelog_hou.php" method="POST"> 
	<?php
	//code to send post request with data

	$catelog_query = "SELECT catelog.name FROM catelog";
	$result = mysqli_query($conn, $catelog_query)
	or die(mysqli_error($conn));


	echo '<select name="catelog">';
	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	  {
		print "$row[name]"; // print result row[manufacture_name]
		echo '<option value="'.$row[name].'">'.$row[name].'</option>';
	  }
	echo '</select>';

	?>
	<input type="submit" value="search" class="btn btn-primary btn-sm">
	</form>
	<hr/>
	
	<p>Choose a catelog to see what items are being sold:</p>
	<form action="final_result_products_hou.php" method="POST"> 
	<?php
	//code to send post request with data
	$catelog_query = "SELECT catelog.name FROM catelog";
	$result = mysqli_query($conn, $catelog_query)
	or die(mysqli_error($conn));

	echo '<select name="catelog">';
	echo '<option value="%">'.All.'</option>';

	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	  {
		print "$row[name]"; // print result row[manufacture_name]
		echo '<option value="'.$row[name].'">'.$row[name].'</option>';
	  }
	echo '</select>';
	?>
	<input type="submit" value="search" class="btn btn-primary btn-sm">
	</form>
	<hr/>
	
	<p>Search product by price</p>
	<form action="final_result_price_hou.php" method="POST"> 
	<select name="price">;
	<?php
	for($first=0; $first<95; $first = $first+5){
		echo '<option value ="'.($first).' - '.($first+5).'">'.($first). '-' .($first+5).'</option>';
	}
	?>
	</select>
	<input type="submit" value="search" class="btn btn-primary btn-sm">
	</form>
	<hr/>

	<p>Search order information</p>
	<form action="final_result_order_hou.php" method="POST"> 
	<select name="month">
	<option value="%"> ALL </option>
	<?php
	$month = array("January","February","March","April","May","June","July","August","September","October","November","December");
	for($i=0; $i<count($month); $i++){
		echo '<option value ="'.($month[$i]).'">'.($month[$i]).'</option>';
	}
	?>
	</select>
	<input type="submit" value="search" class="btn btn-primary btn-sm">
	</form>
	<hr/>

	<p>See what each seller it's selling and their information</p>
	<form action="final_result_seller_hou.php" method="POST"> 
	<?php
	//code to send post request with data
	$seller_query = "SELECT seller.store_name FROM seller";
	$seller_result = mysqli_query($conn, $seller_query)
	or die(mysqli_error($conn));
	echo '<select name="store_name">';
	echo '<option value="%">'.All.'</option>';

	while($row = mysqli_fetch_array($seller_result, MYSQLI_BOTH))
	  {
		echo '<option value="'.$row[store_name].'">'.$row[store_name].'</option>';
	  }
	echo '</select>';
	?>
	<input type="submit" value="search" class="btn btn-primary btn-sm">
	</form>
	<hr/>
</div>

</body>
<?php
//mysqli_free_result($result);
mysqli_close($conn);
?>
</html>