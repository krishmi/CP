<?php require 'db.php'; ?>
<?php
	if($_GET['name']=="")
	{
		echo "Yes";
	}
	else
	{
		$query="SELECT * FROM Challenges WHERE Name='".$_GET['name']."'";
	    $rows=mysqli_query($connect,$query);
	    if(!$rows)
	      die('Problem in query');
	    if(mysqli_fetch_assoc($rows))
	        echo "Yes";
	    else
	    	echo "No";
	}
?>