<?php 
$qid='';
include('SconnectDatabase.php');
if (empty($_SESSION['username']))
{
  header("location:Index.php");      
}
$username=$_SESSION['username'];
if (isset($_GET['qid'])) {
		$qid=$_GET['qid'];
	}
  $_SESSION['qqid']=$qid;
	$db=mysqli_connect('localhost','root','','stackoverflow');
	
	$ansquery="SELECT * FROM questions WHERE qid='$qid'";
    $ansresult=mysqli_query($db,$ansquery);

  $anss="SELECT * FROM answers WHERE qid='$qid'";
  $anssr=mysqli_query($db,$anss);

  $viewsquery="UPDATE questions 
              set 
              viewusers=CONCAT(viewusers,'$username,') WHERE qid=$qid"; 
  $viewresult=mysqli_query($db,$viewsquery);

  $qqery="SELECT COUNT(0) from answers where qid='$qid'";
  $rr=mysqli_query($db,$qqery);
  $roww=mysqli_fetch_array($rr);
  $noans=$roww[0];

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
    	$(".ques-ans").hide();

    $(".ansbtn").click(function(){
    	$(".ques-ans").slideDown(1500);
    	$(".ques-ans").show();
      $(".uudata").hide();
      $(".anss").animate({height:30},1500);
      

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
                  <li><a href="Home.php" class="ask-ques">Ask Question</a></li>
                  <li><a href="Home.php" class="all-ques">Questions</a></li>
                  <li><a href="#">Latest News</a></li>
                  <li><a href="#">Jobs</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>

              </div> 

              <div id="content">
                                     
                    <div class="show-ans">
                      <div class="anstop"><h1>Your Question</h1></div>
                      <?php  while ($row=mysqli_fetch_array($ansresult) )
                      { 
                        $mytags=$row["tags"];
                        $myarray=array();
                        $viewusers=array();
                        $myarray=explode(',',$mytags);
                        $viewusers= $row["viewusers"] ;
                        $viewsarray=explode(',',$viewusers);
                        $totalviews=sizeof($viewsarray)-1;
                        

                        ?>

                      <div class="q-box">
                        <div class="ldata">
                          <table style="margin-top:15px">
                            <tr>
                              <td><?php echo $noans; ?></td>
                            </tr>
                            <tr>
                              <td>Answers</td>
                            </tr>
                            <tr>
                              <td><?php echo $totalviews;  ?></td>
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
                                  <td><a class="q"><?php echo $row["question"] ?></a></td>
                                </tr>
                                
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


                          <div class="uudata">
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
                      <div class="bttn">
                     <button class="ansbtn">Want to Answer</button>  </div>

                     <div class="ques-ans">Your Answer
                      <?php include("Serror.php") ;?>
                      
                      <form method="post">
                       	<table>
                     		<tr>
                     			<td><textarea cols="90" rows="4" placeholder="Answer here" name="aans"></textarea></td>
                     		</tr>
                     		<tr>
                     			<td><button class="anssub" name="anssubmit" style="padding:5px;background:#228b22;color:white;font-size:18px;
									border: 2px solid #006400;margin-top:5px;margin-bottom:10px;cursor:pointer;">Submit</button></td>
                     		</tr>
                     	</table>
                      </form>
                     </div>
                      <div class="tp"><h3>All Answers</h3></div>
                     <?php  while ($roww=mysqli_fetch_array($anssr)) {  ?>
                       
                    
                     <div class="anss">

                      <div class="a"><p><?php echo $roww['answer']; ?></p></div>
                      <div class="uudata">
                            <table>
                              <tr>
                                <td class="datime"><?php echo "asnwered on: ".$roww["datetime"]; ?></td>
                              </tr>
                              <tr>
                                <td class="usernm"><?php echo "User: ".$roww["username"]; ?></td>
                              </tr>
                            </table>
                          </div>
                     </div>
                     <?php }  ?>

                     
                    </div> 



              

          </div>

    

  </div>

  <div id="footer">

    </div>
 </body>

</html>