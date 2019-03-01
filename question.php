<!DOCTYPE html>
<html>
<head>
	<title>CP</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="CSS/question.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <?php
    	session_start();
    	if(!isset($_SESSION['username']))
    	{
    		header("Location: index.php");
    	}
    ?>
    <?php require "db.php" ; ?>
    <?php 
    	$val=$_GET['id'];
    	$query="SELECT * FROM Question WHERE ID=".$val;
    	$query1="SELECT * FROM TestCase WHERE QuestionID=".$val;
        $rows=mysqli_query($connect,$query);
        $row=mysqli_fetch_assoc($rows);
        $rows1=mysqli_query($connect,$query1);
        if(!$rows||(!$rows1))
            die("Problem in query");
    ?>
    <script type="text/javascript">
    	function replace(){
    		document.getElementById('hidden').value =CKEDITOR.instances.editor1.document.getBody().getText().replace("To write the code click on above icon Insert Code Snippet!,then only your code will work as expectedcode snippet widget","");
    	}
    	function logout(){
    		location.href='/CP/logout.php';
    	}
    </script>
</head>
<body >
	<div class="container-fluid logo">
	      <span>CP</span>
	      <button style="float: right;" name="btn" type="button" class="btn"><i class="fa fa-user-o" style="font-size:32px;color:white;" onclick="logout()"></i></button>
	</div>
	<div class="container">
		<div class="card shadow">
			<div class="card-header font-weight-bolder" style="color: white;">
				<?php 
					$val=$row['Name'];
					echo "$val";
				?>
				<span style="float: right;">
				<?php 
					$val=$row['Level'];
					echo "$val";
				?>
				</span>
			</div>
			<div class="card-body">
				<?php 
					$val=$row['Text'];
					echo "$val";
				?>
			</div>
			<div class="card-body">
				<span class="font-weight-bolder">Input:</span>
				<br/>
				<?php 
					$val=$row['Input'];
					echo "$val";
				?>
			</div>
			<div class="card-body ">
				<span class="font-weight-bolder">Output:</span>
			<br/>
				<?php 
					$val=$row['Output'];
					echo "$val";
				?>
			</div>
			<div class="card-body ">
				<span class="font-weight-bolder">Constraints:</span>
				<br/>
				<pre><!--
				--><?php 
					$val=$row['Constraints'];
					echo "$val";
				?>
				</pre>
			</div>
			<div class="card-body">
				<span class="font-weight-bolder">Example:</span>
				<br/>
				<span class="font-weight-bolder">Input:</span>
				<br/>
				<pre><!--
				--><?php 
					$val=$row['ExInput'];
					echo "$val";
				?>
				</pre>
				<span class="font-weight-bolder">Output:</span>
					<br/>
				<pre><!--
					--><?php 
						$val=$row['ExOutput'];
						echo "$val";
					?>
				</pre>
			</div>
			<div class="card-body">
			<button type="button" class=" btn btn-primary " style="display: inline-block;">My Submissions</button>
			<button type="button" class=" btn btn-primary ">All Submissions</button>
			</div>
		</div>
	</div>
	<form method="post">
		<div class="container">
			<div class="card shadow">
				 <textarea name="editor1" id="editor1" rows="10" cols="80">
		                To write the code click on above icon Insert Code Snippet!,then only your code will work as expected
		            </textarea>
		            <script>
		                CKEDITOR.replace( 'editor1' );
		            </script>
		            <input type="hidden" name="hidden" id="hidden"/>
				
					<button type="submit" name='submit' onclick="replace()" class=" btn btn-success float-right" style="display: inline-block;">Submit</button>
			</div>
			<div class="card shadow" style="max-height:300px;overflow: auto;">
				<div class="card-body">
					<?php
				   		if(isset($_POST['submit']))
				   		{
				   			$editor_data = $_POST[ 'hidden' ];
				   			$myFile=fopen('test/test.cpp', 'w');
				   			fwrite($myFile, $editor_data);
				   			$out="";
				   			exec("g++ -std=c++0x test/test.cpp -o test/test 2>&1",$out);
				   			if(count($out)==0)
				   			{
				   				while($in=mysqli_fetch_assoc($rows1))
				   				{
				   					$flag=0;
					   				$file=fopen('test/input.txt','w');
					   				$file1=fopen('test/output.txt','w');
					   				fwrite($file,$in['Input']);
					   				fwrite($file1, preg_replace("/([ ]*\r\n)|([ ]*\n)/","\n",$in['Output']));
					   				fclose($file1);
					   				fclose($file);
					   				exec("./test/test >test/out.txt <test/input.txt 2>&1");
					   				$file=fopen('test/out.txt', 'r');
					   				$out=fread($file, filesize('test/out.txt'));
					   				$out=preg_replace("/([ ]*\r\n)|([ ]*\n)/","\n",$out);
					   				fclose($file);
					   				$file=fopen('test/out.txt', 'w');
					   				fwrite($file, $out);
					   				fclose($file);
						   			$file=fopen('test/output.txt', 'r');
						   			$out=fread($file, 1000);
						   			fclose($file);
						   			$file=fopen('test/out.txt', 'r');
						   			$out1=fread($file, 1000);
						   			fclose($file);
						   			if($out!=$out1)
						   			{
						   				echo "<span class='font-weight-bolder'>Expected Outcome:</span><br/>";
						   				echo "<span class='font-weight-bolder' style='color:red;'>Wrong Answer</span><br/>";
						   				?>
						   				<pre><!--
						   				--><?php
						   				echo "$out";
						   				?>
						   				</pre>
						   				<?php
						   				echo "<span class='font-weight-bolder'>Your Outcome:</span><br/>";
						   				?>
						   				<pre><!--
						   				--><?php
						   				echo "$out1";
						   				?>
						   				</pre>
						   				<?php
						   				$flag=1;
						   				break;
						   			}
					   			}
					   			if($flag==0)
					   			{
					   				echo "<span class='font-weight-bolder'>Output:</span><br/>";
					   				echo "<span class='font-weight-bolder' style='color:green;'>Correct</span><br/>";
					   			}
				   			}
				   			else
				   			{
				   				
				   				foreach ($out as $key => $value) 
				   					echo "$value";
				   			}
				   		}
			   		?>	
			   	</div>	
			</div>
		</div>
	</form>
</body>
</html>