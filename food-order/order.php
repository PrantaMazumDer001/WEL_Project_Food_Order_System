<?php

            include('partials-front/menu.php');

            // Check first food_id is set or not
            if(isset($_GET['food_id']))
            {

                    // Here food_id is available

                    //First , get yhe food_id
                    $food_id =  mysqli_real_escape_string($conn ,  $_GET['food_id']);


                    /*
                        Given methods are old  one and not secure in sql injection

                    $food_id = $_GET['food_id'];

                    */


                    // Create sql command to get data from database
                    $sql = "SELECT * FROM tbl_food WHERE id = $food_id";

                    // Eexecute the query
                    $res = mysqli_query($conn , $sql ) or die(mysqli_error());

                    $count = mysqli_num_rows($res); // Function to get all the rows from database

                    //  Check the number of rows 
                    if($count == 1)
                    {

                                        
                        // We have data in database
                        $rows = mysqli_fetch_assoc($res);

                        //Get individual data
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        $price = $rows['price'];
                    }
                    else
                    {

                        // Food item is not available
                        $_SESSION['food_item_not_available'] = "<div class = 'error' > Thid food item is not available and please , again start from home . </div>";

                        // Redirected to corresponding page
                        
                            header("location:".SITEURL.'index.php');  
        
                       }



            }
            else
            {


                // Here food_id is not available and show this message
                $_SESSION['unauthrization_food_order'] = "<div class = 'error' > There something wrong! Please , again start from home . </div>";

                // Redirected to corresponding page
                
                    header("location:".SITEURL.'index.php');   



            }

?>

<!-- Food Search Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">


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


                    <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                        class="img-responsive img-curve">


                    <?php
                                
                                    }

                            ?>


                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title;?> </h3>
                    <p class="food-price">$<?php echo $price;?></p>

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="e.g. Pranta Mazumder" class="input-responsive"
                    required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="e.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="e.g. hi@PrantaMazumder.com" class="input-responsive"
                    required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="e.g. Street, City, Country" class="input-responsive"
                    required></textarea>
                <input type="hidden" name="food" value="<?php echo $title; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>


        <?php

                                    // Checked weather order button is clicked or not

                                    if(isset($_POST['submit']))
                                    {


                                            // Get all the details from form
                                            $food =  mysqli_real_escape_string($conn ,  $_POST['food']);
                                            $price = mysqli_real_escape_string($conn ,  $_POST['price']);
                                            $qty = mysqli_real_escape_string($conn ,  $_POST['qty']);
                                            $total = $price * $qty;
                                            $order_date = date("y-m-d h:i:sa");
                                            $status = "Ordered"; // Status are 'ordered' , 'on delivery' , 'delivered' and 'cancelled'
                                            $customer_name =  mysqli_real_escape_string($conn , $_POST['full-name']);
                                            $customer_contact =  mysqli_real_escape_string($conn ,  $_POST['contact']);
                                            $customer_email =  mysqli_real_escape_string($conn , $_POST['email']);
                                            $customer_address =  mysqli_real_escape_string($conn , $_POST['address']);



                                                    /*
                                                        Given methods are old  one and not secure in sql injection

                                                    $food = $_POST['food'];
                                                    $price = $_POST['price'];
                                                    $qty = $_POST['qty'];
                                                    $total = $price * $qty;
                                                    $order_date = date("y-m-d h:i:sa");
                                                    $status = "Ordered"; // Status are 'ordered' , 'on delivery' , 'delivered' and 'cancelled'
                                                    $customer_name = $_POST['full-name'];
                                                    $customer_contact = $_POST['contact'];
                                                    $customer_email = $_POST['email'];
                                                    $customer_address = $_POST['address'];

                                                    */


                                            // Now save the data into database

                                            // Create sql query to save the data into database 
                                            
                                                $sql5 = "INSERT INTO tbl_order SET
                                                food = '$food',
                                                price = '$price',
                                                qty = '$qty',
                                                total = '$total',
                                                order_date = '$order_date',
                                                status = '$status',
                                                customer_name = '$customer_name',
                                                customer_contact = '$customer_contact',
                                                customer_email = '$customer_email',
                                                customer_address = '$customer_address'";

                                                // Execute sql coomand 

                                                $res5 = mysqli_query($conn , $sql5 ) or die(mysqli_error());

                                                if($res5==true)
                                                {

                                                    // if data is inserted then this message is shown
                                                    $_SESSION['order_s'] = "<div class = 'success' >Food ordered successfully. </div>";
                                                    // Redirected into category management page
                                                    header("location:".SITEURL.'index.php');
                                                    

                                                }
                                                else
                                                {
                                                                    
                                                    // if data is not inserted then this message is shown
                                                    $_SESSION['order_u'] = "<div class = 'success' > Failed to order . </div>";
                                                    // Redirected into add category managment page
                                                    header("location:".SITEURL.'index.php');   
                                
                                
                                                   }








                                    }

                            ?>






    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->


<?php

include('partials-front/footer.php');

?>




<?php


// This page is secure from sql injection and also structured...


?>