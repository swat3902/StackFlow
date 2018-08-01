<?php include('SconnectDatabase.php');
  
  if (empty($_SESSION['username'])) {
    header("location:Index.php");
  }
?>

<!Doctype html>
<html>
<head>
  <title>StackoverFlow</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="stylesheet" type="text/css" href="tag.css">
  <link rel="import" href="https://fonts.googleapis.com/css?family=Roboto">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script>
      $(document).ready(function(){
        

        $(".qpanel").hide();
        $(".qpanel").css("background","none");

        $(".ask-ques").click(function(){
          $(".qpanel").show();
          $(".show-ques").hide();
          // $(".error").removeData("");
          $(".show-ques").css("background","none");

        });

        $(".all-ques").click(function(){
          $(".show-ques").show();
          $(".qpanel").hide();
          $(".show-ques").css("background","gray");
          $(".qpanel").css("background","none");

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
                  <li><a href="#" class="ask-ques">Ask Question</a></li>
                  <li><a href="#" class="all-ques">Questions</a></li>
                  <li><a href="#">Latest News</a></li>
                  <li><a href="#">Jobs</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>

              </div> 

              <div id="content">
                  <div class="qpanel">
                    
                    <div class="heading">Ask Your Queries?</div>

                    <form method="post" action="Home.php">
                      <div class="qdata">
                        <?php include("Serror.php") ;?>
                         
                        <label class="lb">Enter Question:</label><br>
                        <input type="text" name="qname" placeholder="Your Question" class="input"><br>
                        <label class="lb">Enter Tags:</label><br>
                        
                          <div class="tags-input" data-name="tags-input">
                              <!--<span class="tag">CSS<span class="close"></span></span>
                              <span class="tag">JavaScript<span class="close"></span></span>
                              <span class="tag">HTML<span class="close"></span></span>-->
                          </div>
                                    
                        <button class="btn" name="submit" type="submit">Submit</button>
                      </div>

                    </form> 
                      
                    </div>   

                    <div class="show-ques">
                      <div class="top"><h1>All Questions</h1></div>
                      <?php  while ($row=mysqli_fetch_array($res) )
                      { 
                        $mytags=$row["tags"];
                        $myarray=array();
                        $viewsarray=array();
                        $myarray=explode(',',$mytags);
                        $qqid=$row["qid"];
                        $qqery="SELECT COUNT(0) from answers where qid='$qqid'";
                        $rr=mysqli_query($db,$qqery);
                        $roww=mysqli_fetch_array($rr);
                        $noans=$roww[0]; 
                        $viewusers= $row["viewusers"] ;
                        $viewsarray=explode(',',$viewusers);
                        $totalviews=sizeof($viewsarray)-1;             

                        ?>

                      <div class="ques-box">
                        <div class="ldata">
                          <table>
                            <tr>
                              <td><?php echo $noans;  ?></td>
                            </tr>
                            <tr>
                              <td>Answers</td>
                            </tr>
                            <tr>
                              <td><?php echo $totalviews; ?></td>
                            </tr>
                            <tr>
                              <td>Views</td>
                            </tr>

                          </table>
                        </div>
                        <div class="rdata">
                          <div class="qes">
                              <table>
                                <tr>
                                  <td><?php echo "<a class='q'name='qqq' href='Answers.php?qid=".$qqid."'>" ?>
                                    <?php echo $row["question"].$qqid;  ?></a></td>
                                </tr>
                                
                                <tr class="spacer"></tr>
                                <tr class="spacer"></tr>
                                <tr class="spacer"></tr>
                                <tr class="spacer"></tr>
                                <tr class="spacer"></tr>
                                <tr class="spacer"></tr>
                                <tr class="spacer"></tr>
                                <tr class="spacer"></tr>
                                <tr>
                                  <td class="tg"><?php 
                                    foreach ($myarray as $qtag) {
                                      ?>
                                      <a name="qtags"><?php echo $qtag; ?></a>

                                    <?php } ?> </td>
                                  
                                </tr>
                              </table>    

                          </div>
                          <div class="udata">
                            <table>
                              <tr>
                                <td class="datime"><?php echo "asked on: ".$row["datetime"]; ?></td>
                              </tr>
                              <tr>
                                <td class="usernm"><?php echo "User: ".$row["username"]; ?></td>
                              </tr>
                            </table>
                          </div>

                        </div>
                      </div>

                      <?php 
                        }
                      ?>
                      <div class="pageno" align="center">
                        <?php 
                          $page_query="SELECT * FROM questions ORDER BY qid DESC";
                          $page_result=mysqli_query($db,$page_query);
                          $total_records=mysqli_num_rows($page_result);
                          $total_pages=ceil($total_records/$record_per_page);
                          for ($i=1; $i<=$total_pages; $i++) 
                          { 
                            echo "<a href='Home.php?page=".$i."'>".$i."  "."</a>";
                          }

                         ?>

                      </div>
                    </div> 



              </div>

          </div>

  </div>

   <div id="footer">

    </div>

  <script src="tags.js"></script>
</body>

</html>