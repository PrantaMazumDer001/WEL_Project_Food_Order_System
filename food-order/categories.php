<?php

include('partials-front/menu.php');

?>


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
            ?>
        <br><br>

            <?php

                        // Show all the data from database

                        // First create sql command for get all the data
                        $sql = "SELECT * FROM tbl_catagory WHERE active = 'yes'";

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



        <a href="category-foods.php?category_id=<?php echo $id; ?>&category_title=<?php echo $title; ?>&cp=1">
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
                <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" alt="Pizza"
                    class="img-responsive img-curve">


            <?php

                }

            ?>
                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>




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

<?php

include('partials-front/footer.php');

?>

   
<?php


// This page is secure from sql injection and also structured...


?>