<?php

include('partials/menu.php');

?>




<?php
        ob_start();
        // Wether passing id  is available or not

        if(isset($_GET['id']))
        {

                // Get the value  and delete

            //  $id = $_GET['id']; it is old one and not secure in sql injection
            // With secure method where sql injection is not be able to perform
            $id = mysqli_real_escape_string($conn , $_GET['id']);


            // 2. Get data from database

            $sql2 = "SELECT * FROM tbl_order WHERE id = '$id'";

            $res2 = mysqli_query($conn , $sql2 ) or die(mysqli_error());

            $count2 = mysqli_num_rows($res2); // Function to get all the rows from database

                if($count2 == 1)
                {

                    //Get individual data

                    $rows = mysqli_fetch_assoc($res2);

                    $food = $rows['food'];
                    $price = $rows['price'];
                    $qty = $rows['qty'];
                    $total = $rows['total'];
                    $customer_name = $rows['customer_name'];
                    $customer_email = $rows['customer_email'];
                    $customer_contact = $rows['customer_contact'];
                    $customer_address = $rows['customer_address'];
                    $order_date = $rows['order_date'];
                    $status = $rows['status'];
                    

                }


?>




<div class="wrapper">
    <h1 class="text-center heading">This is food order update site </h1>

    <br><br>
     <?php

            if(isset($_SESSION['update_order_u']))
            { 
                    
                    // Checking the variable is set

                    echo $_SESSION['update_order_u']; // Display the message
                    unset($_SESSION['update_order_u']); //Removing the message
                    
            }
     ?>













     
    <br><br>


    <form action="" method="POST">


        <table class="tbl-form-category">
            <tr>
                <td> Food Name :</td>
                <td><input type="text" name="food" value="<?php echo $food ; ?>" class="input-responsive_order"></td>
            </tr>
            <tr>
                <td> Price ($) :</td>
                <td><input type="number" name="price" value="<?php echo $price ; ?>" class="input-responsive_order">
                </td>
            </tr>
            <tr>
                <td> Quantity :</td>
                <td><input type="number" name="qty" value="<?php echo $qty ; ?>" class="input-responsive_order"></td>
            </tr>
            <tr>
                <td> Customer Name :</td>
                <td><input type="text" name="customer_name" value="<?php echo $customer_name ; ?>"
                        class="input-responsive_order"></td>
            </tr>
            <tr>
                <td> Status :</td>
                <td>
                    <select name="status">

                        <option <?php if($status == "Ordered"){  echo "selected";} ?> value="Ordered">Ordered</option>
                        <option <?php if($status == "On delivery"){  echo "selected";} ?> value="On delivery">On
                            delivery</option>
                        <option <?php if($status == "Delivered"){  echo "selected";} ?> value="Delivered">Delivered
                        </option>
                        <option <?php if($status == "Cancelled"){  echo "selected";} ?> value="Cancelled">Cancelled
                        </option>





                    </select>
                </td>
            </tr>
            <tr>
                <td> Date :</td>
                <td><input type="text" name="date" value="<?php echo $order_date ; ?>" class="input-responsive_order">
                </td>
            </tr>
            <tr>
                <td> Contact :</td>
                <td>
                    <input type="tel" name="contact" value="<?php echo $customer_contact ; ?>"
                        class="input-responsive_order" required>

                </td>
            </tr>
            <tr>
                <td> Email :</td>
                <td>
                    <input type="email" name="email" value="<?php echo $customer_email ; ?>"
                        class="input-responsive_order" required>

                </td>
            </tr>
            <tr>
                <td> Address :</td>
                <td>
                    <textarea name="address" rows="10" class="input-responsive_order"
                        required> <?php echo $customer_address ; ?> </textarea>


                </td>
            </tr>



            <tr></tr>
            <tr></tr>
            <tr></tr>

            <tr>

                <td colspan="2" class="text-center">

                    <input type="hidden" name="id" value="<?php echo $id ; ?>">
                    <input type="submit" name="submit" value="Update" class="btn-primary">

                </td>
            </tr>
        </table>



    </form>

    <div class="clearfix"></div>


</div>
<br><br>
    <?php


            // Checked weather order button is clicked or not

            if(isset($_POST['submit']))
            {


                // Get all the details from form

                $id1 = mysqli_real_escape_string($conn ,  $_POST['id']);
                $food1 = mysqli_real_escape_string($conn ,  $_POST['food']);
                $price1 =  mysqli_real_escape_string($conn , $_POST['price']);
                $qty1 = mysqli_real_escape_string($conn ,  $_POST['qty']);
                $total1 = $price1 * $qty1;
                $order_date1 =  mysqli_real_escape_string($conn ,  $_POST['date']);
                $status1 =  mysqli_real_escape_string($conn ,  $_POST['status']); // Status are 'ordered' , 'on delivery' , 'delivered' and 'cancelled'

                $customer_name1 =  mysqli_real_escape_string($conn , $_POST['customer_name']);
                $customer_contact1 =  mysqli_real_escape_string($conn , $_POST['contact']);
                $customer_email1 =   mysqli_real_escape_string($conn , $_POST['email']);
                $customer_address1 =  mysqli_real_escape_string($conn , $_POST['address']);

                /* 

                Given methods are old  one and not secure in sql injection

                $id1 = $_POST['id'];
                $food1 = $_POST['food'];
                $price1 = $_POST['price'];
                $qty1 = $_POST['qty'];
                $total1 = $price1 * $qty1;
                $order_date1 =  $_POST['date'];
                $status1 =  $_POST['status']; // Status are 'ordered' , 'on delivery' , 'delivered' and 'cancelled'

                $customer_name1 = $_POST['customer_name'];
                $customer_contact1 = $_POST['contact'];
                $customer_email1 = $_POST['email'];
                $customer_address1 = $_POST['address'];
                  
                */

            




                // Now save the data into database

                // Create sql query to save the data into database 
                
                    $sql5 = "UPDATE tbl_order SET
                    food = '$food1',
                    price = '$price1',
                    qty = '$qty1',
                    total = '$total1',
                    order_date = '$order_date1',
                    status = '$status1',
                    customer_name = '$customer_name1',
                    customer_contact = '$customer_contact1',
                    customer_email = '$customer_email1',
                    customer_address = '$customer_address1'
                    WHERE id = $id1";

                    // Execute sql coomand 

                    $res5 = mysqli_query($conn , $sql5 ) or die(mysqli_error());

                    if($res5==true)
                                {
                                        // if data is inserted then this message is shown
                                    $_SESSION['update_order_s'] = "<div class = 'success' >Food order update successfully. </div>";
                                        // Redirected into category management page
                                        header("location:".SITEURL.'admin/manage-order.php');
                                        ob_end_flush();

                                }
                                else
                                {
                                    // if data is not inserted then this message is shown
                                    $_SESSION['update_order_u'] = "<div class = 'success' > Failed to update order . </div>";
                                    // Redirected into add category managment page
                                    header("location:".SITEURL.'admin/update_order.php');   
                                }








            }


    }else{

        // if data is not inserted then this message is shown
        $_SESSION['unauthorization'] = "<div class = 'error' > Invalid arrgument passing. </div>";
    
        // Redirected to manage-catagory page

        header("location:".SITEURL.'admin/manage-order.php');    


    }



?>


    
<?php


// This page is secure from sql injection and also structured...


?>