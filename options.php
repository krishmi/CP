<?php require 'db.php';?>
<?php
	$level=$_GET['level'];
	$query="SELECT * FROM Question WHERE Level='".$level."'";
	$rows=mysqli_query($connect,$query);
	if(!$rows)
		die("Problem in query");
	while($row=mysqli_fetch_assoc($rows))
	{
		echo "<option value=".$row['ID'].">".$row['Name']."</option>";
	}
?>