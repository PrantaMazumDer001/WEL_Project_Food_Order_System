<?php include('partials/menu.php'); ?>


<div class="main-content">

    <div class="wrapper">
        <h1 class="text-center heading">This is food management page</h1>
        <br><br><br>
        <a href="add-food.php" class="btn-primary">Add food</a>

        <br><br><br>



        <?php
             
                     if(isset($_SESSION['food-s']))
                     {
                           
                           // Checking the variable is set

                           echo $_SESSION['food-s']; // Display the message
                           unset($_SESSION['food-s']); //Removing the message
                        
                      }

                                                         
                     if(isset($_SESSION['delete-food-image-u']))
                     {
                        
                           // Checking the variable is set

                           echo $_SESSION['delete-food-image-u']; // Display the message
                           unset($_SESSION['delete-food-image-u']); //Removing the message
                        
                           
                     }

                           
                     if(isset($_SESSION['food-delete-s']))
                     {
                           
                           // Checking the variable is set

                           echo $_SESSION['food-delete-s']; // Display the message
                           unset($_SESSION['food-delete-s']); //Removing the message
                        
                     }

                     if(isset($_SESSION['food-delete-u']))
                     {
                           
                           // Checking the variable is set

                           echo $_SESSION['food-delete-u']; // Display the message
                           unset($_SESSION['food-delete-u']); //Removing the message
                        
                     }

                     if(isset($_SESSION['unauthorization']))
                     {
                           
                           // Checking the variable is set

                           echo $_SESSION['unauthorization']; // Display the message
                           unset($_SESSION['unauthorization']); //Removing the message
                        
                     }

                     if(isset($_SESSION['update-food-u']))
                     {
                           
                           // Checking the variable is set

                           echo $_SESSION['update-food-u']; // Display the message
                           unset($_SESSION['update-food-u']); //Removing the message
                        
                     }

                     if(isset($_SESSION['update-food-e'])){  // Checking the variable is set

                        echo $_SESSION['update-food-e']; // Display the message
                        unset($_SESSION['update-food-e']); //Removing the message
                     }
                                          
                                 
                     if(isset($_SESSION['upload-image-u']))
                     {
                           
                           // Checking the variable is set

                           echo $_SESSION['upload-image-u']; // Display the message
                           unset($_SESSION['upload-image-u']); //Removing the message
                        
                     }
                              
                     if(isset($_SESSION['food-u-s']))
                     {
                           
                           // Checking the variable is set

                           echo $_SESSION['food-u-s']; // Display the message
                           unset($_SESSION['food-u-s']); //Removing the message
                        
                     }

                              
                     if(isset($_SESSION['food-u-u']))
                     {
                        
                           // Checking the variable is set

                           echo $_SESSION['food-u-u']; // Display the message
                           unset($_SESSION['food-u-u']); //Removing the message
                        
                     }

 






             ?>





        <br>

        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N. </th>
                <th> Title </th>
                <th>Image </th>
                <th>Price</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>


            </tr>

            <?php

                        //Query to get all admin's information
                        $sql = "SELECT * FROM tbl_food";

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
                                          while($rows = mysqli_fetch_assoc($res))
                                          {

                                                // Use while loop for getting all data from database and this loop is run as long as we have data in database
                                                //Get individual data
                                                $id = $rows['id'];
                                                $title = $rows['title'];
                                                $image_name = $rows['image_name'];
                                                $price = $rows['price'];

                                                $featured = $rows['featured'];
                                                $active = $rows['active'];

                                                // For display data as table format by HTML we break PHP 
                ?>

            <tr>
                <td> <?php echo $sn++; ?></td>
                <td> <?php echo $title; ?> </td>

                <td>
                    <?php 
                        // Process of showing image
                        // First , check the image is available or not by $image_name variable
                        if($image_name != "")
                        {

                           // If image is found then it shown
                           
                ?>
                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="55px" alt="">

                    <?php



                           }else{

                              // If image is not available then this error message is shown

                              
                    ?>
                    <div class="error-message">Image not found</div>

                    <?php
                        }
                        
                    ?>

                </td>

                <td> <?php echo $price; ?> </td>

                <td> <?php echo $featured; ?> </td>
                <td> <?php echo $active; ?> </td>


                <td>
                    <a href="<?php echo SITEURL; ?>/admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                        class="btn-secondary">Update</a>
                    <a href="<?php echo SITEURL; ?>/admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                        class="btn-denger">Delete</a>
                </td>

            </tr>



                  <?php

                        
                           }
                        }else{

                        // If there are not any user then this message is shown

                  ?>


            <tr>


                <td colspan="6">
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


<?php include('partials/footer.php'); ?>

    
<?php


// This page is secure from sql injection and also structured...


?>