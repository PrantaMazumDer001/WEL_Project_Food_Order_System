
<?php include('partials/menu.php') ?>

<div class="wrapper">
    <h1 class="text-center heading">This is food order  adding site </h1>

    <br><br>
    <?php

            if(isset($_SESSION['food_order_u'])){  // Checking the variable is set

                            echo $_SESSION['food_order_u']; // Display the message
                            unset($_SESSION['food_order_u']); //Removing the message
                        
            }













    ?>
    <br><br>


    <form action="" method="POST" >


        <table class="tbl-form-category">
            <tr>
                <td> Food Name :</td>
                <td><input type="text" name="food" placeholder="Enter food name" class="input-responsive_order"></td>
            </tr>
            <tr>
                <td>  Price :</td>
                <td><input type="number" name="price" placeholder="Enter food price in US dollar" class="input-responsive_order"></td>
            </tr>
            <tr>
                <td>  Quantity :</td>
                <td><input type="number" name="qty" placeholder="Enter food quantity" class="input-responsive_order"></td>
            </tr>
            <tr>
                <td> Customer Name :</td>
                <td><input type="text" name="customer_name" placeholder="Enter customer name" class="input-responsive_order"></td>
            </tr>
            <tr>
                <td> Contact :</td>
                <td>
                <input type="tel" name="contact" placeholder="e.g. 9843xxxxxx" class="input-responsive_order" required>

                </td>
            </tr>
            <tr>
                <td> Email :</td>
               <td>
               <input type="email" name="email" placeholder="e.g. hi@PrantaMazumder.com" class="input-responsive_order" required>

               </td> 
            </tr>
            <tr>
                <td> Address :</td>
              <td>
              <textarea name="address" rows="10" placeholder="e.g. Street, City, Country" class="input-responsive_order" required></textarea>


              </td>  
            </tr>
            

          
            <tr></tr>
            <tr></tr>
            <tr></tr>

            <tr>
                <td colspan="2" class="text-center"><input type="submit" name="submit" value="Add order"
                        class="btn-primary"></td>
            </tr>
        </table>



    </form>

    <div class="clearfix"></div>


</div>
<br><br>

<?php

// Checked weather add order button is clicked or not
  if(isset($_POST['submit'])){


                    // Get all the details from form
                    $food = mysqli_real_escape_string($conn , $_POST['food']);
                    $price = mysqli_real_escape_string($conn , $_POST['price']);
                    $qty =  mysqli_real_escape_string($conn ,  $_POST['qty']);
                    $total = $price * $qty;
                    $order_date = date("y-m-d h:i:sa");
                    $status = "Ordered"; // Status are 'ordered' , 'on delivery' , 'delivered' and 'cancelled'

                    $customer_name =  mysqli_real_escape_string($conn , $_POST['customer_name']);
                    $customer_contact =  mysqli_real_escape_string($conn , $_POST['contact']);
                    $customer_email =  mysqli_real_escape_string($conn , $_POST['email']);
                    $customer_address =  mysqli_real_escape_string($conn ,  $_POST['address']);


                        /*
                            Given methods are old  one and not secure in sql injection

                            $food = $_POST['food'];
                            $price = $_POST['price'];
                            $qty = $_POST['qty'];
                            $total = $price * $qty;
                            $order_date = date("y-m-d h:i:sa");
                            $status = "Ordered"; // Status are 'ordered' , 'on delivery' , 'delivered' and 'cancelled'

                            $customer_name = $_POST['customer_name'];
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
                                $_SESSION['food_order_s'] = "<div class = 'success' >Food ordered add successfully. </div>";
                                    // Redirected into category management page
                                    header("location:".SITEURL.'admin/manage-order.php');    
                            
                        }
                        else
                        {
                            // if data is not inserted then this message is shown
                            $_SESSION['food_order_u'] = "<div class = 'success' > Failed to add food order and try again. </div>";
                            // Redirected into add category managment page
                            header("location:".SITEURL.'admin/add_order.php');    
                        }








       }







?>


<?php 


include('partials/footer.php')


?>



    
<?php


// This page is secure from sql injection and also structured...


?>