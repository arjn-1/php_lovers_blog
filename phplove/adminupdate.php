<?php
session_start();


if (!isset($_SESSION["email"])) {
    header("Location: welcome.php");
}

include 'config/config.php';
// include 'welcome.php';
     
if (isset($_POST["update"])) {//when the update button is clicked
    $fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $dob = mysqli_real_escape_string($conn, $_POST["dob"]);

    

            $sql = "UPDATE admin SET fullname='$fullname', phone='$phone', dob='$dob'  WHERE email='{$_SESSION["email"]}'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Profile Updated Successfully')</script>";
            } else {
                echo "<script>alert('Profile can not Updated.')</script>";
                echo  $conn->error;
            }
    
    }

?>


<html>
   <head>
       <title>Updation of profile</title>
       <style>
           body{
            background-image: linear-gradient(to right bottom, #ff3535e3, #3a0096c9,#ff3535e3 );        
           }
           input{
               width: 40%;
               height: 5%;
               border: 1px;
               padding: 8px 15px 8px 15px;
               margin: 10px 0px 10px 0px;
               box-shadow: 1px 1px 2px 1px grey;
           }
           .styling{
                color: white;
                font-size: large;
            }
            .abd{
                color: pink;
                background-color: black;
            }
       </style>
   </head>

   <body>
       <center>
           <h1>Update Profile</h1>
           <hr>
           <form action="" method="POST">
               <!-- <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" required><br> -->
               <input type="text" name="fullname" placeholder="Update name" required><br>
               <input type="text" name="phone" placeholder="Update phone number" pattern="[0-9]{5} [0-9]{5}" required><br>
               <input type="text" name="dob" placeholder="Update dob" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" required><br>
               <!-- <input type="text" name="address" placeholder="Enter the address" ><br>
               <input type="text" name="city" placeholder="Enter the city" ><br>
               <input type="text" name="state" placeholder="Enter the state"><br>
               <input type="text" name="pin" placeholder="Enter the pin code"><br> -->

               <input class="abd" type="submit" name="update" value="UPDATE DATA"><br>
               <a class="styling" href="welcome.php">back</a>

           </form>
       </center>
   </body>
</html>