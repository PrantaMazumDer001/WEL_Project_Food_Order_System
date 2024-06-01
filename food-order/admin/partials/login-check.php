<?php


        // Checking login vailidity

        if(!isset($_SESSION['user'])){  
            
            

                            
                        // Display message of login in login.php by session variable
                        $_SESSION['login-no'] = "<div class = 'error-small' > To access , login first!</div>";
                        // Redirected into add admin page
                        header("location:".SITEURL.'admin/login.php');    


        }


?>


     
<?php


// This page is secure from sql injection and also structured...


?>