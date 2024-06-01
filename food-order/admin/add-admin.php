<?php include('partials/menu.php') ?>

<div class="wrapper">
    <h1 class="text-center heading">This is admin management site</h1>

    <br><br>
    <?php 
             
             if(isset($_SESSION['add'])){  // Checking the variable is set

                echo $_SESSION['add']; // Display the message
                unset($_SESSION['add']); //Removing the message
             }
             
             
    ?>

             <br><br>

    <form action="" method="POST">


        <table class="tbl-form">
            <tr>
                <td>Full Name :</td>
                <td><input type="text" name="full_name" placeholder="Enter admin name"></td>
            </tr>
            <tr>
                <td>Usernamme :</td>
                <td><input type="text" name="username" placeholder="Enter admin usernamme"></td>
            </tr>
            <tr>
                <td>Password :</td>
                <td><input type="password" name="password" placeholder="Enter admin password"></td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>

            <tr>
                <td colspan="2" class="text-center"><input type="submit" name="submit" value="Add admin"
                        class="btn-primary"></td>
            </tr>
        </table>



    </form>

    <div class="clearfix"></div>


</div>

<?php include('partials/footer.php') ?>

<?php

        // Process the value from form and save it in database

        // Check weather sumbmit button is clicked

        if(isset($_POST['submit'])){

                        // Button clicked
                        //1. Get the data from form
                        $full_name =  mysqli_real_escape_string($conn ,  $_POST['full_name']);
                        $username =  mysqli_real_escape_string($conn , $_POST['username']);
                        $password = md5($_POST['password']); // md5 make password encryption

                            /*

                                Given methods are old  one and not secure in sql injection

                                        
                                $full_name = $_POST['full_name'];
                                $username = $_POST['username'];
                                $password = md5($_POST['password']); // md5 make password encryption

                                */

                        //2. SQL query to save data in database


                        $sql = "INSERT INTO tbl_admin SET 
                        full_name = '$full_name',
                        username = '$username' ,
                        password  = '$password' ";

                        
                    // Execution of query and save to database

                        $res = mysqli_query($conn , $sql ) or die(mysqli_error());

                        // Check data is insertwd into database or not 

                    if($res==true)
                    {
                            // if data is inserted then this message is shown
                            $_SESSION['add'] = "<div class = 'success' > Admin added successfully . </div>";
                            // Redirected into admin management page
                            header("location:".SITEURL.'admin/manage-admin.php');
                            
                    }
                    else
                    {
                            // if data is not inserted then this message is shown
                            $_SESSION['add'] = "<div class = 'success' > Failed to add admin </div>";
                            // Redirected into add admin page
                            header("location:".SITEURL.'admin/add-admin.php');   
                            
                    }



        }

?>


    
<?php


// This page is secure from sql injection and also structured...


?>