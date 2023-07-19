<?php
//Here the connection file i included so that it can be used in this current page.
require_once "config/config.php";//The require_once keyword is used to embed PHP code from another file. If the file is not found, a fatal error is thrown and the program stops. If the file was already included previously, this statement will not include it again.
$email = $password = $confirm_password = $phone = $address = $city = $state = $pin = $fullname = $age = $gender = "";//new empty variables 
$email_err = $password_err = $confirm_password_err = $err = "";//new variable 

if($_SERVER['REQUEST_METHOD'] == "POST"){// collect the value of input field
    //check if email is empty
    if(empty(trim($_POST["email"]))){//after removing white space from both side of the string to check if it is empty
        $email_err = "email cannot be blank";
        echo "<script>alert('email cannot be blank')</script>";
    }
    else{
        $sql = "SELECT id FROM admin WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);//returns a statement object or false if it is not created
        if($stmt){//if it is created
            mysqli_stmt_bind_param($stmt, "s", $param_email);//function is used to bind variables to the parameter markers of a prepared statement
            
            //set value of param  email
            $param_email = trim($_POST['email']);

            //try to execute the statement
            if(mysqli_stmt_execute($stmt)){//Executes previously prepared statement.that has been prepared at 13line
             mysqli_stmt_store_result($stmt);//stores the result
                if(mysqli_stmt_num_rows($stmt) == 1){//if that email matches to one in the table 
                    $email_err = "This email is already taken";
                    echo "<script>alert('This Email is already taken')</script>";
                }
                else{
                    $email = trim($_POST['email']);//store that name clearing the white spaces from the string
                }
            }
            else{
                echo "something went wrong";
            }
        }
    }
    mysqli_stmt_close($stmt);


//check for phone
if(empty(trim($_POST['phone']))){//collect the value of phone no and if it is empty
  $err = "phone cant be blank";
  echo "<script>alert('Phone number cannot be blank')</script>";
}
else{
$phone = trim($_POST['phone']);//input the phone after clearing white spaces
}



//check for fullname
if(empty(trim($_POST['fullname']))){//collect the value of full name and if it is empty
  $err = "fullname can't be blank";
  echo "<script>alert('Fullname cannot be blank')</script>";
}
else{
$fullname = trim($_POST['fullname']);//input the fullname after clearing white spaces
}

//check for gender
if(($_POST['gender']) == "Choose..."){//collect the value of gender and if it is empty
  $err = "gender cant be blank";
  echo "<script>alert('gender cant be blank')</script>";
}
else{
$gender = trim($_POST['gender']);//input the gender after clearing white spaces
}

if(empty(trim($_POST['age']))){//collect the value of dob and if it is empty
  $err = "dob can't be blank";
  echo "<script>alert('dob cannot be blank')</script>";
}
else{
$age = trim($_POST['age']);//input the dob after clearing white spaces
}

//check for password
if(empty(trim($_POST['password']))){//collect the value of password and if it is empty
    $password_err = "Password cant be blank";
    echo "<script>alert('Password cannot be blank')</script>";
}
elseif(strlen(trim($_POST['password'])) < 5){//if the password is not empty but less than 5 char
    $password_err = "Password cannot be less tahan 5 chars";
    echo "<script>alert('Password cannot be less than 5 characters')</script>";
}
elseif(!preg_match('@[0-9]@', $_POST['password'])){//The preg_match() function returns whether a match was found in a string
  $password_err = "Password should have 1 number in it";
    echo "<script>alert('Password should have 1 number in it')</script>";
}
elseif(!preg_match('@[A-Z]@', $_POST['password'])){
  $password_err = "Password should have atleast one uppercase letter in it";
    echo "<script>alert('Password should have 1 uppercase letter in it')</script>";
}
elseif(!preg_match('@[a-z]@', $_POST['password'])){
  $password_err = "Password should have atleast one lowercase letter in it";
    echo "<script>alert('Password should have 1 lowercase letter in it')</script>";
}
else{
    $password = trim($_POST['password']);//input the password after clearing white spaces
}

//check for confirm passsword
if(trim($_POST['password']) != trim($_POST['confirm_password'])){//if the confirm password and password does not match
    $password_err = "Passwords should match";
    echo "<script>alert('Password should match')</script>";
}

//if there were no errors, go ahead and insert into the database
if(empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($err))//no errors were there
{
    $sql = "INSERT INTO admin (email, fullname, gender,phone ,  dob,  password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ssssss" ,$email , $fullname,$gender, $phone, $age , $param_password);//to create two new parameter to store string
        //set these parameters
        $param_password = password_hash($password, PASSWORD_DEFAULT);//to hash the password using by default algorithm
        //try to execute the query
        if(mysqli_stmt_execute($stmt))//if the execution is successful got to login.php
        {
            header("location: welcome.php");
        }
        else{
            echo "Something went wrong ... cannot redirect";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>







<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- responsive-->

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link href="./style3.css" rel="stylesheet" />

    <title>Marksheet system</title>
  </head>
  <style> 
.btn-primary{
  background-color: black;
  border-color: black;
  border-radius: 5px;
}
</style>
  <body >
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"><!--expand for resp collapsing and color schemes -->
  <a class="navbar-brand" href="#">NEW ADMIN REGISTER PAGE</a><!--for your company, product, or project name. -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown"><!--for grouping and hiding navbar contents by a parent breakpoint. -->
  <!-- <ul class="navbar-nav">
   
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="adminlogin.php">Admin Login</a>
      </li>
    </ul> -->
  </div>
</nav>
    <div class="container mt-4">
      <h3>Register Here:</h3>
      <hr />
      <form action="" method="post">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input
              type="email"
              class="form-control"
              name="email"
              id="inputEmail4"
              placeholder="eg. someone@xyz.com"
              required
            />
          </div>
          <div class="form-group col-md-6">
            <label for="inputname">Full Name</label>
            <input
              type="text"
              class="form-control"
              id="inputname"
              name="fullname"
              placeholder="eg. JOHN WATSON"
              required
            />
          </div>
          <div class="form-group col-md-6">
            <label for="inputage">Date Of Birth</label>
            <input
              type="text"
              class="form-control"
              id="inputage"
              name="age"
              pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"
              placeholder="eg. 12"
              required
            />
          </div>
          <div class="form-group col-md-4">
            <label for="inputgender">Gender</label>
            <select id="inputgender" name="gender" class="form-control">
              <option selected>--select--</option>
              <option>Male</option>
              <option>Female</option>
              <option>Other</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="inputPhone">Phone No.</label>
            <input
              type="text"
              class="form-control"
              id="inputPhone"
              name="phone"
              placeholder="eg. 9080XXXXXX"
              required
            />
          </div>
         
            <div class="form-group col-md-6">
              <label for="inputPassword4">Password</label>
              <input
                type="password"
                class="form-control"
                name="password"
                id="inputPassword4"
                placeholder="Password"
                required
              />
            </div>
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Confirm Password</label>
            <input
              type="password"
              class="form-control"
              name="confirm_password"
              id="inputPassword"
              placeholder="Confirm Password"
              pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}"
              title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"
              required
            />
          </div>
          <button type="submit" class="btn btn-primary">Sign Up</button>
          <a href="welcome.php">Back</a>
        </div>
        
      </form>
    </div>
    <div id="message" class="container mb-4">
      <h3>Password must contain the following:</h3>
      <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
      <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
      <p id="number" class="invalid">A <b>number</b></p>
      <p id="length" class="invalid">Minimum <b>5 characters</b></p>
    </div>
    <script type="text/javascript" src="./pswrd-valid.js"></script>
  </body>
</html>
