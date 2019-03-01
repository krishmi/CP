<!DOCTYPE html>
<html>
<head>
	<title>CP</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/compete.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	function changeQues(val){
    		level=val.value;
			try
			{
				xmlHttp=new XMLHttpRequest();
			}catch(e1){
				try{
					xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}catch(e2){
					try{
						xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
					}catch(e3){
						alert('Ajax not supported');
						return false;
					}
				}
			}
			xmlHttp.onreadystatechange=function() 
			{
				if(xmlHttp.readyState==4 && xmlHttp.status==200)
				{
					val.parentElement.children[1].innerHTML=xmlHttp.responseText;
				}
			}
			xmlHttp.open("GET","options.php?level="+level,true);
			xmlHttp.send(null);
    	}
        function logout(){
        location.href='/CP/logout.php';
        }
    </script>
</head>
<body>
    <div class="container-fluid logo ">
      <span>CP</span>
      <button style="float: right;" name="btn" type="button" class="btn"><i class="fa fa-user-o" style="font-size:32px;color:white;" onclick="logout()"></i></button>
    </div>
	<?php
      session_start();
      if(!isset($_SESSION['username']))
      {
        header("Location: index.php");
      }
    ?>
    <?php require "db.php" ?>
    <?php
    	if(isset($_POST['add']))
    	{
        	?>
    			<div class="container">
    				<div class="card mt-4">
    					<div class="card-header bg-primary" style="color: white">
	    					<?php
	    						echo $_POST['name'];
	    					?>
    					</div>
    					<div class="card-body">
    						<form class="form" method="post">
    							<input type="hidden" name="num" value="<?php echo $_POST['number']; ?>" />
    							<input type="hidden" name="nam" value="<?php echo $_POST['name']; ?>" />
    							<?php
    								for($i=1;$i<=intval($_POST['number']);++$i)
    								{
    							?>
    								<h4>Question <?php echo "$i"; ?></h4>
    								<br/>
			                        <div class="form-group">
			                            <select name="level" class="form-control" onchange="changeQues(this)">
			                            	<option>Select</option>
			                            	<option>Basic</option>
			                            	<option>Easy</option>
			                            	<option>Medium</option>
			                            	<option>Hard</option>
			                            </select>
			                        
			                        	<select class="form-control mt-4" name="<?php echo $i; ?>" >
			                        		
			                        	</select>
			                        </div>
    							<?php
    								}
    							?>
    							<div class="card-body">
	    							<div class="form-group ">
				                            <input type="submit" name="login" class="btnSubmit btn btn-success" value="Add" />
				                    </div>
			                    </div>
    						</form>
    					</div>
    				</div>
    			</div>
    		<?php
    	}
    	else if(isset($_POST['login']))
    	{
    		$query="INSERT INTO Challenges(Name) VALUES ('".$_POST['nam']."')";
    		$rows=mysqli_query($connect,$query);
    		if(!$rows)
    			die("Problem in query");
    		$query="SELECT * FROM Challenges WHERE Name='".$_POST['nam']."'";
    		$rows=mysqli_query($connect,$query);
    		$ID=mysqli_fetch_assoc($rows);
    		if(!$rows)
    			die("Problem in query");
    		for($i=1;$i<=intval($_POST['num']);++$i)
    		{
    			if($_POST[$i]!="0")
    			{
    				$query="INSERT INTO QuesChall VALUES (".$_POST[$i].",".$ID['ID'].")";
		    		$rows=mysqli_query($connect,$query);
		    		if(!$rows)
		    			die("Problem in query 1");
	    		}
    		}
            header('Location: compete.php');
    	}	
    ?>
</body>
</html>