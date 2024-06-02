<?php include('partials/menu.php')
 ?>


<!--Main Content Starts -->


<div class="main-content">

    <div class="wrapper">
        <h1 class="text-center heading">This is admin management site</h1>
        <br><br>
        <?php 
             
             if(isset($_SESSION['add']))
             {
                  
                  // Checking the variable is set

                  echo $_SESSION['add']; // Display the message
                  unset($_SESSION['add']); //Removing the message

             }

             
             
             
         
            

             if(isset($_SESSION['delete']))
             {  
                  
                  // Checking the variable is set

                  echo $_SESSION['delete']; // Display the message
                  unset($_SESSION['delete']); //Removing the message
                  
             }

             if(isset($_SESSION['update-s']))
             {  
                  
                  // Checking the variable is set

                  echo $_SESSION['update-s']; // Display the message
                  unset($_SESSION['update-s']); //Removing the message
                  
             }

             if(isset($_SESSION['update-p-s']))
             { 
               
                  // Checking the variable is set

                  echo $_SESSION['update-p-s']; // Display the message
                  unset($_SESSION['update-p-s']); //Removing the message
                  
             }

             if(isset($_SESSION['update-p-se']))
             { 
                  
                  // Checking the variable is set

                  echo $_SESSION['update-p-se']; // Display the message
                  unset($_SESSION['update-p-se']); //Removing the message
                  
             }
             if(isset($_SESSION['update-pc-s']))
             { 
                  
                  // Checking the variable is set

                  echo $_SESSION['update-pc-s']; // Display the message
                  unset($_SESSION['update-pc-s']); //Removing the message

             }

             if(isset($_SESSION['update-p-e']))
             { 
                  
                  // Checking the variable is set

                  echo $_SESSION['update-p-e']; // Display the message
                  unset($_SESSION['update-p-e']); //Removing the message
                  
             }
             

             if(isset($_SESSION['login-s']))
             {  
                  
                  // Checking the variable is set

                  echo $_SESSION['login-s']; // Display the message
                  unset($_SESSION['login-s']); //Removing the message
                  
            }
            
            
            if(isset($_SESSION['unauthorization']))
            { 
                  
                  // Checking the variable is set

                  echo $_SESSION['unauthorization']; // Display the message
                  unset($_SESSION['unauthorization']); //Removing the message
                  
            }
            
             
        ?>







        <br><br>
        <br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br><br><br>
        <table class="tbl_full_admin">
            <tr>
                <th>S.N. :</th>
                <th>Full name</th>
                <th>Usernamme</th>
                <th>Active</th>

            </tr>


            <?php

                  //Query to get all admin's information
                  $sql = "SELECT * FROM tbl_admin";

                  // Eexecute the query
                  $res = mysqli_query($conn , $sql ) or die(mysqli_error());
                  // Check weather query is worked or not
                  if($res==TRUE)
                  {

                     $count = mysqli_num_rows($res); // Function to get all the rows from database

                     //  Check the number of rows 
                     if($count>0)
                     {




                           // Create a demo value and also initialize it
               
                                 $sn = 1;

                                    // We have data in database
                           while($rows = mysqli_fetch_assoc($res)){

                              // Use while loop for getting all data from database and this loop is run as long as we have data in database
                              //Get individual data
                              $id = $rows['id'];
                              $full_name = $rows['full_name'];
                              $username = $rows['username'];

                              // For display data as table format by HTML we break PHP 
            ?>
            <tr class="position_auto">
                <td> <?php echo $sn++; ?></td>
                <td> <?php echo $full_name; ?> </td>
                <td> <?php echo $username; ?> </td>
                <td>
                    <a href="<?php echo SITEURL; ?>/admin/update-password.php?id=<?php echo $id; ?>"
                        class="btn-primary">Change Password</a>
                    <a href="<?php echo SITEURL; ?>/admin/update-admin.php?id=<?php echo $id; ?>"
                        class="btn-secondary">Update</a>
                    <a href="<?php echo SITEURL; ?>/admin/delete-admin.php?id=<?php echo $id; ?>"
                        class="btn-denger">Delete</a>
                </td>

            </tr>



            <?php

                    
                        }
                    }else{

                     // If there are not any user then this message is shown
            ?>
            <tr>


                <td colspan="4">
                    <div class="error-small"> It's empty.</div>
                </td>



            </tr>
            <?php



                    }
                
                    




                }
            ?>










        </table>


        <div class="clearfix"></div>


    </div>
</div>


<!--Main Content End -->
<?php include('partials/footer.php') ?>



<?php


// This page is secure from sql injection and also structured...


?>