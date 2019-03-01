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
    <script type="text/javascript">
      function logout(){
        location.href='/CP/logout.php';
      }
    </script>
  </head>
  <body>
    <?php
      session_start();
      if(!isset($_SESSION['username']))
      {
        header("Location: index.php");
      }
    ?>
    <?php require "db.php" ?>
    <div class="container-fluid logo ">
      <span>CP</span>
      <button style="float: right;" name="btn" type="button" class="btn"><i class="fa fa-user-o" style="font-size:32px;color:white;" onclick="logout()"></i></button>
    </div>
    <div class="container-fluid p-0">
    
        <div id="home" class="container "><br>
          <?php
            $query="SELECT * FROM QuesChall WHERE ChallengeId=".$_GET['id'];
            $rows=mysqli_query($connect,$query);
            if(!$rows)
              die('Problem in query');
            while($row=mysqli_fetch_assoc($rows))
            {
              $query="SELECT * FROM Question WHERE ID=".$row['QuestionID'];
              $row1=mysqli_query($connect,$query);
              $row=mysqli_fetch_assoc($row1);
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
       
      </div>
  </body>
</html>