<?php include('partials/menu.php') ?>


<div class="main-content">

    <div class="wrapper_order">
        <h1 class="text-center heading_order">This is order management page</h1>
        <br><br>
                <?php

                                
                        if(isset($_SESSION['unauthorization']))
                        {
                            
                                // Checking the variable is set

                                echo $_SESSION['unauthorization']; // Display the message
                                unset($_SESSION['unauthorization']); //Removing the message

                        }
                                                
                        if(isset($_SESSION['delete_order_s']))
                        {
                                
                                // Checking the variable is set

                                echo $_SESSION['delete_order_s']; // Display the message
                                unset($_SESSION['delete_order_s']); //Removing the message

                        }

                                
                        if(isset($_SESSION['delete_order_u']))
                        {
                                
                                // Checking the variable is set

                                echo $_SESSION['delete_order_u']; // Display the message
                                unset($_SESSION['delete_order_u']); //Removing the message

                        }

                                
                        if(isset($_SESSION['food_order_s']))
                        {
                                
                                // Checking the variable is set

                                echo $_SESSION['food_order_s']; // Display the message
                                unset($_SESSION['food_order_s']); //Removing the message

                        }

                                
                        if(isset($_SESSION['update_order_s']))
                        {
                                
                                // Checking the variable is set

                                echo $_SESSION['update_order_s']; // Display the message
                                unset($_SESSION['update_order_s']); //Removing the message

                        }



                ?>

        <br><br><br>
        <a href="add_order.php" class="btn-primary">Add oreder</a>

        <br><br><br>

        <br>
        <table class="tbl-full-order">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>price ($)</th>
                <th>Quantity</th>
                <th>Total ($)</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>



            </tr>


            <?php


                    //Query to get all order's information
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // Here sort is applied for showing order by latest

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
                                            $food = $rows['food'];
                                            $price = $rows['price'];
                                            $qty = $rows['qty'];
                                            $total = $rows['total'];
                                            $status = $rows['status'];
                                            $customer_name = $rows['customer_name'];
                                            $customer_email = $rows['customer_email'];
                                            $customer_contact = $rows['customer_contact'];
                                            $customer_address = $rows['customer_address'];
                                            $order_date = $rows['order_date'];



                                            // For display data as table format by HTML we break PHP 
            ?>


            <tr>
                <td> <?php echo $sn++; ?></td>
                <td> <?php echo $food; ?> </td>
                <td> <?php echo $price; ?> </td>
                <td> <?php echo $qty; ?> </td>
                <td> <?php echo $total; ?> </td>
                <td> 
                    
                    <?php
               
                                
                                if($status == "Ordered"){
                                    echo "<div class = 'ordered'> $status </div>";

                                }

                                                
                                if($status == "Delivered"){
                                    echo "<div class = 'delivered'> $status </div>";

                                }
                                                
                                if($status == "On delivery"){
                                    echo "<div class = 'on_delivery'> $status </div>";

                                }
                                                
                                if($status == "Cancelled"){
                                    echo "<div class = 'cancelled'> $status </div>";

                                }
                                
                                




                    ?>

                </td>
                <td> <?php echo $order_date; ?> </td>
                <td> <?php echo $customer_name; ?> </td>
                <td> <?php echo $customer_contact; ?> </td>
                <td> <?php echo $customer_email; ?> </td>
                <td> <?php echo $customer_address; ?> </td>


                <td>
                    <a href="<?php echo SITEURL; ?>/admin/update_order.php?id=<?php echo $id; ?>"
                        class="btn-secondary">Update</a>
                    <a href="<?php echo SITEURL; ?>/admin/delete_order.php?id=<?php echo $id; ?>"
                        class="btn-denger">Delete</a>
                </td>

            </tr>



            <?php

                    
                        }
                    }else{

                    // If there are not any user then this message is shown
            ?>
            
            <tr>


                <td colspan="11">
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

<?php include('partials/footer.php') ?>

    
<?php


// This page is secure from sql injection and also structured...


?>