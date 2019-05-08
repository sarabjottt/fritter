<?php
include_once ('db.php');
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Welcome <?= $name ?></title>
  <?php include 'css/css.html'; ?>
</head>

<body>
  <div class="form">

	<h1 style="font-family: roboto slab;font-size: 50px;font-weight: 400;letter-spacing: 5px; color: #1ab188;margin-bottom: 20px;" >Fritter</h1> 
	<p>Welcome back (<span><?= $name ?></span>)</p>
	<p style="margin-bottom: 10px; text-decoration: underline;">Recent post's</p> 
	<p>
	  <?php 
			//using inner joint to show post, name & date together 
		  $sql = "SELECT post.id,post.text,post.post_date, user.name FROM `post` 
		  INNER JOIN `user` ON post.user_id = user.id ORDER BY `post`.`post_date` DESC;";
		  $res = $mysqli->query($sql);

		  if ($res->num_rows > 0) {
			 // output data of each row
			while($row = $res->fetch_assoc()) {
			echo "<br>"
		?>
		
		<article class="comment">
		<div class="comment-body">
		<div class="text">
		<p><?php echo $row["text"] ?></p></div>
		<p class="attribution">by <a href="#non"><?php echo $row["name"] ?> </a> at <?php echo $row["post_date"] ?></p></div></article>
		<a href="#" class="like" id="<?php echo $row['id']; ?>" > <button class="fritter" name="/">Like</button></a>
		<a href="#" class="comment" ><button class="fritter" name="/">Comment</button></a>

		<?php
			}
		   } 
			else {
			echo "0 results";
			}
		?>
	  </p>
	  
	  <!--( Posting New Post )-->
	<form id="form1" method="post" action="insert-post.php">
		<textarea name="article" onKeyDown="limitText(this.form.article,this.form.countdown,120);" onKeyUp="limitText(this.form.article,this.form.countdown,120);" cols="0" rows="3" class="widebox" id="article"></textarea>
		<input style="margin:0px;font-size: 15px;height: 10%;padding: 6px;background: none;background-image: none;border: none;color: rgba(255, 255, 255, 0.52);border-radius: 0;text-align: right;" readonly type="text" name="countdown" size="3" value="100">
		<input type="submit" name="submit" value="Post" id="submit">
	</form>
	
	<a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>
    </div>
    
    <!--( Java Sript for limit and showing the character )-->
	<script language="javascript" type="text/javascript">
	function limitText(limitField, limitCount, limitNum) {
		if (limitField.value.length > limitNum) {
			limitField.value = limitField.value.substring(0, limitNum);
		} else {
			limitCount.value = limitNum - limitField.value.length;
		}
	}
	</script> 
 
	
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="js/index.js"></script>

</body>
</html>
