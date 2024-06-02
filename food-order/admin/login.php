<?php
include('../config/constants.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Document</title>
</head>

<body>
    <div class="login">
        <h3 class="text-center">
            Login
        </h3><br><br>
            <?php 
                
                if(isset($_SESSION['login-u'])){  // Checking the variable is set

                    echo $_SESSION['login-u']; // Display the message
                    unset($_SESSION['login-u']); //Removing the message
                }
                
                if(isset($_SESSION['login-no'])){  // Checking the variable is set

                    echo $_SESSION['login-no']; // Display the message
                    
                    if(isset($_SESSION['user']))
                    {  
                
                        unset($_SESSION['login-no']); //Removing the message

                    }
                }

                
            ?>


        <br><br>

        <!-- Login form is started here  -->

        <form action="" method="post">

            Username :
            <input type="text" name="username" placeholder="Enter  your userame"> <br> <br>
            Password :
            <input type="password" name="password" placeholder="Enter  your password"> <br> <br>
            <input type="submit" name="submit" value="Login" class="btn-login"><br><br><br>


        </form>

        <!-- Login form is ended here  -->


        <p class="text-center"> All rights reserved by <a href="#">Pranta Mazumder.</a></p>



    </div>

</body>

</html>


<?php

    // Check if the submit button is clicked

    if(isset($_POST['submit']))
    {

            // Process of login
            // 1. Get the values
            $username =  mysqli_real_escape_string($conn , $_POST['username']);

            /* Given methods are old  one and not secure in sql injection

            $username = $_POST['username']; 

            */

            $password = md5($_POST['password']);


            // 2. SQL query to check whether the user and password exists or not
            $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password' ";

            // 3. Execute the query

            $res = mysqli_query($conn , $sql);

            // Count rows for check the existence of user

            $count = mysqli_num_rows($res);

            if($count == 1)
            {


                    // Display message of successfully the login of user by session variable
                    $_SESSION['login-s'] = "<div class = 'success-small' > Successfully Login. </div>";
                    $_SESSION['user'] = $username; // Check wether user is logged in or not and logout will unset it

                            // Redirected into add admin page
                            header("location:".SITEURL.'admin/manage-admin.php');    


            }
            else
            {


                    // Display message of unsuccessfull to login by session variable
                    $_SESSION['login-u'] = "<div class = 'error-small' > Invailid username or password. </div>";
                            // Redirected into add admin page
                            header("location:".SITEURL.'admin/login.php');    



            }


    }




?>

    
<?php


// This page is secure from sql injection and also structured...


?>