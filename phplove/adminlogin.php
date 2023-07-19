<?php
//this will be used for login


session_start();//starting a new session

//check if user is already logged in
if(isset($_SESSION['email']))//if the email is set for this session
{
    header("location: welcome.php");//if true stay on 
    exit;
}


require_once "config/config.php";//making connection with the database

$email = $password = "";//new variables
$email_err = $password_err = "";

//if request method is post              //request - used to collect data 
if($_SERVER['REQUEST_METHOD'] == "POST"){//post - to collect value of input field
    if(empty(trim($_POST['email'])))//if the email is empty
    {
        $email_err = "Please enter email";
        echo "email is not entered";
    }
    elseif(empty(trim($_POST['password'])))//if the password is empty
    {
        $err = "Please enter password";
        echo "password is not entered";
    }
    elseif(strlen(trim($_POST['password'])) < 5){//if the length of password entered is less than 5
      $err = "password less than 5 character";
      echo "password cannot be less than 5 characters";

    }
    else{
        $email = trim($_POST['email']);//enter the email
        $password = trim($_POST['password']);//password

    }
   
    if(empty($email_err) && empty($password_err))//if no error is there
    {
        $sql = "SELECT id, email, password FROM admin WHERE email = ?";//to get the email
        $stmt = mysqli_prepare($conn, $sql);//used to prepare sql statement for execution
        mysqli_stmt_bind_param($stmt, "s", $param_email);//creating new parameter to bind variables in it
        $param_email = $email;
        //try to execute the statement
        if(mysqli_stmt_execute($stmt)){//if the mysql statement is executed
          mysqli_stmt_store_result($stmt);//then store the result
          if(mysqli_stmt_num_rows($stmt) == 1){//if that email matches to one in the table 
            
            mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);//to bind the result that has come from sql with the stmt
            if(mysqli_stmt_fetch($stmt))//if the statement is returning something like the email is already present in it
            {
                if(password_verify($password,$hashed_password)){
                //this means the password is correct.and allow user to login
                session_start();//starting the new session with the following session variables
                $_SESSION["email"] = $email;
                $_SESSION["id"] = $id;
                $_SESSION["loggedin"] = true;
                }
                //Redirect user to welcome page
                header("location: welcome.php");
            }
        }
        }
    }

}
?>










<!-- nav bar -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
   <!-- Bootstrap CSS -->
   <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link href="./style3.css" rel="stylesheet" />

    <title>php lover blog</title>
  </head>
  <style> 
html{
/* background-color: #7dd1c2; */

}
.btn-primary{
  background-color: black;
  border-color: black;
  border-radius: 5px;
}
</style>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark"><!--expand for resp collapsing and color schemes -->
  <a class="navbar-brand" href="#">Amdin Login </a><!--for your company, product, or project name. -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown"><!--for grouping and hiding navbar contents by a parent breakpoint. -->
  <ul class="navbar-nav">
      
      
      <li class="nav-item">
        <a class="nav-link" href="index.php">all post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="adminregister.php">register</a>
      </li>
    </ul>
  </div>
</nav>
<!-- login page  -->
<div class="container mt-4">
<h3>Please Login Here:</h3>
<hr>

<form action="" method="post"><!--action-Where to send the form-data when the form is submitted.-->
                               <!--POST is used to send data to a server to create/update a resource. -->

  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email" required>
    <!--form-control for size , aria-describedby used to indicate the IDs of the elements that describe the object -->
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" required>
  </div>
  <button type="submit" class="btn-primary" >Submit</button>
</form>
</div>
<script type="text/javascript" src="pswrd-valid.js"></script>
</body>
</html>