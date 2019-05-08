<?php
// Registration process, inserts user info into the database 
 

// Set session variables to be used on profile.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['name'] = $_POST['firstname'];

// Escape all $_POST variables to protect against SQL injections
$name = $mysqli->escape_string($_POST['firstname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));

      
// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM user WHERE email='$email'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");
    
}
else { // Email doesn't already exist in a database, proceed...

    $sql = "INSERT INTO user (name, email, password) " 
            . "VALUES ('$name','$email','$password')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] = "Regestration success !";
		header("location: success.php");

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}