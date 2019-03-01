<!DOCTYPE html>
<html>
<head>
	<title>CP</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"/>
	<link rel="stylesheet" type="text/css" href="CSS/index.css"/>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<?php require "db.php" ; ?>
    <?php
        session_start();
        if(isset($_POST['login']))
        {
            $uname=$_POST['email'];
            $passwd=$_POST['password'];
            $query="SELECT Password FROM Users WHERE email='$uname'";
            $rows=mysqli_query($connect,$query);
            if(!$rows)
                die("Problem in query");
            $row=mysqli_fetch_assoc($rows);
            if($row['Password']!=$passwd)
            {
                ?>
                    <script type="text/javascript">
                        alert("Invalid username or password");
                    </script>
                <?php
            }
            else
            {
                $_SESSION['username']=$uname;
                header("Location: compete.php");
            }
        }
        else if(isset($_POST['register']))
        {
            $uname=$_POST['email'];
            $passwd=$_POST['password'];
            if (!filter_var($uname, FILTER_VALIDATE_EMAIL)) {
              echo("<script>alert('$uname is not a valid email address');</script>");
            } else {
                $query="INSERT INTO Users VALUES('$uname','$passwd')";
                $row=mysqli_query($connect,$query);
                if(!$row)
                {
                    echo "<script>alert('User already exists!')</script>";
                    die("Problem in query");
                }
                $_SESSION['username']=$uname;
                header("Location: compete.php");
            }
        }
    ?>
	<div class="container-fluid logo"><span>CP</span></div>
	<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Sign In</h3>
                    <form method="post" >
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Your Email *" value="" required autofocus />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Your Password *" value="" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">
                            <a href="change.php" class="ForgetPwd">Forget Password?</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 login-form-2">
                    <h3>Sign Up</h3>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Your Email *" value="" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Your Password *" value="" required/>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="register" class="btnSubmit" value="Register" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

</body>
</html>