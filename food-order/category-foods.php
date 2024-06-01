<?php

        include('partials-front/menu.php');

        if(isset($_GET['category_id']) && isset($_GET['category_title']) )
        {

                $category_id =  mysqli_real_escape_string($conn , $_GET['category_id']);
                $category_title =  mysqli_real_escape_string($conn , $_GET['category_title']);

                
            /*
                Given methods are old  one and not secure in sql injection

                $category_id = $_GET['category_id'];
                $category_title = $_GET['category_title'];

            */



        }
        else
        {

            
            // if data is not inserted then this message is shown
            $_SESSION['unauthrization'] = "<div class = 'error' > Invalid arrgument passing. </div>";
        
            // Redirected to manage-catagory page
            if($_GET['cp']==1)
            {

                 header("location:".SITEURL.'categories.php');   

            }
            else
            {

                 header("location:".SITEURL.'index.php');  

            }       
        }


?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods On <a href="#" class="text-white"><?php echo $category_title; ?> Category</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

            

                    // Create sql query to get the search data
                    $sql = "SELECT * FROM tbl_food WHERE catagory_id = $category_id ";

                    // Eexecute the query
                    $res = mysqli_query($conn , $sql ) or die(mysqli_error());

                        $count = mysqli_num_rows($res); // Function to get all the rows from database

                        //  Check the number of rows 
                        if($count>0)
                        {

                                                        
                                                // Food is avaiable
                            // We have data in database
                                    while($rows2 = mysqli_fetch_assoc($res))
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

</section>
<!-- fOOD Menu Section Ends Here -->

<?php

include('partials-front/footer.php');

?>





<?php


// This page is secure from sql injection and also structured...


?>