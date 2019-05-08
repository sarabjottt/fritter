<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome to Fritter</title>
  <?php include 'css/css.html'; ?>
</head>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in
		require 'login.php';   
	}
    elseif (isset($_POST['register'])) { //user registering 
        require 'register.php';
    }
}
?>
<body>
  <div class="form">
  <header>
      <h1>Welcome to <span>Fritter</span></h1></header>
      <ul class="tab-group">
        <li class="tab"><a href="#signup">Sign Up</a></li>
        <li class="tab active"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
		<div id="login">   
     	<form action="index.php" method="post" autocomplete="off">
          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name="email"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>
          
          <button class="button button-block" name="login" />Log In</button>
          
         </form>
         </div>
          
        <div id="signup">   
          
          <form action="index.php" method="post" autocomplete="off">
          <div class="top-row">
            <div class="field-wrap">
              <label>
                Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='firstname' />
            </div>
            </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name='email' />
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name='password' min="5" max="9"/>
          </div>
          
          <button type="submit" class="button button-block" name="register" />Register</button>
          
          </form>
          </div>  
      </div><br>
      
      <!-- Post-content -->
      <h2><br>Global Post</h2> 
		<p style="margin: 0;">
          <?php 
          // Showing total numbers of Post's 
          $sql ="SELECT * FROM `post`;";
          $result = $mysqli->query($sql);
          $num_rows = mysqli_num_rows($result);
		  echo "Total Posts $num_rows";
		  
		  //Showing 10 global post 
          $sql = "SELECT post.text,post.post_date, user.name FROM `post` INNER JOIN `user` 
          ON post.user_id = user.id ORDER BY `post`.`post_date` DESC LIMIT 10;";
          $res = $mysqli->query($sql);

          if ($res->num_rows > 0) {
         
    		 // output data of each row
     		while($row = $res->fetch_assoc()) {
     		echo "<article class="."comment"."><div class="."comment-body"."><div class="."text"."><p>". $row["text"]."</p></div>
     		<p class="."attribution".">by "."<a href="."#non".">".$row["name"]."</a> at ". $row["post_date"]."</p></div></article>";
    		}
		   } 
		   else {
     		echo "0 results";
		   }
          ?>
          </p>
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
