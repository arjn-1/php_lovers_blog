
<?php

session_start();
require_once("config/config.php");

?>
<?php

$query = " SELECT * FROM `admin` WHERE id = '{$_SESSION['id']}' ";
$run_query = mysqli_query($conn,$query);

if(mysqli_num_rows($run_query)==1){
    while($result = mysqli_fetch_assoc($run_query)){
         $admin_email = $result['email'];
         $admin_fullname = $result['fullname'];
         $admin_phone = $result['phone'];
         $admin_gender = $result['gender'];
         $admin_dob = $result['dob'];

    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            .styling{
                color: black;
                font-size: large;
            }
            /* body{
                /* background-color: #7dd1c2; */
                background-image: linear-gradient(to right bottom, #ff3535e3, #3a0096c9,#ff3535e3 );
            } */
        </style>
        <title>admin Profile</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="name.css" /> 
        <!-- Bootstrap CSS -->
   <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />  
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"><!--expand for resp collapsing and color schemes -->
  <a class="navbar-brand" href="#">Admin Login</a><!--for your company, product, or project name. -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown"><!--for grouping and hiding navbar contents by a parent breakpoint. -->
  <ul class="navbar-nav">
      
      
      
      <li class="nav-item">
        <a class="nav-link" href="viewpost2.php">View All Cars</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>


        <div id="profile">
            <!-- <center> -->
            <h1><strong>admin Information : </strong></h1><hr><br><br>
            <p class="name"><strong>Email: </strong><?php echo $admin_email; ?></p><br><br>
            <p class="name"><strong>Name: </strong><?php echo $admin_fullname; ?></p><br><br>
            <p class="name"><strong>Phone: </strong><?php echo $admin_phone; ?></p><br><br>
            <p class="name"><strong>Date of Birth: </strong><?php echo $admin_dob; ?></p><br><br>
            <p class="name"><strong>Gender: </strong><?php echo $admin_gender; ?></p><br><br>
            
        
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>"><!--it means that the view profile has to be processed in the same page-->
                    <!-- <input type="submit" name="back_btn" value="Back" href="welcome.php"> -->
                <br><br> <a  href="adminupdate.php">Update Information</a><br><br>
                    <a href="welcome.php">back</a>
                    
                </form>
            </p>
<!-- </center> -->
        </div>
    </body>
</html>