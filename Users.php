<?php include('SconnectDatabase.php');
  
  if (empty($_SESSION['username'])) {
    header("location:Index.php");
  }
  $sqll="SELECT username FROM users";
  $rets=mysqli_query($db,$sqll);
?>

<!Doctype html>
<html>
<head>
  <title>StackoverFlow</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="stylesheet" type="text/css" href="tag.css">
  <link rel="import" href="https://fonts.googleapis.com/css?family=Roboto">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <style type="text/css">
    *{
      margin: 0px;
      padding: 0px;
    }
    
    #main{
      width: 100%;
      height: 100%;
    }
    
    #body{
      width: 100%;
      height: 630px;
    }

    #nav{
      width: 25%;
      height: 630px;
      background-color: #A9A9A9;
      float: left;

    }

    #nav>ul{
      margin-top: 70px;
      float: center;
      background-color: #d3d3d3;
      margin-left: 40px;
      margin-right: 40px;

    }

    #nav>ul>li{
      border: 1px solid red;
      list-style: none;
      margin-top: 1px;
      
    }

    #nav>ul>li>a{
      display: block;
      text-decoration: none;
      color: black;
      font-weight: bold;
      text-align: left;
      padding: 3px;
      line-height: 60px;
      font-size: 25px;
    }
    #content{
      width: 75%;
      height: 630px;
      background-color: #fdedec;
      float: right;
      
    }

    #footer{
      width: 100%;
      background-color: #333;
      height: 30px;
    }

    
  </style>
  
</head>

<body>
    <div id="header">
      <div id="logo"> 
        <img src="Image/stack5.png" width="300px" height="80px">
      </div>
      <ul id="navbar">
        <li><a href="#">Home</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Notifications</a></li>
        <li><a href="#">Achievements</a></li>
        <li><a href="Index.php?logout='1'">Logout</a></li>
      </ul>
    </div>

          <div id="body">
              <div id="nav">
                <ul>
                  <li><a href="Home.php">Home</a></li>
                  <li><a href="Users.php">Users</a></li>
                  <li><a href="Home.php" class="ask-ques">Ask Question</a></li>
                  <li><a href="Home.php" class="all-ques">Questions</a></li>
                  <li><a href="#">Latest News</a></li>
                  <li><a href="#">Jobs</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>

              </div> 

              <div id="content">

                <div class="qpanel">
                  <div class="heading">Users</div>
                  <div class="usser">
                    <?php while ($row=mysqli_fetch_array($rets) ) { ?>
                    <ul>
                      <li><?php echo $row["username"];    ?></li>
                    </ul>

                    <?php  }  ?>
                  </div>

                </div>  



              </div>

          </div>

    <div id="footer">

    </div>

  </div>
  <script src="tags.js"></script>
</body>

</html>