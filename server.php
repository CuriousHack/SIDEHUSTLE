<?php
session_start();
// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = htmlspecialchars($_POST['username']);
  $email = htmlspecialchars($_POST['email']);
  $password_1 = htmlspecialchars($_POST['password_1']);
  $password_2 = htmlspecialchars($_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) {
  array_push($errors, "Username is required");
   }
  if (empty($email)) {
   array_push($errors, "Email is required");
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    array_push($errors, "Not a valid Email Address");
    }
  if (empty($password_1)) { 
  array_push($errors, "Password is required");
   }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // check if there is an active session
  if (isset($_SESSION['username'])) { // if session is set
   session_unset();
  }else{
  if(count($errors) == 0){
  //register the user with session if there are no errors
  $_SESSION['username'] = $username;
  $_SESSION['email'] = $email;
  $_SESSION['password'] = $password_1;
  $_SESSION['success'] = "You are now logged in";
  header('location: index.php');
  }
  }
}
// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
  if (count($errors) == 0) {
  //check if the session details tally with the newly collected data
  	if ($_SESSION['username'] == $username && $_SESSION['password']==$password ) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
}
}
}

?>