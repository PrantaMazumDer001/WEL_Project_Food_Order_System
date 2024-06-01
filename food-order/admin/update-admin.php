<?php include('partials/menu.php') ?>
<div class="wrapper">
    <h1 class="text-center heading">This is admin data update site</h1>

    <br><br>


                <?php 
                        
                        if(isset($_SESSION['update-e']))
                        {  
                                
                                // Checking the variable is set

                                echo $_SESSION['update-e']; // Display the message
                                unset($_SESSION['update-e']); //Removing the message

                        }

                
                        
                    
                        

                        if(isset($_SESSION['admin-available']))
                        { 
                                
                                // Checking the variable is set

                                echo $_SESSION['admin-available']; // Display the message
                                unset($_SESSION['admin-available']); //Removing the message

                        }

                
                        
                ?>

    <br>
            <?php

                    // Wether passing id  is available or not

                if(isset($_GET['id']))
                {

                        $id =  mysqli_real_escape_string($conn ,  $_GET['id']);

                        /*
                            Given methods are old  one and not secure in sql injection

                        $id = $_GET['id'];

                        */


                        //Query to get all admin's information
                        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

                        // Eexecute the query
                        $res = mysqli_query($conn , $sql ) or die(mysqli_error());
                        // Check weather query is worked or not
                        if($res==TRUE)
                        {


                            $count = mysqli_num_rows($res); // Function to get all the rows from database

                            //  Check the number of rows 
                            if($count == 1)
                            {


                                    $_SESSION['admin-available'] = "<div class = 'success' > Available the admin. </div>";
                                    $rows = mysqli_fetch_assoc($res);
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];



    

                            
                            }
                            else
                            {

                                // echo "Admin is not available";
                                header('location:' .SITEURL.'admin/manage-admin.php');


                            }

                        }
                                        
                }
                else
                {
                    
                    // if data is not inserted then this message is shown
                    $_SESSION['unauthorization'] = "<div class = 'error' > Invalid arrgument passing. </div>";
                
                    // Redirected to manage-admin page

                    header("location:".SITEURL.'admin/manage-admin.php');    

                }



            ?>














    <br><br>

    <form action="" method="POST">


        <table class="tbl-form">
            <tr>
                <td>Full Name :</td>
                <td><input type="text" name="full_name" value="<?php echo $full_name  ?>"></td>
            </tr>
            <tr>
                <td>Usernamme :</td>
                <td><input type="text" name="username" value="<?php echo $username  ?>"></td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>

            <tr>
                <td colspan="2" class="text-center">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">


                    <input type="submit" name="submit" value="Update admin" class="btn-secondary">
                </td>
            </tr>
        </table>



    </form>

    <div class="clearfix"></div>


</div>

         <?php
            // Check the update button is weather clicked
            if(isset($_POST['submit']))
            {


                    // Get the updated values by POST method
                $id =  mysqli_real_escape_string($conn ,  $_POST['id']);
                $full_name =  mysqli_real_escape_string($conn ,  $_POST['full_name']); 
                $username =  mysqli_real_escape_string($conn ,  $_POST['username']);


                /*
                    Given methods are old  one and not secure in sql injection

                $id = $_POST['id'];
                $full_name = $_POST['full_name']; 
                $username = $_POST['username'];

                */


                // Update value in database 
                $sql = "UPDATE tbl_admin SET
                full_name = '$full_name',
                username = '$username'
                WHERE id = '$id'";
                $res = mysqli_query($conn , $sql)  or die(mysqli_error());


                if($res == true)
                {
                                        
                    // If update process is success than redirected to manage-admin page and show the success message
                    $_SESSION['update-s'] = "<div class = 'success' > Successfully update the admin. </div>";
                    // Redirected into add admin page
                    header("location:".SITEURL.'admin/manage-admin.php');    


                }
                else
                {

                    $_SESSION['update-e'] = " <div class = 'error' > Faild to update the admin . </div> ";
                    // Redirected into add admin page
                    header("location:".SITEURL.'admin/update-admin.php');    

                }

            }


         ?>



<?php include('partials/footer.php') ?>



    
<?php


// This page is secure from sql injection and also structured...


?>