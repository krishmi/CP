<!DOCTYPE html>
<html>
<head>
	<title>CP</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="CSS/change.css"/>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<?php require 'db.php' ?>
	<?php 
		if(isset($_POST['submit']))
		{
			$email=$_POST['email'];
			$query="SELECT * FROM Users WHERE Email='$email'";
			$rows=mysqli_query($connect,$query);
			if(!$rows)
				die('Problem in query');
			$row=mysqli_fetch_assoc($rows);
			if($row)
			{
				
			}
			else
				echo "<script>alert('Invalid email');</script>";
		}
	 ?>
</head>
<body>
	<div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="post">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submit">Send Mail</button>
            </form>
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>
</html>