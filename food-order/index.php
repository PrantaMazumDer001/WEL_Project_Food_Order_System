<?php

include('partials-front/menu.php');

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search For Food and get related foods..." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <br>
        <?php 
                    
                    if(isset($_SESSION['unauthrization']))
                    {
                        
                        // Checking the variable is set

                        echo $_SESSION['unauthrization']; // Display the message
                        unset($_SESSION['unauthrization']); //Removing the message

                    }

                    if(isset($_SESSION['unauthrization_food_order']))
                    {
                        
                        // Checking the variable is set

                        echo $_SESSION['unauthrization_food_order']; // Display the message
                        unset($_SESSION['unauthrization_food_order']); //Removing the message
                    
                    }

                    if(isset($_SESSION['food_item_not_available']))
                    {
                        
                        // Checking the variable is set

                        echo $_SESSION['food_item_not_available']; // Display the message
                        unset($_SESSION['food_item_not_available']); //Removing the message
                    
                    }

                    if(isset($_SESSION['order_s']))
                    {
                        
                        // Checking the variable is set

                        echo $_SESSION['order_s']; // Display the message
                        unset($_SESSION['order_s']); //Removing the message
                    
                    }

                    if(isset($_SESSION['order_u']))
                    {
                        
                        // Checking the variable is set

                        echo $_SESSION['order_u']; // Display the message
                        unset($_SESSION['order_u']); //Removing the message
                    
                    }


                 ?>


        <br><br>

        <?php


                            // Create sql command to get data from database
                            $sql = "SELECT * FROM tbl_catagory WHERE featured = 'yes' AND active = 'yes' LIMIT 3";

                            // Eexecute the query
                            $res = mysqli_query($conn , $sql ) or die(mysqli_error());

                                $count = mysqli_num_rows($res); // Function to get all the rows from database

                                //  Check the number of rows 
                                if($count>0)
                                {


                                    // We have data in database
                                    while($rows = mysqli_fetch_assoc($res))
                                    {

                                        // Use while loop for getting all data from database and this loop is run as long as we have data in database
                                        //Get individual data
                                        $id = $rows['id'];
                                        $title = $rows['title'];
                                        $image_name = $rows['image_name'];

                 ?>


        <a href="category-foods.php?category_id=<?php echo $id; ?>&category_title=<?php echo $title; ?>">
            <div class="box-3 float-container">

                <?php
                        // First check the image is available or not

                        if($image_name == "")
                        {


                                // Show this error message

                                echo "<div class = 'error-message'>Image not found!</div>";

                        }
                        else
                        {


                ?>


                <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                    class="img-responsive img-curve">


                <?php
             
                     }

                ?>

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
        </a>

        <?php

                        
                                }
                            
                        }else{

                            // Show this error message

                            echo "<div class = 'error-message'>No category found!</div>";
                        }






                ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php


                            // Create sql command to get data from database
                            $sql2 = "SELECT * FROM tbl_food WHERE featured = 'yes' AND active = 'yes' LIMIT 6";

                            // Eexecute the query
                            $res2 = mysqli_query($conn , $sql2 ) or die(mysqli_error());

                                $count2 = mysqli_num_rows($res2); // Function to get all the rows from database

                                //  Check the number of rows 
                                if($count2 > 0)
                                {



                                        // We have data in database
                                        while($rows2 = mysqli_fetch_assoc($res2))
                                        {

                                            // Use while loop for getting all data from database and this loop is run as long as we have data in database
                                            //Get individual data
                                            $id2 = $rows2['id'];
                                            $title2 = $rows2['title'];
                                            $price2 = $rows2['price'];
                                            $description2 = $rows2['description'];
                                            $image_name2 = $rows2['image_name'];

                            
                            
                ?>


        <div class="food-menu-box">
            <div class="food-menu-img">

                <?php
                        // First check the image is available or not

                        if($image_name2 == "")
                        {


                                // Show this error message

                                echo "<div class = 'error-message'>Image not found!</div>";


                        }
                        else
                        {


                ?>


                <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name2; ?>" alt="<?php echo $title2; ?>"
                    class="img-responsive img-curve">

                <?php

                      }

                ?>


            </div>

            <div class="food-menu-desc">
                <h4><?php echo $title2; ?></h4>
                <p class="food-price"><?php echo $price2; ?></p>
                <p class="food-detail">
                    <?php echo $description2; ?>
                </p>
                <br>

                <a href="order.php?food_id=<?php echo $id2; ?>" class="btn btn-primary">Order Now</a>
            </div>
        </div>


        <?php

                            
                                    }
                                
                            }else{

                                // Show this error message

                                echo "<div class = 'error-message'>No food found!</div>";
                            }






                ?>
        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="foods.php">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->


<?php

include('partials-front/footer.php');

?>


<?php


// This page is secure from sql injection and also structured...


?>