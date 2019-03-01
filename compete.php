<!DOCTYPE html>
<html>
  <head>
    <title>CP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="CSS/compete.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <?php
      session_start();
      if(!isset($_SESSION['username']))
      {
        header("Location: index.php");
      }
    ?>
    <?php require "db.php" ?>
    <script type="text/javascript">
      flag=true;
      function logout(){
        location.href='/CP/logout.php';
      }
      function checkName(val){
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
          if(xmlHttp.responseText=="No")
            flag=false;
        }
      }
      xmlHttp.open("GET","checkName.php?name="+val.value,true);
      xmlHttp.send(null);
      }
      function checkFlag()
      {
        if(flag)
        {
          alert('Already a challenge with given name exists!');
          return false;
        }
        else
          return true;
      }
    </script>
  </head>
  <body>
    <div class="container-fluid logo ">
      <span>CP</span>
      <button style="float: right;" name="btn" type="button" class="btn"><i class="fa fa-user-o" style="font-size:32px;color:white;" onclick="logout()"></i></button>
    </div>
    <div class="container-fluid p-0">
      <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="nav-item">
          <a class="nav-link active font-weight-bold" data-toggle="tab" href="#home">Practise</a>
        </li>
        <li class="nav-item">
          <a class="nav-link font-weight-bold" data-toggle="tab" href="#challenge">Challenges</a>
        </li>
      </ul>

    <!-- Tab panes -->
      <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
          <?php
            $query="SELECT * FROM Question";
            $rows=mysqli_query($connect,$query);
            if(!$rows)
              die('Problem in query');
            while($row=mysqli_fetch_assoc($rows))
            {
          ?>
            <div class="w-75 shadow-lg p-4 mb-4 h-25 font-weight-bold rounded question" style="display: inline-block;">
              <?php
                $val=$row['Name'];
                echo "$val";
              ?>
              <div class="bg-white w-25  pl-5 h-30 rounded float-right" style="color: blue;" >
              <?php
                $val=$row['ID'];
              ?>
              <a href="/CP/question.php?id=<?php echo $val ; ?>" >Solve</a>
            </div>
          </div>
          <?php
            }
          ?>
        </div>
        <div id="challenge" class="container tab-pane fade"><br>
        <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#myModal">Add challenge</button>
          <?php
            $query="SELECT * FROM Challenges";
            $rows=mysqli_query($connect,$query);
            if(!$rows)
              die('Problem in query');
            while($row=mysqli_fetch_assoc($rows))
            {
          ?>
          <br/>
            <div class="w-75 shadow-lg p-4 mb-4 h-25 font-weight-bold rounded question" style="display: inline-block;">
              <?php
                $val=$row['Name'];
                echo "$val";
              ?>
              <div class="bg-white w-25  pl-5 h-30 rounded float-right" style="color: blue;" >
              <?php
                $val=$row['ID'];
              ?>
              <a href="/CP/challenge.php?id=<?php echo $val ; ?>" >Participate</a>
            </div>
          </div>
          <?php
            }
          ?>
        </div>
      </div>
    </div>
    <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered model-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Challenge</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
	        <form method="post" action="addChallenge.php">
			  <div class="form-group">
			    <label for="name">Name:</label>
			    <input type="text" name="name" class="form-control" id="name" onchange ="checkName(this)">
			  </div>
			  <div class="form-group">
			    <label for="num">Number of qestions:</label>
			    <input type="number" name="number" class="form-control" id="num">
			  </div>
			  <button type="submit" onclick ="return checkFlag()" class="btn btn-primary" name="add">Add</button>
			</form>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>