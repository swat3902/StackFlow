<?php  include('SconnectDatabase.php');   ?>

<!Doctype html>
<html>
<head>
  <title>StackoverFlow</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="import" href="https://fonts.googleapis.com/css?family=Roboto">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
      $(document).ready(function(){
        $(".login-form").hide();
        $(".login").css("background","none");

        $(".login").click(function(){
            $(".signup-form").hide();
            $(".login-form").show();
            $(".signup").css("background","none");
            $(".login").css("background","#fff");
        });

        $(".signup").click(function(){
            $(".signup-form").show();
            $(".login-form").hide();
            $(".signup").css("background","#fff");
            $(".login").css("background","none");
        });

        
      });
  </script>
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
      background-color: #e9eaea ;
      float: right;
      font-family: 'Roboto',sans-serif;
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
        <li><a href="#">Help</a></li>
      </ul>
    </div>

          <div id="body">
              <div id="nav">
                <ul>
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Users</a></li>
                  <li><a href="#">Tags</a></li>
                  <li><a href="#">Top Questions</a></li>
                  <li><a href="#">Latest News</a></li>
                  <li><a href="#">Jobs</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>

              </div> 

              <div id="content">

                <div class="container">
                    <div class="signup">sign up</div>
                    <div class="login">log in</div>
                  <form method="post" action="Index.php">
                    <div class="signup-form">
                      <?php include("Serror.php") ;  ?>
                        <input type="text" name="email" placeholder="Your Email Address" class="input" value="<?php $email; ?>"><br>
                        <input type="text" name="username" placeholder="Choose a Username" class="input" value="<?php $username; ?>"><br>
                        <input type="password" name="pass1" placeholder="Choose a Password" class="input"><br>
                        <input type="password" name="pass2" placeholder="Confirm Password" class="input"><br>
                        <button class="btn" name="register" type="submit">create account</button>
                    </div>
                    </form>
                    <form method="post" action="Index.php">
                    <div class="login-form">
                        <?php include("Serror.php") ;  ?>
                        <input type="text" name="user" class="input" placeholder="Username"><br>
                        <input type="password" name="pass" class="input" placeholder="Password"><br>
                        <button class="btn" name="login" type="submit">log in</button>
                        <span><a href="#">Forgot Username or Password</a></span>
                    </div>
                    </form>
                </div>

              </div>

          </div>

    <div id="footer">

    </div>

  </div>
</body>

</html>